<?php
session_start();
require_once __DIR__ . '/../dao/ComunicadoDAO.php';
require_once __DIR__ . '/../models/Comunicado.php';

class ComunicadoController {
    
    // Método para mostrar la pantalla
    public function index() {
        // Validación de seguridad: Si no hay sesión, lo expulsamos al login
        if(!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=login");
            exit();
        }

        // Instanciamos el DAO para traer el historial de noticias
        $dao = new ComunicadoDAO();
        $stmt = $dao->obtenerTodos();
        $comunicados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cargamos la vista pasándole los datos
        require_once __DIR__ . '/../views/admin/gestionar_comunicados.php';
    }

    // Método para procesar el formulario cuando se presiona "Publicar"
    public function guardar() {
        if(!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Llenamos el objeto Modelo con los datos del formulario HTML
            $comunicado = new Comunicado();
            $comunicado->tit_comunicado = $_POST['titulo'];
            $comunicado->cpo_comunicado = $_POST['cuerpo'];
            $comunicado->cat_comunicado = $_POST['categoria'];
            
            // Generamos la fecha exacta del servidor
            date_default_timezone_set('America/Lima');
            $comunicado->fec_publicacion = date('Y-m-d H:i:s');
            
            // Vinculamos el comunicado con el trabajador logueado
            $comunicado->id_usuario = $_SESSION['usuario_id'];

            // Guardamos en Base de Datos usando el DAO
            $dao = new ComunicadoDAO();
            if($dao->crear($comunicado)) {
                // Redirigimos de vuelta con mensaje de éxito
                header("Location: index.php?action=comunicados&success=1");
            } else {
                echo "Hubo un error al guardar.";
            }
        }
    }
}
?>
