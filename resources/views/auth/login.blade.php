<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Galleta de la Fortuna</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="card card-login">
        <h2 style="margin-top: 0; margin-bottom: 30px; text-align: center;">Iniciar Sesión</h2>
        
        @if($errors->has('loginError'))
            <div style="background-color: #fee2e2; color: #991b1b; padding: 10px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; text-align: center;">
                {{ $errors->first('loginError') }}
            </div>
        @endif
        
        <form action="/login" method="POST">
            @csrf 
            <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn">Entrar</button>
        </form>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="/register" style="color: #4b5563; text-decoration: none; font-size: 14px;">¿No tienes cuenta? Regístrate</a>
        </div>
    </div>
</body>
</html>