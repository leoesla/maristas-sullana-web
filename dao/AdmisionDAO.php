<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/DocumentoAdmision.php';

class AdmisionDAO {
    private $conn;
    private $table_name = "TB_DOCUMENTO_ADMISION";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Método para CREAR el registro de un nuevo documento PDF
    public function crear($documento) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (tit_documento, rut_archivo, anio_vigencia, id_usuario) 
                  VALUES (:titulo, :ruta, :anio, :id_usuario)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":titulo", $documento->tit_documento);
        $stmt->bindParam(":ruta", $documento->rut_archivo);
        $stmt->bindParam(":anio", $documento->anio_vigencia);
        $stmt->bindParam(":id_usuario", $documento->id_usuario);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para LEER los documentos vigentes (Para el público)
    public function obtenerTodos() {
        // Ordenamos por año de vigencia descendente
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY anio_vigencia DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
}
?>
