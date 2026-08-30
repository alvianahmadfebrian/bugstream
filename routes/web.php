<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BugController;

use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        $user = auth()->user();
        if ($user->role === 'developer') {
            return redirect()->route('bugs');
        }
        $query = \App\Models\Bug::query();
        if ($user->role === 'support_dev') {
            $query->where('reporter_id', $user->id);
        }
        $recentBugs = $query->orderBy('created_at', 'desc')->take(5)->get();
        return view('dashboard', compact('recentBugs'));
    })->name('dashboard');

    Route::get('/bugs', [BugController::class, 'index'])->name('bugs');
    Route::get('/bugs/create', [BugController::class, 'create'])->name('bugs.create');
    Route::post('/bugs', [BugController::class, 'store'])->name('bugs.store');
    Route::get('/bugs/{bug}', [BugController::class, 'show'])->name('bugs.show');
    Route::patch('/bugs/{bug}/status', [BugController::class, 'updateStatus'])->name('bugs.status.update');
    Route::get('/reports', function () {
        if (auth()->user()->role === 'developer') {
            return redirect()->route('bugs');
        }
        return view('reports');
    })->name('reports');

    Route::get('/settings', [ProfileController::class, 'edit'])->name('settings');
    Route::patch('/settings/profile', [ProfileController::class, 'updateProfile'])->name('settings.profile.update');
    Route::put('/settings/password', [ProfileController::class, 'updatePassword'])->name('settings.password.update');
    Route::resource('users', \App\Http\Controllers\UserController::class);

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});
