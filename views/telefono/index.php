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
        <h1 class="center">Sección de Consulta telefonos</h1>
        <?php echo "id es: ".$this->id?>
        <div class="center"><?php echo $this->mensaje; ?></div>
        <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
            <input type="submit" value="Regresar">
        </form>
        <form
            action="<?php echo constant('URL'); ?>consultaAsistencia/verasistenciaid/<?php echo $this->id?>"
            method="POST">
            <input type="submit" value="Asistencias">
        </form>
        <form
            action="<?php echo constant('URL'); ?>documento/verdocumentoid/<?php echo $this->id?>"
            method="POST">
            <input type="submit" value="Documentacion">
        </form>
        <form
            action="<?php echo constant('URL'); ?>telefono/vertelefonoid/<?php echo $this->id?>"
            method="POST">
            <input type="submit" value="Telefonos">
        </form>
        <div id="respuesta" class="center"></div>

        <table width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>lada</th>
                    <th>numero</th>
                    <th>Tipo</th>
                    <th>Propietario: </th>
                </tr>
            </thead>
            <tbody id="tbody-telefono">
                <?php
                    include_once 'models/telefonos.php';
                    foreach($this->telefono as $row){
                        $telefono = new Telefonos();
                        $telefono = $row; 
                ?>
                <tr id="fila-<?php echo $telefono->id_personal; ?>">
                    <td><?php echo $telefono->id_personal; ?></td>
                    <td><?php echo $telefono->lada; ?></td>
                    <td><?php echo $telefono->numero; ?></td>
                    <td><?php echo $telefono->tipo; ?></td>
                    <td><?php echo $telefono->descripcion; ?></td>

                    <td><a
                            href="<?php echo constant('URL') . 'telefono/vertelefono/' . $telefono->id_personal.'/'. $telefono->lada.'/'. $telefono->numero; ?>">Editar</a>
                    </td>
                    <td><a href="<?php echo constant('URL') . 'telefono/eliminartelefono/' . $telefono->id_personal.'/'. $telefono->lada.'/'. $telefono->numero; ?>">Eliminar</a> </td>
                    <!-- <td><button class="bEliminar"
                            data-matricula="<?php echo $telefono->id_personal; ?>">Eliminar</button></td> -->
                </tr>

                <?php } ?>
            </tbody>
        </table>
            <a href="<?php echo constant('URL') . 'telefono/nuevoTelefono/' . $this->id; ?>">Nuevo</a>
        <!-- <form action="<?php echo constant('URL'); ?>personal/listar" method="POST">
            <input type="submit" value="Regresar">
        </form> -->
    </div>

    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>

</body>

</html>