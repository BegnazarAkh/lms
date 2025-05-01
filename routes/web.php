<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Teacher\SubjectController as TSubjectController;
use App\Http\Controllers\Teacher\TaskController     as TTaskController;
use App\Http\Controllers\Teacher\SolutionController as TSolutionController;
use App\Http\Controllers\Student\SubjectController as SSubjectController;
use App\Http\Controllers\Student\TaskController     as STaskController;
use App\Http\Controllers\Student\SolutionController as SSolutionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Student\SubjectController as StudentSubjectController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::resource('subjects', Teacher\SubjectController::class);
    Route::resource('subjects.tasks', Teacher\TaskController::class);
    Route::get('solutions/{solution}', [Teacher\SolutionController::class, 'show'])->name('solutions.show');
    // etc.
});

Route::middleware(['auth', 'student'])->prefix('student')->name('student.')->group(function () {
    Route::get('subjects', [Student\SubjectController::class, 'index'])->name('subjects.index');
    Route::post('subjects/{subject}/enroll', [Student\SubjectController::class, 'enroll'])->name('subjects.enroll');
    Route::resource('subjects.tasks', Student\TaskController::class)->only(['index', 'show']);
    Route::resource('subjects.tasks.solutions', Student\SolutionController::class)->only(['store']);
    // etc.
});

Route::middleware(['auth', 'teacher'])
     ->prefix('teacher')
     ->name('teacher.')
     ->group(function () {
    // Subjects CRUD
    Route::resource('subjects', TSubjectController::class);

    // Tasks nested under subjects
    Route::resource(
        'subjects.tasks',
        TTaskController::class
    )->shallow();

    // View & evaluate individual solutions
    Route::get('solutions/{solution}', [TSolutionController::class, 'show'])
         ->name('solutions.show');
    Route::post('solutions/{solution}/evaluate', [TSolutionController::class, 'evaluate'])
         ->name('solutions.evaluate');
});

Route::middleware(['auth','student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
        // List available/enrolled subjects
        // Note: this single resource generates student.subjects.index and student.subjects.show
        Route::resource('subjects', SSubjectController::class)
            ->only(['index','show']);

        // Enroll / Leave (separate because they’re not standard RESTful)
        Route::post('subjects/{subject}/enroll', [SSubjectController::class, 'enroll'])
             ->name('subjects.enroll');
        Route::post('subjects/{subject}/leave', [SSubjectController::class, 'leave'])
             ->name('subjects.leave');

        // View tasks & submit solutions
        Route::get('subjects/{subject}/tasks', [STaskController::class, 'index'])
             ->name('subjects.tasks.index');
        Route::get('tasks/{task}', [STaskController::class, 'show'])
             ->name('tasks.show');
        Route::post('tasks/{task}/solutions', [SSolutionController::class, 'store'])
             ->name('tasks.solutions.store');
    });

require __DIR__.'/auth.php';
