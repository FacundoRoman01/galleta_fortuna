<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Auditoría - Logs</title>
</head>
<body>
    <div style="padding: 20px;">
        <h2>Registro de Auditoría del Sistema</h2>
        <a href="/home" style="text-decoration: none; color: blue;">&larr; Volver al inicio</a>
        <hr>
        
        <pre style="background: #f4f4f4; padding: 15px; border: 1px solid #ccc; max-width: 800px; overflow-x: auto;">
{{ $logs }}
        </pre>
        
    </div>
</body>
</html>