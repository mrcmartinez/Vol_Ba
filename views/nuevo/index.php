<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php require 'views/header.php'; ?>

    <div id="main">
        <h1 class="center">Sección de Nuevo</h1>

        <div class="center"><?php echo $this->mensaje; ?></div>

        <form action="<?php echo constant('URL'); ?>nuevo/registrarPersonal" method="POST">

            <!-- <p>
                <label for="id_personal">ID</label><br>
                <input type="number" name="id_personal" id="">
            </p> -->
            <p>
                <label for="nombre">Nombre</label><br>
                <input type="text" name="nombre" id="" required autofocus>
            </p>
            <p>
                <label for="apellido_paterno">Apellido Paterno</label><br>
                <input type="text" name="apellido_paterno" id="" required>
            </p>
            <p>
                <label for="apellido_materno">Apellido Materno</label><br>
                <input type="text" name="apellido_materno" id="" required>
            </p>
            <p>
                <label for="calle">Calle</label><br>
                <input type="text" name="calle" id="" required>
            </p>
            <p>
                <label for="colonia">Colonia</label><br>
                <input type="text" name="colonia" id="" required>
            </p>
            <p>
                <label for="numero_exterior">Numero exterior</label><br>
                <input type="tel" name="numero_exterior" id="" required >
            </p>
            <p>
                <label for="edad">Edad</label><br>
                <input type="number" name="edad" min="18" max="45" required>
            </p>
            <p>
                <label for="fecha_nacimiento">Fecha Nacimiento</label><br>
                <input type="date" name="fecha_nacimiento" id="" required>
            </p>
            <p>
                <label for="estado_civil">Estado Civil</label><br>
                <select id="estado_civil" name="estado_civil">
                    <option value="casada">Casada</option>
                    <option value="soltera">soltera</option>
                    <option value="viuda">Viuda</option>
                    <option value="concubinato">Concubinato</option>
                    <option value="union libre">Union Libre</option>
                </select>
                <!-- <input type="text" name="estado_civil" id="" required> -->
            </p>

            <p>
                <label for="numero_hijos">Numero de hijos</label><br>
                <input type="number" name="numero_hijos" id="" required>
            </p>
            <p>
                <label for="escolaridad">Escolaridad</label><br>
                <input type="text" name="escolaridad" id="" required>
            </p>
            <p>
                <label for="estatus">Estatus</label><br>
                <select id="estatus" name="estatus">
                    <option value="Activo">Activo</option>
                    <option value="Candidato">Candidato</option>
                </select>
                <!-- <input type="text" name="estatus" id="" required> -->
            </p>
            <!-- pantalla siguiente "----------------------------------------------------------";
            <p>
                <label for="estatus">Telefono celular</label><br>
                <input type="text " name="telefono_cel" id="" required placeholder="lada">
                <input type="text" name="telefono_cel" id="" required placeholder="numero">
            </p>
            <p>
                <label for="estatus">Telefono de casa</label><br>
                <input type="text" name="telefono_casa" id="" required placeholder="lada">
                <input type="text" name="telefono_cel" id="" required placeholder="numero"> 
            </p>
            <p>
                <label for="estatus">Telefono de emergencia</label><br>
                <input type="text" name="telefono_emer" id="" required placeholder="lada">
                <input type="text" name="telefono_cel" id="" required placeholder="numero">
                <input type="text" name="telefono_cel" id="" required placeholder="avisar a:">
            </p>-->
            <p>
            <input type="submit" value="Registrar">
            </p>

        </form>
        <form action="<?php echo constant('URL'); ?>consulta/listar" method="POST">
            <input type="submit" value="Cancelar">
        </form>
    </div>

    <?php require 'views/footer.php'; ?>
</body>
</html>