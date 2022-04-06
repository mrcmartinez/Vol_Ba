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
        $this->view->render('documentacion/consultaDocumento');
    }
    
    function verdocumentoid($param = null){
        echo "entro verDocumentoID";
        $idPersonal = $param[0];
        $documento = $this->model->get($idPersonal);
        $this->view->id = $idPersonal;
        // print_r($documento);
        $this->view->documento = $documento;
        $this->view->render('documentacion/consultaDocumento');
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
    function eliminardocumento($param = null){
        $id_personal = $param[0];
        $nombre = $param[1];

        if($this->model->delete($id_personal,$nombre)){
            //$this->view->mensaje = "telefono eliminado correctamente";
            $mensaje = "Documento eliminado correctamente";
        }else{
            // mensaje de error
            //$this->view->mensaje = "No se pudo eliminar el telefono";
            $mensaje = "No se pudo eliminar el documento";
        }
        //$this->render();
        
        // echo $mensaje;
        $this->view->mensaje = $mensaje;
        $documento = $this->model->get($id_personal);
        $this->view->documento = $documento;
        $this->view->render('documentacion/consultaDocumento');
    }
}

?>