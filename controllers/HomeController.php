<?php
require_once __DIR__ . '/../dao/ComunicadoDAO.php';
require_once __DIR__ . '/../dao/AdmisionDAO.php';
require_once __DIR__ . '/../dao/CalendarioDAO.php'; // Agregamos el DAO del calendario

class HomeController {
    public function index() {
        // 1. Obtenemos noticias
        $daoComunicado = new ComunicadoDAO();
        $stmtCom = $daoComunicado->obtenerTodos();
        $comunicados = $stmtCom->fetchAll(PDO::FETCH_ASSOC);

        // 2. Obtenemos documentos PDF
        $daoAdmision = new AdmisionDAO();
        $stmtAdm = $daoAdmision->obtenerTodos();
        $documentos = $stmtAdm->fetchAll(PDO::FETCH_ASSOC);

        // 3. Obtenemos los eventos del calendario
        $daoCalendario = new CalendarioDAO();
        $stmtCal = $daoCalendario->obtenerTodos();
        $eventos = $stmtCal->fetchAll(PDO::FETCH_ASSOC);

        // Cargamos la vista pública con las 3 variables listas
        require_once __DIR__ . '/../views/public/home.php';
    }
}
?>
