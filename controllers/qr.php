<?php

class Qr extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->qr = [];
        $this->view->mensaje = "";
    }

    function consultar($param = null)
    {
        $idPersonal = $param[0];
        // $telefono = $this->model->get($idPersonal);
        $this->listar($idPersonal);
        // 
        // 
    }
    function listar($param){
        clearstatcache();
        $idPersonal = $param;
        $this->view->id = $idPersonal;
        $file = "assets/img/QR/qr".$idPersonal.".png";
        $img=constant('URL').$file;
        $this->view->img = $img;
        // 
        $qr = $this->model->getId($idPersonal);
        // print_r($qr);
        $this->view->qr = $qr;
        // $this->view->telefono = $telefono;
        $this->view->render('qr/index');
    }
function actualizar($param = null){
    require 'libraries/phpqrcode/qrlib.php';
    // echo "actualizar QR";
    $id_personal = $param[0];
    $nombre=$_POST['nombreVol'];
    $fecha=date("Y-m-d");
    $identificador=mt_rand(5, 15);
     // //file path
    $file = "assets/img/QR/qr".$id_personal.".png";
     // //data to be stored in qr
    $content = $id_personal.",".$nombre.",".$identificador;
     // //other parameters
    $ecc = 'H';
    $pixel_size = 10;
    $frame_size = 5;
    // $url=constant('URL');
    // Generates QR Code and Save as PNG
    
    if($this->model->updateQr(['id_personal' => $id_personal, 'identificador' => $identificador,
    'fecha_modificacion' => $fecha])){
        if (unlink($file)) {
            // echo "file was successfully deleted";
            QRcode::png($content, $file, $ecc, $pixel_size, $frame_size);
            $this->view->mensaje = "Nuevo Qr activado";
            $this->view->code = "success";
          } else {
            // echo "there was a problem deleting the file"; 
            $this->view->mensaje = "No se pudo actualizar el code";
            $this->view->code = "error";
          }
    }else{
        $this->view->mensaje = "No se pudo actualizar el code";
        $this->view->code = "error";
    }
    // echo $idPersonal;
    $this->listar($id_personal);
}

}