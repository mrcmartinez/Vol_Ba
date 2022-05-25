<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <?php require 'views/header.php'; ?>

    <div id="main">
        <h1 class="center">Agregar telefono</h1>

        <div class="center-form"><?php echo $this->mensaje; ?>
        <?php $idU=intval($this->ultimoId);?>
        <form form class="row g-3" action="<?php echo constant('URL'); ?>telefono/registrarTelefono" method="POST">

            <div class="col-12">
                <label for="id_personal">ID</label>
                <input class="form-control" type="number" name="id_personal" readonly value=<?php echo $idU?>>
            </div>

            <div class="col-md-1">
                <label for="lada_1">Lada</label><br>
                <input class="form-control" type="tel" name="lada_1" id="" pattern="[0-9]{3}">
            </div>
            <div class="col-md-3">
                <label for="numero_1">Numero</label><br>
                <input class="form-control" type="tel" name="numero_1" id="" pattern="[0-9]{7}">
            </div>
            <div class="col-md-3">
                <label for="tipo_1">Tipo</label><br>
                <input class="form-control" type="text" name="tipo_1" value="Telefono celular" readonly>
            </div>
            <div class="col-md-5">
                <label for="descripcion_1">Descripcion</label><br>
                <input class="form-control" type="text" name="descripcion_1" id="" value="">
            </div>
            <!--  -->
            <div class="col-md-1">
                <label for="lada_2">Lada</label><br>
                <input class="form-control" type="tel" name="lada_2" id="" pattern="[0-9]{3}">
            </div>
            <div class="col-md-3">
                <label for="numero_2">Numero</label><br>
                <input class="form-control" type="tel" name="numero_2" id="" pattern="[0-9]{7}">
            </div>
            <div class="col-md-3">
                <label for="tipo_2">Tipo</label><br>
                <input class="form-control" type="text" name="tipo_2" value="Telefono casa" readonly>
            </div>
            <div class="col-md-5">
                <label for="descripcion_2">Descripcion</label><br>
                <input class="form-control" type="text" name="descripcion_2" id="" value="">
            </div>
            <!--casa  -->
            <!-- emergencia -->
            <div class="col-md-1">
                <label for="lada_3">Lada</label><br>
                <input class="form-control" type="tel" name="lada_3" id="" pattern="[0-9]{3}">
            </div>
            <div class="col-md-3">
                <label for="numero_3">Numero</label><br>
                <input class="form-control" type="tel" name="numero_3" id="" pattern="[0-9]{7}">
            </div>
            <div class="col-md-3">
                <label for="tipo_3">Tipo</label><br>
                <input class="form-control" type="text" name="tipo_3" value="Emergencia" readonly>
            </div>
            <div class="col-md-5">
                <label for="descripcion_3">Comunicarse con:</label><br>
                <input class="form-control" type="text" name="descripcion_3" id="">
            </div>

            <div class="col-md-2">
                <input type="submit" value="Siguiente">
            </div>

            <div class="col-md-10">
                <progress id="file" value="33" max="100"></progress>
            </div>
        </form>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>