<?php

class ConsultaFaltas extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->faltas = [];
        $this->view->mensaje = "";
    }
function render(){
    // echo "controlador";
    $this->view->mensaje;
    // $this->view->render('faltas/index');
    // $this->view->render('faltas');

    $faltas = $this->model->get();
    $this->view->faltas = $faltas;
    $this->view->render('faltas/index');
}

}