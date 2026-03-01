<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class StudentController extends Controller
{
    /**
     * Show the student registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Register a new student.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'student_id' => ['required', 'string', 'max:50', 'unique:users'],
            'department' => ['required', 'string', 'max:100'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
            'student_id' => $request->student_id,
            'department' => $request->department,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registration successful!');
    }

    /**
     * Show the teacher promotion form (admin only).
     */
    public function showPromotionForm()
    {
        $students = User::where('role', 'student')->get();
        return view('admin.promote', compact('students'));
    }

    /**
     * Promote a student to teacher.
     */
    public function promoteToTeacher(Request $request)
    {
        $request->validate([
            'student_id' => ['required', 'exists:users,id'],
            'promotion_reason' => ['required', 'string', 'max:255'],
        ]);

        $student = User::findOrFail($request->student_id);

        if ($student->role !== 'student') {
            return back()->with('error', 'This user is not a student.');
        }

        $student->update([
            'role' => 'teacher',
        ]);

        return back()->with('success', 'Student promoted to teacher successfully!');
    }

    /**
     * Show all users for admin management.
     */
    public function showUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    /**
     * Show the teacher assignment form (admin only).
     */
    public function showAssignmentForm()
    {
        $students = User::where('role', 'student')->get();
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.assign-teachers', compact('students', 'teachers'));
    }

    /**
     * Assign a teacher to a student.
     */
    public function assignTeacher(Request $request)
    {
        $request->validate([
            'student_id' => ['required', 'exists:users,id'],
            'teacher_id' => ['required', 'exists:users,id'],
        ]);

        $student = User::findOrFail($request->student_id);
        $teacher = User::findOrFail($request->teacher_id);

        if ($student->role !== 'student') {
            return back()->with('error', 'Selected user is not a student.');
        }

        if ($teacher->role !== 'teacher') {
            return back()->with('error', 'Selected user is not a teacher.');
        }

        // Assign teacher to student's projects
        $student->projects()->update(['teacher_id' => $teacher->id]);

        return back()->with('success', 'Teacher assigned to student successfully!');
    }
}
