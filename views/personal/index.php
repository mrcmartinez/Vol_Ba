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
        <h1 class="center"><small>Personal</small>Voluntariado</h1>
        <!-- <div class="center"><?php echo $this->mensaje; ?></div> -->

        <div id="respuesta" class="center">
            <!-- <h4>Bienvenido<?php echo $_SESSION['rol']?></h4> -->

            <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
                <?php switch($this->radio){
                    case "Activo":
                        echo '<input type="radio" id="" name="radio_busqueda" value="Activo" onchange="this.form.submit()" checked>Activo
                        <input type="radio" id="" name="radio_busqueda" value="Baja" onchange="this.form.submit()">Baja
                        <input type="radio" id="" name="radio_busqueda" value="Candidato" onchange="this.form.submit()">Candidato';
                        break;
                    case "Baja":
                        echo '<input type="radio" id="" name="radio_busqueda" value="Activo" onchange="this.form.submit()">Activo
                        <input type="radio" id="" name="radio_busqueda" value="Baja"checked onchange="this.form.submit()">Baja
                        <input type="radio" id="" name="radio_busqueda" value="Candidato" onchange="this.form.submit()">Candidato';
                        break;
                    case "Candidato":
                        echo '<input type="radio" id="" name="radio_busqueda" value="Activo" onchange="this.form.submit()">Activo
                        <input type="radio" id="" name="radio_busqueda" value="Baja" onchange="this.form.submit()">Baja
                        <input type="radio" id="" name="radio_busqueda" value="Candidato"checked onchange="this.form.submit()">Candidato';
                        break;
                }?>
                <p>
                    <input type="search" name="caja_busqueda" id="caja_busqueda" value ="<?php echo $this->consulta; ?>"autofocus>
                    <input type="submit" value="🔍Buscar">
                </p>
            </form>
        </div>
        <!-- <div class="center"></div> -->
        <form action="<?php echo constant('URL'); ?>personal" method="POST">
            <input type="image" src="<?php echo constant('URL'); ?>assets/img/nuevo.png">
        </form>
        <form action="<?php echo constant('URL'); ?>personal/generarReporte" method="POST">
            <input type="hidden" name="caja_busqueda" id="caja_busqueda" value="<?php echo $this->consulta; ?>">
            <input type="hidden" name="radio_busqueda" id="radio_busqueda" value="<?php echo $this->radio; ?>">
            <input type="image" src="<?php echo constant('URL'); ?>assets/img/xls.png">
        </form>

        <form action="<?php echo constant('URL'); ?>personal/generarReportePDF" method="post">
            <input type="hidden" name="caja_busqueda" id="caja_busqueda" value="<?php echo $this->consulta; ?>">
            <input type="hidden" name="radio_busqueda" id="radio_busqueda" value="<?php echo $this->radio; ?>">
            <input type="image" src="<?php echo constant('URL'); ?>assets/img/pdf.png">
        </form>
        <form action="<?php echo constant('URL'); ?>consultaAsistencia/paseLista" method="post">
            <input type="image" src="<?php echo constant('URL'); ?>assets/img/listaVinetas.png">
        </form>
    
        <!-- <div class="table-responsive"> -->
        <table>
        <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th class="espaciado"></th>
                    <th >Turno</th>
                    <th >Actividad</th>
                    <th >Estatus</th>
                    <th >Acciones</th>
                </tr>
            </thead>
        </table>
        
        <div id="div2">
        <table class="table">

            <tbody id="tbody-personal">        
                <?php
                    include_once 'models/personalBanco.php';
                    foreach($this->personal as $row){
                        $personal = new PersonalBanco();
                        $personal = $row; 
                ?>
                <tr id="fila-<?php echo $personal->id_personal; ?>">
                
                    <td><?php echo $personal->id_personal; ?></td>
                    <td><?php echo $personal->apellido_paterno.' '.$personal->apellido_materno.' '.$personal->nombre; ?></td>
                    <td><?php echo $personal->turno; ?></td>
                    <td><?php echo $personal->actividad; ?></td>
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
                            <a href="<?php echo constant('URL') . 'personal/verInformacion/' . $personal->id_personal; ?>"><img src="<?php echo constant('URL'); ?>assets/img/lupa.png"/></a>
                            <a href="<?php echo constant('URL') . 'personal/verPersonal/' . $personal->id_personal; ?>"><img src="<?php echo constant('URL'); ?>assets/img/edit.png"/></a>

                            <?php if ($this->radio!="Activo") {
                                ?><a href="<?php echo constant('URL') . 'personal/eliminarPersonal/' . $personal->id_personal.'/'.$this->radio; ?>"><button
                                onclick="return confirmBaja()"><img src="<?php echo constant('URL'); ?>assets/img/alta.png"/></a><?php
                            }else{
                                ?><a href="<?php echo constant('URL') . 'personal/llamarBaja/' . $personal->id_personal; ?>"><img src="<?php echo constant('URL'); ?>assets/img/eliminar.png"/></a><?php
                            }?>
                            
                            
                    </td>
                    <?php } ?>
                </tr>
                <?php } ?>
            </tbody>
            </div>
        </table>
    </div>
    <?php require 'views/footer.php'; ?>
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
                    <!-- <h2>Baja de personal</h2> -->
                    <label for="">Motivo de la baja</label>
                    <p>
                    <input type="hidden" name="id_personal" value="<?php echo $this->idBaja?>">
                    <input type="text" name="motivo" required>
                    </p>
                    <input type="submit" value="Aceptar">
                    </form>
                </div>  
            </div>
            <?php    
        }
    ?>
</body>
</html>