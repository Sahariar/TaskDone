<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SuperAdmin\SaProjectController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Spatie\Permission\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});
Route::middleware(['auth', RoleMiddleware::class.':super-admin'])->group(function () {
    // Super-Admin routes
    Route::get('/projects', [SaProjectController::class, 'index'])->name('projects.index');

});

Route::middleware(['auth', RoleMiddleware::class.':project-manager'])->group(function () {
    // project-manager routes
    // Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');

});


require __DIR__.'/auth.php';
