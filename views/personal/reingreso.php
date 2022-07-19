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

        <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
            <input type="submit" value="❌">
        </form>
        <form action="<?php echo constant('URL'); ?>personal" method="POST">
            <input type="hidden" name="reingreso">
            <input type="submit" value="Reingreso">
        </form>
        <div class="center-form"><?php echo $this->mensaje; ?>
        
            <h1 class="center">Agregar <small>voluntariado reingreso</small></h1>

            <form class="row g-3" action="<?php echo constant('URL'); ?>personal/registrarPersonal" method="POST">
            
                <div class="col-md-1">
                    <label for="ID">ID</label>
                    <input class="form-control" type="number" name="ID" id="" required autofocus>
                </div>
                <div class="col-md-5">
                    <label for="nombre">Nombre</label>
                    <input class="form-control" type="text" name="nombre" id="" required autofocus>
                </div>
                <div class="col-md-3">
                    <label for="apellido_paterno">Apellido Paterno</label>
                    <input class="form-control" type="text" name="apellido_paterno" id="" required>
                </div>
                <div class="col-md-3">
                    <label for="apellido_materno">Apellido Materno</label>
                    <input class="form-control" type="text" name="apellido_materno" id="">
                </div>

                <div class="col-md-6">
                    <label for="calle">Calle</label>
                    <input class="form-control" type="text" name="calle" id="" required>
                </div>
                <div class="col-md-2">
                    <label for="numero_exterior">Número exterior</label>
                    <input class="form-control" type="tel" name="numero_exterior" id="" pattern="[0-9]+[a-z]{0,1}" title="ej. 103 0 103a">
                </div>
                <div class="col-md-4">
                    <label for="colonia">Colonia</label>
                    <input class="form-control" type="text" name="colonia" id="" required>
                </div>

                <div class="col-md-4">
                    <label for="fecha_nacimiento">Fecha Nacimiento</label>
                    <input class="form-control" type="date" min="1900-01-01" max="<?php echo date("Y-m-d");?>"
                        name="fecha_nacimiento" id="" required>
                </div>
                <div class="col-md-4">
                    <label for="estado_civil">Estado Civil</label>
                    <select class="form-select" id="estado_civil" name="estado_civil">
                        <option value="Casada">Casada</option>
                        <option value="Soltera">Soltera</option>
                        <option value="Divorciada">Divorciada</option>
                        <option value="Separada">Separada</option>
                        <option value="Viuda">Viuda</option>
                        <option value="Concubinato">Concubinato</option>
                        <option value="Union libre">Union Libre</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="numero_hijos">Número de hijos</label>
                    <input class="form-control" type="number" min="0" max="20" name="numero_hijos" id="" required>
                </div>

                <div class="col-md-2">
                    <label for="seguro_medico">Seguro Médico</label>
                    <input class="form-control" list="seguro" name="seguro_medico" id="seguro_medico" required>
                    <datalist id="seguro">
                        <option value="IMSS">
                        <option value="ISSSTE">
                        <option value="INSABI">
                        <option value="NINGUNO">
                    </datalist>
                </div>

                <div class="col-md-4">
                    <label for="escolaridad">Escolaridad</label>
                    <select class="form-select" id="escolaridad" name="escolaridad">
                        <option value="Primaria">Primaria</option>
                        <option value="Primaria-trunca">Primaria-trunca</option>
                        <option value="Secundaria">Secundaria</option>
                        <option value="Secundaria-trunca">Secundaria-trunca</option>
                        <option value="Preparatoria">Preparatoria</option>
                        <option value="Preparatoria-trunca">Preparatoria-trunca</option>
                        <option value="Licenciatura">Licenciatura</option>
                        <option value="Licenciatura-trunca">Licenciatura-trunca</option>
                        <option value="Ninguna">Ninguna</option>
                    </select>
                </div>

                <div class="col-md-3">
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

                <div class="col-md-3">
                    <label for="actividad">Actividad</label>
                    <input class="form-control" list="act" name="actividad" id="actividad" required>
                    <datalist id="act">
                        <option value="Panaderia">
                        <option value="Comedor">
                        <option value="Aseo">
                        <option value="Armado">
                        <option value="Act. varias">
                        <option value="F.s Barrio">
                    </datalist>
                </div>
                <div class="col-md-2">
                    <!-- <label for="estatus">Estatus</label> -->
                    <input type="hidden" name="estatus" value="Activo">
                    <!-- <select class="form-select" id="estatus" name="estatus"> -->
                        <!-- <option value="Activo">Activo</option> -->
                        <!-- <option value="Candidato">Candidato</option> -->
                    <!-- </select> -->
                </div>

                <div class="col-md-4">
                    <input class="form-control btn btn-dark" type="submit" value="Registrar">
                </div>
                <div class="col-md-8">
                    <progress class="form-control" id="file" value="1" max="100"> 32% </progress>
                </div>
            </form>
        </div>
        </div>
    <?php require 'views/footer.php'; ?>

</body>

</html>