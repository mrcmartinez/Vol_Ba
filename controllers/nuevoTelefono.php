<?php

class NuevoTelefono extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
        //echo "<p>Nuevo controlador Main</p>";
    }

    function render(){
        $this->view->render('nuevoTelefono/index');
    }

    function nuevoTelefono($param = null){
        $id_personal = $param[0];
        $this->view->ultimoId = $id_personal;
        $this->view->mensaje = "";
        $this->view->render('nuevoTelefono/nuevoRegistro');
    }
    function registrarNuevo(){
        $mensaje = "Favor de ingresar Telefono";
        $id_personal = $_POST['id_personal'];
        $lada    = $_POST['lada'];
            // echo "lada es: ".$_POST['lada_'.$i]." ";
        $numero  = $_POST['numero'];
            // echo "numero es: ".$_POST['numero_'.$i]." ";
        $tipo  = $_POST['tipo'];
            // echo "tipo es: ".$_POST['tipo_'.$i]." ";
        $descripcion  = $_POST['descripcion'];
            // echo "descripcion es: ".$_POST['descripcion_'.$i]." ";
    
        if($this->model->insert(['id_personal' => $id_personal, 'lada' => $lada, 'numero' => $numero,
            'tipo' => $tipo, 'descripcion' => $descripcion])){
            $mensaje = "Telefono creado";
        }else{
            $mensaje = "Telefono ya existe";    
            }
    
            // $this->view->mensaje = $mensaje;
            // $this->view->ultimoId = $id_personal;
            // // $this->view->render('nuevoTelefono/index');
            // $this->render();
        $this->view->mensaje = $mensaje;
        // $id_personal = $_POST['id_personal'];
        $this->view->ultimoId = $id_personal;
        $this->view->render('nuevoTelefono/nuevoRegistro');
        // $this->render();

        // $mensaje = "No ha ingresado ningun telefono";
        // $this->render();
    }
    function registrarTelefono(){
        $mensaje = "Favor de ingresar Telefono";
        $id_personal = $_POST['id_personal'];
        for ($i=1; $i < 4; $i++) { 
            // echo "entro al for: ".$i." ";
            // echo "id es: ".$_POST['id_personal']." ";
            // echo "lada es: ".$_POST['lada_'.$i]." ";
            // echo "numero es: ".$_POST['numero_'.$i]." ";
            // echo "tipo es: ".$_POST['tipo_'.$i]." ";
            // echo "descripcion es: ".$_POST['descripcion_'.$i]." ";
        if (
            isset($_POST['lada_'.$i])&&($_POST['lada_'.$i]!=null)&&
            isset($_POST['numero_'.$i])&&($_POST['numero_'.$i]!=null)&&
            isset($_POST['tipo_'.$i])&&
            isset($_POST['descripcion_'.$i])
        ) {
            // echo "entro al if: ".$i." ";
            $id_personal = $_POST['id_personal'];
            // echo "id es: ".$_POST['id_personal']." ";
            $lada    = $_POST['lada_'.$i];
            // echo "lada es: ".$_POST['lada_'.$i]." ";
            $numero  = $_POST['numero_'.$i];
            // echo "numero es: ".$_POST['numero_'.$i]." ";
            $tipo  = $_POST['tipo_'.$i];
            // echo "tipo es: ".$_POST['tipo_'.$i]." ";
            $descripcion  = $_POST['descripcion_'.$i];
            // echo "descripcion es: ".$_POST['descripcion_'.$i]." ";
    
            if($this->model->insert(['id_personal' => $id_personal, 'lada' => $lada, 'numero' => $numero,
             'tipo' => $tipo, 'descripcion' => $descripcion])){
                $mensaje = "Telefono creado".$i;
            }else{
                $mensaje = "Telefono ya existe".$i;
                
            }
    
            // $this->view->mensaje = $mensaje;
            // $this->view->ultimoId = $id_personal;
            // // $this->view->render('nuevoTelefono/index');
            // $this->render();
        }
        }
        $this->view->mensaje = $mensaje;
        // $id_personal = $_POST['id_personal'];
        $this->view->ultimoId = $id_personal;
         $this->view->render('nuevoDocumento/index');
        // $this->render();

        // $mensaje = "No ha ingresado ningun telefono";
        // $this->render();
    }
}

?>