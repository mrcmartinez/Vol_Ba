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
        <h1 class="center">Agregar Documento</h1>

        
        <form action="<?php echo constant('URL'); ?>nuevoTelefono/registrarTelefono" method="POST">

            <p>
                <label for="id_personal">ID</label><br>
                <input type="number" name="id_personal" >
            </p>
            <!--  -->
            <!-- <p>
                <label for="lada_1">Lada</label><br>
                <input type="number" name="lada_1" id="">
            </p>
            <p>
                <label for="numero_1">Numero</label><br>
                <input type="number" name="numero_1" id="">
            </p>
            <p>
                <label for="tipo_1">Tipo</label><br>
                <input type="text" name="tipo_1" value="Telefono casa">
            </p>
            <p>
                <label for="descripcion_1">Descripcion</label><br>
                <input type="text" name="descripcion_1" id="">
            </p> -->
            <!--  -->
            <!--  -->
            <p>
                <label for="nombre_1">Documento</label><br>
                <input type="text" name="nombre_1" id="" value="IFE" readonly>
                <input type="file" name="url_1" >
            </p></br>
            <!--  -->
            <p>
                <!-- <label for="nombre_2">Documento</label><br> -->
                <input type="text" name="nombre_2" id="" value="CURP" readonly>
                <input type="file" name="url_2" >
            </p> 
            <!--  -->
            <!--  -->
            <p></br>
                <!-- <label for="nombre_3">Documento</label><br> -->
                <input type="text" name="nombre_3" id="" value="Comprobante" readonly>
                <input type="file" name="url_3" >
            </p> </br>
            <!--  -->
            <!--  -->
            <!--  -->
            <p>
            <!-- <label for="nombre_3">Documento</label><br> -->
                <input type="text" name="nombre_4" id="" value="Carta Compromiso" readonly>
                <input type="file" name="url_4" >
            </p> </br>
            <!--  -->
            <p>
                <!-- <label for="nombre_4">Documento</label><br> -->
                <input type="text" name="nombre_5" id="" value="Examen medico" readonly>
                <input type="file" name="url_5" >
            </p>
            <!--  -->
            <p></br>
            <!-- <label for="nombre_3">Documento</label><br> -->
                <input type="text" name="nombre_6" id="" value="Estudio Socioeconomico" readonly>
                <input type="file" name="url_6" >
            </p>
            <!--  -->
                        <!--  -->
            <p></br>
            <!-- <label for="nombre_3">Documento</label><br> -->
                <input type="text" name="nombre_7" id="" value="Solicitud" readonly>
                <input type="file" name="url_7" >
            </p>
            <!--  -->
            <!--  -->
            <p></br>
            <!-- <label for="nombre_3">Documento</label><br> -->
                <input type="text" name="nombre_8" id="" value="Acta Nacimiento" readonly>
                <input type="file" name="url_8" >
            </p> </br>
            <!--  -->
            <!--  -->
            </br>
            <p>
                <input type="submit" value="Subir">
            </p>

        </form>
    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>