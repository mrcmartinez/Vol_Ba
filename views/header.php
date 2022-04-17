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
            <img src="<?php echo constant('URL'); ?>assets/img/logo (5).png" alt="Logo Bamex">
            <!-- <h2 class="logo-nombre">Bamex</h2> -->
        </div>
        <div class="cont-lateral">
            <nav>
                <ul>
                    <!-- <li><a href="<?php echo constant('URL'); ?>inicio">Cursos</a></li> -->
                    <!-- <li><a href="<?php echo constant('URL'); ?>personal">Nuevo</a></li> -->
                    <a href="<?php echo constant('URL'); ?>personal/listar">Voluntariado</a>
                    <!-- <li><a href="<?php echo constant('URL'); ?>consulta">telefonos</a></li> -->
                    <a href="<?php echo constant('URL'); ?>curso/listar">Curso</a>
                    <a href="<?php echo constant('URL'); ?>curso/nuevo">nuevo Curso</a>
                    <!-- <a href="<?php echo constant('URL'); ?>usuario/nuevo">nuevo Usuario</a> -->
                    <!-- <li><a href="<?php echo constant('URL'); ?>capacitaciones">Capacitacion Curso</a></li> -->
                    <!-- <li><a href="<?php echo constant('URL'); ?>documento">Documentacio</a></li> -->
                    <!-- <li><a href="<?php echo constant('URL'); ?>documento">nuevo Documentacio</a></li> -->

                </ul>
            </nav>
        </div>
    </header>
    <input type="checkbox" id="btn-menu">
    <div class="container-menu">
        <div class="cont-menu">
            <nav>
                <a href="<?php echo constant('URL'); ?>usuario/nuevo">Usuarios</a>
                <a href="#">Configuracion</a>
                <a href="<?php echo constant('URL'); ?>inicio/cerrar_sesion">Cerrar sesion</a>
            </nav>
            <label for="btn-menu">✖️</label>
        </div>
    </div>
</body>

</html>