<?php
require_once __DIR__ . '/../dao/ComunicadoDAO.php';

class HomeController {
    public function index() {
        // Instanciamos el DAO de comunicados
        $dao = new ComunicadoDAO();
        
        // Obtenemos todas las noticias publicadas
        $stmt = $dao->obtenerTodos();
        $comunicados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cargamos la vista pública y le pasamos los datos
        require_once __DIR__ . '/../views/public/home.php';
    }
}
?>
