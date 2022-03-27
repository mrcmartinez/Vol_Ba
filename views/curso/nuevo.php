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
        <h1 class="center">Sección de Nuevo curso</h1>

        <form action="<?php echo constant('URL'); ?>curso/crear" method="POST">
            <!-- <label for="">ID</label><br>
            <input type="text" name="id" id=""><br> -->
            <label for="">Nombre</label><br>
            <input type="text" name="nombre" id=""><br>
            <label for="">Descripcion</label><br>
            <input type="text" name="descripcion" id=""><br>
            <label for="">Responsable</label><br>
            <input type="text" name="responsable" id=""><br>
            <label for="">Fecha</label><br>
            <input type="date" name="fecha" id=""><br>
            <label for="">Hora</label><br>
            <input type="time" name="hora" id=""><br>
            <label for="">Estatus</label><br>
            <input type="text" name="estatus" id=""><br>
            <input type="submit" value="Crear nuevo curso">
        </form>
    </div>

    <?php require 'views/footer.php'; ?>
    
</body>
</html>