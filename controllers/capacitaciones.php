<?php



class Capacitaciones extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
    }

    // function render(){
    //     $capacitacion = $this->view->datos = $this->model->get();
    //     $this->view->capacitacion = $capacitacion;
    //     $this->view->render('capacitaciones/consulta');
    // }
    function asignarCapacitacion(){

        // $idC = $param[0];
        // echo "idC es: ".$idC;
        $id_curso=$_POST['id'];
        echo "id_curso esssssssssss: ".$id_curso;
        $estatus="Pendiente";
        if (empty($_POST['personal'])) {
            echo "no se ha seleccionadao nada";
        }else{
        foreach ($_POST['personal'] as $id_personal) {
            echo "$id_personal <br>";
            $this->model->insert(['id_curso' => $id_curso, 'id_personal' => $id_personal,
                                  'estatus' => $estatus]);
        
          }
        $this->view->mensaje = "se asigno correctamente personal";
        //   $this->view->render('curso/consulta');
        // $this->render();
        $capacitacion = $this->view->datos = $this->model->getById($id_curso);
        $this->view->capacitacion = $capacitacion;
        $this->view->render('capacitaciones/consulta');

        }

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