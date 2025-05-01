<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

// Teacher Controllers
use App\Http\Controllers\Teacher\SubjectController as TSubjectController;
use App\Http\Controllers\Teacher\TaskController    as TTaskController;
use App\Http\Controllers\Teacher\SolutionController as TSolutionController;

// Student Controllers
use App\Http\Controllers\Student\SubjectController  as SSubjectController;
use App\Http\Controllers\Student\TaskController     as STaskController;
use App\Http\Controllers\Student\SolutionController as SSolutionController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

/*
|--------------------------------------------------------------------------
| Authenticated & Profile
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))
         ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])
         ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
         ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
         ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'teacher'])
     ->prefix('teacher')
     ->name('teacher.')
     ->group(function () {
    // Subjects CRUD
    Route::resource('subjects', TSubjectController::class);

    // Tasks nested under subjects
    Route::resource('subjects.tasks', TTaskController::class)
         ->shallow();

    // View & evaluate individual solutions
    Route::get('solutions/{solution}', [TSolutionController::class, 'show'])
         ->name('solutions.show');
    Route::post('solutions/{solution}/evaluate', [TSolutionController::class, 'evaluate'])
         ->name('solutions.evaluate');
});

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'student'])
     ->prefix('student')
     ->name('student.')
     ->group(function () {
    // List & show subjects
    Route::resource('subjects', SSubjectController::class)
         ->only(['index','show']);

    // Enroll / Leave
    Route::post('subjects/{subject}/enroll', [SSubjectController::class, 'enroll'])
         ->name('subjects.enroll');
    Route::post('subjects/{subject}/leave', [SSubjectController::class, 'leave'])
         ->name('subjects.leave');

    // List & view tasks
    Route::get('subjects/{subject}/tasks', [STaskController::class, 'index'])
         ->name('subjects.tasks.index');
    Route::get('tasks/{task}', [STaskController::class, 'show'])
         ->name('tasks.show');

    // Submit & view solutions
    Route::post('tasks/{task}/solutions', [SSolutionController::class, 'store'])
         ->name('solutions.store');
    Route::get('solutions/{solution}', [SSolutionController::class, 'show'])
         ->name('solutions.show');
});

require __DIR__.'/auth.php';
