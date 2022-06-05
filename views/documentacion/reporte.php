<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php require 'views/header.php'; ?>

    <div id="main">
    <form action="<?php echo constant('URL'); ?>documento" method="POST">
            <input type="submit" value="Documentacion">
        </form>
        <form action="<?php echo constant('URL'); ?>consultaAsistencia" method="POST">
            <input type="submit" value="Asistencias">
        </form>
        <form action="<?php echo constant('URL'); ?>baja" method="POST">
            <input type="submit" value="Bajas">
        </form>

        <h1 class="center"><small>Reportes</small>Documentacion</h1>
        <div class="center"><?php echo $this->mensaje; ?></div>
        <div id="respuesta" class="center"></div>
        <form action="<?php echo constant('URL'); ?>documento" method="POST">
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
        <table width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Documento</th>
                    <th>Tipo</th>
                    <th>Estatus</th>
                </tr>
            </thead>
            <tbody id="tbody-documento">
                <?php
                    include_once 'models/documentos.php';
                    foreach($this->documento as $row){
                        $documento = new Documentos();
                        $documento = $row; 
                ?>
                <tr id="fila-<?php echo $documento->id_personal; ?>">
                    <td><?php echo $documento->id_personal; ?></td>
                    <td><?php echo $documento->nombre_personal; ?></td>
                    <td><?php echo $documento->nombre; ?></td>
                    <td><?php echo $documento->estatus; ?></td>
                    <!-- <td><a href="<?php echo constant('URL') . 'documento/eliminardocumento/' . $documento->id_personal.'/'. $documento->nombre; ?>">Eliminar</a> </td> -->

                </tr>

                <?php } ?>
            </tbody>
        </table>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>

</body>

</html>