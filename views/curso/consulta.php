
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
        <div><?php echo $this->mensaje; ?></div>
        <h1 class="center">Cursos</h1>
        <form action="<?php echo constant('URL'); ?>curso/listar" method="POST">
            <?php switch($this->radio){
                    case "Activo":
                        echo '<input type="radio" id="" name="radio_busqueda" value="Activo"checked onchange="this.form.submit()">Activo
                        <input type="radio" id="" name="radio_busqueda" value="Terminado" onchange="this.form.submit()">Terminado';
                        break;
                    case "Terminado":
                        echo '<input type="radio" id="" name="radio_busqueda" value="Activo" onchange="this.form.submit()">Activo
                        <input type="radio" id="" name="radio_busqueda" value="Terminado"checked onchange="this.form.submit()">Terminado';
                        break;
                }?>
            <p>
                <input type="text" name="caja_busqueda" id="caja_busqueda" autofocus>
                <input type="date" name="caja_fecha" id="caja_fecha" autofocus>
                <input type="submit" value="🔍Buscar">
            </p>
        </form>
        <form action="<?php echo constant('URL'); ?>curso" method="POST">
            <input type="submit" value="Nuevo">
        </form>
        <table id="tabla">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>descripcion</th>
                    <th>Responsable</th>
                    <th>Fecha</th>
                    
                    <th>Estatus</th>
                    <th></th>
                    
                </tr>
            </thead>

            <tbody id="tbody-alumnos">

                <?php
            include_once 'models/cursos.php';
            foreach ($this->cursos as $row) {
                $curso = new Cursos();
                $curso = $row;
        ?>
                <tr id="fila-<?php echo $curso->id; ?>">
                    <td><?php echo $curso->id; ?></td>
                    <td><?php echo $curso->nombre; ?></td>
                    <td><?php echo $curso->descripcion; ?></td>
                    <td><?php echo $curso->responsable; ?></td>
                    <td><?php echo $curso->fecha; ?></td>
                    
                    <td><?php echo $curso->estatus; ?></td>
                    <td><a href="<?php echo constant('URL') . 'capacitaciones/verCapacitacionId/'. $curso->id.'/'.$curso->estatus;?>"><img
                                src="<?php echo constant('URL'); ?>assets/img/lista.png" /></a>

                        <?php if (( $_SESSION['rol']!="Supervisor" )&&($this->radio=="Activo")) { ?>
                    <a href="<?php echo constant('URL') . 'personal/listarPersonal/'. $curso->id.'/'.$curso->estatus;?>"><img
                                src="<?php echo constant('URL'); ?>assets/img/grupo.png" /></a>
                    <a href="<?php echo constant('URL') . 'curso/verCurso/' . $curso->id; ?>"><img
                                src="<?php echo constant('URL'); ?>assets/img/editar.png" /></a>
                    
                    <?php } ?>
                    <a href="<?php echo constant('URL') . 'curso/eliminarCurso/' . $curso->id.'/'.$this->radio; ?>"><button
                                onclick="return confirmBaja()"><?php if ($this->radio=="Activo") { 
                            ?>Cerrar</button><?php
                            }else{
                                ?>Activar</button><?php
                            } ?></a></td>
                </tr>
                <?php } ?>
            </tbody>
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
    
</body>

</html>