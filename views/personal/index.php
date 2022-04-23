<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/estilos.css">
</head>

<body>
    <?php require 'views/header.php'; ?>

    <div class="container-fluid">
        <h1 class="center">Voluntariado</h1>
        <div class="center"><?php echo $this->mensaje; ?></div>

        <div id="respuesta" class="center">
            <!-- <h4>Bienvenido<?php echo $_SESSION['rol']?></h4> -->

            <form action="<?php echo constant('URL'); ?>personal/listar" method="POST">
                <?php switch($this->radio){
                    case "Activo":
                        echo '<input type="radio" id="" name="radio_busqueda" value="Activo"checked>Activo
                        <input type="radio" id="" name="radio_busqueda" value="Baja">Baja
                        <input type="radio" id="" name="radio_busqueda" value="Candidato">Candidato';
                        break;
                    case "Baja":
                        echo '<input type="radio" id="" name="radio_busqueda" value="Activo">Activo
                        <input type="radio" id="" name="radio_busqueda" value="Baja"checked>Baja
                        <input type="radio" id="" name="radio_busqueda" value="Candidato">Candidato';
                        break;
                    case "Candidato":
                        echo '<input type="radio" id="" name="radio_busqueda" value="Activo">Activo
                        <input type="radio" id="" name="radio_busqueda" value="Baja">Baja
                        <input type="radio" id="" name="radio_busqueda" value="Candidato"checked>Candidato';
                        break;
                }?>
                <p>
                    <input type="text" name="caja_busqueda" id="caja_busqueda" autofocus>
                    <input type="submit" value="Buscar">
                </p>
            </form>
        </div>
        <div class="center"><?php echo $this->consulta; ?></div>
        <form action="<?php echo constant('URL'); ?>personal" method="POST">
            <input type="submit" value="Nuevo">
        </form>
        <form action="<?php echo constant('URL'); ?>personal/generarReporte" method="POST">
            <input type="hidden" name="caja_busqueda" id="caja_busqueda" value="<?php echo $this->consulta; ?>">
            <input type="hidden" name="radio_busqueda" id="radio_busqueda" value="<?php echo $this->radio; ?>">
            <input type="image" src="<?php echo constant('URL'); ?>assets/img/iconxls.png">
        </form>

        <form action="<?php echo constant('URL'); ?>personal/generarReportePDF" method="post">
            <input type="hidden" name="caja_busqueda" id="caja_busqueda" value="<?php echo $this->consulta; ?>">
            <input type="hidden" name="radio_busqueda" id="radio_busqueda" value="<?php echo $this->radio; ?>">
            <input type="image" src="<?php echo constant('URL'); ?>assets/img/iconpdf.png">
        </form>
        <!-- <div class="table-responsive"> -->
        <table class="table">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Turno</th>
                    <th>Actividad</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tbody-personal">
                <?php
                    include_once 'models/personalBanco.php';
                    foreach($this->personal as $row){
                        $personal = new PersonalBanco();
                        $personal = $row; 
                ?>
                <tr id="fila-<?php echo $personal->id_personal; ?>">
                    <td><?php echo $personal->id_personal; ?></td>
                    <td><?php echo $personal->completo; ?></td>
                    <td><?php echo $personal->turno; ?></td>
                    <td><?php echo $personal->actividad; ?></td>
                    <td><?php echo $personal->estatus; ?></td>

                    <td>
                        <!-- <a
                            href="<?php echo constant('URL') . 'telefono/vertelefonoid/'. $personal->id_personal;?>">☏</a> -->
                        <a
                            href="<?php echo constant('URL') . 'personal/verInformacion/' . $personal->id_personal.'/'.$personal->completo; ?>"><img src="<?php echo constant('URL'); ?>assets/img/lupa.png"/></a>
                        <!-- <td><a href="<?php echo constant('URL') . 'consultaAsistencia/verasistenciaid/'. $personal->id_personal;?>">Asistencias</a> -->
                        <!-- <td><a href="<?php echo constant('URL') . 'documento/verdocumentoid/'. $personal->id_personal;?>">Documentos</a> -->
                        <?php if ( $_SESSION['rol']!="Supervisor" ) { ?>
                            <a
                            href="<?php echo constant('URL') . 'personal/verPersonal/' . $personal->id_personal; ?>"><img src="<?php echo constant('URL'); ?>assets/img/editar.png"/></a>
                        <a
                            href="<?php echo constant('URL') . 'personal/eliminarPersonal/' . $personal->id_personal.'/'.$this->radio; ?>"><button
                                onclick="return confirmBaja()"><?php if ($this->radio=="Activo") { 
                            ?><img src="<?php echo constant('URL'); ?>assets/img/eliminar.png"/></button><?php
                            }else{
                                ?>Alta</button><?php
                            } ?></a>

                        
                        <!-- <button class="bEliminar"
                            data-matricula="<?php echo $personal->id_personal; ?>">Eliminar</button> -->
                    </td>
                    <?php } ?>
                    <!-- <td><a href="<?php echo constant('URL') . 'personal/eliminarPersonal/' . $personal->id_personal.'/'.$this->radio; ?>"></a><button onclick="return confirmBaja()">Alerta</button></td> -->
                </tr>

                <?php } ?>
            </tbody>
        </table>
        <!-- </div> -->
    </div>

    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/estatus.js"></script>

</body>

</html>