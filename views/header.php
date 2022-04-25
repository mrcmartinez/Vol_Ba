<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/default.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/estilos.css">
</head>

<body>
    <header>
        <div class="logo">
            <div class="btn-menu">
                <label for="btn-menu">
                    <h2>☰</h2>
                </label>
            </div>
            <img src="<?php echo constant('URL'); ?>assets/img/logoNuevo4.0.png" alt="Logo Bamex">
        </div>
        <div class="cont-lateral">
            <nav>
                <ul>
                    <a href="<?php echo constant('URL'); ?>personal/listarPersonal">Voluntariado</a>
                    <a href="<?php echo constant('URL'); ?>curso/listar">Curso</a>
                    <a href="<?php echo constant('URL'); ?>documento">Reportes</a>
                </ul>
            </nav>
        </div>
    </header>
    <input type="checkbox" id="btn-menu">
    <div class="container-menu">
        <div class="cont-menu">
            <nav>
                <a href="<?php echo constant('URL'); ?>usuario/nuevo">Usuarios</a>
                <a href="<?php echo constant('URL'); ?>usuario/listar">Configuracion</a>
                <a href="<?php echo constant('URL'); ?>inicio/cerrar_sesion">Cerrar sesion</a>
            </nav>
            <label for="btn-menu">✖️</label>
        </div>
    </div>
</body>

</html>