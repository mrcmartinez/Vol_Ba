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

    function prueba(){
        echo "controlador";
        $this->model->pruebaModel();
    }
}