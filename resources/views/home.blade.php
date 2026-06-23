<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Galleta de la Fortuna Pro</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="navbar">
        <span>Usuario: <strong>{{ Auth::user()->username }}</strong></span>
        
        <a href="/admin/logs" class="btn btn-outline" style="text-decoration: none;">📋 Auditoría</a>

        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-outline">Cerrar Sesión</button>
        </form>
    </div>

    <div class="card">
        <h1 style="margin-top: 0;">Descubre tu Destino</h1>
        
        <img src="{{ asset('img/galletita_icono.jpg') }}" alt="Galleta Cerrada" width="150" style="margin: 20px 0; opacity: 0.9;">
        
        <br>
        
        <form action="/abrir-galleta" method="POST">
            @csrf
            <button type="submit" class="btn">
                Abre tu galleta
            </button>
        </form>
    </div>
</body>
</html>