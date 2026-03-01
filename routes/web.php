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

    // Document routes for file uploads
    Route::prefix('projects/{project}')->name('projects.')->group(function () {
        Route::post('documents', [ProjectController::class, 'uploadDocument'])->name('documents.store');
        Route::delete('documents/{document}', [ProjectController::class, 'deleteDocument'])->name('documents.destroy');
        Route::get('documents/{document}/download', [ProjectController::class, 'downloadDocument'])->name('documents.download');
    });
});

require __DIR__.'/auth.php';
