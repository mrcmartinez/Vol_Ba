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
            <h1 class="center">Candidatos</h1>
            <form action="<?php echo constant('URL'); ?>candidato/listar" method="POST">
                <p>
                    <input type="text" name="caja_busqueda" id="caja_busqueda" autofocus>
                    <input type="submit" class="btn-options-info" value="🔍Buscar">
                </p>
            </form>
            <form action="<?php echo constant('URL'); ?>candidato" method="POST">
                <input type="image" src="<?php echo constant('URL'); ?>assets/img/nuevo.png" value="Nuevo">
            </form>
            <div id="div2">
                <table id="tabla">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Edad</th>
                            <th>Fecha solicitud</th>
                            <th>Telefono</th>
                            <th>Acciones</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody id="tbody-alumnos">

                        <?php $i=1;
            include_once 'models/candidatos.php';
            foreach ($this->candidato as $row) {
                $candidato = new Candidatos();
                $candidato = $row;
        ?>
                        <tr id="fila-<?php echo $candidato->id_candidato; ?>">
                        <td><?php echo $i; $i++;?></td>
                            <td><?php echo $candidato->id_candidato; ?></td>
                            <td><?php echo $candidato->nombre; ?></td>
                            <td><?php echo $candidato->edad; ?></td>
                            <td><?php echo $candidato->fecha_solicitud; ?></td>
                            <td><?php echo $candidato->telefono; ?></td>
                            <td><a
                                    href="<?php echo constant('URL') . 'candidato/eliminar/'.$candidato->id_candidato; ?>"><img
                                        src="<?php echo constant('URL'); ?>assets/img/eliminar2.png" /></a>
                            
                                <form action="<?php echo constant('URL'); ?>candidato/alta" method="POST">
                                    <input type="hidden" name="nombre" value="<?php echo $candidato->nombre; ?>">
                                    <input type="hidden" name="id_candidato"
                                        value="<?php echo $candidato->id_candidato; ?>">
                                    <input type="hidden" name="fecha_nacimiento"
                                        value="<?php echo $candidato->fecha_nacimiento; ?>">
                                    <input type="image" src="<?php echo constant('URL'); ?>assets/img/alta.png"
                                        value="Nuevo">
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
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