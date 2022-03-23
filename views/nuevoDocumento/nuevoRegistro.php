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
        <form action="<?php echo constant('URL'); ?>nuevoDocumento/registrarNuevo" method="POST" enctype="multipart/form-data">

            <p>
                <label for="id_personal">ID</label><br>
                <input type="number" name="id_personal" value=<?php echo $idU?> readonly >
            </p>
            <p>
                <label for="nombre">Documento</label><br>
                <!-- <input type="text" name="nombre"> -->
                <select id="nombre" name="nombre">
                    <option value="Solicitud">Solicitud</option>
                    <option value="Carta compromiso">Carta compromiso</option>
                    <option value="Acta nacimiento">Acta nacimiento</option>
                    <option value="CURP">CURP</option>
                    <option value="IFE">IFE</option>
                    <option value="Comprobante domicilio">Comprobante domicilio</option>
                    <option value="Estudio socioeconomico">Estudio socioeconomico</option>
                    <option value="Examen medico">Examen medico</option>
                </select>

                <!-- <input type="text" name="estatus" value="Entregado" readonly> -->
                <input type="file" name="descripcion" >
            </p></br>
            <p>
                <input type="submit" value="Subir Documentos">
            </p>

        </form>
        <form action="<?php echo constant('URL'); ?>consulta" method="POST">
            <input type="submit" value="Cancelar">
        </form>
    </div>

    <?php require 'views/footer.php'; ?>
</body>

</html>