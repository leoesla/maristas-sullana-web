<?php
session_start();
require_once __DIR__ . '/../dao/AdmisionDAO.php';
require_once __DIR__ . '/../models/DocumentoAdmision.php';

class AdmisionController {
    
    public function index() {
        if(!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=login");
            exit();
        }

        $dao = new AdmisionDAO();
        $stmt = $dao->obtenerTodos();
        $documentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/admin/gestionar_admision.php';
    }

    public function guardar() {
        if(!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=login");
            exit();
        }

        // Verificamos si se envió el formulario y si se adjuntó un archivo
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['documento'])) {
            
            $titulo = $_POST['titulo'];
            $anio = $_POST['anio'];
            
            // Datos del archivo subido
            $file_tmp = $_FILES['documento']['tmp_name'];
            $file_name = $_FILES['documento']['name'];
            
            // Generamos un nombre único (usando el tiempo) para evitar que dos PDFs se llamen igual y se sobreescriban
            $nuevo_nombre = time() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "_", $file_name);
            
            // Ruta física en el servidor donde se guardará
            $ruta_destino = __DIR__ . '/../assets/uploads/' . $nuevo_nombre;
            // Ruta relativa que guardaremos en MySQL para luego descargarla
            $ruta_bd = 'assets/uploads/' . $nuevo_nombre; 

            // Función nativa de PHP para mover el archivo de la memoria temporal a nuestra carpeta
            if (move_uploaded_file($file_tmp, $ruta_destino)) {
                
                // Si el archivo se movió con éxito, guardamos los datos en MySQL
                $documento = new DocumentoAdmision();
                $documento->tit_documento = $titulo;
                $documento->rut_archivo = $ruta_bd;
                $documento->anio_vigencia = $anio;
                $documento->id_usuario = $_SESSION['usuario_id'];

                $dao = new AdmisionDAO();
                if($dao->crear($documento)) {
                    header("Location: index.php?action=admision&success=1");
                } else {
                    echo "Error: No se pudo registrar en la base de datos.";
                }
            } else {
                echo "Error: No se pudo subir el archivo físico al servidor. Verifica los permisos de la carpeta uploads.";
            }
        }
    }
}
?>
