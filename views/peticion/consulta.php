<?php require 'libraries/session.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Peticiones</title>
</head>

<body>

    <?php require 'views/header.php'; ?>

    <div id="main">
        <div><?php echo $this->mensaje; ?></div>
        <h1 class="center">Sección de consulta peticiones</h1>
        <form action="<?php echo constant('URL'); ?>peticion" method="POST">
            <input type="submit" value="Nuevo">
        </form>
        <table width="100%" id="tabla">
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Id personal</th>
                    <th>Fecha apertura</th>
                    <th>Tipo</th>
                    <th>Estatus</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody id="tbody-alumnos">

                <?php
            include_once 'models/peticiones.php';
            foreach ($this->peticiones as $row) {
                $peticion = new Peticiones();
                $peticion = $row;
        ?>
                <tr id="fila-<?php echo $peticion->folio; ?>">
                    <td><?php echo $peticion->folio; ?></td>
                    <td><?php echo $peticion->id_personal; ?></td>
                    <td><?php echo $peticion->fecha_apertura; ?></td>
                    <td><?php echo $peticion->tipo; ?></td>
                    <td><?php echo $peticion->estatus; ?></td>
                    <td><a
                            href="<?php echo constant('URL') . 'peticion/verPeticionId/'. $peticion->folio;?>">Gestionar</a>
                    </td>
                    <td><a href="<?php echo constant('URL') . 'peticion/verPeticion/' . $peticion->folio; ?>">Eliminar</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php require 'views/footer.php'; ?>
    <script src="<?php echo constant('URL'); ?>assets/js/estatus.js"></script>
</body>

</html>