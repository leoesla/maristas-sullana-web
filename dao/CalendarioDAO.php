<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/EventoCalendario.php';

class CalendarioDAO {
    private $conn;
    private $table_name = "TB_EVENTO_CALENDARIO";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Método para CREAR un nuevo evento en el calendario
    public function crear($evento) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (des_evento, fec_inicio, fec_fin, id_usuario) 
                  VALUES (:descripcion, :inicio, :fin, :id_usuario)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":descripcion", $evento->des_evento);
        $stmt->bindParam(":inicio", $evento->fec_inicio);
        $stmt->bindParam(":fin", $evento->fec_fin);
        $stmt->bindParam(":id_usuario", $evento->id_usuario);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Método para LEER todos los eventos vigentes
    public function obtenerTodos() {
        // Ordenamos por fecha de inicio (los eventos más próximos primero)
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY fec_inicio ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
}
?>
