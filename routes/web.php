<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SuperAdmin\SaProjectController;
use App\Http\Controllers\TasksController;
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
    Route::get('admin/dashboard', [SaProjectController::class, 'dashboard'])->name('dashboard');
    Route::get('admin/projects', [SaProjectController::class, 'index'])->name('admin.projects.index');
    Route::get('admin/projects/{project}', [SaProjectController::class, 'show'])->name('admin.projects.show');
    Route::get('admin/tasks', [SaProjectController::class, 'tasks'])->name('admin.tasks.index');
    Route::get('admin/tasks/{task}', [SaProjectController::class, 'taskshow'])->name('admin.tasks.show');
});

Route::middleware(['auth', RoleMiddleware::class.':project-manager|admin'])->group(function () {
    // project-manager routes
    Route::resource('projects', ProjectController::class)->names([
        'index' => 'projects.index',
        'show' => 'projects.show',
        'create' => 'projects.create',
        'store' => 'projects.store',
        'edit' => 'projects.edit',
        'update' => 'projects.update',
        'destroy' => 'projects.destroy',
    ]);
    Route::resource('tasks', TasksController::class)->names([
        'index' => 'tasks.index',
        'show' => 'tasks.show',
        'create' => 'tasks.create',
        'store' => 'tasks.store',
        'edit' => 'tasks.edit',
        'update' => 'tasks.update',
        'destroy' => 'tasks.destroy',
    ]);
});


require __DIR__.'/auth.php';
