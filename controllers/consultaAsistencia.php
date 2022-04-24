<?php

class ConsultaAsistencia extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->asistencia = [];
        $this->view->mensaje = "";
        $this->view->consulta= "";
        //echo "<p>Nuevo controlador Inicio</p>";
    }

    function render(){
        $consulta  = "";
        $filtro="Falta";
        $f_inicio=date('Y-m-01');
        $f_termino=date('Y-m-d');
        if (isset($_POST['caja_busqueda'])) {
            $consulta  = $_POST['caja_busqueda'];
            $filtro  = $_POST['radio_busqueda'];
        }if(isset($_POST['fecha_inicio'])){
            $f_inicio  = $_POST['fecha_inicio'];
            $f_termino  = $_POST['fecha_termino'];
        }
        // echo "fecha_inicio: ".$f_inicio;
        // echo "fecha_termino: ".$f_termino;
        // echo "consulta: ".$consulta;
        // echo "filtro: ".$filtro;

        $asistencia = $this->model->getBusqueda($consulta,$filtro,$f_inicio,$f_termino);
        // print_r($asistencia);
        $this->view->inicio = $f_inicio;
        $this->view->termino = $f_termino;
        $this->view->consulta = $consulta;
        $this->view->radio = $filtro;
        $this->view->asistencia = $asistencia;
        $this->view->render('asistencia/reporte');
    }
    
    function verasistenciaid($param = null){
        // echo "entro verAsistenciaID";
        $idPersonal = $param[0];
        $asistencia = $this->model->get($idPersonal);
        // print_r($asistencia);
        $this->view->asistencia = $asistencia;
        $this->view->id = $idPersonal;
        $this->view->render('asistencia/index');
    }

    // function verasistencia($param = null){
    //     $idPersonal = $param[0];
    //     $lada = $param[1];
    //     $numero = $param[2];
    //     $asistencia = $this->model->getById($idPersonal,$lada,$numero);

    //     session_start();
    //     $_SESSION['id_verPersonal'] = $asistencia->id_personal;
    //     $_SESSION['verLada'] = $asistencia->lada;
    //     $_SESSION['verNumero'] = $asistencia->numero;
    //     $this->view->asistencia = $asistencia;
    //     $this->view->mensaje = "";
    //     $this->view->render('asistencia/detalle');
    // }
}

?>