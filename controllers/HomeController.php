<?php
require_once __DIR__ . '/../dao/ComunicadoDAO.php';
require_once __DIR__ . '/../dao/AdmisionDAO.php'; // Agregamos el DAO de admisión

class HomeController {
    public function index() {
        // 1. Obtenemos todas las noticias publicadas
        $daoComunicado = new ComunicadoDAO();
        $stmtCom = $daoComunicado->obtenerTodos();
        $comunicados = $stmtCom->fetchAll(PDO::FETCH_ASSOC);

        // 2. Obtenemos todos los documentos de admisión vigentes
        $daoAdmision = new AdmisionDAO();
        $stmtAdm = $daoAdmision->obtenerTodos();
        $documentos = $stmtAdm->fetchAll(PDO::FETCH_ASSOC);

        // 3. Cargamos la vista pública y le pasamos ambas variables ($comunicados y $documentos)
        require_once __DIR__ . '/../views/public/home.php';
    }
}
?>
