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
        <h1 class="center">Usuarios</h1>
        <div class="center"><?php echo $this->mensaje; ?></div>
        <form action="<?php echo constant('URL'); ?>usuario/nuevo" method="POST">
            <input type="submit" value="Nuevo">
        </form>
        <div id="respuesta" class="center"></div>

        <table width="100%">
            <thead>
                <tr>
                    <th>Id usuario</th>
                    <th>usuario</th>
                    <th>rol</th>
                </tr>
            </thead>
            <tbody id="tbody-usuario">
                <?php
                    include_once 'models/usuarios.php';
                    foreach($this->usuario as $row){
                        $usuario = new Usuarios();
                        $usuario = $row; 
                ?>
                <tr id="fila-<?php echo $usuario->id_usuario; ?>">
                    <td><?php echo $usuario->id_usuario; ?></td>
                    <td><?php echo $usuario->nombre_usuario; ?></td>
                    <td><?php echo $usuario->rol; ?></td>
                
                    <td><a href="<?php echo constant('URL') . 'usuario/verUsuario/' . $usuario->id_usuario; ?>">Editar</a>  </td>
                    <!-- <td><a href="<?php echo constant('URL') . 'usuario/eliminarUsuario/' . $usuario->id_usuario; ?>">Eliminar</a> </td>-->
                    <!-- <td><button class="bEliminar" data-matricula="<?php echo $usuario->id_usuario; ?>">Eliminar</button></td> -->
                </tr>

                <?php } ?>
            </tbody>
        </table>
        <!-- <form action="<?php echo constant('URL'); ?>usuario/listar" method="POST">
            <input type="submit" value="Regresar">
        </form> -->
    </div>

    <?php require 'views/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>

</body>
</html>