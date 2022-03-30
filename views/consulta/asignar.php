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
        <h1 class="center">Asignar Voluntariado</h1>
        <div class="center"><?php echo $this->mensaje; ?></div>

        <div id="respuesta" class="center">
            <h4>Bienvenido<?php echo $_SESSION['rol']?></h4>
            <form action="<?php echo constant('URL'); ?>consulta/listar/ <?php echo $this->idCurso ?>" method="POST">

                <?php switch($this->radio){
                    case "Activo":
                        echo '<input type="radio" id="" name="radio_busqueda" value="Activo"checked>Activo
                        <input type="radio" id="" name="radio_busqueda" value="Candidato">Candidato';
                        break;
                    case "Candidato":
                        echo '<input type="radio" id="" name="radio_busqueda" value="Activo">Activo
                        <input type="radio" id="" name="radio_busqueda" value="Candidato"checked>Candidato';
                        break;
                }?>
                <p>
                    <input type="text" name="caja_busqueda" id="caja_busqueda" autofocus>
                    <input type="submit" value="Buscar">
                </p>
            </form>
        </div>
        <div class="center"><?php echo $this->consulta; ?></div>
        <form action="<?php echo constant('URL'); ?>capacitaciones/saludo" method="POST">
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
                    include_once 'models/personal.php';
                    foreach($this->personal as $row){
                        $personal = new Personal();
                        $personal = $row; 
                ?>
                    <tr id="fila-<?php echo $personal->id_personal; ?>">
                        <td><?php echo $personal->id_personal; ?></td>
                        <td><?php echo $personal->completo; ?></td>
                        <td><?php echo $personal->estatus; ?></td>
                        <td><input type="checkbox" value="<?php echo $personal->id_personal; ?>" name="eliminar" onclick="reload()"></td>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>
            <input type="submit" name="borrar"value="ok" />
        </form>
    </div>

    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>

</body>

</html>