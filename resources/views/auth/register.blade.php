<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Galleta de la Fortuna</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="card card-login">
        <h2 style="margin-top: 0; margin-bottom: 30px; text-align: center;">Registrarse</h2>
        
        @if ($errors->any())
            <div style="background-color: #fee2e2; color: #991b1b; padding: 10px; border-radius: 6px; margin-bottom: 20px; font-size: 14px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/register" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="birthdate">Fecha de Nacimiento</label>
                <input type="date" id="birthdate" name="birthdate" required>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn">Registrar</button>
        </form>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="/login" style="color: #4b5563; text-decoration: none; font-size: 14px;">¿Ya tienes cuenta? Inicia sesión</a>
        </div>
    </div>
</body>
</html>