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
        <h1 class="center">Sección de Consulta</h1>
        <div class="center"><?php echo $this->mensaje; ?></div>
        <div id="respuesta" class="center"></div>

        <table width="100%">
            <thead>
                <tr>
                    <th>Id Personal</th>
                    <th>fecha</th>
                    <th>eststus</th>
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
                    <td><?php echo $asistencia->estatus; ?></td>
                
                    <!-- <td><a href="<?php echo constant('URL') . 'consultaAsistencia/verasistencia/' . $asistencia->id_personal.'/'. $asistencia->lada.'/'. $asistencia->numero; ?>">Editar</a>  </td> -->
                    <!-- <td><a href="<?php echo constant('URL') . 'consultaAsistencia/eliminarasistencia/' . $asistencia->id_personal; ?>">Eliminar</a> </td>-->
                    <!-- <td><button class="bEliminar" data-matricula="<?php echo $asistencia->id_personal; ?>">Eliminar</button></td> -->
                </tr>

                <?php } ?>
            </tbody>
        </table>
        <form action="<?php echo constant('URL'); ?>personal/listar" method="POST">
            <input type="submit" value="Regresar">
        </form>
    </div>

    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>

</body>
</html>