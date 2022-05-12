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
        <div><?php echo $this->mensaje; ?></div>
        <h1 class="center">Sección de consulta capacitacion todo</h1>
        <form action="<?php echo constant('URL'); ?>capacitaciones/saludo" method="POST">
            <table width="100%" id="tabla">
                <thead>
                    <tr>
                        <!-- <th>ID_curso</th> -->
                        <th>ID_personal</th>
                        <th>Nombre</th>
                        <th>estatus</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody id="tbody-alumnos">

                    <?php
            include_once 'models/capacitacion.php';
            foreach ($this->capacitacion as $row) {
                $capacitacion = new Capacitacion();
                $capacitacion = $row;
        ?>
                    <tr id="fila-<?php echo $capacitacion->id_curso; ?>">
                        <!-- <td><?php echo $capacitacion->id_curso; ?></td> -->
                        <td><?php echo $capacitacion->id_personal; ?></td>
                        <td><?php echo $capacitacion->nombre; ?></td>
                        <td><?php echo $capacitacion->estatus; ?></td>

                        <?php if ($capacitacion->estatus=="Pendiente" ) { ?>

                        <td><input type="checkbox" value="<?php echo $capacitacion->id_personal; ?>" name="personal[]"
                                onclick=""></td>

                        <?php }else{
                             ?>
                        <td><input type="checkbox" value="<?php echo $capacitacion->id_personal; ?>" name="" checked disabled
                                onclick=""></td>
                        <?php
                        } ?>

                        <!-- <td><button class="bEliminar" data-matricula="<?php echo $capacitacion->id; ?>">Eliminar</button></td>  -->
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <input type="hidden" name="id" value="<?php echo $capacitacion->id_curso; ?>">
            <input type="submit" name="seleccion" value="ok" />
        </form>
    </div>

    <?php require 'views/footer.php'; ?>
    <script src="<?php echo constant('URL'); ?>/public/js/main.js"></script>
</body>

</html>