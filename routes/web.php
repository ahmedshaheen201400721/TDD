<?php

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
//
////\Illuminate\Support\Facades\DB::listen(fn($query)=>dump($query->sql));
//Route::get('/test',fn()=>auth()->user()->feed());
Route::get('/test',fn()=> dd(auth()->user()->notifications) );
//
//
Route::get('threads',[\App\Http\Controllers\ThreadController::class,'index'])->name('Threads.index');
//
Route::get('{channel:slug}/threads/{thread:slug?}',[\App\Http\Controllers\ThreadController::class,'show'])->name('Threads.show');
//
Route::post('{channel:slug}/threads/{thread:slug?}/subscribe',[\App\Http\Controllers\SubscriptionController::class,'store'])->name('subscription.store');
Route::delete('{channel:slug}/threads/{thread:slug?}/subscribe',[\App\Http\Controllers\SubscriptionController::class,'destroy'])->name('subscription.destroy');

//Route::get('{channel:slug}/Threads/',[\App\Http\Controllers\ChannelController::class,'index'])->name('channel.show');
//
//
Route::post('threads',[\App\Http\Controllers\ThreadController::class,'store'])->name('Threads.store');
Route::delete('threads/{thread:slug}',[\App\Http\Controllers\ThreadController::class,'destroy'])->name('Threads.destroy');
Route::get('threads/create',[\App\Http\Controllers\ThreadController::class,'create'])->name('Threads.create');

Route::post('threads/{thread:slug}/replies',[\App\Http\Controllers\ReplyController::class,'store'])->name('replies.store');
Route::delete('threads/replies/{reply}',[\App\Http\Controllers\ReplyController::class,'destroy'])->name('replies.destroy');
Route::patch('threads/replies/{reply}',[\App\Http\Controllers\ReplyController::class,'update'])->name('replies.update');
//
Route::post('/replies/{reply}/like',[\App\Http\Controllers\LikeController::class,'store'])->name('like');
//
Route::get('/profile/{user:uuid}',[\App\Http\Controllers\ProfileController::class,'show'])->name('profile.index');
//




Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return "ahmed";
    return Inertia::render('Dashboard');

})->name('dashboard');
