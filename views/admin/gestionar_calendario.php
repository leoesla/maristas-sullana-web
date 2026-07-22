<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Calendario - Maristas Sullana</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f4f7f6; padding: 20px; margin: 0; }
        .container { max-width: 800px; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        h2, h3 { color: #6f42c1; margin-top: 0; }
        input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-family: inherit; }
        .date-group { display: flex; gap: 15px; }
        .date-group div { flex: 1; }
        button { background: #6f42c1; color: white; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; width: 100%; margin-top: 10px; }
        button:hover { background: #59339d; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #6f42c1; color: white; }
        .back-link { display: inline-block; margin-bottom: 20px; color: #666; text-decoration: none; font-size: 0.9em; }
        .alert-success { background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #c3e6cb; }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php?action=dashboard" class="back-link">← Volver al Panel de Control</a>
        <h2>Gestión del Calendario Académico</h2>
        
        <?php if(isset($_GET['success'])): ?>
            <div class="alert-success">✅ ¡El evento se ha agendado exitosamente!</div>
        <?php endif; ?>

        <!-- Formulario para CREAR eventos -->
        <form action="index.php?action=guardar_calendario" method="POST">
            <label style="font-weight: bold; color: #555;">Descripción del Evento:</label>
            <input type="text" name="descripcion" placeholder="Ej. Inicio del Segundo Bimestre / Día del Logro" required>
            
            <div class="date-group">
                <div>
                    <label style="font-weight: bold; color: #555;">Fecha de Inicio:</label>
                    <input type="date" name="fecha_inicio" required>
                </div>
                <div>
                    <label style="font-weight: bold; color: #555;">Fecha de Fin:</label>
                    <input type="date" name="fecha_fin" required>
                </div>
            </div>
            
            <button type="submit">Agendar Evento</button>
        </form>

        <hr style="margin: 30px 0; border: 0; border-top: 1px solid #eee;">

        <!-- Tabla para LEER (Cronograma) -->
        <h3>Cronograma de Actividades</h3>
        <table>
            <tr>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Actividad</th>
            </tr>
            <?php if(!empty($eventos)): ?>
                <?php foreach($eventos as $row): ?>
                <tr>
                    <td><?= date('d/m/Y', strtotime($row['fec_inicio'])) ?></td>
                    <td><?= date('d/m/Y', strtotime($row['fec_fin'])) ?></td>
                    <td><?= htmlspecialchars($row['des_evento']) ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="text-align: center;">Aún no hay eventos programados.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
