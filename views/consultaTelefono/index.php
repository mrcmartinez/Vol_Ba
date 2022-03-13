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
                    <th>ID</th>
                    <th>lada</th>
                    <th>numero</th>
                    <th>Tipo</th>
                    <th>Propietario: </th>
                </tr>
            </thead>
            <tbody id="tbody-telefono">
                <?php
                    include_once 'models/telefono.php';
                    foreach($this->telefono as $row){
                        $telefono = new Telefono();
                        $telefono = $row; 
                ?>
                <tr id="fila-<?php echo $telefono->id_personal; ?>">
                    <td><?php echo $telefono->id_personal; ?></td>
                    <td><?php echo $telefono->lada; ?></td>
                    <td><?php echo $telefono->numero; ?></td>
                    <td><?php echo $telefono->tipo; ?></td>
                    <td><?php echo $telefono->descripcion; ?></td>
                    
                    <td><a href="<?php echo constant('URL') . 'consultaTelefono/vertelefono/' . $telefono->id_personal.'/'. $telefono->lada.'/'. $telefono->numero; ?>">Editar</a>  </td>
                    <!-- <td><a href="<?php echo constant('URL') . 'consultaTelefono/eliminartelefono/' . $telefono->id_personal; ?>">Eliminar</a> </td>-->
                    <td><button class="bEliminar" data-matricula="<?php echo $telefono->id_personal; ?>">Eliminar</button></td>
                </tr>

                <?php } ?>
            </tbody>
        </table>
        
    </div>

    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>

</body>
</html>