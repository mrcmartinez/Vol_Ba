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
    <!-- <div><?php echo $this->mensaje; ?></div> -->
        <h1 class="center">Login</h1>

        <form action="<?php echo constant('URL'); ?>inicio/iniciarSesion" method="POST">
            Usuario: <br /><input type="text" name="nombre_usuario"><br />
            Contraseña: <br /><input type="password" name="password"><br />
            <input type="submit" value="Iniciar sesion">
        </form>
    </div>
    <?php require 'views/footer.php'; ?>
    <?php
        if (!empty($this->mensaje)) 
        {
            ?>
            <script>
                Swal.fire({
                // position: 'top-end',
                icon: "<?php echo $this->code; ?>",
                title: '<?php echo $this->mensaje; ?>',
                showConfirmButton: false,
                timer: 1500
      })
            </script>
            <?php    
        }
    ?>
</body>

</html>