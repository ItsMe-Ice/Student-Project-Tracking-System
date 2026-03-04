<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, Project $project)
    {
        // Only teachers and students can comment
        $user = Auth::user();
        if ($user->role !== 'teacher' && $user->role !== 'student') {
            return redirect()->back()->with('error', 'You do not have permission to comment.');
        }

        // Check if user has access to this project
        if (!$this->hasProjectAccess($project)) {
            return redirect()->back()->with('error', 'You do not have access to this project.');
        }

        $request->validate([
            'content' => ['required', 'string', 'max:1000'],
            'comment_type' => ['required', 'string', 'in:general,feedback,question,answer'],
            'parent_id' => ['nullable', 'exists:comments,id'],
            'document_id' => ['nullable', 'exists:documents,id'],
        ]);

        // Check if this is a reply to an existing comment
        $parentId = $request->parent_id;
        
        if ($parentId) {
            $parentComment = Comment::find($parentId);
            if (!$parentComment || $parentComment->project_id !== $project->id) {
                return redirect()->back()->with('error', 'Invalid parent comment.');
            }
        }

        // Check if commenting on a document
        $documentId = $request->document_id;

        Comment::create([
            'project_id' => $project->id,
            'document_id' => $documentId,
            'user_id' => $user->id,
            'content' => $request->content,
            'comment_type' => $request->comment_type,
            'parent_id' => $parentId,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    /**
     * Update the specified comment in storage.
     */
    public function update(Request $request, Project $project, Comment $comment)
    {
        // Only the comment author can edit their comment
        if ($comment->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You can only edit your own comments.');
        }

        // Ensure comment belongs to this project
        if ($comment->project_id !== $project->id) {
            return redirect()->back()->with('error', 'Comment not found.');
        }

        $request->validate([
            'content' => ['required', 'string', 'max:1000'],
            'comment_type' => ['required', 'string', 'in:general,feedback,question,answer'],
        ]);

        $comment->update([
            'content' => $request->content,
            'comment_type' => $request->comment_type,
        ]);

        return redirect()->back()->with('success', 'Comment updated successfully!');
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(Project $project, Comment $comment)
    {
        // Check permissions: comment author, teacher, or admin can delete
        $user = Auth::user();
        $canDelete = false;

        if ($user->role === 'admin') {
            $canDelete = true;
        } elseif ($user->role === 'teacher') {
            // Teacher can delete any comment on projects they're assigned to
            $canDelete = $project->teacher_id === $user->id;
        } else {
            // Student can only delete their own comments
            $canDelete = $comment->user_id === $user->id;
        }

        if (!$canDelete) {
            return redirect()->back()->with('error', 'You do not have permission to delete this comment.');
        }

        // Ensure comment belongs to this project
        if ($comment->project_id !== $project->id) {
            return redirect()->back()->with('error', 'Comment not found.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }

    /**
     * Check if the authenticated user has access to the project.
     */
    private function hasProjectAccess(Project $project): bool
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return true;
        }

        if ($user->role === 'teacher') {
            return $project->teacher_id === $user->id || $project->user_id === $user->id;
        }

        return $project->user_id === $user->id;
    }
}