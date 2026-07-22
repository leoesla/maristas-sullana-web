<?php
session_start();
require_once __DIR__ . '/../dao/CalendarioDAO.php';
require_once __DIR__ . '/../models/EventoCalendario.php';

class CalendarioController {
    
    public function index() {
        if(!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=login");
            exit();
        }

        $dao = new CalendarioDAO();
        $stmt = $dao->obtenerTodos();
        $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/admin/gestionar_calendario.php';
    }

    public function guardar() {
        if(!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $evento = new EventoCalendario();
            $evento->des_evento = $_POST['descripcion'];
            $evento->fec_inicio = $_POST['fecha_inicio'];
            $evento->fec_fin = $_POST['fecha_fin'];
            
            // Validar que la fecha de fin no sea menor a la de inicio
            if($evento->fec_fin < $evento->fec_inicio) {
                // Si hay error en fechas, forzamos que sean iguales
                $evento->fec_fin = $evento->fec_inicio;
            }

            $evento->id_usuario = $_SESSION['usuario_id'];

            $dao = new CalendarioDAO();
            if($dao->crear($evento)) {
                header("Location: index.php?action=calendario&success=1");
            } else {
                echo "Error al registrar el evento en el calendario.";
            }
        }
    }
}
?>
