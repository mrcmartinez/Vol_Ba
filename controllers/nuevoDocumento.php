<?php

class NuevoDocumento extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
        //echo "<p>Nuevo controlador Main</p>";
    }

    function render(){
        $this->view->render('nuevoDocumento/index');
    }

    function registrarDocumento(){
        $mensaje = "Favor de ingresar Telefono";
        $id_personal = $_POST['id_personal'];
        for ($i=1; $i <9 ; $i++) { 
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
                    $mensaje = "Nuevo documento creado".$i;

                // $this->view->mensaje2 = $matricula;
                // $this->view->render('consulta/index');
                }else{
                    $mensaje = "Documento ya existe".$i;
                }
            }
        }
        $this->view->ultimoId = $id_personal;
        $this->view->mensaje = $mensaje;
        $this->render();

    }
}

?>