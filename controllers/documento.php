<?php

class Documento extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->documento = [];
        $this->view->mensaje = "";
        //echo "<p>Nuevo controlador Main</p>";
    }

    // function render(){
    //     // $this->view->mensaje = $mensaje;
    //     $this->view->render('documentacion/index');
    // }
    function nuevoDocumento($param = null){
        $id_personal = $param[0];
        $this->view->ultimoId = $id_personal;
        $this->view->mensaje = "";
        $this->view->render('documentacion/nuevoRegistro');
    }
    function registrarNuevo(){
        // $mensaje = "Favor de ingresar Telefono";
        $id_personal = $_POST['id_personal'];
        $mensaje = "";
                $nombre = $_POST['nombre'];
                $estatus  = "Entregado";
                $file_name = $_FILES['descripcion']['name'];
                $file_tmp = $_FILES['descripcion']['tmp_name'];
                $route="assets/img/".$file_name;
                $descripcion=$file_name;
                move_uploaded_file($file_tmp,$route);
                if($this->model->insert(['id_personal' => $id_personal,'nombre' => $nombre,
                    'descripcion' => $descripcion, 'estatus' => $estatus])){
                    $mensaje = $mensaje."Se entrego: ".$nombre."\n";

                // $this->view->mensaje2 = $matricula;
                // $this->view->render('consulta/index');
                }else{
                    $mensaje =$mensaje."Ya existe".$nombre."\n";
                }
        $this->view->ultimoId = $id_personal;
        $this->view->mensaje = $mensaje;
        // $this->render();
        $this->view->render('documentacion/nuevoRegistro');

    }
    function registrarDocumento(){
        // $mensaje = "Favor de ingresar Telefono";
        $id_personal = $_POST['id_personal'];
        $mensaje = "";
        for ($i=1; $i <10 ; $i++) { 
            if (
                isset($_POST['nombre_'.$i])&& 
                isset($_FILES['descripcion_'.$i]['name'])&&($_FILES['descripcion_'.$i]['name']!=null)
            ) {
                $nombre = $_POST['nombre_'.$i];
                $estatus  = "Entregado";
                // $mensaje = "";
        
                $file_name = $_FILES['descripcion_'.$i]['name'];
                $file_tmp = $_FILES['descripcion_'.$i]['tmp_name'];
                $route="assets/img/".$file_name;
                $descripcion=$file_name;
                move_uploaded_file($file_tmp,$route);
                if($this->model->insert(['id_personal' => $id_personal,'nombre' => $nombre,
                    'descripcion' => $descripcion, 'estatus' => $estatus])){
                    $mensaje = $mensaje."Se entrego: ".$nombre."\n";

                // $this->view->mensaje2 = $matricula;
                // $this->view->render('consulta/index');
                }else{
                    $mensaje =$mensaje."Ya existe".$nombre."\n";
                }
            }
        }
        $this->view->ultimoId = $id_personal;
        $this->view->mensaje = $mensaje;
        // $this->render();//marca
        $this->view->render('documentacion/index');
    }
    function verdocumentoid($param = null){
        echo "entro verDocumentoID";
        $idPersonal = $param[0];
        $documento = $this->model->get($idPersonal);
        $this->view->id = $idPersonal;
        // print_r($documento);
        $this->view->documento = $documento;
        $this->view->render('documentacion/consultaDocumento');
    }

    // function verdocumento($param = null){
    //     $idPersonal = $param[0];
    //     $lada = $param[1];
    //     $numero = $param[2];
    //     $documento = $this->model->getById($idPersonal,$lada,$numero);

    //     session_start();
    //     $_SESSION['id_verPersonal'] = $documento->id_personal;
    //     $_SESSION['verLada'] = $documento->lada;
    //     $_SESSION['verNumero'] = $documento->numero;
    //     $this->view->documento = $documento;
    //     $this->view->mensaje = "";
    //     $this->view->render('documento/detalle');
    // }
    function eliminardocumento($param = null){
        $id_personal = $param[0];
        $nombre = $param[1];

        if($this->model->delete($id_personal,$nombre)){
            //$this->view->mensaje = "telefono eliminado correctamente";
            $mensaje = "Documento eliminado correctamente";
        }else{
            // mensaje de error
            //$this->view->mensaje = "No se pudo eliminar el telefono";
            $mensaje = "No se pudo eliminar el documento";
        }
        //$this->render();
        
        // echo $mensaje;
        $this->view->mensaje = $mensaje;
        $documento = $this->model->get($id_personal);
        $this->view->documento = $documento;
        $this->view->render('documentacion/consultaDocumento');
    }
}

?>