{{-- resources/views/productos/galeria.blade.php --}}
@extends('layouts.app')
@section('titulo', 'Galeria de Productos')
 
@section('contenido')
 
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem; flex-wrap:wrap; gap:1rem;">
    <h1 style="color:var(--primary-dk); margin:0">
        Galeria de Productos
        <span style="font-size:1rem; font-weight:normal; color:var(--text-light)">
            ({{ $productos->count() }} productos)
        </span>
    </h1>
<div style="display:flex; gap:.8rem; align-items:center; flex-wrap:wrap">
        {{-- Barra de búsqueda --}}
        <form method="GET" action="{{ route('productos.galeria') }}" style="margin:0">
            <input type="hidden" name="categoria" value="{{ $categoriaSeleccionada ?? '' }}">
            <input type="text" name="buscar" id="inputBuscar" value="{{ request('buscar') }}"
    placeholder="Buscar producto..."
    style="padding:.5rem .9rem; border:2px solid var(--border);
           border-radius:8px; font-size:.9rem; color:var(--text);
           background:#fff; width:200px;">
        </form>

        {{-- Filtro por categoría --}}
        <form method="GET" action="{{ route('productos.galeria') }}" style="margin:0">
            <input type="hidden" name="buscar" value="{{ request('buscar') }}">
            <select name="categoria" onchange="this.form.submit()"
                style="padding:.5rem .9rem; border:2px solid var(--border);
                       border-radius:8px; font-size:.9rem; color:var(--text);
                       background:#fff; cursor:pointer;">
                <option value="">Todas las categorías</option>
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id_categoria }}"
                        {{ isset($categoriaSeleccionada) && $categoriaSeleccionada == $cat->id_categoria ? 'selected' : '' }}>
                        {{ $cat->descripcion }}
                    </option>
                @endforeach
            </select>
        </form>

        <a href="{{ route('productos.index') }}" class="btn btn-outline btn-sm">Ver como tabla</a>
    </div>
</div>
@if($productos->isEmpty())
    <div class="alert alert-info">No hay productos registrados aun.</div>
@else
    <div class="galeria-grid">
        @foreach($productos as $producto)
        <div class="producto-card">
 
            {{-- Imagen del producto --}}
            @if($producto->foto && file_exists(public_path('img/productos/' . $producto->foto)))
                <img src="{{ asset('img/productos/' . $producto->foto) }}"
                     alt="{{ $producto->nombre }}">
            @else
                <div class="no-foto">Sin imagen</div>
            @endif
 
            <div class="card-body">
                <h3>{{ $producto->nombre }}</h3>
                <p class="marca">{{ $producto->marca }}</p>
 
                {{-- Badge de stock --}}
                @if($producto->stock > 20)
                    <span class="badge-categoria badge-stock-ok">Stock: {{ $producto->stock }}</span>
                @elseif($producto->stock > 5)
                    <span class="badge-categoria badge-stock-warn">Stock: {{ $producto->stock }}</span>
                @else
                    <span class="badge-categoria badge-stock-low">Stock bajo: {{ $producto->stock }}</span>
                @endif
 
                <p class="precio">S/. {{ number_format($producto->precio, 2) }}</p>
            </div>
 
            <div class="card-footer">
                <span class="badge-categoria">{{ $producto->categoria->descripcion ?? 'Sin cat.' }}</span>
                <div style="display:flex; gap:.4rem">
                    <a href="{{ route('productos.show', $producto->id_producto) }}"
                       class="btn btn-outline btn-sm">Ver</a>
                    @if($producto->stock == 0)
    <button class="btn btn-sm" disabled
        style="background:#E5E7E9; color:#AAB7B8; cursor:not-allowed;">
        Agotado
    </button>
@else
    <form action="{{ route('carrito.agregar', $producto->id_producto) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success btn-sm">+ Carrito</button>
    </form>
@endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
 
@push('scripts')
<script>
    document.getElementById('inputBuscar').addEventListener('keyup', function() {
        clearTimeout(this._timer);
        const buscar = this.value;
        const categoria = document.querySelector('select[name="categoria"]').value;

        this._timer = setTimeout(() => {
            const url = new URL("{{ route('productos.galeria') }}");
            if (buscar) url.searchParams.set('buscar', buscar);
            if (categoria) url.searchParams.set('categoria', categoria);

            fetch(url)
                .then(res => res.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const nuevaGaleria = doc.querySelector('.galeria-grid');
                    const galeriaActual = document.querySelector('.galeria-grid');

                    if (nuevaGaleria && galeriaActual) {
                        galeriaActual.innerHTML = nuevaGaleria.innerHTML;
                    } else if (!nuevaGaleria && galeriaActual) {
                        galeriaActual.innerHTML = '<p style="color:var(--text-light); padding:1rem">Sin resultados.</p>';
                    }
                });
        }, 50);
    });
</script>
@endpush

@endsection
