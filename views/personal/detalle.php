<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <?php require 'views/header.php'; ?>

    <div id="main">
        <h1 class="center">Detalle de <?php echo $this->personal->id_personal; ?> </h1>

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
                <!--  -->

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
                    <label for="numero_exterior">Numero exterior</label>
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
                        <option value="Viuda">Viuda</option>
                        <option value="Concubinato">Concubinato</option>
                        <option value="Union libre">Union Libre</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="numero_hijos">Numero de hijos</label>
                    <input class="form-control" type="number" name="numero_hijos"
                        value="<?php echo $this->personal->numero_hijos; ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="escolaridad">Escolaridad</label>
                    <input class="form-control" type="text" name="escolaridad"
                        value="<?php echo $this->personal->escolaridad; ?>" required>
                </div>
                <input class="form-control" type="hidden" name="turno" value="<?php echo $this->personal->turno; ?>">
                <div class="col-md-4">
                    <label for="actividad">Actividad</label>
                    <input class="form-control" type="text" name="actividad"
                        value="<?php echo $this->personal->actividad; ?>">
                </div>
                <div class="col-md-3">

                    <input class="form-control" type="hidden" name="estatus"
                        value="<?php echo $this->personal->estatus; ?>">
                </div>
                <div class="col-md-3">
                    <input class="form-control" type="submit" value="Actualizar personal">
                </div>

            </form>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>