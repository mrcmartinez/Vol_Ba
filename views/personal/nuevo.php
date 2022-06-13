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

        <h1 class="center">Agregar <small>Personal voluntariado</small></h1>

        <div class="center-form"><?php echo $this->mensaje; ?>
            <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
                <input type="submit" value="❌">
            </form>
            <form class="row g-3" action="<?php echo constant('URL'); ?>personal/registrarPersonal" method="POST">
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

                <div class="col-md-6">
                    <label for="calle">Calle</label>
                    <input class="form-control" type="text" name="calle" id="" required>
                </div>
                <div class="col-md-4">
                    <label for="colonia">Colonia</label>
                    <input class="form-control" type="text" name="colonia" id="" required>
                </div>
                <div class="col-md-2">
                    <label for="numero_exterior">Número exterior</label>
                    <input class="form-control" type="text" name="numero_exterior" id="">
                </div>
                <div class="col-md-4">
                    <label for="fecha_nacimiento">Fecha Nacimiento</label>
                    <input class="form-control" type="date" min="1900-01-01" max="<?php echo date("Y-m-d");?>" name="fecha_nacimiento" id="" required>
                </div>
                <div class="col-md-4">
                    <label for="estado_civil">Estado Civil</label>
                    <select class="form-select" id="estado_civil" name="estado_civil">
                        <option value="casada">Casada</option>
                        <option value="soltera">Soltera</option>
                        <option value="viuda">Viuda</option>
                        <option value="concubinato">Concubinato</option>
                        <option value="union libre">Union Libre</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="numero_hijos">Número de hijos</label>
                    <input class="form-control" type="number" min="0" max="20" name="numero_hijos" id="" required>
                </div>

                <div class="col-md-2">
                    <label for="seguro_medico">Seguro Médico</label>
                    <input class="form-control" type="text" name="seguro_medico" id="" required>
                </div>

                <div class="col-md-4">
                    <label for="escolaridad">Escolaridad</label>
                    <input class="form-control" type="text" name="escolaridad" id="" required>
                </div>

                <div class="col-md-4">
                    <label for="turno">Turno</label>
                    <select class="form-select" id="turno" name="turno">
                        <option value="Lunes">Lunes</option>
                        <option value="Martes">Martes</option>
                        <option value="Miercoles">Miercoles</option>
                        <option value="Jueves">Jueves</option>
                        <option value="Viernes">Viernes</option>
                        <option value="Sabado">Sabado</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="actividad">Actividad</label>
                    <select class="form-select" id="actividad" name="actividad">
                        <option value="Panaderia">Panaderia</option>
                        <option value="Comedor">Comedor</option>
                        <option value="Aseo">Aseo</option>
                        <option value="Administrativo">Administrativo</option>
                        <option value="Armado">Armado</option>
                        <option value="Extra">Extra</option>
                        <option value="Barrio">f.s Barrio</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="estatus">Estatus</label>
                    <select class="form-select" id="estatus" name="estatus">
                        <option value="Activo">Activo</option>
                        <option value="Candidato">Candidato</option>
                    </select>
                </div>
                
                <div class="col-md-4">
                    <input class="form-control" type="submit" value="Registrar">
                </div>
                <div class="col-md-4">
                    <progress id="file" value="0" max="100"> 32% </progress>
                </div>
                
                
            </form>
        </div>

    </div>
    <?php require 'views/footer.php'; ?>

</body>

</html>