{{-- resources/views/productos/show.blade.php --}}
@extends('layouts.app')
@section('titulo', $producto->nombre)

@section('contenido')

<a href="{{ route('productos.galeria') }}" class="btn btn-outline btn-sm"
   style="margin-bottom:1.5rem; display:inline-block">&larr; Volver a la galería</a>

<div class="card" style="padding:0; overflow:hidden">

    <div style="display:flex; gap:0; flex-wrap:wrap">

        {{-- Imagen --}}
        <div style="flex:0 0 360px; max-width:100%">
            @if($producto->foto && file_exists(public_path('img/productos/' . $producto->foto)))
                <img src="{{ asset('img/productos/' . $producto->foto) }}"
                     alt="{{ $producto->nombre }}"
                     style="width:100%; height:100%; object-fit:cover; min-height:300px">
            @else
                <div style="width:100%; height:300px; background:#EEF1F5;
                            display:flex; align-items:center; justify-content:center;
                            font-size:4rem"></div>
            @endif
        </div>

        {{-- Información --}}
        <div style="flex:1; min-width:260px; padding:2rem">

            <span class="badge-categoria" style="margin-bottom:1rem; display:inline-block">
                {{ $producto->categoria->descripcion ?? 'Sin categoría' }}
            </span>

            <h1 style="color:var(--primary-dk); font-size:1.8rem; margin-bottom:.3rem">
                {{ $producto->nombre }}
            </h1>
            <p style="color:var(--text-light); font-size:1rem; margin-bottom:1.5rem">
                Marca: <strong style="color:var(--text)">{{ $producto->marca }}</strong>
            </p>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1.5rem">
                <div style="background:var(--bg); border-radius:8px; padding:1rem; text-align:center">
                    <div style="font-size:.8rem; color:var(--text-light); text-transform:uppercase;
                                letter-spacing:.5px; margin-bottom:.3rem">Precio</div>
                    <div style="font-size:1.8rem; font-weight:800; color:var(--primary)">
                        S/. {{ number_format($producto->precio, 2) }}
                    </div>
                </div>
                <div style="background:var(--bg); border-radius:8px; padding:1rem; text-align:center">
                    <div style="font-size:.8rem; color:var(--text-light); text-transform:uppercase;
                                letter-spacing:.5px; margin-bottom:.3rem">Stock</div>
                    <div style="font-size:1.8rem; font-weight:800;
                                color:{{ $producto->stock > 10 ? '#1A7A4A' : ($producto->stock > 0 ? '#9A6A00' : '#A93226') }}">
                        {{ $producto->stock }}
                    </div>
                    <div style="font-size:.8rem; color:var(--text-light)">unidades</div>
                </div>
            </div>

            @if($producto->stock == 0)
                <button class="btn" disabled
                    style="width:100%; background:#EEF1F5; color:#AAB7B8;
                           cursor:not-allowed; padding:.9rem; font-size:1rem">
                     Agotado
                </button>
            @else
                <form action="{{ route('carrito.agregar', $producto->id_producto) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success"
                        style="width:100%; padding:.9rem; font-size:1rem">
                         Agregar al carrito
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>

@endsection