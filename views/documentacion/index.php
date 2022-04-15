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

        <div class="center"><?php echo $this->mensaje; ?></div>
        <?php $idU=intval($this->ultimoId);?>
        <form action="<?php echo constant('URL'); ?>documento/registrarDocumento" method="POST" enctype="multipart/form-data">

            <p>
                <label for="id_personal">ID</label><br>
                <input type="number" name="id_personal" value=<?php echo $idU?> readonly >
            </p>
            <p>
                <label for="nombre_1">Documento</label><br>
                <input type="text" name="nombre_1" value="IFE" readonly>
                <!-- <input type="text" name="estatus" value="Entregado" readonly> -->
                <input type="file" name="descripcion_1" >
            </p></br>
            <p>
                <input type="text" name="nombre_2" value="CURP" readonly>
                <input type="file" name="descripcion_2" >
            </p> 
            
            
            <p></br>
                <input type="text" name="nombre_3" value="Comprobante" readonly>
                <input type="file" name="descripcion_3" >
            </p> </br>
            <p>
                <input type="text" name="nombre_4" value="Carta Compromiso" readonly>
                <input type="file" name="descripcion_4" >
            </p> </br>
            <p>
                <input type="text" name="nombre_5" value="Examen medico" readonly>
                <input type="file" name="descripcion_5" >
            </p>
            <p></br>
                <input type="text" name="nombre_6" value="Estudio Socioeconomico" readonly>
                <input type="file" name="descripcion_6" >
            </p>
            <p></br>
                <input type="text" name="nombre_7" value="Solicitud" readonly>
                <input type="file" name="descripcion_7" >
            </p>
            <p></br>
                <input type="text" name="nombre_8" value="Acta Nacimiento" readonly>
                <input type="file" name="descripcion_8" >
            </p>
            </br>
            <p>
                <input type="text" name="nombre_9">
                <input type="file" name="descripcion_9" >
            </p>
            </br>
            <!-- <p> -->
                <!-- <label for="file">Downloading progress:</label> -->
                <!-- <progress id="file" value="66" max="100"></progress> -->
            <!-- </p> -->
            <p>
                <input type="submit" value="Subir">
                <progress id="file" value="66" max="100"></progress>
            </p>

        </form>
        <form action="<?php echo constant('URL'); ?>personal/listar" method="POST">
            <input type="submit" value="Omitir">
        </form>
    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>