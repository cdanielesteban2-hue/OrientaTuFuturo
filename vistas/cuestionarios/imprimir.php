<?php
/** @var array $area_dominante */
/** @var int $porcentaje_dominante */
/** @var array $areas_map */
/** @var array $conteo */
/** @var int $total */
/** @var string $usuario_nombre */
$url_base = constant('URL_BASE');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Orientación Vocacional - <?php echo htmlspecialchars($usuario_nombre); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --border-color: #cbd5e1;
            --bg-light: #f8fafc;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            color: var(--text-primary);
            line-height: 1.5;
            margin: 0;
            padding: 30px;
            background-color: white;
            font-size: 13px;
        }

        .header-print {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid var(--primary);
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .brand {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .meta-info {
            text-align: right;
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .report-title {
            text-align: center;
            margin-bottom: 25px;
        }

        .report-title h1 {
            font-size: 1.8rem;
            margin: 0 0 5px 0;
            color: var(--text-primary);
        }

        .section-box {
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 18px;
            margin-bottom: 20px;
            background-color: var(--bg-light);
            page-break-inside: avoid;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 6px;
        }

        .table-riasec {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table-riasec th, .table-riasec td {
            border: 1px solid var(--border-color);
            padding: 8px 12px;
            text-align: left;
        }

        .table-riasec th {
            background-color: #e2e8f0;
            font-weight: 700;
        }

        .bar-container {
            width: 100%;
            height: 10px;
            background-color: #e2e8f0;
            border-radius: 5px;
            overflow: hidden;
            display: inline-block;
        }

        .bar-fill {
            height: 100%;
            background-color: var(--primary);
        }

        .ethics-box {
            border: 2px dashed #f59e0b;
            background-color: #fffbeb;
            padding: 15px;
            border-radius: 8px;
            margin-top: 25px;
            page-break-inside: avoid;
        }

        .ethics-box p {
            margin: 4px 0;
            font-size: 0.8rem;
            color: #92400e;
        }

        .btn-print-floating {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 12px 24px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 30px;
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            cursor: pointer;
        }

        @media print {
            body { padding: 0; }
            .btn-print-floating { display: none; }
        }
    </style>
</head>
<body>

    <button onclick="window.print()" class="btn-print-floating">
        <i class="fa-solid fa-print"></i> Imprimir Reporte
    </button>

    <div class="header-print">
        <div class="brand">
            <i class="fa-solid fa-graduation-cap"></i> Orienta tu FUTURO
        </div>
        <div class="meta-info">
            <div><strong>Estudiante:</strong> <?php echo htmlspecialchars($usuario_nombre); ?></div>
            <div><strong>Fecha:</strong> <?php echo date("d/m/Y"); ?></div>
            <div><strong>Modelo:</strong> John Holland RIASEC &amp; Alianzas Académicas</div>
        </div>
    </div>

    <div class="report-title">
        <h1>Informe Oficial de Orientación Vocacional</h1>
        <p style="color: var(--text-secondary); margin: 0;">Diagnóstico Psicométrico y Mapeo de Carreras Universitarias</p>
    </div>

    <!-- Área Dominante -->
    <div class="section-box" style="border-left: 6px solid <?php echo $area_dominante['color']; ?>;">
        <div class="section-title" style="color: <?php echo $area_dominante['color']; ?>;">
            <i class="fa-solid fa-star"></i> Área Ocupacional Dominante: <?php echo htmlspecialchars($area_dominante['nombre']); ?> (<?php echo $porcentaje_dominante; ?>%)
        </div>
        <p style="margin: 6px 0 12px 0;">
            <?php echo htmlspecialchars($area_dominante['descripcion']); ?>
        </p>
        <p style="margin: 0; font-size: 0.85rem;">
            <strong>Habilidades Destacadas:</strong> <?php echo htmlspecialchars($area_dominante['habilidades']); ?><br>
            <strong>Proyección de Empleabilidad:</strong> <?php echo htmlspecialchars($area_dominante['empleabilidad']); ?>
        </p>
    </div>

    <!-- Tabla Desglose RIASEC de las 6 Áreas -->
    <div class="section-box">
        <div class="section-title">
            <i class="fa-solid fa-chart-pie"></i> Desglose de Afinidad en las 6 Dimensiones de Holland
        </div>
        <table class="table-riasec">
            <thead>
                <tr>
                    <th style="width: 35%;">Área Ocupacional</th>
                    <th style="width: 15%;">Código</th>
                    <th style="width: 15%;">Porcentaje</th>
                    <th style="width: 35%;">Nivel de Afinidad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($areas_map as $k => $info): 
                    $votos = $conteo[$k] ?? 0;
                    $pct = $total > 0 ? round(($votos / $total) * 100) : 0;
                ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($info['nombre']); ?></strong></td>
                    <td><?php echo $info['clave']; ?></td>
                    <td><strong><?php echo $pct; ?>%</strong></td>
                    <td>
                        <div class="bar-container">
                            <div class="bar-fill" style="width: <?php echo $pct; ?>%; background-color: <?php echo $info['color']; ?>;"></div>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Carreras Recomendadas -->
    <div class="section-box">
        <div class="section-title">
            <i class="fa-solid fa-graduation-cap"></i> Programas Académicos Sugeridos en Colombia
        </div>
        <p style="font-size: 0.85rem; color: var(--text-secondary); margin-bottom: 10px;">
            Con base en tu congruencia vocacional y el catálogo de universidades del país (UDES, UdeM, U. Nacional, Javeriana, Andes, EAFIT, UPB, ITM, entre otras):
        </p>
        <ul style="padding-left: 20px; margin: 0; font-size: 0.9rem;">
            <?php foreach ($area_dominante['carreras_clave'] as $car): ?>
                <li style="margin-bottom: 4px;"><strong><?php echo htmlspecialchars($car); ?></strong> — Alta afinidad con tus fortalezas cognitivas y prácticas.</li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Reconocimiento Obligatorio y Disclaimer Ético -->
    <div class="ethics-box">
        <p style="font-weight: bold; font-size: 0.85rem;">
            RECONOCIMIENTO DE FUENTES INSTITUCIONALES (OBLIGATORIO):
        </p>
        <p style="font-style: italic;">
            “Este test de orientación vocacional se inspira y toma como referencia el Test Vocacional de Filadd (basado en el modelo de John Holland), el Test de Orientación Vocacional de la Universidad de Santander (UDES) y el Test de Orientación Vocacional de la Universidad de Medellín (UVirtualAbierta).”
        </p>
        <p>
            Metodología fundamentada en el modelo tipológico hexagonal de John Holland (RIASEC) y en las herramientas institucionales colombianas diseñadas por profesionales para la prevención de la deserción universitaria y la consolidación de proyectos de vida profesional.
        </p>
        <p style="font-weight: bold; margin-top: 8px;">
            AVISO ÉTICO: “Este test es una herramienta de orientación y no reemplaza una asesoría profesional personalizada de un orientador vocacional, psicólogo o pedagogo.”
        </p>
    </div>

</body>
</html>
