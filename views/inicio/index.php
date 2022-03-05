<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/styles.css"> -->
</head>

<body>

    <div id="main">
        <h1 class="center">Login</h1>

        <form action="<?php echo constant('URL'); ?>inicio/iniciarSesion" method="POST">
            Username: <br /><input type="text" name="username"><br />
            Password: <br /><input type="text" name="password"><br />
            <input type="submit" value="Iniciar sesion">
        </form>
    </div>
    <?php require 'views/footer.php'; ?>
</body>

</html>