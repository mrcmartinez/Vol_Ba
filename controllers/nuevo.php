<?php

class Nuevo extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
        //echo "<p>Nuevo controlador inicio</p>";
    }

    function render(){
        $this->view->render('nuevo/index');
    }


    function registrarPersonal(){
        // $id_personal = NULL;
        $nombre    = $_POST['nombre'];
        $apellido_paterno  = $_POST['apellido_paterno'];
        $apellido_materno  = $_POST['apellido_materno'];
        $calle  = $_POST['calle'];
        $colonia  = $_POST['colonia'];
        $numero_exterior  = $_POST['numero_exterior'];

        $edad  = $_POST['edad'];
        $fecha_nacimiento  = $_POST['fecha_nacimiento'];
        $estado_civil  = $_POST['estado_civil'];

        $numero_hijos  = $_POST['numero_hijos'];
        $escolaridad  = $_POST['escolaridad'];
        $estatus  = $_POST['estatus'];

        $mensaje = "";

        if($this->model->insert(['nombre' => $nombre, 'apellido_paterno' => $apellido_paterno,
                                 'apellido_materno' => $apellido_materno,'calle' => $calle,
                                 'colonia' => $colonia,'numero_exterior' => $numero_exterior,
                                 'edad' => $edad,'fecha_nacimiento' => $fecha_nacimiento,
                                 'estado_civil' => $estado_civil,'numero_hijos' => $numero_hijos,
                                 'escolaridad' => $escolaridad,'estatus' => $estatus])){
            $mensaje = "Nuevo voluntariado creado";
            $this->view->render('inicio/index');
        }else{
            $mensaje = "Voluntario ya existe";
        }

        $this->view->mensaje = $mensaje;
        // $this->render();
    }

}

?>