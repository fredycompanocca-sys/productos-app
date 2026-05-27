<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

   
    public function login(Request $request)
    {
        
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'El correo electrónico es obligatorio.',
            'email.email'       => 'Ingrese un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min'      => 'La contraseña debe tener al menos 6 caracteres.',
        ]);

        
        $credenciales = $request->only('email', 'password');

        if (Auth::attempt($credenciales)) {
            
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', '¡Bienvenido, ' . Auth::user()->name . '!');
        }

        
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

         public function logout(Request $request)
        {
         Auth::logout();
         $request->session()->regenerateToken();
         return redirect()->route('login')->with('info', 'Ha cerrado sesión correctamente.');
}
}