<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\FileController as AdminFileController;
use App\Http\Controllers\Admin\WorkController as AdminWorkController;
use App\Http\Controllers\Admin\VisitorController as AdminVisitorController;


Route::group(['prefix' => config('admin.admin_prefix'), 'middleware' => ['auth'] ], function () {

    Route::get('/', [AdminController::class, 'dashboard'])->name('admin');

    Route::group(['prefix' => 'users'], function () {
        Route::controller( AdminUserController::class)->group(function () {
            Route::get('/list', 'index')->name('admin_user_list');
        });
    });

    Route::controller( AdminAboutController::class)->group(function () {
        Route::group(['prefix' => 'about'], function () {
            Route::get('/list', 'index')->name('admin_about_list');
            Route::get('/create', 'create')->name('admin_about_create');
            Route::post('/store', 'store')->name('admin_about_store');
            Route::get('/edit', 'edit')->name('admin_about_edit');
            Route::post('/update/{file_id?}', 'update')->name('admin_about_update');
        });
        Route::group(['prefix' => 'info'], function () {
            Route::get('/edit/{id}', 'editInfo')->name('admin_info_edit');
            Route::post('/update/{id}', 'updateInfo')->name('admin_info_update');
        });
    });

    Route::group(['prefix' => 'files'], function () {
        Route::controller( AdminFileController::class)->group(function () {
            Route::get('/list/{type?}', 'index')->name('admin_file_list');
            Route::get('/create', 'create')->name('admin_file_create');
            Route::post('/store', 'store')->name('admin_file_store');
            Route::delete('/destroy/{id}', 'destroy')->name('admin_file_destroy');
        });
    });
    Route::group(['prefix' => 'works'], function () {
        Route::controller( AdminWorkController::class)->group(function () {
            Route::get('/list', 'index')->name('admin_work_list');
            Route::get('/create', 'create')->name('admin_work_create');
            Route::get('/edit/{id}', 'edit')->name('admin_work_edit');
            Route::post('/store', 'store')->name('admin_work_store');
            Route::post('/update/{id}', 'update')->name('admin_work_update');
            Route::delete('/destroy/{id}', 'destroy')->name('admin_work_destroy');
        });
    });

    Route::group(['prefix' => 'visitors'], function () {
        Route::get('/', [AdminVisitorController::class, 'index'])->name('admin_visitor_list');
        Route::post('/ban-update', [AdminVisitorController::class, 'banUpdate'])->name('admin_visitor_ban_update');
    });
});











//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});