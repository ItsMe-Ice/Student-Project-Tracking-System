<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            $projects = Project::with(['user', 'teacher'])->paginate(10);
        } elseif ($user->role === 'teacher') {
            $projects = Project::where('teacher_id', $user->id)
                ->orWhere('user_id', $user->id)
                ->with(['user', 'teacher'])
                ->paginate(10);
        } else {
            $projects = Project::where('user_id', $user->id)
                ->with(['user', 'teacher'])
                ->paginate(10);
        }

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'teacher_id' => ['nullable', 'exists:users,id,role,teacher'],
        ]);

        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_id' => Auth::id(),
            'teacher_id' => $request->teacher_id,
            'status' => 'pending',
        ]);

        return redirect()->route('projects.index')->with('success', 'Project created successfully!');
    }

    /**
     * Display the specified project.
     */
    public function show(Project $project)
    {
        $this->authorizeProjectAccess($project);
        
        // Load comments with user information and replies
        $project->load([
            'comments' => function ($query) {
                $query->with(['user', 'replies.user'])
                      ->whereNull('parent_id')
                      ->orderBy('created_at', 'asc'); // Changed from 'desc' to 'asc' to show oldest first
            },
            'documents' => function ($query) {
                $query->with(['user']);
            }
        ]);
        
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project)
    {
        $this->authorizeProjectAccess($project);
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, Project $project)
    {
        $this->authorizeProjectAccess($project);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'status' => ['required', 'string', 'in:pending,in_progress,completed,cancelled'],
        ]);

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project)
    {
        $this->authorizeProjectAccess($project);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully!');
    }

    /**
     * Authorize project access based on user role.
     */
    private function authorizeProjectAccess(Project $project)
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

    /**
     * Upload a document for a project.
     */
    public function uploadDocument(Request $request, Project $project)
    {
        $this->authorizeProjectAccess($project);

        $validator = Validator::make($request->all(), [
            'file' => ['required', 'file', 'max:10240', 'mimes:pdf,doc,docx,txt,png,jpg,jpeg'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $mimeType = $file->getMimeType();
        $size = $file->getSize();

        // Generate unique filename
        $filename = time() . '_' . uniqid() . '.' . $extension;
        $path = $file->storeAs('projects/' . $project->id . '/documents', $filename, 'public');

        $document = Document::create([
            'project_id' => $project->id,
            'user_id' => Auth::id(),
            'title' => $request->title,
            'file_path' => $path,
            'file_name' => $originalName,
            'file_size' => $size,
            'file_type' => $mimeType,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Document uploaded successfully!');
    }

    /**
     * Delete a document.
     */
    public function deleteDocument(Project $project, Document $document)
    {
        $this->authorizeProjectAccess($project);

        // Check if the document belongs to this project
        if ($document->project_id !== $project->id) {
            return redirect()->back()->with('error', 'Document not found.');
        }

        // Check if the user owns this document (for students) or is admin/teacher
        $user = Auth::user();
        if ($user->role === 'student' && $document->user_id !== $user->id) {
            return redirect()->back()->with('error', 'You can only delete your own documents.');
        }

        // Delete file from storage
        if (Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return redirect()->back()->with('success', 'Document deleted successfully!');
    }

    /**
     * Show the form for assigning a teacher to a project.
     */
    public function showAssignForm(Project $project)
    {
        $this->authorizeProjectAccess($project);
        
        // Only teachers and admins can assign teachers
        $user = Auth::user();
        if ($user->role !== 'teacher' && $user->role !== 'admin') {
            abort(403);
        }

        // Get all teachers for the dropdown
        $teachers = \App\Models\User::where('role', 'teacher')->get();

        return view('projects.assign', compact('project', 'teachers'));
    }

    /**
     * Assign a teacher to a project.
     */
    public function assignTeacher(Request $request, Project $project)
    {
        $this->authorizeProjectAccess($project);
        
        // Only teachers and admins can assign teachers
        $user = Auth::user();
        if ($user->role !== 'teacher' && $user->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'teacher_id' => ['required', 'exists:users,id,role,teacher'],
        ]);

        $project->update([
            'teacher_id' => $request->teacher_id,
        ]);

        return redirect()->route('projects.index')->with('success', 'Teacher assigned successfully!');
    }

    /**
     * Download a document.
     */
    public function downloadDocument(Project $project, Document $document)
    {
        $this->authorizeProjectAccess($project);

        // Check if the document belongs to this project
        if ($document->project_id !== $project->id) {
            abort(404);
        }

        // Check permissions for students
        $user = Auth::user();
        if ($user->role === 'student') {
            // Students can download their own documents and documents from their teacher
            $canDownload = $document->user_id === $user->id || $project->teacher_id === $user->id;
            if (!$canDownload) {
                abort(403);
            }
        }

        $path = storage_path('app/public/' . $document->file_path);
        
        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path, $document->file_name);
    }
}
