<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Comunicado.php';

class ComunicadoDAO {
    private $conn;
    private $table_name = "TB_COMUNICADO";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Método para CREAR un nuevo comunicado (Noticia/Aviso)
    public function crear($comunicado) {
        // Preparamos la consulta SQL para insertar datos
        $query = "INSERT INTO " . $this->table_name . " 
                  (tit_comunicado, cpo_comunicado, fec_publicacion, cat_comunicado, id_usuario) 
                  VALUES (:titulo, :cuerpo, :fecha, :categoria, :id_usuario)";
        
        $stmt = $this->conn->prepare($query);

        // Enlazamos los datos de PHP con los parámetros de MySQL (Seguridad anti-hackeos)
        $stmt->bindParam(":titulo", $comunicado->tit_comunicado);
        $stmt->bindParam(":cuerpo", $comunicado->cpo_comunicado);
        $stmt->bindParam(":fecha", $comunicado->fec_publicacion);
        $stmt->bindParam(":categoria", $comunicado->cat_comunicado);
        $stmt->bindParam(":id_usuario", $comunicado->id_usuario);

        // Ejecutamos la consulta
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para LEER todos los comunicados (Para mostrarlos en la web)
    public function obtenerTodos() {
        // Ordenamos por fecha descendente (los más nuevos primero)
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY fec_publicacion DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
}
?>
