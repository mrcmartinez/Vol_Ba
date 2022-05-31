<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/bootstrap.min.css"> -->
</head>

<body>
    <?php require 'views/header.php'; ?>
    <div id="main">
        <h1 class="center">Detalle de
            <?php echo $this->personal->apellido_paterno.' '.$this->personal->apellido_materno.' '.$this->personal->nombre; ?>
        </h1>


        <div class="center-form"><?php echo $this->mensaje; ?>
            <div class="section-form">
                <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
                    <input class="btn-option" type="submit" value="Regresar">
                </form>
                <form
                    action="<?php echo constant('URL'); ?>consultaAsistencia/verasistenciaid/<?php echo $this->personal->id_personal ?>"
                    method="POST">
                    <input type="submit" value="Asistencias">
                </form>
                <form
                    action="<?php echo constant('URL'); ?>documento/verdocumentoid/<?php echo $this->personal->id_personal ?>"
                    method="POST">
                    <input type="submit" value="Documentacion">
                </form>
                <form
                    action="<?php echo constant('URL'); ?>telefono/vertelefonoid/<?php echo $this->personal->id_personal ?>"
                    method="POST">
                    <input type="submit" value="Telefonos">
                </form>
            </div>
            
                <p>
                    <label for="id_personal">ID</label><br>
                    <input type="number" name="id_personal" disabled
                        value="<?php echo $this->personal->id_personal; ?>">
                </p>
                <p>
                    <label for="nombre">Nombre</label><br>
                    <input type="text" name="nombre" value="<?php echo $this->personal->nombre; ?>" disabled>
                </p>
                <!--  -->

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
                    <label for="numero_exterior">Numero exterior</label><br>
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
                <p>
                    <label for="estado_civil">Estado Civil</label><br>
                    <input type="text" name="estado_civil" value="<?php echo $this->personal->estado_civil; ?>"
                        disabled>
                </p>

                <p>
                    <label for="numero_hijos">Numero de hijos</label><br>
                    <input type="number" name="numero_hijos" value="<?php echo $this->personal->numero_hijos; ?>"
                        disabled>
                </p>
                <p>
                    <label for="escolaridad">Escolaridad</label><br>
                    <input type="text" name="escolaridad" value="<?php echo $this->personal->escolaridad; ?>" disabled>
                </p>
                <!--  -->
                <p>
                    <label for="turno">Turno</label><br>
                    <input type="text" name="turno" value="<?php echo $this->personal->turno; ?>" disabled>
                </p>
                <p>
                    <label for="actividad">Actividad</label><br>
                    <input type="text" name="actividad" value="<?php echo $this->personal->actividad; ?>" disabled>
                </p>
                <p>
                    <label for="fecha_ingreso">fecha_ingreso</label><br>
                    <input type="date" name="fecha_ingreso" value="<?php echo $this->personal->fecha_ingreso; ?>" disabled>
                </p>
                <p>
                    <label for="estatus">Estatus</label><br>
                    <input type="text" name="estatus" value="<?php echo $this->personal->estatus; ?>" disabled>
                </p>
            
        </div>
    </div>
    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>