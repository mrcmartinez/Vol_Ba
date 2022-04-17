<?php

class Telefono extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
        $this->view->telefono = [];
        $this->view->mensaje = "";
        //echo "<p>Nuevo controlador Main</p>";
    }

    // function render(){
    //     $this->view->render('telefono/nuevo');
    // }
    function render(){
        $telefono = $this->model->get(1);
        $this->view->telefono = $telefono;
        $this->view->render('telefono/index');
    }

    function nuevoTelefono($param = null){
        $id_personal = $param[0];
        $this->view->ultimoId = $id_personal;
        $this->view->mensaje = "";
        $this->view->render('telefono/nuevoRegistro');
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
            // // $this->view->render('telefono/index');
            // $this->render();
        $this->view->mensaje = $mensaje;
        // $id_personal = $_POST['id_personal'];
        $this->view->ultimoId = $id_personal;
        $this->view->render('telefono/nuevoRegistro');
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
            // // $this->view->render('telefono/index');
            // $this->render();
        }
        }
        $this->view->mensaje = $mensaje;
        // $id_personal = $_POST['id_personal'];
        $this->view->ultimoId = $id_personal;
         $this->view->render('documentacion/index');
        // $this->render();

        // $mensaje = "No ha ingresado ningun telefono";
        // $this->render();
    }
    function vertelefonoid($param = null){
        // echo "entro verTelefonoID";
        $idPersonal = $param[0];
        $telefono = $this->model->get($idPersonal);
        $this->view->id = $idPersonal;
        $this->view->telefono = $telefono;
        $this->view->render('telefono/index');
    }

    function vertelefono($param = null){
        $idPersonal = $param[0];
        $lada = $param[1];
        $numero = $param[2];
        $telefono = $this->model->getById($idPersonal,$lada,$numero);

        // session_start();
        // $_SESSION['id_verPersonal'] = $telefono->id_personal;
        // $_SESSION['verLada'] = $telefono->lada;
        // $_SESSION['verNumero'] = $telefono->numero;
        $this->view->telefono = $telefono;
        $this->view->mensaje = "";
        $this->view->render('telefono/detalle');
    }


    function actualizartelefono(){
        // session_start();
        $ant_lada=$_POST['ant_lada'];
        $ant_numero=$_POST['ant_numero'];
        $id_personal = $_POST['id_personal'];
        $lada    = $_POST['lada'];
        $numero  = $_POST['numero'];
        $tipo = $_POST['tipo'];
        $descripcion = $_POST['descripcion'];
        // unset($_SESSION['id_verPersonal']);

        if($this->model->update(['id_personal' => $id_personal, 'lada' => $lada, 'numero' => $numero,
         'tipo' => $tipo,
         'descripcion' => $descripcion, 'ant_lada' => $ant_lada, 'ant_numero' => $ant_numero] )){
            // actualizar telefono exito
            $telefono = new Telefonos();
            $telefono->id_personal = $id_personal;
            $telefono->lada = $lada;
            $telefono->numero = $numero;
            $telefono->tipo = $tipo;
            $telefono->descripcion = $descripcion;
            // mostrar los que se actualizaron
            
            $this->view->telefono = $telefono;
            $this->view->mensaje = "telefono actualizado correctamente";
        }else{
            // mensaje de error
            $this->view->mensaje = "No se pudo actualizar el Persoanl";
        }
        // $this->render();
        $telefono = $this->model->get($id_personal);
        $this->view->telefono = $telefono;
        $this->view->render('telefono/index');
    }

    function eliminartelefono($param = null){
        $id_personal = $param[0];
        $lada = $param[1];
        $numero = $param[2];

        if($this->model->delete($id_personal,$lada,$numero)){
            //$this->view->mensaje = "telefono eliminado correctamente";
            $mensaje = "telefono eliminado correctamente";
        }else{
            // mensaje de error
            //$this->view->mensaje = "No se pudo eliminar el telefono";
            $mensaje = "No se pudo eliminar el telefono";
        }
        //$this->render();
        
        // echo $mensaje;
        $this->view->mensaje = $mensaje;
        $telefono = $this->model->get($id_personal);
        $this->view->telefono = $telefono;
        $this->view->render('telefono/index');
    }
}

?>