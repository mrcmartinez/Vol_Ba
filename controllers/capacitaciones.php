<?php
class Capacitaciones extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
    }

    function saludo(){
        $id_curso=$_POST['id'];
        $estatus="Completo";
        if (empty($_POST['personal'])) {
            // echo "no se ha seleccionadao nada";
            $this->view->mensaje = "no se ha seleccionadao nada";
            $this->view->code = "error";
        }else{
        foreach ($_POST['personal'] as $id_personal) {
            $this->model->update(['id_curso' => $id_curso, 'id_personal' => $id_personal,'estatus' => $estatus]);
          }
        $this->view->mensaje = "correcto pase de toma";
        $this->view->code = "success";
        }
        $capacitacion = $this->view->datos = $this->model->getById($id_curso);
        $this->view->capacitacion = $capacitacion;
        $this->view->render('capacitaciones/consulta');
    }
    function asignarCapacitacion(){
        $id_curso=$_POST['id'];
        $estatus="Pendiente";
        if (empty($_POST['personal'])) {
            // echo "no se ha seleccionadao nada";
            $this->view->mensaje = "No se ha seleccionado personal";
            $this->view->code = "error";

        }else{
        foreach ($_POST['personal'] as $id_personal) {
            $this->model->insert(['id_curso' => $id_curso, 'id_personal' => $id_personal,
                                  'estatus' => $estatus]);
        
          }
            $this->view->mensaje = "Personal asignado";
            $this->view->code = "success";
        }
        $capacitacion = $this->view->datos = $this->model->getById($id_curso);
        $this->view->capacitacion = $capacitacion;
        $this->view->render('capacitaciones/consulta');
    }
    function verCapacitacionId($param = null){
        $idCurso = $param[0];
        $capacitacion = $this->model->getById($idCurso);
        $this->view->capacitacion = $capacitacion;
        $this->view->render('capacitaciones/consulta');
    }
    
}

?>