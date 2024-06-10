<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']); 

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function (){

    Route::get('/home', function () {
    return view('home');
    });

    Route::get('/dashboard', function () {
    return view('dashboard');
    });

    Route::middleware('role:mahasiswa,admin')->group (function (){
        Route::get('/mahasiswa', function () {
        return view('mahasiswa');
        });

        Route::get('/matkul', function () {
        return view('matkul');
        });

    });

    Route::middleware('role:dosen,admin')->group (function (){
        Route::get('/dosen', function () {
        return view('dosen');
        });

        Route::get('/jurusan', function () {
        return view('jurusan');
        });

    });
});