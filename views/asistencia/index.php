<?php require 'libraries/session.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo constant('URL'); ?>assets/img/logo.ico" />
</head>

<body>
    <?php require 'views/header.php'; ?>

    <div id="main">
        <div class="center-form"><?php echo $this->mensaje; ?>
        
       
            <h1 class="center"><?php echo $_SESSION['nombreVol'];?></h1>
            <h1 class="center">Asistencia</h1>
            <div class="section-form">
                <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
                    <input type="submit" value="Regresar">
                </form>
                <form action="<?php echo constant('URL'); ?>consultaAsistencia/verasistenciaid/<?php echo $this->id?>"
                    method="POST">
                    <input class="btn-option" type="submit" value="Asistencias">
                </form>
                <form action="<?php echo constant('URL'); ?>documento/verdocumentoid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" value="Documentación">
                </form>
                <form action="<?php echo constant('URL'); ?>telefono/vertelefonoid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" value="Teléfonos">
                </form>
            </div>

            <div class="center"><?php echo $this->mensaje; ?></div>
            <div id="respuesta" class="center"></div>

            <table width="100%">
                <thead>
                    <tr>
                        <th>Id Personal</th>
                        <th>fecha</th>
                        <th>hora</th>
                        <th>estatus</th>
                    </tr>
                </thead>
                <tbody id="tbody-asistencia">
                    <?php
                    include_once 'models/asistencia.php';
                    foreach($this->asistencia as $row){
                        $asistencia = new Asistencia();
                        $asistencia = $row; 
                ?>
                    <tr id="fila-<?php echo $asistencia->id_personal; ?>">
                        <td><?php echo $asistencia->id_personal; ?></td>
                        <td><?php echo $asistencia->fecha; ?></td>
                        <td><?php echo $asistencia->hora; ?></td>
                        <td><?php echo $asistencia->estatus; ?></td>
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