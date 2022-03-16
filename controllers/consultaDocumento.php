<?php

class ConsultaDocumento extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->documento = [];
        $this->view->mensaje = "";
        
        //echo "<p>Nuevo controlador Inicio</p>";
    }

    function render(){
        $documento = $this->model->get(1);
        $this->view->documento = $documento;
        $this->view->render('consulta/consultaDocumento');
    }
    
    function verdocumentoid($param = null){
        echo "entro verDocumentoID";
        $idPersonal = $param[0];
        $documento = $this->model->get($idPersonal);
        $this->view->id = $idPersonal;
        // print_r($documento);
        $this->view->documento = $documento;
        $this->view->render('consulta/consultaDocumento');
    }

    // function verdocumento($param = null){
    //     $idPersonal = $param[0];
    //     $lada = $param[1];
    //     $numero = $param[2];
    //     $documento = $this->model->getById($idPersonal,$lada,$numero);

    //     session_start();
    //     $_SESSION['id_verPersonal'] = $documento->id_personal;
    //     $_SESSION['verLada'] = $documento->lada;
    //     $_SESSION['verNumero'] = $documento->numero;
    //     $this->view->documento = $documento;
    //     $this->view->mensaje = "";
    //     $this->view->render('consultaDocumento/detalle');
    // }
}

?>