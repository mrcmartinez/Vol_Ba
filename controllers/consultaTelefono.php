<?php

class ConsultaTelefono extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->telefono = [];
        
        //echo "<p>Nuevo controlador Inicio</p>";
    }

    function render(){
        $telefono = $this->model->get();
        $this->view->telefono = $telefono;
        $this->view->render('consultaTelefono/index');
    }
    
    function vertelefonoid($param = null){
        echo "entro verTelefonoID";
        $idPersonal = $param[0];
        $telefono = $this->model->get($idPersonal);
        $this->view->telefono = $telefono;
        $this->view->render('consultaTelefono/index');
    }

    function vertelefono($param = null){
        $idPersonal = $param[0];
        $telefono = $this->model->getById($idPersonal);

        session_start();
        $_SESSION['id_verPersonal'] = $telefono->id_personal;
        $this->view->telefono = $telefono;
        $this->view->mensaje = "";
        $this->view->render('consultaTelefono/detalle');
    }

    function actualizartelefono(){
        session_start();
        $id_personal = $_POST['id_personal'];
        $lada    = $_POST['lada'];
        $numero  = $_POST['numero'];
        $tipo = $_POST['tipo'];
        $descripcion = $_POST['descripcion'];
        unset($_SESSION['id_verPersonal']);

        if($this->model->update(['id_personal' => $id_personal, 'lada' => $lada, 'numero' => $numero,
         'tipo' => $tipo,
         'descripcion' => $descripcion] )){
            // actualizar telefono exito
            $telefono = new Telefono();
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
        $this->view->render('consultaTelefono/detalle');
    }

    function eliminartelefono($param = null){
        $id_personal = $param[0];

        if($this->model->delete($id_personal)){
            //$this->view->mensaje = "telefono eliminado correctamente";
            $mensaje = "telefono eliminado correctamente";
        }else{
            // mensaje de error
            //$this->view->mensaje = "No se pudo eliminar el telefono";
            $mensaje = "No se pudo eliminar el telefono";
        }
        //$this->render();
        
        echo $mensaje;
    }
}

?>