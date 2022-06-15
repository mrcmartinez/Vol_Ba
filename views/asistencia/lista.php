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
            <h1 class="center">Lista Asistencia <?php echo $this->fecha; ?></h1>
            <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
                <input type="submit" value="Regresar">
            </form>
            <form action="<?php echo constant('URL'); ?>consultaAsistencia/generar" method="POST">
                <input type="submit" value="manual">
            </form>
            <div id="respuesta" class="center"></div>
            <form action="<?php echo constant('URL'); ?>consultaAsistencia/saludo" method="POST">
                <div id="div2">
                    <table width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Actividad</th>
                                <th>hora</th>


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
                                <td><?php echo $asistencia->id_personal; ?></td>
                                <td><?php echo $asistencia->nombre; ?></td>

                                <td><?php echo $asistencia->actividad; ?></td>
                                <td><?php echo $asistencia->hora; ?></td>

                                <?php if ($asistencia->estatus!="Asistencia" ) { ?>

                                <td><input type="checkbox" value="<?php echo $asistencia->id_personal; ?>"
                                        name="personal[]" onclick=""></td>

                                <?php }else{
     ?>
                                <td>
                                    <div class="check-color"><input type="checkbox"
                                            value="<?php echo $asistencia->id_personal; ?>" name="personal[]" checked
                                            disabled onclick="" id="check1"><label for="check1">Asistencia</label></div>
                                </td>
                                <?php
} ?>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <input type="hidden" name="estatus" value="Asistencia">
                <input type="submit" name="seleccion" value="Validar" />
            </form>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>
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