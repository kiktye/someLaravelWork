<?php

use App\Http\Controllers\DuelController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TeamController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return view('welcome');
});

Route::get('/matches', [DuelController::class, 'index'])->name('matches.index')->middleware('auth');


Route::middleware(Admin::class)->group(function () {
    // Team
    Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
    Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
    Route::get('/teams{team}', [TeamController::class, 'show'])->name('teams.show');
    Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');
    Route::get('/teams/{team}/edit', [TeamController::class, 'edit'])->name('teams.edit');
    Route::put('/teams/{team}', [TeamController::class, 'update'])->name('teams.update');
    Route::delete('/teams/{team}', [TeamController::class, 'destroy'])->name('teams.destroy');

    // Player
    Route::get('/players', [PlayerController::class, 'index'])->name('players.index');
    Route::get('/players/create', [PlayerController::class, 'create'])->name('players.create');
    Route::get('/players/{player}', [PlayerController::class, 'show'])->name('players.show');
    Route::post('/players', [PlayerController::class, 'store'])->name('players.store');
    Route::get('/players/{player}/edit', [PlayerController::class, 'edit'])->name('players.edit');
    Route::put('/players/{player}', [PlayerController::class, 'update'])->name('players.update');
    Route::delete('/players/{player}', [PlayerController::class, 'destroy'])->name('players.destroy');

    // Match
    Route::post('/matches', [DuelController::class, 'store'])->name('matches.store');
    Route::get('/matches/create', [DuelController::class, 'create'])->name('matches.create');
    Route::get('/matches/{match}/edit', [DuelController::class, 'edit'])->name('matches.edit');
    Route::put('/matches/{match}', [DuelController::class, 'update'])->name('matches.update');
    Route::delete('/matches/{match}', [DuelController::class, 'destroy'])->name('matches.destroy');
    Route::get('/matches/{match}', [DuelController::class, 'show'])->name('matches.show')->middleware('auth')->withoutMiddleware(Admin::class);
});


Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});

Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');
