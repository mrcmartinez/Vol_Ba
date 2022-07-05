<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo constant('URL'); ?>assets/img/logo.ico" />
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/estilos.css">
</head>

<body>
    <?php require 'views/header.php'; ?>

    <div id="main">
        <div class="center-form">
            <form action="<?php echo constant('URL'); ?>documento" method="POST">
                <input type="submit" value="Documentación Digital">
            </form>
            <form action="<?php echo constant('URL'); ?>documentoFisico/reporte" method="POST">
                <input type="submit" value="Documentación Fisica">
            </form>
            <form action="<?php echo constant('URL'); ?>consultaAsistencia" method="POST">
                <input type="submit" value="Asistencias">
            </form>
            <form action="<?php echo constant('URL'); ?>baja" method="POST">
                <input type="submit" value="Bajas">
            </form>

            <h1 class="center"><small>Reportes</small>Documentación Fisica entregada</h1>
            <div class="center"><?php echo $this->mensaje; ?></div>
            <div id="respuesta" class="center"></div>
            <form action="<?php echo constant('URL'); ?>documentoFisico/reporte" method="POST">
                <p>
                    <input type="text" name="caja_busqueda" id="caja_busqueda" autofocus>
                    <input type="submit" value="🔍Buscar">
                </p>
            </form>
            <form action="<?php echo constant('URL'); ?>documento/generarReporte" method="POST">
                <input type="hidden" name="caja_busqueda" id="caja_busqueda" value="<?php echo $this->consulta; ?>">
                <input type="image" src="<?php echo constant('URL'); ?>assets/img/xls.png">
            </form>

            <form action="<?php echo constant('URL'); ?>documento/generarReportePDF" method="post">
                <input type="hidden" name="caja_busqueda" id="caja_busqueda" value="<?php echo $this->consulta; ?>">
                <input type="image" src="<?php echo constant('URL'); ?>assets/img/pdf.png">
            </form>
            <div id="div2">
                <table class = "t-tipo1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>nombre</th>
                            <th>Acta</th>
                            <th>Curp</th>
                            <th>Carta</th>
                            <th>Comprobante</th>
                            <th>Datos</th>
                            <th>Estudio</th>
                            <th>Examen</th>
                            <th>INE</th>
                            <th>Solicitud</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-documento">
                        <?php
                    include_once 'models/documentosfisicos.php';
                    foreach($this->documentoFisico as $row){
                        $documentoFisico = new DocumentosFisicos();
                        $documentoFisico = $row; 
                ?>
                        <tr id="fila-<?php echo $documentoFisico->id_personal; ?>">
                            <td><?php echo $documentoFisico->id_personal; ?></td>
                            <td><?php echo $documentoFisico->nombre_personal; ?></td>
                            <td><?php echo $documentoFisico->acta; ?></td>
                            <td><?php echo $documentoFisico->curp; ?></td>
                            <td><?php echo $documentoFisico->carta; ?></td>
                            <td><?php echo $documentoFisico->comprobante; ?></td>
                            <td><?php echo $documentoFisico->datos; ?></td>
                            <td><?php echo $documentoFisico->estudio; ?></td>
                            <td><?php echo $documentoFisico->examen; ?></td>
                            <td><?php echo $documentoFisico->ine; ?></td>
                            <td><?php echo $documentoFisico->solicitud; ?></td>
                            <!-- <td><a href="<?php echo constant('URL') . 'documento/eliminardocumento/' . $documento->id_personal.'/'. $documento->nombre; ?>">Eliminar</a> </td> -->

                        </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>

</body>

</html>