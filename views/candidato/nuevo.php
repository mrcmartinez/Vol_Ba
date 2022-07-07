<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo constant('URL'); ?>assets/img/logo.ico" />
</head>

<body>
    <?php require 'views/header.php'; ?>
    <div id="main">
        <form action="<?php echo constant('URL'); ?>candidato/listar" method="POST">
            <input type="submit" value="❌">
        </form>
        <div class="center-form"><?php echo $this->mensaje; ?>
        
            <h1 class="center">Agregar <small>Candidato</small></h1>

            <form class="row g-3" action="<?php echo constant('URL'); ?>candidato/registrar" method="POST">
                <div class="col-md-6">
                    <label for="nombre">Nombre</label>
                    <input class="form-control" type="text" name="nombre" id="" required autofocus>
                </div>
                <div class="col-md-3">
                    <label for="apellido_paterno">Apellido Paterno</label>
                    <input class="form-control" type="text" name="apellido_paterno" id="" required>
                </div>
                <div class="col-md-3">
                    <label for="apellido_materno">Apellido Materno</label>
                    <input class="form-control" type="text" name="apellido_materno" id="" required>
                </div>

                <div class="col-md-4">
                    <label for="fecha_nacimiento">Fecha Nacimiento</label>
                    <input class="form-control" type="date" min="1900-01-01" max="<?php echo date("Y-m-d");?>"
                        name="fecha_nacimiento" id="" required>
                </div>
                <div class="col-md-4">
                    <label for="telefono">Telefono</label>
                    <input class="form-control" type="tel"
                        name="telefono" id="" required>
                </div>
                
                <div class="col-md-4">
                    <input type="hidden" name="estatus" value="Activo">
                    <br><input class="form-control btn btn-dark" type="submit" value="Registrar">
                </div>
            </form>
        </div>
        </div>
    <?php require 'views/footer.php'; ?>

</body>

</html>