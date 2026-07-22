<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colegio San José Obrero Maristas Sullana</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f4f7f6; margin: 0; color: #333; }
        header { background: #1854DA; color: white; padding: 20px; text-align: center; }
        .nav-bar { background: #0e3c9b; padding: 10px; text-align: right; }
        .nav-bar a { color: white; text-decoration: none; font-weight: bold; padding: 10px 20px; font-size: 0.9em; }
        .container { max-width: 1000px; margin: 30px auto; padding: 0 20px; }
        
        /* Cajas de secciones */
        .box { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-bottom: 40px; }
        .box-admision { border-left: 5px solid #fd7e14; }
        .box-calendario { border-left: 5px solid #6f42c1; }
        
        /* Listas */
        .clean-list { list-style: none; padding: 0; margin: 0; }
        .clean-list li { margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px dashed #eee; }
        .clean-list li:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
        .btn-descarga { background: #fd7e14; color: white; text-decoration: none; padding: 6px 12px; border-radius: 4px; font-size: 0.85em; font-weight: bold; margin-left: 10px; display: inline-block; }
        .btn-descarga:hover { background: #e06c00; }
        .fecha-badge { color: #6f42c1; font-weight: bold; }

        /* Estilos para las noticias */
        .news-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin-top: 20px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-top: 4px solid #1854DA; }
        .card.Urgente { border-top-color: #dc3545; }
        .card.Evento { border-top-color: #28a745; }
        .card-date { font-size: 0.8em; color: #777; margin-bottom: 10px; }
        .card-title { color: #1854DA; margin: 0 0 10px 0; font-size: 1.2em; }
        .badge { display: inline-block; padding: 4px 8px; border-radius: 4px; font-size: 0.75em; font-weight: bold; color: white; background: #1854DA; margin-bottom: 10px; }
        .badge.Urgente { background: #dc3545; }
        .badge.Evento { background: #28a745; }
    </style>
</head>
<body>
    <div class="nav-bar">
        <a href="index.php?action=login">Acceso Administrativo 🔒</a>
    </div>
    <header>
        <h1>Plataforma Informativa</h1>
        <h2>Colegio San José Obrero Maristas Sullana</h2>
    </header>

    <div class="container">
        
        <!-- SECCIÓN 1: PROCESO DE ADMISIÓN (PDFs) -->
        <h3 style="border-bottom: 2px solid #ccc; padding-bottom: 10px;">Proceso de Admisión</h3>
        <div class="box box-admision">
            <ul class="clean-list">
                <?php if(!empty($documentos)): ?>
                    <?php foreach($documentos as $doc): ?>
                        <li>
                            📄 <strong><?= htmlspecialchars($doc['tit_documento']) ?> (Año <?= $doc['anio_vigencia'] ?>)</strong> 
                            <a href="<?= $doc['rut_archivo'] ?>" target="_blank" class="btn-descarga">↓ Descargar PDF</a>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li><em>No hay documentos de admisión disponibles.</em></li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- SECCIÓN 2: CALENDARIO ESCOLAR -->
        <h3 style="border-bottom: 2px solid #ccc; padding-bottom: 10px;">Calendario Académico</h3>
        <div class="box box-calendario">
            <ul class="clean-list">
                <?php if(!empty($eventos)): ?>
                    <?php foreach($eventos as $evento): ?>
                        <li>
                            <span class="fecha-badge">
                                📅 <?= date('d/m/Y', strtotime($evento['fec_inicio'])) ?> 
                                <?php if($evento['fec_inicio'] != $evento['fec_fin']) echo " al " . date('d/m/Y', strtotime($evento['fec_fin'])); ?>:
                            </span> 
                            <?= htmlspecialchars($evento['des_evento']) ?>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li><em>No hay eventos programados próximos.</em></li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- SECCIÓN 3: COMUNICADOS RECIENTES -->
        <h3 style="border-bottom: 2px solid #ccc; padding-bottom: 10px;">Últimos Comunicados</h3>
        <div class="news-grid">
            <?php if(!empty($comunicados)): ?>
                <?php foreach($comunicados as $row): ?>
                    <div class="card <?= $row['cat_comunicado'] ?>">
                        <div class="badge <?= $row['cat_comunicado'] ?>"><?= $row['cat_comunicado'] ?></div>
                        <div class="card-date">🗓️ <?= date('d/m/Y h:i A', strtotime($row['fec_publicacion'])) ?></div>
                        <h4 class="card-title"><?= htmlspecialchars($row['tit_comunicado']) ?></h4>
                        <p><?= nl2br(htmlspecialchars($row['cpo_comunicado'])) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay comunicados recientes.</p>
            <?php endif; ?>
        </div>

    </div>
</body>
</html>

