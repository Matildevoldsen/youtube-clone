<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShowChannelController;
use App\Http\Controllers\TrendingController;
use App\Livewire\Channel;
use App\Livewire\UploadVideo;
use App\Livewire\VideoPage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('home');
Route::get('/trending', TrendingController::class)->name('trending');
Route::get('/channels/{user:username}', ShowChannelController::class)->name('channel.show');
Route::get('/videos/{video:uuid}', VideoPage::class)->name('video.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/video/upload', [UploadVideo::class, 'handleChunk'])->name('video.upload');
});
