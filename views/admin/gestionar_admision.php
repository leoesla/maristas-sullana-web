<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Admisión - Maristas Sullana</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f4f7f6; padding: 20px; margin: 0; }
        .container { max-width: 800px; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        h2, h3 { color: #1854DA; margin-top: 0; }
        input, select { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        input[type="file"] { padding: 10px; background: #e9ecef; }
        button { background: #1854DA; color: white; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; width: 100%; }
        button:hover { background: #0e3c9b; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #1854DA; color: white; }
        .back-link { display: inline-block; margin-bottom: 20px; color: #666; text-decoration: none; font-size: 0.9em; }
        .alert-success { background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #c3e6cb; }
        .btn-descarga { color: white; background-color: #28a745; padding: 5px 10px; text-decoration: none; border-radius: 3px; font-size: 0.9em; }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php?action=dashboard" class="back-link">← Volver al Panel de Control</a>
        <h2>Gestión de Documentos de Admisión</h2>
        
        <?php if(isset($_GET['success'])): ?>
            <div class="alert-success">✅ ¡El documento PDF se ha subido exitosamente!</div>
        <?php endif; ?>

        <!-- Importante: enctype="multipart/form-data" es obligatorio para subir archivos -->
        <form action="index.php?action=guardar_admision" method="POST" enctype="multipart/form-data">
            <input type="text" name="titulo" placeholder="Título del Documento (Ej. Requisitos 2026)" required>
            
            <input type="number" name="anio" placeholder="Año de vigencia (Ej. 2026)" value="<?= date('Y') ?>" required>
            
            <label style="font-weight: bold; color: #555; display: block; margin-top: 10px;">Subir archivo PDF:</label>
            <input type="file" name="documento" accept=".pdf" required>
            
            <button type="submit" style="margin-top: 15px;">Subir y Publicar Documento</button>
        </form>

        <hr style="margin: 30px 0; border: 0; border-top: 1px solid #eee;">

        <!-- Historial de documentos -->
        <h3>Documentos Vigentes</h3>
        <table>
            <tr>
                <th>Año</th>
                <th>Título del Documento</th>
                <th>Archivo</th>
            </tr>
            <?php if(!empty($documentos)): ?>
                <?php foreach($documentos as $row): ?>
                <tr>
                    <td><?= $row['anio_vigencia'] ?></td>
                    <td><?= htmlspecialchars($row['tit_documento']) ?></td>
                    <td>
                        <a href="<?= $row['rut_archivo'] ?>" target="_blank" class="btn-descarga">↓ Descargar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="text-align: center;">No hay documentos registrados.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
