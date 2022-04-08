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
        <h1 class="center">Detalle de <?php echo $this->telefono->id_personal; ?> </h1>

        <div class="center"><?php echo $this->mensaje; ?></div>

        <form action="<?php echo constant('URL'); ?>telefono/actualizartelefono" method="POST">

            <p>
                <label for="id_personal">ID</label><br>
                <input type="number" name="id_personal" readonly value="<?php echo $this->telefono->id_personal; ?>" required>
            </p>
            <p>
                <label for="lada">lada</label><br>
                <input type="text" name="lada" value="<?php echo $this->telefono->lada; ?>" required>
            </p>
            <p>
                <label for="numero">numero</label><br>
                <input type="text" name="numero" value="<?php echo $this->telefono->numero; ?>" required>
            </p>
<!--  -->

            <p>
                <label for="tipo">tipo</label><br>
                <input type="text" name="tipo" value="<?php echo $this->telefono->tipo; ?>" required>
            </p>
            <p>
                <label for="descripcion">descripcion</label><br>
                <input type="text" name="descripcion" value="<?php echo $this->telefono->descripcion; ?>" required>
            </p>

<!--  -->
            <p>
            <input type="submit" value="Actualizar telefono">
            </p>

        </form>
    </div>

    <?php require 'views/footer.php'; ?>
</body>
</html>