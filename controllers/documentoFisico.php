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
    function actualizarDocumentoFisico(){
        // echo $id = $_POST['id_personal'];
        $acta=0;$curp=0;
        if(isset($_POST['acta']))
            $acta=$_POST['acta'];
        if(isset($_POST['curp']))
            $curp=$_POST['curp'];
        echo $acta;
        echo $curp;
        // $carta  = $_POST['carta'];
        // $domicilio  = $_POST['domicilio'];
        // $datos  = $_POST['datos'];
        // $estudio  = $_POST['estudio'];
        // $examen  = $_POST['examen'];
        // $ine  = $_POST['ine'];
        // $solicitud  = $_POST['solicitud'];

        // if($this->model->update(['id' => $id, 'nombre' => $nombre, 'descripcion' => $descripcion,
        //                         'responsable' => $responsable, 'fecha' => $fecha, 'hora' => $hora, 'estatus' => $estatus])){
        //     $this->view->mensaje = "Curso actualizado correctamente";
        // }else{
        //     $this->view->mensaje = "No se pudo actualizar al curso";
        // }
        // $this->listar();
    }

}

?>