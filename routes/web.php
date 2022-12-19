<?php

use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return view('home');
    }
    return redirect('login');
})->name('home');

Route::redirect('/admin/login', '/login');

Route::post('/apply', ApplicationController::class)->name('apply');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect('/');
})->name('dashboard');
