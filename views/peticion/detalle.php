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
        <h1 class="center">ver Detalle de <?php echo $this->peticion->folio; ?></h1>


        <div class="center"><?php echo $this->mensaje; ?></div>
        <form action="<?php echo constant('URL'); ?>peticion/autorizar" method="POST">
            <input type="submit" value="Regresar">
        </form>

        <?php if ( empty($this->peticion->dia_solicitado)) { ?>
            <form action="<?php echo constant('URL'); ?>peticion/autorizarFecha" method="POST">
        <?php }else{
            ?>
            <form action="<?php echo constant('URL'); ?>peticion/autorizarDia" method="POST">
        <?php
        } ?>
        <p>
            <label for="folio">Folio</label><br>
            <input type="number" name="folio" readonly value="<?php echo $this->peticion->folio; ?>">
        </p>
        <p>
            <label for="id_personal">ID personal</label><br>
            <input type="number" name="id_personal" readonly value="<?php echo $this->peticion->id_personal; ?>">
        </p>
        <!--  -->

        <p>
            <label for="fecha_apertura">fecha apertura</label><br>
            <input type="date" name="fecha_apertura" readonly value="<?php echo $this->peticion->fecha_apertura; ?>">
        </p>
        <p>
            <label for="tipo">Tipo</label><br>
            <input type="text" name="tipo" readonly value="<?php echo $this->peticion->tipo; ?>">
        </p>
        <p>
            <label for="descripcion">Descripcion</label><br>
            <input type="text" name="descripcion" readonly value="<?php echo $this->peticion->descripcion; ?>">
        </p>
        <?php if ( empty($this->peticion->dia_solicitado)) { ?>
        <p>
            <label for="fecha_solicitada">Fecha solicitada</label><br>
            <input type="date" name="colonia" readonly value="<?php echo $this->peticion->fecha_solicitada; ?>">
        </p>
        <?php }else{
            ?>
        <p>
            <label for="dia_solicitado">Dia solicitado</label><br>
            <input type="text" name="dia_solicitado" readonly value="<?php echo $this->peticion->dia_solicitado; ?>">
        </p>
        <?php
        } ?>
        <p>
            <label for="estatus">Estatus</label><br>
            <input type="text" name="estatus" readonly value="<?php echo $this->peticion->estatus; ?>">
        </p>
        <p>
            <input type="submit" value="Autorizar">
        </p>
        </form>
    </div>

    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>