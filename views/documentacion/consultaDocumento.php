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
        <h1 class="center">Sección de Consultaid</h1>
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
        <div class="center"><?php echo $this->mensaje; ?></div>
        <div id="respuesta" class="center"></div>

        <table width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Estatus</th>
                    <th></th>
                    <th></th>
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
                    <td><?php echo $documento->nombre; ?></td>
                    <td><?php echo $documento->estatus; ?></td>
                    <td><a href="<?php echo constant('URL') . 'documento/eliminardocumento/' . $documento->id_personal.'/'. $documento->nombre; ?>">Eliminar</a></td>
                    <td><a href="<?php echo constant('URL') . 'documento/verDocumento/' . $documento->id_personal.'/'. $documento->descripcion; ?>"target="_blank">ver</a></td>
                
                </tr>

                <?php } ?>
            </tbody>
        </table>
        <a href="<?php echo constant('URL') . 'documento/nuevoDocumento/' . $this->id; ?>">Nuevo</a>
        <!-- <form action="<?php echo constant('URL'); ?>personal/listar" method="POST">
            <input type="submit" value="Regresar">
        </form> -->
    </div>

    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>

</body>
</html>