<?php

class ConsultaFaltas extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->faltas = [];
        $this->view->mensaje = "";
        $this->view->filtroHorario = "";
    }
function render(){
    $consulta = "";
    $filtroHorario = "";
        if (isset($_POST['caja_busqueda'])) {
            $consulta = $_POST['caja_busqueda'];
            $filtroHorario = $_POST['filtroHorario'];
        }
    // echo "controlador";
   
    // $this->view->render('faltas/index');
    // $this->view->render('faltas');

    $faltas = $this->model->get($consulta,$filtroHorario);
    $this->view->faltas = $faltas;
    $this->view->mensaje;
    $this->view->filtroHorario=$filtroHorario;
    $this->view->consulta=$consulta;
    $this->view->render('faltas/index');
}

}