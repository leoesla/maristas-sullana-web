<?php
// Obtenemos la acción de la URL (ej: index.php?action=login). Si no hay, por defecto es 'home'
$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'login':
        require_once __DIR__ . '/controllers/LoginController.php';
        $controller = new LoginController();
        $controller->authenticate();
        break;

    case 'logout':
        require_once __DIR__ . '/controllers/LoginController.php';
        $controller = new LoginController();
        $controller->logout();
        break;

    case 'dashboard':
        // Vista temporal del Panel de Control protegido
        session_start();
        if(isset($_SESSION['usuario_nombre'])) {
            echo "<div style='font-family: sans-serif; text-align:center; padding: 50px;'>";
            echo "<h1 style='color: #1854DA;'>Panel de Control - Maristas Sullana</h1>";
            echo "<h3>Bienvenido/a, " . $_SESSION['usuario_nombre'] . "</h3>";
            echo "<p>Tu nivel de acceso es: <strong>" . $_SESSION['usuario_rol'] . "</strong></p>";
            echo "<br><a href='index.php?action=logout' style='color: red; text-decoration:none;'>[ Cerrar Sesión ]</a>";
            echo "</div>";
        } else {
            // Si intenta entrar al dashboard sin loguearse, lo pateamos al login
            header("Location: index.php?action=login");
        }
        break;

    default:
        // 'home' -> Vista pública principal
        echo "<div style='font-family: sans-serif; text-align:center; padding: 50px;'>";
        echo "<h1>Plataforma Web - Colegio San José Obrero Maristas Sullana</h1>";
        echo "<h3>(Vista pública en construcción)</h3>";
        echo "<br><a href='index.php?action=login' style='padding: 10px 20px; background: #1854DA; color: white; text-decoration: none; border-radius: 5px;'>Acceso Personal Administrativo</a>";
        echo "</div>";
        break;
}
?>
