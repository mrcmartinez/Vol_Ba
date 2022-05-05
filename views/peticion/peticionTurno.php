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
        
        <h1 class="center">Petición cambio de turno</h1>

        <form action="<?php echo constant('URL') . 'personal/seleccionarPersonal/'?>" method="post">
            <input type="hidden" name="peticion" value="turno">
            <input type="submit" value="🔍Buscar">
        </form>
        <div><?php echo $this->mensaje; ?></div>
        <!-- <form action="<?php echo constant('URL'); ?>personal/seleccionar" method="post"></form> -->
        <form action="<?php echo constant('URL'); ?>peticion/crear"  method="POST" enctype="multipart/form-data">

            <label for="">Id personal</label><br>
            <input type="number" name="id_personal" id="" value="<?php echo $this->id; ?>"><br>

            <label for="">Tipo</label><br>
            <input type="text" readonly name="tipo" value="Cambio turno"><br>

            
            <input type="hidden" name="fecha_solicitada" id="">
            
            <label for="">Dia solicitado</label><br>
            <input type="text" name="dia_solicitado" id=""><br>

            <label for="">Descripcion</label><br>
            <input type="text" name="descripcion" id=""><br>

            <input type="file" name="archivo" accept="application/pdf"></br>

            <input type="submit" value="Solicitar">
        </form>
    </div>

    <?php require 'views/footer.php'; ?>
    
</body>
</html>