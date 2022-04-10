<?php require 'libraries/session.php';?>
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
        <h1 class="center">Sección de consulta curso</h1>
        <form action="<?php echo constant('URL'); ?>curso/listar" method="POST">
            <?php switch($this->radio){
                    case "Activo":
                        echo '<input type="radio" id="" name="radio_busqueda" value="Activo"checked>Activo
                        <input type="radio" id="" name="radio_busqueda" value="Terminado">Terminado';
                        break;
                    case "Terminado":
                        echo '<input type="radio" id="" name="radio_busqueda" value="Activo">Activo
                        <input type="radio" id="" name="radio_busqueda" value="Terminado"checked>Terminado';
                        break;
                }?>
            <p>
                <input type="text" name="caja_busqueda" id="caja_busqueda" autofocus>
                <input type="date" name="caja_fecha" id="caja_fecha" autofocus>
                <input type="submit" value="Buscar">
            </p>
        </form>
        <table width="100%" id="tabla">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>descripcion</th>
                    <th>Responsable</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estatus</th>
                    <th></th>
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
                    <td><?php echo $curso->hora; ?></td>
                    <td><?php echo $curso->estatus; ?></td>
                    <td><a
                            href="<?php echo constant('URL') . 'capacitaciones/verCapacitacionId/'. $curso->id;?>">Ver</a>
                    </td>
                    <td><a href="<?php echo constant('URL') . 'curso/verCurso/' . $curso->id; ?>">Actualizar</a></td>
                    <!-- <td><a href="<?php echo constant('URL') . 'curso/eliminarCurso/' . $curso->id; ?>">Eliminar</a></td> -->
                    <td> <a
                            href="<?php echo constant('URL') . 'curso/eliminarCurso/' . $curso->id.'/'.$this->radio; ?>"><button onclick="return confirmBaja()"><?php if ($this->radio=="Activo") { 
                            ?>Cerrar</button><?php
                            }else{
                                ?>Activar</button><?php
                            } ?></a></td>
                    <td><a href="<?php echo constant('URL') . 'personal/listar/'. $curso->id;?>">Asignar</a></td>
                    <!-- <td><button class="bEliminar" data-matricula="<?php echo $curso->id; ?>">Eliminar</button></td>  -->
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php require 'views/footer.php'; ?>
    <script src="<?php echo constant('URL'); ?>assets/js/estatus.js"></script>
</body>

</html>