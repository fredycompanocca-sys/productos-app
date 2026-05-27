<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
   
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return view('productos.index', compact('productos'));
    }

   
    public function show($id)
    {
        $producto = Producto::with('categoria')->findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    
public function galeria(Request $request)
{
    $categorias = \App\Models\Categoria::all();
    $query = Producto::with('categoria');

  
    if ($request->has('categoria') && $request->categoria != '') {
        $query->where('id_categoria', $request->categoria);
    }

    
    if ($request->has('buscar') && $request->buscar != '') {
        $query->where('nombre', 'LIKE', '%' . $request->buscar . '%');
    }

    $productos = $query->get();
    $categoriaSeleccionada = $request->categoria;

    return view('productos.galeria', compact('productos', 'categorias', 'categoriaSeleccionada'));
}
}