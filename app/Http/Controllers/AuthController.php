<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage; // <-- Excelente ubicación

class AuthController extends Controller
{
    // Muestra la vista de Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Procesa el formulario de Login
    public function login(Request $request)
    {
        // 1. Validamos los datos que llegan del formulario
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // 2. Intentamos loguear al usuario
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // ---> AGREGADO: LOG DE ÉXITO <---
            Storage::append('auditoria.log', "[" . now()->format('Y-m-d H:i:s') . "] ACCIÓN: Inicio de sesión exitoso - USUARIO: " . $request->username);
            
            return redirect('/home'); // Si sale bien, lo mandamos al home
        }

        // ---> AGREGADO: LOG DE ERROR (Login fallido) <---
        Storage::append('auditoria.log', "[" . now()->format('Y-m-d H:i:s') . "] ACCIÓN: Intento de inicio de sesión fallido - USUARIO: " . $request->username);

        // 3. Si falla, lo devolvemos con un mensaje de error
        return back()->withErrors([
            'loginError' => 'Las credenciales no son correctas.',
        ]);
    }

    // Muestra la vista de Registro
    public function showRegister()
    {
        return view('auth.register');
    }

    // Procesa el formulario de Registro
    public function register(Request $request)
    {
        // 1. Validamos que los datos sean correctos y no estén repetidos
        $validated = $request->validate([
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'birthdate' => 'required|date',
            'password' => 'required|string', 
        ]);

        // 2. Creamos el usuario en la base de datos
        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'birthdate' => $validated['birthdate'],
            'password' => Hash::make($validated['password']), // Laravel exige encriptar la clave sí o sí
        ]);

        // 3. Lo logueamos automáticamente
        Auth::login($user);

        // ---> AGREGADO: LOG DE NUEVO USUARIO <---
        Storage::append('auditoria.log', "[" . now()->format('Y-m-d H:i:s') . "] ACCIÓN: Nuevo usuario registrado - USUARIO: " . $validated['username']);

        return redirect('/home');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}