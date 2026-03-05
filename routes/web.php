<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Admin routes
    Route::middleware(['checkRole:admin'])->group(function () {
        Route::get('/admin/users', [StudentController::class, 'showUsers'])->name('admin.users');
        Route::get('/admin/promote', [StudentController::class, 'showPromotionForm'])->name('admin.promote');
        Route::post('/admin/promote', [StudentController::class, 'promoteToTeacher'])->name('admin.promote.store');
        Route::get('/admin/assign-teachers', [StudentController::class, 'showAssignmentForm'])->name('admin.assign.teachers');
        Route::post('/admin/assign-teachers', [StudentController::class, 'assignTeacher'])->name('admin.assign.teachers.store');
    });

    // Project routes
    Route::resource('projects', ProjectController::class);

    // Project assignment route
    Route::get('projects/{project}/assign', [ProjectController::class, 'showAssignForm'])->name('projects.assign');
    Route::post('projects/{project}/assign', [ProjectController::class, 'assignTeacher'])->name('projects.assign.store');

    // Document routes for file uploads
    Route::prefix('projects/{project}')->name('projects.')->group(function () {
        Route::post('documents', [ProjectController::class, 'uploadDocument'])->name('documents.store');
        Route::delete('documents/{document}', [ProjectController::class, 'deleteDocument'])->name('documents.destroy');
        Route::get('documents/{document}/download', [ProjectController::class, 'downloadDocument'])->name('documents.download');
    });

    // Document-specific routes for viewing and commenting
    Route::prefix('projects/{project}/documents/{document}')->name('projects.documents.')->group(function () {
        Route::get('/', [DocumentController::class, 'show'])->name('show');
        Route::post('comments', [DocumentController::class, 'storeComment'])->name('comments.store');
        Route::put('comments/{comment}', [DocumentController::class, 'updateComment'])->name('comments.update');
        Route::delete('comments/{comment}', [DocumentController::class, 'destroyComment'])->name('comments.destroy');
    });

    // Comment routes
    Route::prefix('projects/{project}')->name('projects.')->group(function () {
        Route::post('comments', [\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
        Route::put('comments/{comment}', [\App\Http\Controllers\CommentController::class, 'update'])->name('comments.update');
        Route::delete('comments/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');
    });
});

require __DIR__.'/auth.php';
