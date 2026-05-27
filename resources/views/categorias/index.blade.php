{{-- resources/views/categorias/index.blade.php --}}
@extends('layouts.app')
@section('titulo', 'Categorías')

@section('contenido')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem">
    <div>
        <h1 style="color:var(--primary-dk); margin:0; font-size:1.6rem">Categorías</h1>
        <p style="color:var(--text-light); margin-top:.3rem; font-size:.9rem">
            Listado de todas las categorías registradas
        </p>
    </div>
</div>

@if($categorias->isEmpty())
    <div class="alert alert-info">No hay categorías registradas aún.</div>
@else
<div class="card" style="padding:0; overflow:hidden">
    <table>
        <thead>
            <tr>
                <th style="width:60px">#</th>
                <th>Descripción</th>
                <th style="text-align:center">N° Productos</th>
                <th style="text-align:center">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
            <tr>
                <td style="font-weight:700; color:var(--primary)">
                    {{ $categoria->id_categoria }}
                </td>
                <td>
                    <strong>{{ $categoria->descripcion }}</strong>
                </td>
                <td style="text-align:center">
                    <span class="badge-categoria">
                        {{ $categoria->productos->count() }} productos
                    </span>
                </td>
                <td style="text-align:center">
                    @if($categoria->productos->count() > 0)
                        <span class="badge-categoria badge-stock-ok">✔ Activa</span>
                    @else
                        <span class="badge-categoria badge-stock-warn">⚠ Sin productos</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@endsection