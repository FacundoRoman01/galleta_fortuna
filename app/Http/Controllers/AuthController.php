<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage; 

class AuthController extends Controller
{
  
    public function showLogin()
    {
        return view('auth.login');
    }

   
    public function login(Request $request)
    {
      
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

     
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            
            Storage::append('auditoria.log', "[" . now()->format('Y-m-d H:i:s') . "] ACCIÓN: Inicio de sesión exitoso - USUARIO: " . $request->username);
            
            return redirect('/home'); 
        }

       
        Storage::append('auditoria.log', "[" . now()->format('Y-m-d H:i:s') . "] ACCIÓN: Intento de inicio de sesión fallido - USUARIO: " . $request->username);

      
        return back()->withErrors([
            'loginError' => 'Las credenciales no son correctas.',
        ]);
    }

   
    public function showRegister()
    {
        return view('auth.register');
    }

   
    public function register(Request $request)
    {
        
        $validated = $request->validate([
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'birthdate' => 'required|date',
            'password' => 'required|string', 
        ]);

       
        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'birthdate' => $validated['birthdate'],
            'password' => Hash::make($validated['password']), 
        ]);

        Auth::login($user);

        
        Storage::append('auditoria.log', "[" . now()->format('Y-m-d H:i:s') . "] ACCIÓN: Nuevo usuario registrado - USUARIO: " . $validated['username']);

        return redirect('/home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}