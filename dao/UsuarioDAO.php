<?php
// Requerimos los archivos que acabamos de crear
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioDAO {
    private $conn;
    private $table_name = "TB_USUARIO";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // CUS-05: Método para validar el Login
    public function login($username, $password) {
        // Consulta preparada (previene hackeos por inyección SQL)
        $query = "SELECT id_usuario, nom_usuario, rol_usuario, password_usuario 
                  FROM " . $this->table_name . " 
                  WHERE nom_usuario = :username LIMIT 0,1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        // Si el usuario existe
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Comparamos la contraseña (en un proyecto real se usaría password_verify)
            if($password === $row['password_usuario']) {
                $usuario = new Usuario();
                $usuario->id_usuario = $row['id_usuario'];
                $usuario->nom_usuario = $row['nom_usuario'];
                $usuario->rol_usuario = $row['rol_usuario'];
                
                return $usuario; // Retorna el objeto con los datos si es exitoso
            }
        }
        return false; // Falla el login
    }
}
?>
