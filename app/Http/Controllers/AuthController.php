<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de login.
     * Si el usuario ya está autenticado, redirige al home.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    /**
     * Procesa el formulario de login.
     */
    public function login(Request $request)
    {
        // Paso 1: Validar campos del formulario
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'El correo electrónico es obligatorio.',
            'email.email'       => 'Ingrese un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min'      => 'La contraseña debe tener al menos 6 caracteres.',
        ]);

        // Paso 2: Intentar autenticar
        $credenciales = $request->only('email', 'password');

        if (Auth::attempt($credenciales)) {
            // Paso 3: Autenticación exitosa
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', '¡Bienvenido, ' . Auth::user()->name . '!');
        }

        // Paso 4: Credenciales incorrectas
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    /**
     * Cierra la sesión del usuario actual.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('info', 'Ha cerrado sesión correctamente.');
    }
}