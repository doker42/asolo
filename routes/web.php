<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\ResumeController;
use App\Http\Middleware\VisitorMiddleware;

Route::group(['prefix' => 'articles'], function () {
    Route::controller( ArticleController::class)->group(function () {
        Route::get('/','index')->name('articles.index');
        Route::get('/show/{article}', 'show')->name('articles.show');

        Route::group(['middleware' => ['auth']], function (){
            Route::get('/create', 'create')->name('articles.create');
            Route::get('/edit/{article}', 'edit')->name('articles.edit');
            Route::post('/store', 'store')->name('articles.store');
            Route::post('/update/{article}', 'update')->name('articles.update');
            Route::patch('/{article}/toggle-published', 'togglePublished')->name('articles.toggle-published');
            Route::delete('/{article}', 'destroy')->name('articles.destroy');
            Route::post('/images/upload', 'uploadImage')->name('articles.image.upload');
        });
    });
});

//Route::middleware([VisitorMiddleware::class])->group(function () {

    Route::get('/home', function (){
        return redirect('admin');
    })->name('home');

    Route::controller( ResumeController::class)->group(function () {
        Route::get('/','resume')->name('resume');
        Route::get('/show', 'show')->name('resume.show');
        Route::get('/download', 'download')->name('resume.download');
    });
//});

Route::group(['prefix' => config('admin.admin_prefix')], function () {

    Route::view('dashboard', 'dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::middleware(['auth'])->group(function () {
        Route::redirect('settings', 'settings/profile');

        Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
        Volt::route('settings/password', 'settings.password')->name('settings.password');
        Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    });
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
