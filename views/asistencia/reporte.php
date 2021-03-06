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
            <form action="<?php echo constant('URL'); ?>documento" method="POST">
                <input type="submit" class="btn-options" value="Documentacion">
            </form>
            <form action="<?php echo constant('URL'); ?>documentoFisico/reporte" method="POST">
                <input type="submit" class="btn-options" value="Documentación Fisica">
            </form>
            <form action="<?php echo constant('URL'); ?>consultaAsistencia" method="POST">
                <input type="submit" class="btn-options-check" value="Asistencias">
            </form>
            <form action="<?php echo constant('URL'); ?>baja" method="POST">
                <input type="submit" class="btn-options" value="Bajas">
            </form>
            <h1 class="center"><small>Reportes</small>Asistencia</h1>
            <div id="respuesta" class="center"></div>
            <form action="<?php echo constant('URL'); ?>consultaAsistencia" method="POST">
                Filtrar por:
                <?php switch($this->radio){
                    
                    case "Asistencia":
                        echo '<input type="radio" id="" name="radio_busqueda" value="Asistencia"checked onchange="this.form.submit()">Asistencias
                        <input type="radio" id="" name="radio_busqueda" value="Falta" onchange="this.form.submit()">Faltas
                        <input type="radio" id="" name="radio_busqueda" value="" onchange="this.form.submit()">Todo';
                        break;
                    case "Falta":
                        echo '<input type="radio" id="" name="radio_busqueda" value="Asistencia" onchange="this.form.submit()">Asistencias
                        <input type="radio" id="" name="radio_busqueda" value="Falta"checked onchange="this.form.submit()">Faltas
                        <input type="radio" id="" name="radio_busqueda" value="" onchange="this.form.submit()">Todo';
                        break;
                    case "":
                        echo '<input type="radio" id="" name="radio_busqueda" value="Asistencia" onchange="this.form.submit()">Asistencias
                        <input type="radio" id="" name="radio_busqueda" value="Falta" onchange="this.form.submit()">Faltas
                        <input type="radio" id="" name="radio_busqueda" value="" checked onchange="this.form.submit()">Todo';
                        break;
                }?>
                <p>
                    Ordenar Por:
                    <?php switch ($this->radioOrden) {
                case "fecha":
                    echo'<input type="radio" name="radio_ordenar" value="nombre">Voluntariado
                    <input type="radio" name="radio_ordenar" value="fecha"checked>Fecha';
                    break;
                case 'nombre':
                        echo'<input type="radio" name="radio_ordenar" value="nombre"checked>Voluntariado
                        <input type="radio" name="radio_ordenar" value="fecha">Fecha';
                        break;
                    break;
            }?>
                </p>

                <p>
                    <input type="text" name="caja_busqueda" id="caja_busqueda" autofocus placeholder="ID,Nombre">
                    De:<input type="Date" name="fecha_inicio" id="fecha_inicio" value="<?php echo $this->inicio; ?>">
                    a:<input type="Date" name="fecha_termino" id="fecha_termino" value="<?php echo $this->termino; ?>">
                    <input type="submit" value="🔍Buscar">
                </p>
            </form>
            <form action="<?php echo constant('URL'); ?>consultaAsistencia/generarReporte" method="POST">
                <input type="hidden" name="caja_busqueda" id="caja_busqueda" value="<?php echo $this->consulta; ?>">
                <input type="hidden" name="radio_busqueda" id="radio_busqueda" value="<?php echo $this->radio; ?>">
                <input type="hidden" name="radio_ordenar" id="radio_ordenar" value="<?php echo $this->radioOrden; ?>">
                <input type="hidden" name="fecha_inicio" id="fecha_inicio" value="<?php echo $this->inicio; ?>">
                <input type="hidden" name="fecha_termino" id="fecha_termino" value="<?php echo $this->termino; ?>">
                <input type="image" src="<?php echo constant('URL'); ?>assets/img/xls.png">
            </form>

            <form action="<?php echo constant('URL'); ?>consultaAsistencia/generarReportePDF" method="post">
                <input type="hidden" name="caja_busqueda" id="caja_busqueda" value="<?php echo $this->consulta; ?>">
                <input type="hidden" name="radio_busqueda" id="radio_busqueda" value="<?php echo $this->radio; ?>">
                <input type="hidden" name="radio_ordenar" id="radio_ordenar" value="<?php echo $this->radioOrden; ?>">
                <input type="hidden" name="fecha_inicio" id="fecha_inicio" value="<?php echo $this->inicio; ?>">
                <input type="hidden" name="fecha_termino" id="fecha_termino" value="<?php echo $this->termino; ?>">
                <input type="image" src="<?php echo constant('URL'); ?>assets/img/pdf.png">
            </form>
            <div id="div2">
                <table class="t-tipo3">
                    <thead>
                        <tr>
                            <th>Id Personal</th>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estatus</th>
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
                            <td><?php echo $asistencia->fecha; ?></td>
                            <td><?php echo $asistencia->hora; ?></td>
                            <td><?php echo $asistencia->estatus; ?></td>
                        </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>

</body>

</html>