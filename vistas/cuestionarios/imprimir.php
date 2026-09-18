<?php $url_base = constant('URL_BASE'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Orientación Vocacional - <?php echo htmlspecialchars($_SESSION['usuario']['nombre']); ?></title>
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #4f46e5;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --bg-light: #f8fafc;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-primary);
            line-height: 1.6;
            margin: 0;
            padding: 40px;
            background-color: white;
        }

        .header-print {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid var(--primary);
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary);
        }

        .meta-info {
            text-align: right;
            font-size: 0.88rem;
            color: var(--text-secondary);
        }

        .meta-info strong {
            color: var(--text-primary);
        }

        .report-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .report-title h1 {
            font-size: 2.2rem;
            margin: 0 0 10px 0;
            color: var(--text-primary);
        }

        .report-title p {
            color: var(--text-secondary);
            margin: 0;
        }

        .section-box {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            background-color: var(--bg-light);
            page-break-inside: avoid;
        }

        .section-title {
            font-size: 1.3rem;
            color: var(--primary);
            margin-top: 0;
            margin-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dominant-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .dominant-badge {
            font-size: 1.15rem;
            font-weight: 800;
            padding: 8px 18px;
            border-radius: 30px;
            color: white;
        }

        .dominant-pct {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary);
        }

        /* Breakdown Bars */
        .bar-wrapper {
            margin-bottom: 15px;
        }

        .bar-label {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .progress-bar-bg {
            background-color: #e2e8f0;
            height: 10px;
            border-radius: 5px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            border-radius: 5px;
        }

        /* Programs table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid var(--border-color);
            text-align: left;
        }

        th {
            background-color: #f1f5f9;
            color: var(--text-primary);
            font-weight: 700;
        }

        td {
            font-size: 0.9rem;
        }

        .price-tag {
            font-weight: 700;
            color: var(--primary);
        }

        .actions-print {
            text-align: center;
            margin-top: 40px;
            page-break-inside: avoid;
        }

        .btn-print {
            background-color: var(--primary);
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
            transition: all 0.2s;
        }

        .btn-print:hover {
            opacity: 0.9;
        }

        .footer-print {
            text-align: center;
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin-top: 50px;
            border-top: 1px solid var(--border-color);
            padding-top: 15px;
        }

        @media print {
            body {
                padding: 0;
            }
            .actions-print {
                display: none;
            }
            .section-box {
                border: none;
                padding: 0;
                background-color: transparent;
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header-print">
        <div class="brand">
            <i class="fa-solid fa-graduation-cap"></i>
            <span>Orienta tu FUTURO</span>
        </div>
        <div class="meta-info">
            Estudiante: <strong><?php echo htmlspecialchars($_SESSION['usuario']['nombre']); ?></strong><br>
            Ciudad: <strong><?php echo htmlspecialchars($_SESSION['usuario']['ciudad']); ?></strong><br>
            Fecha: <strong><?php echo date("d/m/Y"); ?></strong>
        </div>
    </div>

    <!-- Title -->
    <div class="report-title">
        <h1>Diagnóstico Vocacional de Holland (RIASEC)</h1>
        <p>Análisis personalizado de intereses profesionales y sugerencias de carrera</p>
    </div>

    <!-- Dominant Area -->
    <div class="section-box">
        <h2 class="section-title"><i class="fa-solid fa-star"></i> Perfil Vocacional Dominante</h2>
        <div class="dominant-area">
            <div class="dominant-badge" style="background-color: <?php echo $area_dominante['color']; ?>;">
                <?php echo htmlspecialchars($area_dominante['nombre']); ?>
            </div>
            <div class="dominant-pct">
                Afinidad: <?php echo $porcentaje_dominante; ?>%
            </div>
        </div>
        <p style="font-size: 1.05rem; line-height: 1.7; text-align: justify; margin: 0;">
            <?php echo htmlspecialchars($area_dominante['descripcion']); ?>
        </p>
    </div>

    <!-- Breakdown Chart -->
    <div class="section-box">
        <h2 class="section-title"><i class="fa-solid fa-chart-pie"></i> Distribución de Intereses</h2>
        
        <?php foreach ($areas_map as $key => $info): ?>
            <?php 
                $votos = $conteo[$key];
                $pct = round(($votos / $total) * 100);
            ?>
            <div class="bar-wrapper">
                <div class="bar-label">
                    <span><?php echo htmlspecialchars($info['nombre']); ?></span>
                    <strong style="color: <?php echo $info['color']; ?>;"><?php echo $pct; ?>%</strong>
                </div>
                <div class="progress-bar-bg">
                    <div class="progress-bar-fill" style="width: <?php echo $pct; ?>%; background-color: <?php echo $info['color']; ?>;"></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Suggested Careers -->
    <div class="section-box">
        <h2 class="section-title"><i class="fa-solid fa-graduation-cap"></i> Carreras Universitarias Sugeridas</h2>
        <p style="margin-bottom: 20px; font-size: 0.95rem;">
            De acuerdo con tu afinidad predominante con el área de <strong><?php echo htmlspecialchars($area_dominante['nombre']); ?></strong>, te recomendamos explorar las siguientes ofertas de pregrado:
        </p>

        <?php if (count($programas_sugeridos) === 0): ?>
            <p style="color: var(--text-secondary); font-style: italic; text-align: center; padding: 20px;">
                No se registran programas cargados para esta área vocacional actualmente en el sistema.
            </p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Programa Académico</th>
                        <th>Institución de Educación Superior</th>
                        <th>Duración</th>
                        <th style="text-align: right;">Matrícula Semestral</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($programas_sugeridos as $prog): ?>
                        <tr>
                            <td style="font-weight: 700; color: var(--text-primary);"><?php echo htmlspecialchars($prog['n_programa']); ?></td>
                            <td>
                                <i class="fa-solid fa-building-columns"></i> <?php echo htmlspecialchars($prog['universidad_nombre']); ?>
                                <span style="display: block; font-size: 0.78rem; color: var(--text-secondary);"><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($prog['universidad_ciudad']); ?></span>
                            </td>
                            <td><?php echo htmlspecialchars($prog['duracion']); ?> semestres</td>
                            <td style="text-align: right;" class="price-tag">
                                <?php echo ($prog['costo'] == 0) ? 'Gratuito / Variable' : '$' . number_format($prog['costo'], 0, ',', '.'); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <!-- Floating Actions -->
    <div class="actions-print">
        <button onclick="window.print();" class="btn-print">
            <i class="fa-solid fa-print"></i> Imprimir o Guardar en PDF
        </button>
        <a href="<?php echo $url_base; ?>usuarios/dashboard" class="btn-print" style="background-color: var(--text-secondary); margin-left: 10px;">
            <i class="fa-solid fa-arrow-left"></i> Volver a mi Panel
        </a>
    </div>

    <!-- Footer -->
    <div class="footer-print">
        <p>&copy; <?php echo date("Y"); ?> Orienta tu FUTURO. Reporte emitido bajo algoritmo de evaluación vocacional de Holland (RIASEC).</p>
    </div>

    <script>
        // Lanzar diálogo de impresión automáticamente tras cargar
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>
