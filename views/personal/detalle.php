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
        <h1 class="center">Actualizar Datos de
            <?php echo $this->personal->apellido_paterno.' '.$this->personal->apellido_materno.' '.$this->personal->nombre; ?>
        </h1>
        <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
            <input type="submit" value="❌">
        </form>

        <div class="center-form"><?php echo $this->mensaje; ?>

            <form class="row g-3" action="<?php echo constant('URL'); ?>personal/actualizarPersonal" method="POST">

                <div class="col-12">
                    <label for="id_personal">ID</label>
                    <input class="form-control" type="number" name="id_personal" readonly
                        value="<?php echo $this->personal->id_personal; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="nombre">Nombre</label>
                    <input class="form-control" type="text" name="nombre" value="<?php echo $this->personal->nombre; ?>"
                        required>
                </div>

                <div class="col-md-3">
                    <label for="apellido_paterno">Apellido Paterno</label>
                    <input class="form-control" type="text" name="apellido_paterno"
                        value="<?php echo $this->personal->apellido_paterno; ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="apellido_materno">Apellido Materno</label>
                    <input class="form-control" type="text" name="apellido_materno"
                        value="<?php echo $this->personal->apellido_materno; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="calle">Calle</label>
                    <input class="form-control" type="text" name="calle" value="<?php echo $this->personal->calle; ?>"
                        required>
                </div>
                <div class="col-md-4">
                    <label for="colonia">Colonia</label>
                    <input class="form-control" type="text" name="colonia"
                        value="<?php echo $this->personal->colonia; ?>" required>
                </div>
                <div class="col-md-2">
                    <label for="numero_exterior">Número exterior</label>
                    <input class="form-control" type="number" name="numero_exterior"
                        value="<?php echo $this->personal->numero_exterior; ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="fecha_nacimiento">Fecha Nacimiento</label>
                    <input class="form-control" type="date" name="fecha_nacimiento"
                        value="<?php echo $this->personal->fecha_nacimiento; ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="estado_civil">Estado Civil</label>
                    <select class="form-select" id="estado_civil" name="estado_civil">
                        <option value="<?php echo $this->personal->estado_civil; ?>">
                            ✔<?php echo $this->personal->estado_civil; ?></option>
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
                    <input class="form-control" type="number" name="numero_hijos"
                        value="<?php echo $this->personal->numero_hijos; ?>" required>
                </div>
                <div class="col-md-2">
                    <label for="seguro_medico">Seguro Médico</label>
                    <input class="form-control" list="seguro" name="seguro_medico" id="seguro_medico"
                        value="<?php echo $this->personal->seguro_medico; ?>" required>
                    <datalist id="seguro">
                        <option value="IMSS">
                        <option value="ISSSTE">
                        <option value="INSABI">
                        <option value="NINGUNO">
                    </datalist>
                </div>

                <div class="col-md-4">
                    <label for="escolaridad">Escolaridad</label>
                    <input class="form-control" type="text" name="escolaridad"
                        value="<?php echo $this->personal->escolaridad; ?>" required>
                </div>
                

                <div class="col-md-4">
                    <label for="actividad">Actividad</label>
                    <input class="form-control" list="act" name="actividad" id="actividad"
                        value="<?php echo $this->personal->actividad; ?>" required>
                    <datalist id="act">
                        <option value="Panaderia">
                        <option value="Comedor">
                        <option value="Aseo">
                        <option value="Armado">
                        <option value="Act. varias">
                        <option value="F.s Barrio">
                    </datalist>
                </div>

                <div class="col-md-4">
                <label for="turno">Dia</label>
                <select class="form-select" id="turno" name="turno">
                        <option value="<?php echo $this->personal->turno; ?>">
                            ✔<?php echo $this->personal->turno; ?></option>
                        <option value="Lunes">Lunes</option>
                        <option value="Martes">Martes</option>
                        <option value="Miercoles">Miercoles</option>
                        <option value="Jueves">Jueves</option>
                        <option value="Viernes">Viernes</option>
                        <option value="Sabado">Sabado</option>
                    </select>
                    <input class="form-control" type="hidden" name="estatus"
                        value="<?php echo $this->personal->estatus; ?>">
                </div>
                <div class="col-md-3">
                    <input class="form-control btn btn-dark" type="submit" value="Actualizar personal">
                </div>

            </form>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>