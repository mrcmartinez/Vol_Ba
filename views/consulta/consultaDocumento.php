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
        <h1 class="center">Sección de Consulta</h1>
        <div class="center"><?php echo $this->mensaje; ?></div>
        <div id="respuesta" class="center"></div>

        <table width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Estatus</th>
                </tr>
            </thead>
            <tbody id="tbody-documento">
                <?php
                    include_once 'models/documento.php';
                    foreach($this->documento as $row){
                        $documento = new Documento();
                        $documento = $row; 
                ?>
                <tr id="fila-<?php echo $documento->id_personal; ?>">
                    <td><?php echo $documento->id_personal; ?></td>
                    <td><?php echo $documento->nombre; ?></td>
                    <td><?php echo $documento->estatus; ?></td>
                    <td><a href="<?php echo constant('URL') . 'consultaDocumento/eliminardocumento/' . $documento->id_personal.'/'. $documento->nombre; ?>">Eliminar</a> </td>
                
                </tr>

                <?php } ?>
            </tbody>
        </table>
        <a href="<?php echo constant('URL') . 'nuevoDocumento/nuevoDocumento/' . $this->id; ?>">Nuevo</a>
        <form action="<?php echo constant('URL'); ?>consulta" method="POST">
            <input type="submit" value="Regresar">
        </form>
    </div>

    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>

</body>
</html>