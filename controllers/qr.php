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
    // echo "actualizar QR";
    $id_personal = $param[0];
    $nombre=$_POST['nombreVol'];
    $fecha=date("Y-m-d");
    $identificador=mt_rand(5, 15);
    // echo $nombre;
     // //file path
    //  $file = "assets/img/QR/qr".$id_personal.".png";
     // //data to be stored in qr
    //  $content = $id_personal.",".$nombre.",".$identificador;
     // //other parameters
    //  $ecc = 'H';
    //  $pixel_size = 10;
    //  $frame_size = 5;
    //  $url=constant('URL');
     // // Generates QR Code and Save as PNG
    //  QRcode::png($content, $file, $ecc, $pixel_size, $frame_size);
    if($this->model->updateQr(['id_personal' => $id_personal, 'identificador' => $identificador,
    'fecha_modificacion' => $fecha])){
        $this->view->mensaje = "Code actualizado correctamente";
    }else{
        $this->view->mensaje = "No se pudo actualizar el code";
    }
    // echo $idPersonal;
    $this->listar($id_personal);
}

    function prueba(){
        echo "controlador";
        $this->model->pruebaModel();
    }
}