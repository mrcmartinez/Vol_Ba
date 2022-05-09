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

        <form action="<?php echo constant('URL'); ?>personal/actualizarPersonal" method="POST">

            <p>
                <label for="id_personal">ID</label><br>
                <input type="number" name="id_personal" readonly value="<?php echo $this->personal->id_personal; ?>"
                    required>
            </p>
            <p>
                <label for="nombre">Nombre</label><br>
                <input type="text" name="nombre" value="<?php echo $this->personal->nombre; ?>" required>
            </p>
            <!--  -->

            <p>
                <label for="apellido_paterno">Apellido Paterno</label><br>
                <input type="text" name="apellido_paterno" value="<?php echo $this->personal->apellido_paterno; ?>"
                    required>
            </p>
            <p>
                <label for="apellido_materno">Apellido Materno</label><br>
                <input type="text" name="apellido_materno" value="<?php echo $this->personal->apellido_materno; ?>"
                    required>
            </p>
            <p>
                <label for="calle">Calle</label><br>
                <input type="text" name="calle" value="<?php echo $this->personal->calle; ?>" required>
            </p>
            <p>
                <label for="colonia">Colonia</label><br>
                <input type="text" name="colonia" value="<?php echo $this->personal->colonia; ?>" required>
            </p>
            <p>
                <label for="numero_exterior">Numero exterior</label><br>
                <input type="number" name="numero_exterior" value="<?php echo $this->personal->numero_exterior; ?>"
                    required>
            </p>
            <p>
                <label for="fecha_nacimiento">Fecha Nacimiento</label><br>
                <input type="date" name="fecha_nacimiento" value="<?php echo $this->personal->fecha_nacimiento; ?>"
                    required>
            </p>
            <label for="estado_civil">Estado Civil</label><br>
                <select id="estado_civil" name="estado_civil">
                    <option value="<?php echo $this->personal->estado_civil; ?>">✔<?php echo $this->personal->estado_civil; ?></option>
                    <option value="Casada">Casada</option>
                    <option value="Soltera">Soltera</option>
                    <option value="Viuda">Viuda</option>
                    <option value="Concubinato">Concubinato</option>
                    <option value="Union libre">Union Libre</option>
                </select>

            <p>
                <label for="numero_hijos">Numero de hijos</label><br>
                <input type="number" name="numero_hijos" value="<?php echo $this->personal->numero_hijos; ?>" required>
            </p>
            <p>
                <label for="escolaridad">Escolaridad</label><br>
                <input type="text" name="escolaridad" value="<?php echo $this->personal->escolaridad; ?>" required>
            </p>

            <p>
                <input type="hidden" name="turno" value="<?php echo $this->personal->turno; ?>">
            </p>
            <p>
                <label for="actividad">Actividad</label><br>
                <input type="text" name="actividad" value="<?php echo $this->personal->actividad; ?>">
            </p>
            <p>
                <input type="submit" value="Actualizar personal">
            </p>

        </form>
    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>