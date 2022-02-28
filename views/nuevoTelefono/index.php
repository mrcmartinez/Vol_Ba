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
            <p>
                <label for="lada">Lada</label><br>
                <input type="number" name="lada" id="" required>
            </p>
            <p>
                <label for="numero">Numero</label><br>
                <input type="number" name="numero" id="" required>
            </p>
            <p>
                <label for="tipo">Tipo</label><br>
                <input type="text" name="tipo" id="" required>
            </p>
            <p>
                <label for="descripcion">Descripcion</label><br>
                <input type="text" name="descripcion" id="" required>
            </p>
            <p>
            <input type="submit" value="Registrar nuevo Telefono">
            </p>

        </form>
    </div>

    <?php require 'views/footer.php'; ?>
</body>
</html>