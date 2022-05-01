<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/bootstrap.min.css"> -->
</head>

<body>
    <?php require 'views/header.php'; ?>
    <div id="main">
        <h1 class="center">Detalle de <?php echo $this->peticion->folio; ?></h1>


        <div class="center"><?php echo $this->mensaje; ?></div>
        <form action="<?php echo constant('URL'); ?>peticion/listar" method="POST">
            <input type="submit" value="Regresar">
        </form>
        <p>
            <label for="folio">Folio</label><br>
            <input type="number" name="folio" disabled value="<?php echo $this->peticion->folio; ?>">
        </p>
        <p>
            <label for="id_personal">ID personal</label><br>
            <input type="number" name="id_personal" value="<?php echo $this->peticion->id_personal; ?>" disabled>
        </p>
        <!--  -->

        <p>
            <label for="fecha_apertura">fecha apertura</label><br>
            <input type="date" name="fecha_apertura" value="<?php echo $this->peticion->fecha_apertura; ?>" disabled>
        </p>
        <p>
            <label for="tipo">Tipo</label><br>
            <input type="text" name="tipo" value="<?php echo $this->peticion->tipo; ?>" disabled>
        </p>
        <p>
            <label for="descripcion">Descripcion</label><br>
            <input type="text" name="descripcion" value="<?php echo $this->peticion->descripcion; ?>" disabled>
        </p>
        <?php if ( empty($this->peticion->dia_solicitado)) { ?>
        <p>
            <label for="fecha_solicitada">Fecha solicitada</label><br>
            <input type="date" name="colonia" value="<?php echo $this->peticion->fecha_solicitada; ?>" disabled>
        </p>
        <?php }else{
            ?>
        <p>
            <label for="dia_solicitada">Dia solicitado</label><br>
            <input type="text" name="colonia" value="<?php echo $this->peticion->dia_solicitado; ?>" disabled>
        </p>
        <?php
        } ?>
        <p>
            <label for="estatus">Estatus</label><br>
            <input type="text" name="estatus" value="<?php echo $this->peticion->estatus; ?>" disabled>
        </p>
    </div>

    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>