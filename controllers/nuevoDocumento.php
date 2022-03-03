<?php

class NuevoDocumento extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
        //echo "<p>Nuevo controlador Main</p>";
    }

    function render(){
        $this->view->render('nuevoDocumento/index');
    }

    function registrarDocumento(){
        $id_personal = $_POST['id_personal'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $estatus  = $_POST['estatus'];
        $mensaje = "";

        if($this->model->insert(['id_personal' => $id_personal,'nombre' => $nombre,
                                 'descripcion' => $descripcion, 'estatus' => $estatus])){
            $mensaje = "Nuevo documento creado";
            // $this->view->mensaje2 = $matricula;
            // $this->view->render('consulta/index');
        }else{
            $mensaje = "Documento ya existe";
        }

        $this->view->mensaje = $mensaje;
        $this->render();
    }
}

?>