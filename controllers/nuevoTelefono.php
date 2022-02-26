<?php

class NuevoTelefono extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
        //echo "<p>Nuevo controlador Main</p>";
    }

    function render(){
        $this->view->render('nuevoTelefono/index');
    }

    function registrarTelefono(){
        $id_personal = $_POST['id_personal'];
        $lada    = $_POST['lada'];
        $numero  = $_POST['numero'];

        $mensaje = "";

        if($this->model->insert(['id_personal' => $id_personal, 'lada' => $lada, 'numero' => $numero])){
            $mensaje = "Nuevo telefono creado";
        }else{
            $mensaje = "ID ya existe";
        }

        $this->view->mensaje = $mensaje;
        $this->view->render('inicio/index');
        // $this->render();
    }
}

?>