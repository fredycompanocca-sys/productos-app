<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'ProductosApp') | DAI</title>
<style>
    :root {
        --primary:    #1B4F8A;
        --primary-dk: #0D2E57;
        --accent:     #C0C8D4;
        --bg:         #EEF1F5;
        --card-bg:    #FFFFFF;
        --text:       #1A2433;
        --text-light: #6B7B8D;
        --border:     #C8D0DC;
        --radius:     12px;
        --shadow:     0 4px 20px rgba(0,0,0,.10);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Segoe UI', Arial, sans-serif; background: var(--bg);
           color: var(--text); min-height: 100vh; }
    a { color: var(--primary); text-decoration: none; }
    a:hover { color: var(--primary-dk); text-decoration: underline; }

    
    .navbar {
        background: linear-gradient(90deg, #0D2E57 0%, #1B4F8A 100%);
        padding: .9rem 2.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 3px 12px rgba(0,0,0,.25);
    }
    .navbar .brand {
        color:#fff; font-size:1.4rem; font-weight:800;
        letter-spacing:1px; text-transform:uppercase;
    }
    .navbar .brand span {
        color: #A8C4E0;
        font-weight: 300;
    }
    .navbar nav a {
        color: rgba(255,255,255,.80); margin-left:1.5rem;
        font-size:.92rem; font-weight:500; transition: color .2s;
        text-transform: uppercase; letter-spacing: .5px;
    }
    .navbar nav a:hover { color:#fff; text-decoration:none; }
    .navbar .carrito-btn {
        background: rgba(255,255,255,0.15);
        color:#fff; border: 1px solid rgba(255,255,255,0.3);
        padding:.45rem 1.2rem; border-radius:20px; cursor:pointer;
        font-size:.9rem; font-weight:600; transition: all .2s;
        margin-left: 1.5rem;
    }
    .navbar .carrito-btn:hover {
        background: rgba(255,255,255,0.25);
        border-color: rgba(255,255,255,0.6);
    }

   
    .main-content { max-width: 1200px; margin: 2.5rem auto; padding: 0 2rem; }

    
    .card {
        background: var(--card-bg); border-radius: var(--radius);
        box-shadow: var(--shadow); padding: 1.8rem;
        margin-bottom: 1.5rem;
        border-top: 3px solid var(--primary);
    }

    .btn {
        display: inline-block; padding: .55rem 1.4rem;
        border-radius: 6px; font-weight: 600; font-size: .9rem;
        cursor: pointer; border: none; transition: all .2s;
        letter-spacing: .3px;
    }
    .btn-primary { background: var(--primary); color:#fff; }
    .btn-primary:hover { background: var(--primary-dk); color:#fff; text-decoration:none; transform: translateY(-1px); }
    .btn-success { background: #1A7A4A; color:#fff; }
    .btn-success:hover { background: #145E38; color:#fff; text-decoration:none; }
    .btn-danger  { background: #A93226; color:#fff; }
    .btn-outline { background:transparent; border:2px solid var(--primary); color:var(--primary); }
    .btn-outline:hover { background:var(--primary); color:#fff; text-decoration:none; }
    .btn-sm { padding:.35rem .9rem; font-size:.82rem; }

    
    .galeria-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.8rem;
        margin-top: 1.5rem;
    }
    .producto-card {
        background: var(--card-bg); border-radius: var(--radius);
        box-shadow: var(--shadow); overflow: hidden;
        transition: transform .25s, box-shadow .25s;
        display: flex; flex-direction: column;
        border: 1px solid var(--border);
    }
    .producto-card:hover { transform: translateY(-6px);
        box-shadow: 0 12px 32px rgba(27,79,138,.15); }
    .producto-card img { width: 100%; height: 200px; object-fit: cover; }
    .producto-card .no-foto {
        width:100%; height:200px; background:#EEF1F5;
        display:flex; align-items:center; justify-content:center;
        color: var(--text-light); font-size:.9rem;
    }
    .producto-card .card-body {
        padding: 1.2rem; flex-grow:1; display:flex; flex-direction:column;
    }
    .producto-card .card-body h3 { font-size:1rem; margin-bottom:.3rem; color: var(--primary-dk); }
    .producto-card .card-body .marca { color:var(--text-light); font-size:.85rem; margin-bottom:.6rem; }
    .producto-card .card-body .precio {
        font-size:1.3rem; font-weight:700; color:var(--primary); margin-top:auto;
    }
    .producto-card .card-footer {
        padding: .9rem 1.2rem; border-top:1px solid var(--border);
        display:flex; gap:.5rem; justify-content:space-between; align-items:center;
        background: #F8FAFC;
    }
    .badge-categoria {
        background:#DDEAF7; color:var(--primary-dk); padding:.25rem .7rem;
        border-radius:20px; font-size:.78rem; font-weight:600;
    }
    .badge-stock-ok   { background:#D5F0E3; color:#145E38; }
    .badge-stock-warn { background:#FEF0CD; color:#9A6A00; }
    .badge-stock-low  { background:#FADBD8; color:#A93226; }

   
    table { width:100%; border-collapse:collapse; margin-top:1rem; }
    th { background: linear-gradient(90deg, #0D2E57, #1B4F8A); color:#fff;
         padding:.8rem 1rem; text-align:left; font-size:.88rem;
         text-transform: uppercase; letter-spacing: .5px; }
    td { padding:.7rem 1rem; border-bottom:1px solid var(--border); font-size:.92rem; }
    tr:hover td { background:#F0F5FB; }

   
    .alert { padding:.9rem 1.2rem; border-radius:var(--radius); margin-bottom:1rem; font-size:.95rem; }
    .alert-success { background:#D5F0E3; border-left:4px solid #1A7A4A; color:#145E38; }
    .alert-danger  { background:#FADBD8; border-left:4px solid #A93226; color:#7B241C; }
    .alert-info    { background:#DDEAF7; border-left:4px solid #1B4F8A; color:#0D2E57; }

   
    .form-group { margin-bottom: 1.2rem; }
    .form-group label { display:block; font-weight:600; margin-bottom:.4rem; font-size:.92rem; }
    .form-group input, .form-group select, .form-group textarea {
        width:100%; padding:.6rem .9rem; border:1.5px solid var(--border);
        border-radius:6px; font-size:.95rem; transition: border-color .2s;
    }
    .form-group input:focus, .form-group select:focus {
        outline:none; border-color:var(--primary);
        box-shadow: 0 0 0 3px rgba(27,79,138,0.1);
    }
    .form-error { color:#A93226; font-size:.83rem; margin-top:.3rem; }

   
    .site-footer {
        text-align:center; padding:1.5rem; margin-top:3rem;
        color:var(--text-light); font-size:.85rem;
        border-top:1px solid var(--border);
        background: var(--card-bg);
    }
</style>
    @stack('styles')
</head>
<body>

<div class="navbar">
    <a href="{{ route('home') }}" class="brand">Shop<span>Hub</span></a>
    <nav>
        @auth
            <a href="{{ route('productos.galeria') }}">Galeria</a>
            <a href="{{ route('productos.index') }}">Productos</a>
            <a href="{{ route('categorias.index') }}">Categorias</a>
            <a href="{{ route('carrito.index') }}" class="carrito-btn">
                Carrito
                @if(session('carrito_' . Auth::id()) && count(session('carrito_' . Auth::id())) > 0)
                ({{ count(session('carrito_' . Auth::id())) }})
                @endif
            </a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" style="margin-left:1rem; background:rgba(255,255,255,0.15);
    color:#fff; border:1px solid rgba(255,255,255,0.4); padding:.45rem 1.2rem;
    border-radius:6px; cursor:pointer; font-size:.88rem; font-weight:600;
    transition: all .2s; letter-spacing:.3px;">
      Cerrar Sesión
</button>
            </form>
        @else
            <a href="{{ route('login') }}">Iniciar sesion</a>
        @endauth
    </nav>
</div>

<div class="main-content">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif

    @yield('contenido')
</div>

<div class="site-footer">
    Desarrollo de Aplicaciones en Internet &mdash; Ciclo III &mdash; {{ date('Y') }}
</div>

@stack('scripts')
</body>
</html>