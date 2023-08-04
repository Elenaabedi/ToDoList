<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Welcome: the user can acces to the login or register page
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// When user has been log, he can access to the to do list history
/* Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');  */

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/language/{lang}', [ProfileController::class, 'setLanguage'])->name('proflie.setLanguage');

    // PATHS FOR ADDED CONTROLLERS
    // TASK CONTROLLER
    Route::get('/dashboard', [TaskController::class, 'list'])->name('dashboard');
    Route::post('/dashboard/store', [TaskController::class, 'store'])->name('dashboard.store');
    Route::get('/dashboard/edit/{id}', [TaskController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/update/{id}', [TaskController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/delete/{id}', [TaskController::class, 'delete'])->name('dashboard.delete'); 

});


// Auth properties
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
