{{-- resources/views/productos/index.blade.php --}}
@extends('layouts.app')
@section('titulo', 'Productos')

@section('contenido')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem">
    <div>
        <h1 style="color:var(--primary-dk); margin:0; font-size:1.6rem">Productos</h1>
        <p style="color:var(--text-light); margin-top:.3rem; font-size:.9rem">
            Listado completo de productos en catálogo
        </p>
    </div>
    <a href="{{ route('productos.galeria') }}" class="btn btn-primary">Ver Galería</a>
</div>

@if($productos->isEmpty())
    <div class="alert alert-info">No hay productos registrados aún.</div>
@else
<div class="card" style="padding:0; overflow:hidden">
    <table>
        <thead>
            <tr>
                <th style="width:50px">#</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th style="text-align:right">Precio</th>
                <th style="text-align:center">Stock</th>
                <th>Categoría</th>
                <th style="text-align:center">Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td style="font-weight:700; color:var(--primary)">
                    {{ $producto->id_producto }}
                </td>
                <td>
                    <strong>{{ $producto->nombre }}</strong>
                </td>
                <td style="color:var(--text-light)">{{ $producto->marca }}</td>
                <td style="text-align:right; font-weight:700; color:var(--primary-dk)">
                    S/. {{ number_format($producto->precio, 2) }}
                </td>
                <td style="text-align:center">
                    @if($producto->stock == 0)
                        <span class="badge-categoria badge-stock-low">Agotado</span>
                    @elseif($producto->stock <= 5)
                        <span class="badge-categoria badge-stock-warn">{{ $producto->stock }} und.</span>
                    @else
                        <span class="badge-categoria badge-stock-ok">{{ $producto->stock }} und.</span>
                    @endif
                </td>
                <td>
                    <span class="badge-categoria">
                        {{ $producto->categoria->descripcion ?? 'Sin categoría' }}
                    </span>
                </td>
                <td style="text-align:center">
                    <a href="{{ route('productos.show', $producto->id_producto) }}"
                       class="btn btn-outline btn-sm">👁 Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@endsection