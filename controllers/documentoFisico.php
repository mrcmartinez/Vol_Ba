<?php
require 'libraries/session.php';

class DocumentoFisico extends Controller{

    public function __construct()
    {
        parent::__construct();
        $this->view->documentoFisico = [];
        $this->view->mensaje = "";
        $this->view->consulta = "";
    }

    public function verdocumentoid($param = null)
    {
        $idPersonal = $param[0];
        $documentoFisico = $this->model->getById($idPersonal);
        $this->view->id = $idPersonal;
        $this->view->prueba = "PruebaHola";
        $this->view->documentoFisico = $documentoFisico;
        print_r($documentoFisico);
        $this->view->render('documentoFisico/consulta');
    }

}

?>