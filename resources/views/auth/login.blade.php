<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopHub – Iniciar Sesión</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            background: #1C2833;
        }

        /* Panel izquierdo decorativo */
        .left-panel {
         flex: 1;
         background: linear-gradient(135deg, #0D2E57 0%, #1B4F8A 60%, #2E86C1 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            position: relative;
            overflow: hidden;
        }
        .left-panel::before {
           content: '';
           position: absolute;
           width: 400px; height: 400px;
           background: rgba(255,255,255,0.05);
            border-radius: 50%;
            top: -100px; left: -100px;
        }
        .left-panel::after {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
            bottom: -80px; right: -80px;
        }
        .left-panel .logo {
            font-size: 3rem;
            font-weight: 900;
            color: #fff;
            letter-spacing: 2px;
            z-index: 1;
        }
        .left-panel .logo span { color: #A8C4E0; }
        .left-panel .tagline {
            color: rgba(255,255,255,0.75);
            font-size: 1.1rem;
            margin-top: 1rem;
            text-align: center;
            z-index: 1;
        }
        .left-panel .features {
            margin-top: 3rem;
            z-index: 1;
            width: 100%;
            max-width: 320px;
        }
        .left-panel .features .feature {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.2rem;
            color: rgba(255,255,255,0.85);
            font-size: 0.95rem;
        }
        .left-panel .features .feature .icon {
            width: 42px; height: 42px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
            border: 1px solid rgba(255,255,255,0.3);
            flex-shrink: 0;
        }

        /* Panel derecho */
        .right-panel {
            width: 480px;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3.5rem;
            box-shadow: -10px 0 40px rgba(0,0,0,0.4);
        }
        .right-panel .welcome {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1C2833;
            margin-bottom: .4rem;
        }
        .right-panel .subtitle {
            color: #7F8C8D;
            font-size: 0.95rem;
            margin-bottom: 2.5rem;
        }

        .form-group { margin-bottom: 1.4rem; }
        label {
            display: block;
            font-size: .85rem;
            font-weight: 600;
            color: #2C3E50;
            margin-bottom: .5rem;
            text-transform: uppercase;
            letter-spacing: .5px;
        }
        input[type=email], input[type=password] {
            width: 100%;
            padding: .85rem 1rem;
            border: 2px solid #D5D8DC;
            border-radius: 8px;
            font-size: .95rem;
            color: #2C3E50;
            transition: border-color .2s, box-shadow .2s;
            background: #F9FAFB;
        }
        input:focus {
            outline: none;
            border-color: #2ECC71;
            box-shadow: 0 0 0 3px rgba(46,204,113,0.15);
            background: #fff;
        }
        .input-error { border-color: #E74C3C !important; }
        .error-msg { color: #E74C3C; font-size: .82rem; margin-top: .4rem; }

        .alert {
            padding: .9rem 1.1rem;
            border-radius: 8px;
            margin-bottom: 1.2rem;
            font-size: .9rem;
        }
        .alert-danger  { background: #FADBD8; color: #922B21; border-left: 4px solid #E74C3C; }
        .alert-success { background: #D5F5E3; color: #1E8449; border-left: 4px solid #2ECC71; }
        .alert-info    { background: #D6EAF8; color: #1A5276; border-left: 4px solid #2E86C1; }

        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #0D2E57, #1B4F8A);
            color: white;
            border: none;
            padding: .95rem;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            margin-top: .5rem;
            letter-spacing: .5px;
            transition: all .2s;
            box-shadow: 0 4px 12px rgba(39,174,96,0.3);
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #1C2833, #2C3E50);
            box-shadow: 0 6px 20px rgba(28,40,51,0.4);
            transform: translateY(-1px);
        }

        .divider {
            text-align: center;
            color: #BDC3C7;
            margin: 1.5rem 0;
            font-size: .85rem;
            position: relative;
        }
        .divider::before, .divider::after {
            content: '';
            position: absolute;
            top: 50%; width: 42%;
            height: 1px;
            background: #D5D8DC;
        }
        .divider::before { left: 0; }
        .divider::after  { right: 0; }

        .hint {
            background: #F2F3F4;
            border-radius: 8px;
            padding: 1rem 1.2rem;
            font-size: .82rem;
            color: #7F8C8D;
            border-left: 3px solid #1B4F8A;
            margin-top: 1.5rem;
        }
        .hint strong { color: #1C2833; }

        @media (max-width: 768px) {
            .left-panel { display: none; }
            .right-panel { width: 100%; padding: 2rem; }
        }
    </style>
</head>
<body>

    <!-- Panel izquierdo -->
    <div class="left-panel">
        <div class="logo">Shop<span>Hub</span></div>
        <p class="tagline">Tu tienda favorita en un solo lugar</p>
        <div class="features">
            <div class="feature">
                <div class="icon">💻</div>
                <span>Electrónica y Tecnología</span>
            </div>
            <div class="feature">
                <div class="icon">👕</div>
                <span>Ropa y Accesorios</span>
            </div>
            <div class="feature">
                <div class="icon">☕</div>
                <span>Alimentos y Bebidas</span>
            </div>
            <div class="feature">
                <div class="icon">🏠</div>
                <span>Hogar y Jardín</span>
            </div>
            <div class="feature">
                <div class="icon">⚽</div>
                <span>Deportes y Fitness</span>
            </div>
        </div>
    </div>

    <!-- Panel derecho -->
    <div class="right-panel">
        <p class="welcome">Bienvenido</p>
        <p class="subtitle">Ingresa tus credenciales para acceder al sistema</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif
        @if($errors->has('email') && !$errors->has('password'))
            <div class="alert alert-danger">{{ $errors->first('email') }}</div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       class="{{ $errors->has('email') ? 'input-error' : '' }}"
                       placeholder="ejemplo@correo.com">
                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password"
                       class="{{ $errors->has('password') ? 'input-error' : '' }}"
                       placeholder="••••••••">
                @error('password')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-login">Iniciar Sesión</button>
        </form>

        <div class="divider">credenciales de prueba</div>

        <div class="hint">
            <strong>Admin:</strong> admin@productosapp.com / admin123<br>
            <strong>Demo:</strong> demo@productosapp.com / demo123
        </div>
    </div>

</body>
</html>