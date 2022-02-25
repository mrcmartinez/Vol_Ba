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
        <h1 class="center">Detalle de <?php echo $this->personal->id_personal; ?> </h1>

        <div class="center"><?php echo $this->mensaje; ?></div>

        <form action="<?php echo constant('URL'); ?>consulta" method="POST">

            <p>
                <label for="id_personal">ID</label><br>
                <input type="number" name="id_personal" disabled value="<?php echo $this->personal->id_personal; ?>">
            </p>
            <p>
                <label for="nombre">Nombre</label><br>
                <input type="text" name="nombre" value="<?php echo $this->personal->nombre; ?>" disabled>
            </p>
            <p>
                <label for="estatus">estatus</label><br>
                <input type="text" name="estatus" value="<?php echo $this->personal->estatus; ?>" disabled>
            </p>
<!--  -->

            <p>
                <label for="apellido_paterno">Apellido Paterno</label><br>
                <input type="text" name="apellido_paterno" value="<?php echo $this->personal->apellido_paterno; ?>" disabled>
            </p>
            <p>
                <label for="apellido_materno">Apellido Materno</label><br>
                <input type="text" name="apellido_materno" value="<?php echo $this->personal->apellido_materno; ?>" disabled>
            </p>
            <p>
                <label for="calle">Calle</label><br>
                <input type="text" name="calle" value="<?php echo $this->personal->calle; ?>" disabled>
            </p>
            <p>
                <label for="colonia">Colonia</label><br>
                <input type="text" name="colonia" value="<?php echo $this->personal->colonia; ?>" disabled>
            </p>
            <p>
                <label for="numero_exterior">Numero exterior</label><br>
                <input type="number" name="numero_exterior" value="<?php echo $this->personal->numero_exterior; ?>" disabled>
            </p>
            <p>
                <label for="edad">Edad</label><br>
                <input type="number" name="edad" value="<?php echo $this->personal->edad; ?>" disabled>
            </p>
            <p>
                <label for="fecha_nacimiento">Fecha Nacimiento</label><br>
                <input type="date" name="fecha_nacimiento" value="<?php echo $this->personal->fecha_nacimiento; ?>" disabled>
            </p>
            <p>
                <label for="estado_civil">Estado Civil</label><br>
                <input type="text" name="estado_civil" value="<?php echo $this->personal->estado_civil; ?>" disabled>
            </p>

            <p>
                <label for="numero_hijos">Numero de hijos</label><br>
                <input type="number" name="numero_hijos" value="<?php echo $this->personal->numero_hijos; ?>" disabled>
            </p>
            <p>
                <label for="escolaridad">Escolaridad</label><br>
                <input type="text" name="escolaridad" value="<?php echo $this->personal->escolaridad; ?>" disabled>
            </p>

<!--  -->
            <p>
            <input type="submit" value="Regresar">
            </p>

        </form>
    </div>

    <?php require 'views/footer.php'; ?>
</body>
</html>