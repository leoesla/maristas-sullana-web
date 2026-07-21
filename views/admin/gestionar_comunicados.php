<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Comunicados - Maristas Sullana</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f4f7f6; padding: 20px; margin: 0; }
        .container { max-width: 800px; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        h2, h3 { color: #1854DA; margin-top: 0; }
        input, textarea, select { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-family: inherit; }
        button { background: #1854DA; color: white; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; width: 100%; }
        button:hover { background: #0e3c9b; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #1854DA; color: white; }
        .back-link { display: inline-block; margin-bottom: 20px; color: #666; text-decoration: none; font-size: 0.9em; }
        .alert-success { background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #c3e6cb; }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php?action=dashboard" class="back-link">← Volver al Panel de Control</a>
        <h2>Gestión de Comunicados Oficiales</h2>
        
        <?php if(isset($_GET['success'])): ?>
            <div class="alert-success">✅ ¡El comunicado se ha publicado exitosamente!</div>
        <?php endif; ?>

        <!-- Formulario para CREAR -->
        <form action="index.php?action=guardar_comunicado" method="POST">
            <input type="text" name="titulo" placeholder="Título del aviso o noticia" required>
            
            <select name="categoria" required>
                <option value="">Seleccione una categoría...</option>
                <option value="Urgente">🚨 Urgente / Suspensión</option>
                <option value="Académico">📚 Académico / Matrícula</option>
                <option value="Evento">🎉 Evento Institucional</option>
            </select>

            <textarea name="cuerpo" rows="5" placeholder="Escriba el contenido del comunicado aquí..." required></textarea>
            
            <button type="submit">Publicar Comunicado</button>
        </form>

        <hr style="margin: 30px 0; border: 0; border-top: 1px solid #eee;">

        <!-- Tabla para LEER (Historial) -->
        <h3>Historial de Publicaciones</h3>
        <table>
            <tr>
                <th>Fecha y Hora</th>
                <th>Título</th>
                <th>Categoría</th>
            </tr>
            <!-- Aquí el controlador inyectará la variable $comunicados -->
            <?php if(!empty($comunicados)): ?>
                <?php foreach($comunicados as $row): ?>
                <tr>
                    <td><?= $row['fec_publicacion'] ?></td>
                    <td><?= $row['tit_comunicado'] ?></td>
                    <td><?= $row['cat_comunicado'] ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="text-align: center;">Aún no hay comunicados publicados.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
