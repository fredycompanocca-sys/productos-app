{{-- resources/views/carrito/index.blade.php --}}
@extends('layouts.app')
@section('titulo', 'Mi Carrito')

@section('contenido')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem">
    <div>
        <h1 style="color:var(--primary-dk); margin:0; font-size:1.6rem">Mi Carrito</h1>
        <p style="color:var(--text-light); margin-top:.3rem; font-size:.9rem">
            Productos seleccionados para tu compra
        </p>
    </div>
    <a href="{{ route('productos.galeria') }}" class="btn btn-outline btn-sm">
        &larr; Seguir comprando
    </a>
</div>

@if(empty($productos))
    <div class="card" style="text-align:center; padding:4rem">
        <div style="font-size:4rem; margin-bottom:1rem"></div>
        <p style="font-size:1.2rem; color:var(--text-light); margin-bottom:1.5rem">
            Tu carrito está vacío.
        </p>
        <a href="{{ route('productos.galeria') }}" class="btn btn-primary">
            Ver galería de productos
        </a>
    </div>
@else
    <div class="card" style="padding:0; overflow:hidden">
        <table>
            <thead>
                <tr>
                    <th style="width:80px">Imagen</th>
                    <th>Producto</th>
                    <th style="text-align:right">Precio unit.</th>
                    <th style="text-align:center">Cantidad</th>
                    <th style="text-align:right">Subtotal</th>
                    <th style="text-align:center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $item)
                <tr>
                    <td>
                        @if($item['producto']->foto && file_exists(public_path('img/productos/' . $item['producto']->foto)))
                            <img src="{{ asset('img/productos/' . $item['producto']->foto) }}"
                                style="width:65px; height:65px; object-fit:cover;
                                       border-radius:8px; box-shadow:var(--shadow)">
                        @else
                            <div style="width:65px; height:65px; background:#EEF1F5;
                                        border-radius:8px; display:flex; align-items:center;
                                        justify-content:center; color:var(--text-light)">
                                
                            </div>
                        @endif
                    </td>
                    <td>
                        <strong style="color:var(--primary-dk)">{{ $item['producto']->nombre }}</strong><br>
                        <span style="color:var(--text-light); font-size:.85rem">
                            {{ $item['producto']->marca }}
                        </span>
                    </td>
                    <td style="text-align:right; font-weight:600">
                        S/. {{ number_format($item['producto']->precio, 2) }}
                    </td>
                    <td style="text-align:center">
                        <div style="display:flex; align-items:center; justify-content:center; gap:.5rem">
                            <form action="{{ route('carrito.quitar', $item['producto']->id_producto) }}" method="POST">
                                @csrf
                                <button class="btn btn-danger btn-sm">−</button>
                            </form>
                            <strong style="font-size:1.1rem; min-width:24px; text-align:center">
                                {{ $item['cantidad'] }}
                            </strong>
                            <form action="{{ route('carrito.agregar', $item['producto']->id_producto) }}" method="POST">
                                @csrf
                                <button class="btn btn-success btn-sm">+</button>
                            </form>
                        </div>
                    </td>
                    <td style="text-align:right; font-weight:700; color:var(--primary)">
                        S/. {{ number_format($item['subtotal'], 2) }}
                    </td>
                    <td style="text-align:center">
                        <form action="{{ route('carrito.quitar', $item['producto']->id_producto) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Quitar este producto del carrito?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Resumen y acciones --}}
        <div style="padding:1.5rem; background:#F8FAFC; border-top:2px solid var(--border);
                    display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem">
            <form action="{{ route('carrito.vaciar') }}" method="POST">
                @csrf
                <button class="btn btn-outline"
                    onclick="return confirm('¿Vaciar el carrito?')">
                    Vaciar carrito
                </button>
            </form>
            <div style="display:flex; align-items:center; gap:1.5rem; flex-wrap:wrap">
                <div style="font-size:1.4rem; font-weight:800; color:var(--primary-dk)">
                    Total: <span style="color:var(--primary)">S/. {{ number_format($total, 2) }}</span>
                </div>
                <a href="{{ route('carrito.confirmar') }}" class="btn btn-primary">
                    Proceder al pago
                </a>
            </div>
        </div>
    </div>
@endif

@endsection