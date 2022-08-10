<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/bootstrap.min.css"> -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo constant('URL'); ?>assets/img/logo.ico" />
    <!-- <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/estilos.css"> -->
</head>

<body>
    <?php require 'views/header.php'; ?>

    <div id="main">
        <div class="center-form"><?php echo $this->mensaje; ?>
            <h1 class="center"><?php echo $_SESSION['nombreVol'];?></h1>
            <h1 class="center">Información</h1>
            <div class="section-form">

                <!-- <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
                    <input class="btn-option" type="submit" value="Regresar">
                </form> -->
                <form
                    action="<?php echo constant('URL'); ?>consultaAsistencia/verasistenciaid/<?php echo $this->personal->id_personal ?>"
                    method="POST">
                    <input type="submit" value="Asistencias">
                </form>
                <form
                    action="<?php echo constant('URL'); ?>documento/verdocumentoid/<?php echo $this->personal->id_personal ?>"
                    method="POST">
                    <input type="submit" value="Documentación Digital">
                </form>
                <form
                    action="<?php echo constant('URL'); ?>documentoFisico/verdocumentoid/<?php echo $this->personal->id_personal ?>"
                    method="POST">
                    <input type="submit" value="Documentación Fisico">
                </form>
                <form
                    action="<?php echo constant('URL'); ?>telefono/vertelefonoid/<?php echo $this->personal->id_personal ?>"
                    method="POST">
                    <input type="submit" value="Teléfonos">
                </form>
                <form action="<?php echo constant('URL'); ?>qr/consultar/<?php echo $this->personal->id_personal ?>"
                    method="POST">
                    <input type="submit" value="Qr">
                </form>
            </div>
            <div class="form-info">
                <p>
                    <label for="id_personal">ID</label><br>
                    <input type="number" name="id_personal" disabled
                        value="<?php echo $this->personal->id_personal; ?>">
                </p>
                <p>
                    <label for="nombre">Nombre</label><br>
                    <input type="text" name="nombre" value="<?php echo $this->personal->nombre; ?>" disabled>
                </p>

                <p>
                    <label for="apellido_paterno">Apellido Paterno</label><br>
                    <input type="text" name="apellido_paterno" value="<?php echo $this->personal->apellido_paterno; ?>"
                        disabled>
                </p>
                <p>
                    <label for="apellido_materno">Apellido Materno</label><br>
                    <input type="text" name="apellido_materno" value="<?php echo $this->personal->apellido_materno; ?>"
                        disabled>
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
                    <label for="numero_exterior">Número exterior</label><br>
                    <input type="number" name="numero_exterior" value="<?php echo $this->personal->numero_exterior; ?>"
                        disabled>
                </p>

                <p>
                    <label for="fecha_nacimiento">Fecha Nacimiento</label><br>
                    <input type="date" name="fecha_nacimiento" value="<?php echo $this->personal->fecha_nacimiento; ?>"
                        disabled>
                </p>
                <p>
                    <label for="edad">Edad</label><br>
                    <input type="number" name="edad" value="<?php echo $this->edadCalculada; ?>" disabled>
                </p>
            </div>
            <div class="form-info">

                <label for="estado_civil">Estado Civil</label><br>
                <input type="text" name="estado_civil" value="<?php echo $this->personal->estado_civil; ?>" disabled>

                <p>
                    <label for="numero_hijos">Número de hijos</label><br>
                    <input type="number" name="numero_hijos" value="<?php echo $this->personal->numero_hijos; ?>"
                        disabled>
                </p>
                <p>
                    <label for="seguro_medico">Seguro Médico</label><br>
                    <input type="text" name="seguro_medico" value="<?php echo $this->personal->seguro_medico; ?>"
                        disabled>
                </p>
                <p>
                    <label for="escolaridad">Escolaridad</label><br>
                    <input type="text" name="escolaridad" value="<?php echo $this->personal->escolaridad; ?>" disabled>
                </p>
                <p>
                    <label for="turno">Turno</label><br>
                    <input type="text" name="turno" value="<?php echo $this->personal->turno; ?>" disabled>
                </p>
                <p>
                    <label for="horario">Horario</label><br>
                    <input type="text" name="horario" value="<?php echo $this->personal->horario; ?>" disabled>
                </p>
                <p>
                    <label for="actividad">Actividad</label><br>
                    <input type="text" name="actividad" value="<?php echo $this->personal->actividad; ?>" disabled>
                    </p>
                    <p>
                        <label for="fecha_ingreso">Fecha Ingreso</label><br>
                    <input type="date" name="fecha_ingreso" value="<?php echo $this->personal->fecha_ingreso; ?>"
                        disabled>
                </p>
                <p>
                    <label for="estatus">Estatus</label><br>
                    <input type="text" name="estatus" value="<?php echo $this->personal->estatus; ?>" disabled>
                </p>
            </div>
        </div>
    </div>
    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>