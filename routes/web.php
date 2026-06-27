<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FortuneController;


Route::get('/', function () {
    return redirect('/login');
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
});


Route::middleware('auth')->group(function () {
    
    Route::get('/home', function () {
        return view('home');
    })->name('home');
    
    Route::post('/abrir-galleta', [FortuneController::class, 'abrir']);
    
  
    Route::get('/admin/logs', function () {
        $contenido = \Illuminate\Support\Facades\Storage::exists('auditoria.log') 
            ? \Illuminate\Support\Facades\Storage::get('auditoria.log') 
            : 'El archivo de auditoría está vacío.';
            
        return view('admin.logs', ['logs' => $contenido]);
    });
   
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});