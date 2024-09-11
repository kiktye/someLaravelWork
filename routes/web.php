<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Approved;
use App\Http\Middleware\CommentOwnership;
use App\Http\Middleware\Ownership;
use Illuminate\Support\Facades\Route;

Route::get('/', [DiscussionController::class, 'index'])->name('discussions.index');

Route::middleware('auth')->group(function () {
    // Auth discussion
    Route::get('/discussions/unapproved', [DiscussionController::class, 'unapproved'])
        ->name('discussions.unapproved')
        ->middleware(Admin::class);

    Route::get('/discussions/approve/{discussion}', [DiscussionController::class, 'approve'])
        ->name('discussions.approve')
        ->middleware(Admin::class);

    Route::get('/discussions/create', [DiscussionController::class, 'create'])
        ->name('discussions.create');

    Route::post('/discussions', [DiscussionController::class, 'store'])
        ->name('discussions.store');

    Route::get('/discussions/{discussion}/edit', [DiscussionController::class, 'edit'])
        ->name('discussions.edit')
        ->middleware(Ownership::class);

    Route::put('/discussions/{discussion}', [DiscussionController::class, 'update'])
        ->name('discussions.update')
        ->middleware(Ownership::class);

    Route::delete('/discussions/{discussion}', [DiscussionController::class, 'destroy'])
        ->name('discussions.destroy')
        ->middleware(Ownership::class);


    // Auth discussion comments
    Route::get('/discussions/{discussion}/comments/create', [CommentController::class, 'create'])
        ->name('comments.create');

    Route::post('/discussions/{discussion}/comments', [CommentController::class, 'store'])
        ->name('comments.store');

    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit')
        ->middleware(CommentOwnership::class);

    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update')
        ->middleware(CommentOwnership::class);
        
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy')
        ->middleware(CommentOwnership::class);
});

Route::get('/discussions/{discussion}', [DiscussionController::class, 'show'])
    ->name('discussions.show')
    ->middleware(Approved::class);


Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});


Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');
