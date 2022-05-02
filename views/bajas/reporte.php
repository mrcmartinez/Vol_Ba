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

        <h1 class="center">Sección de Reporte bajas</h1>
        <div class="center"><?php echo $this->mensaje; ?></div>
        <div id="respuesta" class="center"></div>


        <table width="100%">
            <thead>
                <tr>
                    <th>ID_PERSONAL</th>
                    <th>FECHA</th>
                    <th>MOTIVO</th>
                </tr>
            </thead>
            <tbody id="tbody-baja">
                <?php
                    include_once 'models/bajas.php';
                    foreach($this->baja as $row){
                        $baja = new Bajas();
                        $baja = $row; 
                ?>
                <tr id="fila-<?php echo $baja->id_personal; ?>">
                    <td><?php echo $baja->id_personal; ?></td>
                    <td><?php echo $baja->fecha; ?></td>
                    <td><?php echo $baja->motivo; ?></td>

                </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>

</body>

</html>