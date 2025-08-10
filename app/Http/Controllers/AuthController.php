<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Mostrar el formulario de login
     */
    public function showLoginForm() 
    {
        // Debug: Registrar que se está accediendo a la vista
        Log::info('AuthController: Mostrando formulario de login');
        
        // Verificar que la vista existe
        if (!view()->exists('auth.login')) {
            Log::error('AuthController: Vista auth.login no encontrada');
            return response('Vista auth.login no encontrada', 500);
        }
        
        return view('auth.login');
    }

    /**
     * Procesar el login
     */
    public function login(Request $request) 
    {
        Log::info('AuthController: Procesando login', ['email' => $request->email]);
        
        // Validar los datos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3', // Reducido para testing
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            Log::info('AuthController: Login exitoso', ['user_id' => auth()->id()]);
            
            return redirect()->intended('dashboard')->with('success', 'Login exitoso!');
        }

        Log::warning('AuthController: Login fallido', ['email' => $request->email]);
        
        return back()->withErrors([
            'email' => 'Las credenciales son incorrectas.',
        ])->withInput($request->except('password'));
    }

    /**
     * Cerrar sesión
     */
    public function logout(Request $request) 
    {
        Log::info('AuthController: Cerrando sesión', ['user_id' => auth()->id()]);
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('success', 'Sesión cerrada correctamente');
    }
}