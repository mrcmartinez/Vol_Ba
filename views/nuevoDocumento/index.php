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

        
        <form action="<?php echo constant('URL'); ?>nuevoDocumento/registrarDocumento" method="POST">

            <p>
                <label for="id_personal">ID</label><br>
                <input type="number" name="id_personal" >
            </p>
            <p>
                <label for="nombre">Documento</label><br>
                <input type="text" name="nombre" value="IFE" readonly>
                <input type="text" name="estatus" value="Entregado" readonly>
                <input type="file" name="descripcion" >
            </p></br>
            <p>
                <input type="text" name="nombre_2" value="CURP" readonly>
                <input type="file" name="url_2" >
            </p> 
            
            
            <p></br>
                <input type="text" name="nombre_3" value="Comprobante" readonly>
                <input type="file" name="url_3" >
            </p> </br>
            <p>
                <input type="text" name="nombre_4" value="Carta Compromiso" readonly>
                <input type="file" name="url_4" >
            </p> </br>
            <p>
                <input type="text" name="nombre_5" value="Examen medico" readonly>
                <input type="file" name="url_5" >
            </p>
            <p></br>
                <input type="text" name="nombre_6" value="Estudio Socioeconomico" readonly>
                <input type="file" name="url_6" >
            </p>
            <p></br>
                <input type="text" name="nombre_7" value="Solicitud" readonly>
                <input type="file" name="url_7" >
            </p>
            <p></br>
                <input type="text" name="nombre_8" value="Acta Nacimiento" readonly>
                <input type="file" name="url_8" >
            </p> </br>
            </br>
            <p>
                <input type="submit" value="Subir">
            </p>

        </form>
    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>