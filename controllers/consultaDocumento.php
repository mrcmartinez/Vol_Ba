<?php

class ConsultaDocumento extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->personal = [];
        $this->view->mensaje = "";
        
        //echo "<p>Nuevo controlador Inicio</p>";
    }

    function render(){
        $personal = $this->model->get();
        $this->view->personal = $personal;
        $this->view->render('consultaDocumento/index');
    }

    function verInformacion($param = null){
        $idPersonal = $param[0];
        $personal = $this->model->getById($idPersonal);
        $this->view->personal = $personal;
        $this->view->mensaje = "";
        $this->view->render('consultaDocumento/informacion');
    }
}

?>