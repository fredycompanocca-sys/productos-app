{{-- resources/views/carrito/confirmar.blade.php --}}
@extends('layouts.app')
@section('titulo', 'Confirmar Pedido')

@section('contenido')

<div style="max-width:750px; margin:0 auto">

    {{-- Encabezado --}}
    <div class="card" style="text-align:center; padding:2.5rem;
                              background:linear-gradient(135deg, #0D2E57, #1B4F8A);
                              color:#fff; border-top:none">
        <div style="font-size:3.5rem; margin-bottom:.8rem">🛍️</div>
        <h1 style="font-size:1.8rem; margin-bottom:.4rem">Confirmación de Pedido</h1>
    </div>

    {{-- Datos del usuario --}}
    <div class="card" style="border-top:3px solid #1A7A4A">
        <h2 style="color:var(--primary-dk); font-size:1rem; text-transform:uppercase;
                   letter-spacing:.5px; margin-bottom:1.2rem">
            Datos del Cliente
        </h2>
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:1rem">
            <div style="background:var(--bg); border-radius:8px; padding:1rem">
                <div style="font-size:.8rem; color:var(--text-light); text-transform:uppercase;
                            letter-spacing:.5px; margin-bottom:.3rem">Cliente</div>
                <div style="font-weight:700; color:var(--primary-dk)">{{ Auth::user()->name }}</div>
            </div>
            <div style="background:var(--bg); border-radius:8px; padding:1rem">
                <div style="font-size:.8rem; color:var(--text-light); text-transform:uppercase;
                            letter-spacing:.5px; margin-bottom:.3rem">Correo</div>
                <div style="font-weight:700; color:var(--primary-dk)">{{ Auth::user()->email }}</div>
            </div>
            <div style="background:var(--bg); border-radius:8px; padding:1rem">
                <div style="font-size:.8rem; color:var(--text-light); text-transform:uppercase;
                            letter-spacing:.5px; margin-bottom:.3rem">Fecha</div>
                <div style="font-weight:700; color:var(--primary-dk)">{{ now()->format('d/m/Y H:i') }}</div>
            </div>
            <div style="background:var(--bg); border-radius:8px; padding:1rem">
                <div style="font-size:.8rem; color:var(--text-light); text-transform:uppercase;
                            letter-spacing:.5px; margin-bottom:.3rem">N° Productos</div>
                <div style="font-weight:700; color:var(--primary-dk)">{{ count(session('carrito', [])) }}</div>
            </div>
        </div>
    </div>

    {{-- Tabla de productos --}}
    <div class="card" style="padding:0; overflow:hidden">
        <div style="padding:1.2rem 1.5rem; border-bottom:1px solid var(--border)">
            <h2 style="color:var(--primary-dk); font-size:1rem; text-transform:uppercase;
                       letter-spacing:.5px; margin:0">
                Resumen de Productos
            </h2>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th style="text-align:center">Cantidad</th>
                    <th style="text-align:right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $item)
                <tr>
                    <td>
                        <strong style="color:var(--primary-dk)">{{ $item['producto']->nombre }}</strong><br>
                        <span style="color:var(--text-light); font-size:.85rem">{{ $item['producto']->marca }}</span>
                    </td>
                    <td style="text-align:center">
                        <span class="badge-categoria">{{ $item['cantidad'] }} und.</span>
                    </td>
                    <td style="text-align:right; font-weight:700; color:var(--primary)">
                        S/. {{ number_format($item['subtotal'], 2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Total --}}
        <div style="padding:1.5rem; background:#F8FAFC; border-top:2px solid var(--border);
                    text-align:right">
            <div style="font-size:1.6rem; font-weight:800; color:var(--primary-dk)">
                Total a pagar:
                <span style="color:var(--primary)">S/. {{ number_format($total, 2) }}</span>
            </div>
        </div>
    </div>

    {{-- Botones --}}
    <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; margin-top:1rem">
        <a href="{{ route('carrito.index') }}" class="btn btn-outline">
            &larr; Volver al carrito
        </a>
        <form action="{{ route('carrito.vaciar') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">
                Confirmar y Finalizar
            </button>
        </form>
    </div>

</div>

@endsection