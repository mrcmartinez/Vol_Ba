<?php require 'libraries/session.php';?>
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
        <div class="center-form">
        
       
            <h1 class="center"><?php echo $_SESSION['nombreVol'];?></h1>
            <h1 class="center">Asistencia</h1>
            <div class="section-form">
                <!-- <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
                    <input type="submit" value="Regresar">
                </form> -->
                <form action="<?php echo constant('URL'); ?>consultaAsistencia/verasistenciaid/<?php echo $this->id?>"
                    method="POST">
                    <input class="btn-option" type="submit" value="Asistencias">
                </form>
                <form action="<?php echo constant('URL'); ?>documento/verdocumentoid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" value="Documentación Digital">
                </form>
                <form action="<?php echo constant('URL'); ?>documentoFisico/verdocumentoid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" value="Documentacion Fisica">
                </form>
                <form action="<?php echo constant('URL'); ?>telefono/vertelefonoid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" value="Teléfonos">
                </form>
                <form
                    action="<?php echo constant('URL'); ?>qr/consultar/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" value="Qr">
                </form>
            </div>

            <div id="respuesta" class="center"></div>

            <table width="100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estatus</th>
                        <th>Motivo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tbody-asistencia">
                    <?php
                    include_once 'models/asistencia.php';
                    foreach($this->asistencia as $row){
                        $asistencia = new Asistencia();
                        $asistencia = $row; 
                ?>
                    <tr id="fila-<?php echo $asistencia->id_personal; ?>">
                    <td><a
                                href="<?php echo constant('URL') . 'consultaAsistencia/eliminar/' . $asistencia->id_personal.'/'.$asistencia->fecha.'/ID'; ?>" onclick="return confirmBaja()"><img
                                            src="<?php echo constant('URL'); ?>assets/img/eliminar.png" title="Quitar de Lista"/></a></td>
                        <td><?php echo $asistencia->id_personal; ?></td>
                        <td><?php echo diaSemana($asistencia->fecha);echo date('d-m-Y', strtotime($asistencia->fecha)); ?></td>
                        <td><?php echo $asistencia->hora; ?></td>
                        <td><?php echo $asistencia->estatus; ?></td>
                        <td><?php echo $asistencia->descripcion; ?></td>
                        <?php if ($asistencia->estatus=="Falta") {
                            ?>
                            <td><a href="<?php echo constant('URL') . 'consultaAsistencia/marcarjustificado/'. $asistencia->id_personal.'/'.$asistencia->fecha; ?>" onclick="return confirmBaja()"><img
                                            src="<?php echo constant('URL'); ?>assets/img/refresh2.png" title="Marcar como justificada"/></a></td>
                            <?php
                        }?>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>
    <script src="<?php echo constant('URL'); ?>assets/js/estatus.js"></script>
    <?php
        if (!empty($this->mensaje)) 
        {
            ?>
        <script>
        Swal.fire({
            // position: 'top-end',
            icon: "<?php echo $this->code; ?>",
            title: '<?php echo $this->mensaje; ?>',
            showConfirmButton: false,
            timer: 1500
        })
        </script>
        <?php    
        }
    ?>

</body>

</html>