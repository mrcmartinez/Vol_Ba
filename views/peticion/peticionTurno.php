<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Peticiones</title>
</head>
<body>

    <?php require 'views/header.php'; ?>

    <div id="main">
        <div><?php echo $this->mensaje; ?></div>
        <h1 class="center">Petición Cambio de Turno</h1>

        <form action="<?php echo constant('URL'); ?>peticion/crear" method="POST">

            <label for="">Id personal</label><br>
            <input type="number" name="id_personal" id=""><br>

            <label for="">Tipo</label><br>
            <input type="text" readonly name="tipo" value="Cambio turno"><br>

            <label for="">Dia solicitado</label><br>
            <input type="text" name="dia_solicitado" id=""><br>

            <input type="hidden" name="fecha_solicitada" id="">

            <label for="">Descripcion</label><br>
            <input type="text" name="descripcion" id=""><br>

            <input type="submit" value="Solicitar">
        </form>
    </div>

    <?php require 'views/footer.php'; ?>
    
</body>
</html>