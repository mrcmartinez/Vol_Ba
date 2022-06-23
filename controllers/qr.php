<?php

class Qr extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->Qr = [];
        $this->view->mensaje = "";
    }

    function consultar($param = null)
    {
        $idPersonal = $param[0];
        // $telefono = $this->model->get($idPersonal);
        $this->view->id = $idPersonal;
        $file = "assets/img/QR/qr".$idPersonal.".png";
        $img=constant('URL').$file;
        $this->view->img = $img;
        // $this->view->telefono = $telefono;
        $this->view->render('qr/index');
    }
function saludo(){
    echo "prueba QR";
}
public function generarQR($id){
    // echo "id es: ".$id;
    require 'libraries/phpqrcode/qrlib.php';
    $id_personal = $id;
    $fecha=date("Y-m-d");
    $identificador=mt_rand(5, 15);
    // $file = "assets/img/QR/qr".$id_personal.".png";
    // //data to be stored in qr
    // $content = "$id_personal";
    // //file path
    // // $file = "images/qr1.png";
    // //other parameters
    // $ecc = 'H';
    // $pixel_size = 10;
    // $frame_size = 5;
    // $url=constant('URL');
    // // Generates QR Code and Save as PNG
    // QRcode::png($content, $file, $ecc, $pixel_size, $frame_size);
    // // echo $url;
    // echo "<img src='hola.png'/>";
    // Displaying the stored QR code if you want
    // $img=constant('URL').$file;
    // $this->model->insertQr(['id_personal' => $id_personal, 'identificador' => $identificador,
    // 'fecha_modificacion' => $fecha]);
    if($this->model->pruebaModel()){
            echo "bien";
        }else{
            echo "error";
        }
        // $this->view->mensaje = "Curso creado correctamente";
        // $this->view->code = "success";
        // $this->listar();
 
        
    // echo "<div><img src='".$img."'></div>";
    // header ("Content-Disposition: attachment; filename=".$id_personal);
    // header ("Content-Type: image/gif");
    // header ("Content-Length: ".filesize($img));
    // readfile($enlace);
    // readfile($img);
    // $this->listarPersonal();
    }
}