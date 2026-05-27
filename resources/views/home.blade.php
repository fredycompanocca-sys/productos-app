{{-- resources/views/home.blade.php --}}
@extends('layouts.app')
@section('titulo', 'Inicio')
@section('contenido')

<div class="card">
    <h1 style="color:var(--primary-dk); margin-bottom:.5rem; font-size:1.6rem">
        Panel de Administración
    </h1>
    <p style="color:var(--text-light); margin-bottom:2rem">
        Resumen general del catálogo de <strong>ShopHub</strong>.
    </p>

    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:1.2rem; margin-bottom:2rem">
        
        <div style="background:linear-gradient(135deg, #0D2E57 0%, #1B4F8A 100%);
                    color:#fff; border-radius:var(--radius); padding:1.8rem;
                    box-shadow: 0 6px 20px rgba(13,46,87,.3); position:relative; overflow:hidden;">
            <div style="position:absolute; top:-15px; right:-15px; width:80px; height:80px;
                        background:rgba(255,255,255,.08); border-radius:50%;"></div>
            <div style="font-size:.8rem; text-transform:uppercase; letter-spacing:1px; opacity:.8; margin-bottom:.5rem">
                Categorías
            </div>
            <div style="font-size:3rem; font-weight:800;">{{ $totalCategorias }}</div>
            <div style="font-size:.82rem; opacity:.7; margin-top:.3rem">registradas</div>
        </div>

        <div style="background:linear-gradient(135deg, #1A7A4A 0%, #27AE60 100%);
                    color:#fff; border-radius:var(--radius); padding:1.8rem;
                    box-shadow: 0 6px 20px rgba(26,122,74,.3); position:relative; overflow:hidden;">
            <div style="position:absolute; top:-15px; right:-15px; width:80px; height:80px;
                        background:rgba(255,255,255,.08); border-radius:50%;"></div>
            <div style="font-size:.8rem; text-transform:uppercase; letter-spacing:1px; opacity:.8; margin-bottom:.5rem">
                Productos
            </div>
            <div style="font-size:3rem; font-weight:800;">{{ $totalProductos }}</div>
            <div style="font-size:.82rem; opacity:.7; margin-top:.3rem">en catálogo</div>
        </div>

    </div>

    <div style="margin-top:1rem; display:flex; gap:1rem; flex-wrap:wrap">
        <a href="{{ route('productos.galeria') }}" class="btn btn-primary">Ver Galería</a>
        <a href="{{ route('categorias.index') }}" class="btn btn-outline">Ver Categorías</a>
        <a href="{{ route('productos.index') }}" class="btn btn-outline">Ver Productos</a>
        <a href="{{ route('carrito.index') }}" class="btn btn-outline">Ver Carrito</a>
    </div>
</div>

@endsection