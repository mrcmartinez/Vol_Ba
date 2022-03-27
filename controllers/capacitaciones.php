<?php



class Capacitaciones extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
    }

    function render(){
        $capacitacion = $this->view->datos = $this->model->get();
        $this->view->capacitacion = $capacitacion;
        $this->view->render('capacitaciones/consulta');
    }

    function verCapacitacionId($param = null){
        echo "entro verCapacitacionesID";
        $idCurso = $param[0];
        $capacitacion = $this->model->getById($idCurso);
        // $this->view->id = $idCurso;
        // print_r($documento);
        $this->view->capacitacion = $capacitacion;
        $this->view->render('capacitaciones/consulta');
    }
    
}

?>