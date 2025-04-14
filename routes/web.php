<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\ResumeController;
use App\Http\Middleware\VisitorMiddleware;


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
