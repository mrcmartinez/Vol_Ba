<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/estilos.css">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo constant('URL'); ?>assets/img/logo.ico" />
</head>

<body>
    <?php require 'views/header.php'; ?>
    <div id="main-inicio">
        <div class="container-fluid">
            <div class="center-form-inicio">
                <h1 class="center">Voluntariado</h1>
                <div id="respuesta" class="center">
                    <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
                        <?php switch($this->radio){
                    case "Activo":
                        echo '<input type="submit" class="btn-options-check" name="radio_busqueda" value="Activo" onchange="this.form.submit()">
                        <input type="submit" class="btn-options-baja" name="radio_busqueda" value="Baja" onchange="this.form.submit()">';
                        break;
                    case "Baja":
                        echo '<input type="submit" class="btn-options-activo" name="radio_busqueda" value="Activo" onchange="this.form.submit()">
                        <input type="submit" class="btn-options-check-Red" name="radio_busqueda" value="Baja" onchange="this.form.submit()">';
                        break;
                    // case "Candidato":
                    //     echo '<input type="radio" id="" name="radio_busqueda" value="Activo" onchange="this.form.submit()">Activo
                    //     <input type="radio" id="" name="radio_busqueda" value="Baja" onchange="this.form.submit()">Baja
                    //     <input type="radio" id="" name="radio_busqueda" value="Candidato"checked onchange="this.form.submit()">Candidato';
                    //     break;
                }?>

                        <div class="alinear">
                            <div class="col-md-2">
                                <select class="form-select" id="horario" name="filtroHorario"
                                    onchange="this.form.submit()">
                                    <option value="<?php echo $this->filtroHorario; ?>">
                                        ✔<?php echo filtroHorario($this->filtroHorario); ?></option>
                                    <option value="">Todo</option>
                                    <option value="Matutino">Matutino</option>
                                    <option value="Vespertino">Vespertino</option>
                                </select>
                            </div>
                            <input type="search" class="form-control" name="caja_busqueda" id="caja_busqueda"
                                value="<?php echo $this->consulta; ?>" autofocus
                                title="Buscar ID, Nombre, Dia, Actividad">
                            <input class="btn btn-info" type="submit" value="🔍Buscar">
                        </div>

                    </form>
                </div>
                <form action="<?php echo constant('URL'); ?>personal" method="POST">
                    <input type="image" src="<?php echo constant('URL'); ?>assets/img/nuevo.png"
                        title="Nuevo Voluntariado">
                </form>
                <form action="<?php echo constant('URL'); ?>personal/generarReporte" method="POST">
                    <input type="hidden" name="caja_busqueda" id="caja_busqueda" value="<?php echo $this->consulta; ?>">
                    <input type="hidden" name="radio_busqueda" id="radio_busqueda" value="<?php echo $this->radio; ?>">
                    <input type="hidden" name="filtroHorario" id="filtroHorario"
                        value="<?php echo $this->filtroHorario; ?>">
                    <input type="image" src="<?php echo constant('URL'); ?>assets/img/xls.png" title="Generar Excel">
                </form>

                <form action="<?php echo constant('URL'); ?>personal/generarReportePDF" method="post">
                    <input type="hidden" name="caja_busqueda" id="caja_busqueda" value="<?php echo $this->consulta; ?>">
                    <input type="hidden" name="radio_busqueda" id="radio_busqueda" value="<?php echo $this->radio; ?>">
                    <input type="hidden" name="filtroHorario" id="filtroHorario"
                        value="<?php echo $this->filtroHorario; ?>">
                    <input type="image" src="<?php echo constant('URL'); ?>assets/img/pdf.png" title="Generar PDF">
                </form>
                <form action="<?php echo constant('URL'); ?>consultaAsistencia/paseLista" method="post">
                    <input type="image" src="<?php echo constant('URL'); ?>assets/img/listaVinetas.png"
                        title="Lista asistencia">
                </form>
                <div class="right-icon">
                    <form action="<?php echo constant('URL'); ?>personal/actualizarestado" method="post">
                        <input type="image" src="<?php echo constant('URL'); ?>assets/img/refresh.png"
                            title="actualizar estatus faltas">
                    </form>
                    <form action="<?php echo constant('URL'); ?>personal/listarSiguiente" method="post">
                        <input type="hidden" name="filtroHorario" id="filtroHorario"
                            value="<?php echo $this->filtroHorario; ?>">
                        <input type="hidden" name="radio_busqueda" id="radio_busqueda"
                            value="<?php echo $this->radio; ?>">
                        <input type="image" src="<?php echo constant('URL'); ?>assets/img/next.png" title="+ filtros">
                    </form>
                </div>
                <!-- <table>
                    <thead>
                        <tr>
                            <th>Nª</th>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th class="espaciado"></th>
                            <th>Turno</th>
                            <th>Actividad</th>
                            <th>Ingreso</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table> -->

                <div id="div2">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="header" scope="col">Nª</th>
                                <th class="header" scope="col">ID</th>
                                <th class="header" scope="col">Nombre</th>
                                <th class="header" scope="col">Turno</th>
                                <th class="header" scope="col">Horario</th>
                                <th class="header" scope="col">Actividad</th>
                                <th class="header" scope="col">Ingreso</th>
                                <th class="header" scope="col">Estatus</th>
                                <th class="header" scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-personal">

                            <?php $i=1;
                    include_once 'models/personalBanco.php';
                    foreach($this->personal as $row){
                        
                        $personal = new PersonalBanco();
                        $personal = $row; 
                ?>
                            <tr id="fila-<?php echo $personal->id_personal; ?>">
                                <td><?php echo $i; $i++;?></td>
                                <td><?php echo $personal->id_personal; ?></td>
                                <td><?php echo $personal->apellido_paterno.' '.$personal->apellido_materno.' '.$personal->nombre; ?>
                                </td>
                                <td><?php echo $personal->turno; ?></td>
                                <td><?php echo $personal->horario; ?></td>
                                <td><?php echo $personal->actividad; ?></td>
                                <td><?php echo $personal->fecha_ingreso; ?></td>
                                <?php switch($personal->estatus){
                    case "Activo":
                        echo '<td class="td-activo">';echo $personal->estatus;'</td>';
                        break;
                    case "Baja":
                        echo '<td class="td-baja">';echo $personal->estatus;'</td>';
                        break;
                    case "Candidato":
                        echo '<td class="td-candidato">';echo $personal->estatus;'</td>';
                        break;
                    case "Activo-Pendiente":
                            echo '<td class="td-activo-pendiente">';echo $personal->estatus;'</td>';
                        break;
                }?>

                                <td>
                                    <?php if ( $_SESSION['rol']!="Supervisor" ) { ?>
                                    <!-- <a
                                        href="<?php echo constant('URL') . 'personal/eliminarVoluntariado/' . $personal->id_personal; ?>"onclick="return confirmBaja()">❌</a> -->

                                    <a
                                        href="javascript:popup('70','70','<?php echo constant('URL') . 'personal/code/' . $personal->id_personal; ?>')"><img
                                            src="<?php echo constant('URL'); ?>assets/img/qr-code.png"
                                            title="Imprimir QR" /></a>
                                    <a
                                        href="<?php echo constant('URL') . 'personal/verInformacion/' . $personal->id_personal; ?>"><img
                                            src="<?php echo constant('URL'); ?>assets/img/lupa.png"
                                            title="Detalles" /></a>
                                    <a
                                        href="<?php echo constant('URL') . 'personal/verPersonal/' . $personal->id_personal; ?>"><img
                                            src="<?php echo constant('URL'); ?>assets/img/edit.png"
                                            title="Editar" /></a>

                                    <?php if ($this->radio!="Activo") {
                                ?><a
                                        href="<?php echo constant('URL') . 'personal/altaPersonal/' . $personal->id_personal.'/'.$this->radio; ?>"><button
                                            onclick="return confirmBaja()"><img
                                                src="<?php echo constant('URL'); ?>assets/img/alta.png"
                                                title="alta" /></a><?php
                            }else{
                                ?><a
                                        href="<?php echo constant('URL') . 'personal/llamarBaja/' . $personal->id_personal; ?>"><img
                                            src="<?php echo constant('URL'); ?>assets/img/eliminar.png"
                                            title="Baja" /></a><?php
                            }?>


                                </td>
                                <?php } ?>
                            </tr>
                            <?php } ?>
                        </tbody>
                </div>
                </table>
            </div>
        </div>
        <?php require 'views/footer.php'; ?>
        <script src="<?php echo constant('URL'); ?>assets/js/estatus.js"></script>
        <script src="<?php echo constant('URL'); ?>assets/js/salto.js"></script>
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
        <?php
        if (!empty($this->idBaja)) 
        {
            ?>
        <a href="#miModalBaja">Abrir Modal</a>
        <div id="miModalBaja" class="modalBaja">

            <div class="modalBaja-contenido">
                <p>
                    <a href="<?php echo constant('URL'); ?>personal/listarPersonal">❌</a>
                </p>
                <form action="<?php echo constant('URL'); ?>personal/eliminarPersonal" method="post" method="post">
                    <label for="">Motivo de la baja</label>
                    <p>
                    <h6><?php echo $this->nombre;?></h6>
                    <input type="hidden" name="id_personal" value="<?php echo $this->idBaja?>">
                    <textarea name="motivo" id="nota" required rows="2" cols="55" maxlength="200"
                        onkeyup="check(event);"></textarea>
                    </p>
                    <input class="btn btn-dark" type="submit" value="Aceptar">
                </form>
            </div>
        </div>
        <?php    
        }
    ?>
    </div>
    <script>
    function popup(w, h, url) {
        window.open(url, "popup", "width=" + w + ",height=" + h + ",left=20,top=20").print();
        // window.print();
    }
    </script>
</body>

</html>