<?php
class Database {
    // Credenciales por defecto de XAMPP
    private $host = "localhost";
    private $db_name = "db_maristas_sullana";
    private $username = "root"; 
    private $password = "";     
    public $conn;

    // Método para obtener la conexión
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            // Mostrar errores de forma clara
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Soportar tildes y caracteres en español (UTF-8)
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
