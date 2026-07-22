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
        session_start();
        if(isset($_SESSION['usuario_nombre'])) {
            echo "<div style='font-family: sans-serif; text-align:center; padding: 50px;'>";
            echo "<h1 style='color: #1854DA;'>Panel de Control - Maristas Sullana</h1>";
            echo "<h3>Bienvenido/a, " . $_SESSION['usuario_nombre'] . "</h3>";
            echo "<p>Tu nivel de acceso es: <strong>" . $_SESSION['usuario_rol'] . "</strong></p>";
            
            // NUEVO BOTÓN AGREGADO AQUÍ
            echo "<br><br><a href='index.php?action=comunicados' style='padding: 10px 20px; background: #28a745; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;'>Gestionar Comunicados</a><br><br><br>";
            // EL NUEVO BOTÓN DE ADMISIÓN AQUÍ
            echo "<a href='index.php?action=admision' style='padding: 10px 20px; background: #fd7e14; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; margin-left: 15px;'>Módulo de Admisión (PDFs)</a><br><br><br>";
            // NUEVO BOTÓN DE CALENDARIO AQUÍ
            echo "<a href='index.php?action=calendario' style='padding: 10px 20px; background: #6f42c1; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; margin-left: 15px;'>Calendario Escolar</a>";
            echo "<br><br><br>";
            echo "<a href='index.php?action=logout' style='color: red; text-decoration:none;'>[ Cerrar Sesión ]</a>";
            echo "</div>";
        } else {
            header("Location: index.php?action=login");
        }
        break;

        case 'comunicados':
        require_once __DIR__ . '/controllers/ComunicadoController.php';
        $controller = new ComunicadoController();
        $controller->index();
        break;

    case 'guardar_comunicado':
        require_once __DIR__ . '/controllers/ComunicadoController.php';
        $controller = new ComunicadoController();
        $controller->guardar();
        break;

        case 'admision':
        require_once __DIR__ . '/controllers/AdmisionController.php';
        $controller = new AdmisionController();
        $controller->index();
        break;

    case 'guardar_admision':
        require_once __DIR__ . '/controllers/AdmisionController.php';
        $controller = new AdmisionController();
        $controller->guardar();
        break;

        case 'calendario':
        require_once __DIR__ . '/controllers/CalendarioController.php';
        $controller = new CalendarioController();
        $controller->index();
        break;

    case 'guardar_calendario':
        require_once __DIR__ . '/controllers/CalendarioController.php';
        $controller = new CalendarioController();
        $controller->guardar();
        break;

    default:
        // Ruta principal (Vista pública)
        require_once __DIR__ . '/controllers/HomeController.php';
        $controller = new HomeController();
        $controller->index();
        break;
}
?>
