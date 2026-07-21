<?php
// Iniciamos el uso de sesiones para mantener al usuario conectado
session_start();
require_once __DIR__ . '/../dao/UsuarioDAO.php';

class LoginController {
    
    public function authenticate() {
        // Verificamos si el usuario envió el formulario por POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // Instanciamos el DAO y verificamos el login
            $usuarioDAO = new UsuarioDAO();
            $user = $usuarioDAO->login($username, $password);

            if ($user) {
                // Login EXITOSO: Guardamos datos en la sesión
                $_SESSION['usuario_id'] = $user->id_usuario;
                $_SESSION['usuario_nombre'] = $user->nom_usuario;
                $_SESSION['usuario_rol'] = $user->rol_usuario;
                
                // Redirigimos al panel de administración
                header("Location: index.php?action=dashboard");
                exit();
            } else {
                // Login FALLIDO: Mostramos la vista con un mensaje de error
                $error = "Usuario o contraseña incorrectos.";
                require_once __DIR__ . '/../views/public/login.php';
            }
        } else {
            // Si solo entra a la URL sin enviar datos, mostramos el formulario vacío
            require_once __DIR__ . '/../views/public/login.php';
        }
    }

    public function logout() {
        // Destruimos la sesión y volvemos al inicio
        session_start();
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
?>
