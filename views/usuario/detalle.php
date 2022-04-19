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
        <!-- <h1 class="center">Detalle de <?php echo $this->usuario->id_usuario; ?> </h1> -->

        <div class="center"><?php echo $this->mensaje; ?></div>

        <form action="<?php echo constant('URL'); ?>usuario/actualizarUsuario" method="POST">

            <p>
                <label for="id_usuario">ID</label><br>
                <input type="number" name="id_usuario" readonly value="<?php echo $this->usuario->id_usuario; ?>"
                    required>
            </p>
            <p>
                <label for="nombre_usuario">Usuario</label><br>
                <input type="text" name="nombre_usuario" value="<?php echo $this->usuario->nombre_usuario; ?>" required>
            </p>
            <!--  -->

            <p>
                <label for="password">Password</label><br>
                <input type="text" name="password" value="<?php echo $this->usuario->password; ?>"
                    required>
            </p>
            <p>
                <label for="rol">Rol</label><br>
                <input type="text" name="rol" value="<?php echo $this->usuario->rol; ?>"
                    required>
            </p>
        
            <p>
                <input type="submit" value="Actualizar usuario">
            </p>

        </form>
    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>