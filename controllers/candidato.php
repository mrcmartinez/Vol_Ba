<?php
require 'libraries/session.php';

class Candidato extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->candidato = [];
        $this->view->mensaje = "";
        $this->view->consulta= "";
    }

    function render(){
        $this->view->render('candidato/nuevo');
    }
    function listar($param = null){
        $consulta  = "";
        $filtro="Activo";
        if (isset($_POST['caja_busqueda'])) {
            $consulta  = $_POST['caja_busqueda'];
        }
        $candidato = $this->view->candidato = $this->model->getBusqueda($consulta,$filtro);
        $this->view->candidato = $candidato;
        $this->view->consulta = "Usted busco:". $consulta;
        if (isset($param[0])) {
            // $this->view->idCurso = $param[0];
            $this->view->render('candidato/consulta');
        }else{
            $this->view->render('candidato/consulta');
        }
    }

    function registrar(){
        $nombre    = $_POST['nombre'];
        $fecha_solicitud  =  date("Y-m-d");;
        $fecha_nacimiento  = $_POST['fecha_nacimiento'];
        $telefono  = $_POST['telefono'];
        $estatus  = $_POST['estatus'];

        if($this->model->insert(['nombre' => $nombre    , 'fecha_nacimiento' => $fecha_nacimiento,
                                 'fecha_solicitud' => $fecha_solicitud, 'telefono' => $telefono, 'estatus' => $estatus])){
            $this->view->mensaje = "Candidato registrado";
            $this->view->code = "success";
            $this->listar();
        }else{
            $this->view->mensaje = "No se pudo registrar";
            $this->view->code = "error";
            $this->view->render('candidato/nuevo');
        }
    }
    function alta(){
        // echo $nombre=$_POST['nombre'];
        // echo $fecha_nacimiento=$_POST['fecha_nacimiento'];
        $this->view->nombre = $_POST['nombre'];
        $this->view->fecha_nacimiento = $_POST['fecha_nacimiento'];
        // $this->render();
        $this->view->render('candidato/alta');
    }
    function verCurso($param = null){
        $idCurso = $param[0];
        $curso = $this->model->getById($idCurso);
        $this->view->curso = $curso;
        $this->view->render('curso/detalle');
    }

    function actualizarCurso($param = null){
        $id = $_POST['id'];
        $nombre    = $_POST['nombre'];
        $descripcion  = $_POST['descripcion'];
        $responsable  = $_POST['responsable'];
        $fecha  = $_POST['fecha'];
        $hora  = $_POST['hora'];
        $estatus  = $_POST['estatus'];

        if($this->model->update(['id' => $id, 'nombre' => $nombre, 'descripcion' => $descripcion,
                                'responsable' => $responsable, 'fecha' => $fecha, 'hora' => $hora, 'estatus' => $estatus])){
            $this->view->mensaje = "Curso actualizado correctamente";
        }else{
            $this->view->mensaje = "No se pudo actualizar al curso";
        }
        $this->listar();
    }

    function eliminar($param = null){
        $id = $param[0];
        $estatus="Baja";
        if($this->model->delete($id,$estatus)){
            $mensaje ="Candidato eliminado correctamente";
        }else{
            $mensaje = "No se pudo eliminar al candidato";
        }
        $this->listar();
    }
}

?>