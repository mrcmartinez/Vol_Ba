<?php
require 'libraries/session.php';


class Peticion extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->peticiones = [];
        $this->view->mensaje = "";
        $this->view->id = "";
        // $this->view->consulta= "";
    }

    function render(){
        $this->view->render('peticion/nuevo');
    }
    function nuevo(){
        $this->view->render('peticion/peticionTurno');
    }
    function listar($param = null){
        // $consulta  = "";
        $filtro="Pendiente";
        // $fecha="";
        if (isset($_POST['radio_busqueda'])) {
            $filtro  = $_POST['radio_busqueda'];
        }
        $peticiones = $this->view->datos = $this->model->getBusqueda($filtro);
        $this->view->peticiones = $peticiones;
        // $this->view->consulta = "Usted busco:". $consulta;
        // $this->view->radio = $filtro;
        // if (isset($param[0])) {
            // $this->view->idCurso = $param[0];
            // $this->view->render('curso/consulta');
        // }else{
            $this->view->radio = $filtro;
            $this->view->render('peticion/consulta');
        // }
    }
    function autorizarFecha(){
        // echo "autorizar Dia";
        $folio  = $_POST['folio'];
        // echo "folio".$folio;
        $id_personal=$_POST['id_personal'];
        // echo "Id personal".$id_personal;
        $fecha_solicitada  = $_POST['fecha_solicitada'];
        // echo "fecha_solicitada".$fecha_solicitada;
        if($this->model->updateDate(['id_personal' => $id_personal, 'fecha_solicitada' => $fecha_solicitada])){
            $this->model->update(['folio' => $folio,'estatus' => "Autorizado"]);
        $this->view->mensaje = "Se autorizo correctamente";
        }else{
        $this->view->mensaje = "No se pudo autorizar fecha no valida";
        }
        $this->listar();
    }
    function autorizarDia(){
        // echo "autorizar Dia";
        $folio  = $_POST['folio'];
        // echo "folio".$folio;
        $id_personal=$_POST['id_personal'];
        // echo "Id personal".$id_personal;
        $dia_solicitado  = $_POST['dia_solicitado'];
        // echo "dia_solicitado".$dia_solicitado;
        if($this->model->updateDay(['id_personal' => $id_personal, 'dia_solicitado' => $dia_solicitado])){
        $this->model->update(['folio' => $folio,'estatus' => "Autorizado"]);
        $this->view->mensaje = "Se autorizo correctamente";
        }else{
        $this->view->mensaje = "No se pudo autorizar el cambio de turno";
        }
        $this->listar();
        // $this->view->render('peticion/listar');
    }
    function rechazarPeticion(){
        $folio  = $_POST['folio'];
        $this->model->update(['folio' => $folio,'estatus' => "Rechazada"]);
        $this->view->mensaje = "folio peticion rechazada";
        $this->listar();
    }
    function crear(){
        $id_personal  = $_POST['id_personal'];
        $fecha_apertura  = date("Y-m-d");
        $tipo  = $_POST['tipo'];
        $fecha_solicitada  = $_POST['fecha_solicitada'];
        $dia_solicitado  = $_POST['dia_solicitado'];
        $descripcion  = $_POST['descripcion'];
        $estatus  = "Pendiente";
        //"Ela archivo No es pdf"
        if (($_FILES['archivo']['type'] !='application/pdf')&&($_FILES['archivo']['size'] > 1000000)){
            $this->view->mensaje = "El archivo NO es pdf valido";
            $this->view->render('peticion/nuevo');
        }else{
            // echo "El archivo SI es pdf";
            $file_name = $_FILES['archivo']['name'];
            $file_tmp = $_FILES['archivo']['tmp_name'];
    
            $micarpeta = "assets/img/document/".$id_personal;
            if (!file_exists($micarpeta)) {
            mkdir($micarpeta, 0777, true);
            }
            $route = "assets/img/document/".$id_personal."/" . $file_name;
            $archivo = $file_name;
            move_uploaded_file($file_tmp, $route);
    
            if($this->model->insert(['id_personal' => $id_personal,
                                     'fecha_apertura' => $fecha_apertura, 'tipo' => $tipo, 'fecha_solicitada' => $fecha_solicitada,
                                      'dia_solicitado' => $dia_solicitado,'descripcion' => $descripcion,'archivo' => $archivo,'estatus' => $estatus])){
                $this->view->mensaje = "Peticion creada correctamente";
                $this->listar();
            }else{
                $this->view->mensaje = "Folio ya está registrada";
                $this->listar();
            }
        }
    }

    function verPeticionId($param = null){
        $idPeticion = $param[0];
        $peticion = $this->model->getById($idPeticion);
        $this->view->peticion = $peticion;
        $this->view->render('peticion/detalle');
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

    function eliminarCurso($param = null){
        $id = $param[0];
        $estatus = $param[1];
        if($this->model->delete($id,$estatus)){
            $mensaje ="Curso eliminado correctamente";
        }else{
            $mensaje = "No se pudo eliminar al curso";
        }
        $this->listar();
    }
    function imprimir(){
        $id_personal=$_POST['personal'];
        $this->view->id = $id_personal;
        switch ($_POST['peticion']) {
            case 'falta':
                $this->view->render('peticion/nuevo');
                break;
            case 'turno':
                $this->view->render('peticion/peticionTurno');
                break;
            default:
                break;
        }
    }
    function verDocumentoPeticion($param = null){
        $id= $param[0];
        $descripcion= $param[1];
        $route = "assets/img/document/".$id."/" . $descripcion;
        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename=documento.pdf");
        readfile($route);
        
    } 
}

?>