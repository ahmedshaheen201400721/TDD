<?php

use Illuminate\Support\Facades\Route;

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
//\Illuminate\Support\Facades\DB::listen(fn($query)=>dump($query->sql));
Route::get('/test',fn()=>dump(auth()->check()));

Route::get('/', function () {
    return view('welcome');
});

Route::get('threads',[\App\Http\Controllers\ThreadController::class,'index'])->name('threads.index');

Route::get('{channel:slug}/threads/{thread:slug?}',[\App\Http\Controllers\ThreadController::class,'show'])->name('threads.show');

//Route::get('{channel:slug}/threads/',[\App\Http\Controllers\ChannelController::class,'index'])->name('channel.show');


Route::post('threads',[\App\Http\Controllers\ThreadController::class,'store'])->name('threads.store');
Route::delete('threads/{thread:slug}',[\App\Http\Controllers\ThreadController::class,'destroy'])->name('threads.destroy');
Route::get('threads/create',[\App\Http\Controllers\ThreadController::class,'create'])->name('threads.create');
Route::post('threads/{thread:slug}/replies',[\App\Http\Controllers\ReplyController::class,'store'])->name('replies.store');

Route::post('/replies/{reply}/like',[\App\Http\Controllers\LikeController::class,'store'])->name('like');

Route::get('/profile/{user:uuid}',[\App\Http\Controllers\ProfileController::class,'show'])->name('profile.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::post('/avatars',function (\Illuminate\Http\Request $request){
   $path=$request->image->store('','avatars');
   dump($path);

});
