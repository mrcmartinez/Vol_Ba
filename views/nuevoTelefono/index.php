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
        <h1 class="center">Agregar telefono</h1>

        <div class="center"><?php echo $this->mensaje; ?></div>
        <?php $idU=intval($this->ultimoId);?>
        <form action="<?php echo constant('URL'); ?>nuevoTelefono/registrarTelefono" method="POST">

            <p>
                <label for="id_personal">ID</label><br>
                <input type="number" name="id_personal" readonly value=<?php echo $idU?>>
            </p>
            <!--  -->
            <!-- <p>
                <label for="lada_1">Lada</label><br>
                <input type="number" name="lada_1" id="">
            </p>
            <p>
                <label for="numero_1">Numero</label><br>
                <input type="number" name="numero_1" id="">
            </p>
            <p>
                <label for="tipo_1">Tipo</label><br>
                <input type="text" name="tipo_1" value="Telefono casa">
            </p>
            <p>
                <label for="descripcion_1">Descripcion</label><br>
                <input type="text" name="descripcion_1" id="">
            </p> -->
            <!--  -->
            <!--  -->
            <p>
                <label for="lada_1">Lada</label><br>
                <input type="tel" name="lada_1" id="" pattern="[0-9]{3}">
            </p>
            <p>
                <label for="numero_1">Numero</label><br>
                <input type="tel" name="numero_1" id="" pattern="[0-9]{7}">
            </p>
            <p>
                <label for="tipo_1">Tipo</label><br>
                <input type="text" name="tipo_1" value="Telefono celular" readonly>
            </p>
            <p>
                <label for="descripcion_1">Descripcion</label><br>
                <input type="text" name="descripcion_1" id="" value="Propietario">
            </p>
            <!--  -->
            <p>
                <label for="lada_2">Lada</label><br>
                <input type="tel" name="lada_2" id="" pattern="[0-9]{3}">
            </p>
            <p>
                <label for="numero_2">Numero</label><br>
                <input type="tel" name="numero_2" id="" pattern="[0-9]{7}">
            </p>
            <p>
                <label for="tipo_2">Tipo</label><br>
                <input type="text" name="tipo_2" value="Telefono casa" readonly>
            </p>
            <p>
                <label for="descripcion_2">Descripcion</label><br>
                <input type="text" name="descripcion_2" id=""value="Propietario">
            </p>
            <!--casa  -->
            <!-- emergencia -->
            <p>
                <label for="lada_3">Lada</label><br>
                <input type="tel" name="lada_3" id="" pattern="[0-9]{3}">
            </p>
            <p>
                <label for="numero_3">Numero</label><br>
                <input type="tel" name="numero_3" id="" pattern="[0-9]{7}">
            </p>
            <p>
                <label for="tipo_3">Tipo</label><br>
                <input type="text" name="tipo_3" value="Emergencia" readonly>
            </p>
            <p>
                <label for="descripcion_3">Comunicarse con:</label><br>
                <input type="text" name="descripcion_3" id="">
            </p>
            <!-- emergencia -->
            <p>
                <input type="submit" value="Registrar nuevo Telefono">
            </p>

        </form>
    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>