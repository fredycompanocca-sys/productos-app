<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    // Clave única del carrito por usuario
    private function carritoKey()
    {
        return 'carrito_' . Auth::id();
    }

    
    public function index()
    {
        $carrito   = session($this->carritoKey(), []);
        $productos = [];
        $total     = 0;

        foreach ($carrito as $id => $cantidad) {
            $producto = Producto::find($id);
            if ($producto) {
                $subtotal    = $producto->precio * $cantidad;
                $total      += $subtotal;
                $productos[] = [
                    'producto' => $producto,
                    'cantidad' => $cantidad,
                    'subtotal' => $subtotal,
                ];
            }
        }

        return view('carrito.index', compact('productos', 'total'));
    }

    
    public function agregar($id)
    {
        $producto = Producto::findOrFail($id);
        $carrito  = session($this->carritoKey(), []);

        if (isset($carrito[$id])) {
            if ($carrito[$id] < $producto->stock) {
                $carrito[$id]++;
            } else {
                return back()->with('error', 'No hay más stock disponible de ' . $producto->nombre);
            }
        } else {
            $carrito[$id] = 1;
        }

        session([$this->carritoKey() => $carrito]);
        return back()->with('success', $producto->nombre . ' agregado al carrito.');
    }

    
    public function quitar($id)
    {
        $carrito = session($this->carritoKey(), []);

        if (isset($carrito[$id])) {
            if ($carrito[$id] > 1) {
                $carrito[$id]--;
            } else {
                unset($carrito[$id]);
            }
        }

        session([$this->carritoKey() => $carrito]);
        return back()->with('info', 'Producto actualizado en el carrito.');
    }

   
    public function vaciar()
    {
        session()->forget($this->carritoKey());
        return back()->with('info', 'El carrito ha sido vaciado.');
    }

  
    public function confirmar()
    {
        $carrito   = session($this->carritoKey(), []);
        $productos = [];
        $total     = 0;

        if (empty($carrito)) {
            return redirect()->route('carrito.index')
                   ->with('info', 'Tu carrito está vacío.');
        }

        foreach ($carrito as $id => $cantidad) {
            $producto = Producto::find($id);
            if ($producto) {
                $subtotal    = $producto->precio * $cantidad;
                $total      += $subtotal;
                $productos[] = [
                    'producto' => $producto,
                    'cantidad' => $cantidad,
                    'subtotal' => $subtotal,
                ];
            }
        }

        return view('carrito.confirmar', compact('productos', 'total'));
    }
}