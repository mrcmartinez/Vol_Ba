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
        <h1 class="center">Buscar Voluntariado</h1>
        <div class="center"><?php echo $this->mensaje; ?></div>

        <div id="respuesta" class="center">
            <h4>Bienvenido<?php echo $_SESSION['rol']?></h4>
            <form action="<?php echo constant('URL'); ?>personal/seleccionarPersonal/" method="POST">
            <input type="radio" id="" name="radio_busqueda" value="Activo" checked>Activo
                <p>
                    <input type="search" name="caja_busqueda" id="caja_busqueda" value="<?php echo $this->consulta; ?>" autofocus>
                    <input type="hidden" name="peticion" value="<?php echo $this->tipo; ?>">
                    <input type="submit" value="Buscar">
                </p>
            </form>
        </div>
        <form action="<?php echo constant('URL'); ?>peticion/imprimir" method="POST">
        <input type="hidden" name="peticion" value="<?php echo $this->tipo; ?>">
        <!-- <form method="POST"> -->
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Estatus</th>
                        <th>SELECCIONAR</th>
                    </tr>
                </thead>
                <tbody id="tbody-personal">
                    <?php
                    include_once 'models/personalBanco.php';
                    foreach($this->personal as $row){
                        $personal = new PersonalBanco();
                        $personal = $row; 
                ?>
                    <tr id="fila-<?php echo $personal->id_personal; ?>">
                        <td><?php echo $personal->id_personal; ?></td>
                        <td><?php echo $personal->apellido_paterno.' '.$personal->apellido_materno.' '.$personal->nombre; ?></td>
                        <td><?php echo $personal->estatus; ?></td>
                        <td><input type="checkbox" value="<?php echo $personal->id_personal; ?>" name="personal" onchange="this.form.submit()"></td>
                        <input type="hidden" name="nombre" value="<?php echo $personal->apellido_paterno.' '.$personal->apellido_materno.' '.$personal->nombre; ?>">
                    </tr>

                    <?php } ?>
                </tbody>
            </table>
        </form>
    </div>

    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>

</body>

</html>