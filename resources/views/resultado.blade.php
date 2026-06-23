<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tu Fortuna</title>
</head>
<body>
    <div style="text-align: right; padding: 10px;">
        <span>Usuario: <strong>{{ Auth::user()->username }}</strong></span>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit">Cerrar Sesión</button>
        </form>
    </div>

    <div style="text-align: center; margin-top: 50px;">
        <h2>¡Tu galleta se ha abierto!</h2>
        
        <div style="margin: 30px auto; padding: 20px; border: 2px dashed #333; max-width: 500px;">
            <p style="font-size: 24px; font-style: italic;">"{{ $mensaje }}"</p>
        </div>
        
        <p style="color: gray;">Galleta abierta el: {{ $fecha }}</p>

        <br><br>
        
        <a href="/home" style="padding: 10px 20px; background: #eee; text-decoration: none; border: 1px solid #ccc; color: black;">
            Abrir otra galleta
        </a>
    </div>
</body>
</html>