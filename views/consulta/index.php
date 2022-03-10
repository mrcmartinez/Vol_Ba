<?php require 'libraries/session.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/styles.css">
</head>
<body>
    <?php require 'views/header.php'; ?>

    <div class="container-fluid">
        <h1 class="center">Sección de Consulta</h1>
        <div class="center"><?php echo $this->mensaje; ?></div>
        
        <div id="respuesta" class="center"></div>
        <h4>Bienvenido<?php echo $_SESSION['rol']?></h4>
        <table class="table" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tbody-personal">
                <?php
                    include_once 'models/personal.php';
                    foreach($this->personal as $row){
                        $personal = new Personal();
                        $personal = $row; 
                ?>
                <tr id="fila-<?php echo $personal->id_personal; ?>">
                    <td><?php echo $personal->id_personal; ?></td>
                    <td><?php echo $personal->completo; ?></td>
                    <td><?php echo $personal->estatus; ?></td>
                    
                    <td><a href="<?php echo constant('URL') . 'consulta/verInformacion/' . $personal->id_personal; ?>">Ver</a>
                    <td><a href="<?php echo constant('URL') . 'consultaTelefono/vertelefonoid/'. $personal->id_personal;?>">Telefonos</a>
                    <!-- <td><a href="<?php echo constant('URL') . 'consulta/eliminarPersonal/' . $personal->id_personal; ?>">Eliminar</a> </td>-->
                    <?php if ( $_SESSION['rol']!="supervisor" ) { ?>
                        <a href="<?php echo constant('URL') . 'consulta/verPersonal/' . $personal->id_personal; ?>">Editar</a>
                        <button class="bEliminar" data-matricula="<?php echo $personal->id_personal; ?>">Eliminar</button></td>
                    <?php } ?>
                </tr>

                <?php } ?>
            </tbody>
        </table>
        
    </div>

    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>

</body>
</html>