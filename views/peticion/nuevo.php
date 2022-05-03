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
        <h1 class="center">Agregar peticion falta</h1>

        <div class="center"><?php echo $this->mensaje; ?></div>
        <form action="<?php echo constant('URL'); ?>peticion/crear" method="POST" enctype="multipart/form-data">

        <label for="">Id personal</label><br>
            <input type="number" name="id_personal" id=""><br>

            <label for="">Tipo</label><br>
            <input type="text" readonly name="tipo" value="Justificante"><br>

            <label for="">Fecha solicitada</label><br>
            <input type="date" name="fecha_solicitada" id=""><br>

            <input type="hidden" name="dia_solicitado" id="">

            <label for="">Descripcion</label><br>
            <input type="text" name="descripcion" id=""><br>

            <p><input type="file" name="archivo"></p></br>
            <p><input type="submit" value="Solicitar"></p>

        </form>
    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>