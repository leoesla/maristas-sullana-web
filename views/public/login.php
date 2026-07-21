<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Maristas Sullana</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f4f8; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 300px; text-align: center; }
        .login-box h2 { color: #1854DA; margin-top: 0; }
        input[type="text"], input[type="password"] { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background-color: #1854DA; color: white; padding: 12px; border: none; border-radius: 4px; width: 100%; cursor: pointer; font-weight: bold; margin-top: 10px; }
        button:hover { background-color: #0e3c9b; }
        .error-msg { color: #d93025; font-size: 0.9em; margin-bottom: 10px; font-weight: bold; }
        .link { font-size: 0.85em; color: #666; text-decoration: none; margin-top: 20px; display: inline-block; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Acceso Administrativo</h2>
        
        <?php if(isset($error)) { echo "<p class='error-msg'>$error</p>"; } ?>
        
        <form action="index.php?action=login" method="POST">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
        </form>
        <a href="index.php" class="link">← Volver al inicio</a>
    </div>
</body>
</html>
