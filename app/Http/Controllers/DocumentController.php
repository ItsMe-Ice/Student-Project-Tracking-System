<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Project;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    /**
     * Display the specified document with its comments.
     */
    public function show(Project $project, Document $document)
    {
        // Check if the document belongs to the project
        if ($document->project_id !== $project->id) {
            abort(404);
        }

        // Check if user has access to this project
        if (!$this->hasProjectAccess($project)) {
            abort(403, 'You do not have access to this project.');
        }

        // Load comments for this document with user information
        $comments = $document->comments()
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('documents.show', compact('project', 'document', 'comments'));
    }

    /**
     * Store a newly created comment for the document.
     */
    public function storeComment(Request $request, Project $project, Document $document)
    {
        // Check if the document belongs to the project
        if ($document->project_id !== $project->id) {
            abort(404);
        }

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
        ]);

        Comment::create([
            'project_id' => $project->id,
            'document_id' => $document->id,
            'user_id' => $user->id,
            'content' => $request->content,
            'comment_type' => $request->comment_type,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    /**
     * Update the specified comment.
     */
    public function updateComment(Request $request, Project $project, Document $document, Comment $comment)
    {
        // Verify comment belongs to this document and project
        if ($comment->document_id !== $document->id || $comment->project_id !== $project->id) {
            abort(404);
        }

        // Only the comment author can edit their comment
        if ($comment->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You can only edit your own comments.');
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
     * Remove the specified comment.
     */
    public function destroyComment(Project $project, Document $document, Comment $comment)
    {
        // Verify comment belongs to this document and project
        if ($comment->document_id !== $document->id || $comment->project_id !== $project->id) {
            abort(404);
        }

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