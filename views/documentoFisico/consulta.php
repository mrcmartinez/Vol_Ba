<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo constant('URL'); ?>assets/img/logo.ico" />
</head>

<body>
    <?php require 'views/header.php'; ?>

    <div id="main">

        <div class="center-form"><?php echo $this->mensaje; ?>
            <h1 class="center"><?php echo $_SESSION['nombreVol'];?></h1>
            <h1 class="center">Documentación</h1>
            <div class="section-form">
                <!-- <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
                    <input type="submit" value="Regresar">
                </form> -->
                <form action="<?php echo constant('URL'); ?>consultaAsistencia/verasistenciaid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" value="Asistencias">
                </form>
                <form action="<?php echo constant('URL'); ?>documento/verdocumentoid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" value="Documentacion Digital">
                </form>
                <form action="<?php echo constant('URL'); ?>documentoFisico/verdocumentoid/<?php echo $this->id?>"
                    method="POST">
                    <input class="btn-option" type="submit" value="Documentacion Fisica">
                </form>
                <form action="<?php echo constant('URL'); ?>telefono/vertelefonoid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" value="Telefonos">
                </form>
                <form action="<?php echo constant('URL'); ?>qr/consultar/<?php echo $this->id?>" method="POST">
                    <input type="submit" value="Qr">
                </form>
            </div>

            <div id="respuesta" class="center"></div>
            <form action="<?php echo constant('URL'); ?>documentoFisico/actualizardocumentoFisico" method="POST">
                <div class="form-info">
                    <p>
                        <input type="hidden" name="id_personal" readonly
                            value="<?php echo $this->documentoFisico->id_personal; ?>">
                    </p>

                    <p>
                        <input type="checkbox" name="acta" <?php echo check($this->documentoFisico->acta);?> value="1" >
                        <label for="acta">Acta</label>
                    </p>
                    <p>
                        <input type="checkbox" name="curp" <?php echo check($this->documentoFisico->curp);?> value="1">
                        <label for="curp">CURP</label>
                    </p>
                    <p>
                        <input type="checkbox" name="carta" <?php echo check($this->documentoFisico->carta);?> value="1">
                        <label for="carta">Carta compromiso</label>
                    </p>
                    <p>
                        <input type="checkbox" name="comprobante" value="1"
                            <?php echo check($this->documentoFisico->comprobante);?>>
                        <label for="comprobante">Comprobante domicilio</label>
                    </p>
                    <p>
                        <input type="checkbox" name="datos" value="1" <?php echo check($this->documentoFisico->datos);?>>
                        <label for="datos">Datos</label>
                    </p>
                </div>
                <div class="form-info">
                    <p>
                        <input type="checkbox" name="estudio" value="1"
                            <?php echo check($this->documentoFisico->estudio);?>>
                        <label for="estudio">Estudio</label>
                    </p>
                    <p>
                        <input type="checkbox" name="examen" value="1"
                            <?php echo check($this->documentoFisico->examen);?> >
                        <label for="examen">Examen medico</label>
                    </p>
                    <p>
                        <input type="checkbox" name="ine" value="1" <?php echo check($this->documentoFisico->ine);?>>
                        <label for="ine">INE</label>
                    </p>
                    <p>
                        <input type="checkbox" name="solicitud" value="1"
                            <?php echo check($this->documentoFisico->solicitud);?>>
                        <label for="solicitud">Solicitud</label>
                    </p>
                </div>
                <p>
                    <input type="submit" value="Actualizar">
                </p>

            </form>
            <?php
            ?>


        </div>
    </div>
    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>

</body>

</html>