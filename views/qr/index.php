<?php require 'libraries/session.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo constant('URL'); ?>assets/img/logo.ico" />
</head>

<body>
    <?php require 'views/header.php'; 
    ?>

    <div id="main">
        <div class="center-form">
            <h1 class="center"><?php echo $_SESSION['nombreVol'];?></h1>
            <h1 class="center">QR</h1>

            <!-- <div class="center"><?php echo $this->mensaje; ?></div> -->
            <div class="section-form">
                <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
                    <input type="submit" value="Regresar">
                </form>
                <form action="<?php echo constant('URL'); ?>consultaAsistencia/verasistenciaid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" value="Asistencias">
                </form>
                <form action="<?php echo constant('URL'); ?>documento/verdocumentoid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" value="Documentación">
                </form>
                <form action="<?php echo constant('URL'); ?>telefono/vertelefonoid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" value="Teléfonos">
                </form>
                <form action="<?php echo constant('URL'); ?>qr/consultar/<?php echo $this->id?>" method="POST">
                    <input class="btn-option" type="submit" value="Qr">
                </form>
            </div>
            <div id="respuesta" class="center"></div>
            <!-- <div class="form-info"> -->
                <div><img src='<?php echo $this->img; ?>'></div>
            <!-- </div> -->
            <!-- <div class="form-info"> -->
                <p>
                    <label for="fecha_modificacion">Ultima actualización</label><br>
                    <input type="date" name="fecha_modificacion" value="<?php echo $this->qr->fecha_modificacion; ?>"
                        disabled>
                </p>
                <!-- <input type="number" value="<?php echo $this->qr->id_personal; ?>"> -->
                <form action="<?php echo constant('URL'); ?>qr/actualizar/<?php echo $this->id?>" method="POST">
                    <input type="hidden" name="nombreVol" value="<?php echo $_SESSION['nombreVol'];?>">
                    <input class="btn-option" type="submit" value="Actualizar"onclick="return confirmBaja()">
                    
                </form>
            <!-- </div> -->
        </div>
    </div>

    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/estatus.js"></script>
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