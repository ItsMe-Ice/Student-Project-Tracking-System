<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Get project deadlines for the calendar.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getDeadlines(Request $request)
    {
        $user = auth()->user();
        
        // Get projects based on user role
        if ($user->role === 'admin') {
            // Admin can see all projects
            $projects = Project::whereNotNull('end_date')
                ->with('user')
                ->get();
        } elseif ($user->role === 'teacher') {
            // Teacher can only see projects assigned to their students
            $projects = Project::whereNotNull('end_date')
                ->where('teacher_id', $user->id)
                ->with('user')
                ->get();
        } else {
            // Student can only see their own projects
            $projects = Project::whereNotNull('end_date')
                ->where('user_id', $user->id)
                ->with('user')
                ->get();
        }

        // Format the data for the calendar
        $deadlines = $projects->map(function ($project) {
            return [
                'id' => $project->id,
                'title' => $project->title,
                'date' => $project->end_date->format('Y-m-d'),
                'status' => $project->status,
                'student_name' => $project->user->name,
            ];
        });

        return response()->json($deadlines);
    }
}