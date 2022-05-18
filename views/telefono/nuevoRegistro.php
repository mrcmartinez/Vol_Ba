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
        <form action="<?php echo constant('URL'); ?>telefono/registrarNuevo" method="POST">

            <p>
                <label for="id_personal">ID</label><br>
                <input type="number" name="id_personal" readonly value=<?php echo $idU?>>
            </p>

            <p>
                <label for="lada">Lada</label><br>
                <input type="tel" name="lada" id="" pattern="[0-9]{3}" required>
            </p>
            <p>
                <label for="numero">Numero</label><br>
                <input type="tel" name="numero" id="" pattern="[0-9]{7}"required>
            </p>
            <p>
                <label for="tipo">Tipo</label><br>
                <select id="tipo" name="tipo">
                    <option value="Celular">Celular</option>
                    <option value="Casa">Casa</option>
                    <option value="Emergencia">Emergencia</option>
                </select>

            </p>
            <p>
                <label for="descripcion">Descripcion</label><br>
                <input type="text" name="descripcion" id="" value="Propietario">
            </p>

            <p>
                <input type="submit" value="Registrar nuevo Telefono">
            </p>

        </form>
        <form action="<?php echo constant('URL'); ?>telefono/vertelefonoid/<?php echo $idU?>" method="POST">
            <input type="submit" value="Volver">
        </form>
    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>