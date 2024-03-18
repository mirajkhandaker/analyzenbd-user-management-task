<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get("phpinfo",function (){
    echo phpinfo();
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect()->route('users.index');
    });

    Route::resource('/users', UserController::class);
    Route::prefix('deleted-user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('deleted-user.index');
        Route::get('/{id}', [UserController::class, 'restore'])->name('deleted-user.restore');
        Route::delete('/{id}', [UserController::class, 'destroyPermanently'])->name('deleted-user.destroy');
    });
    Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [\App\Http\Controllers\AuthController::class, 'loginView']);
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
});
