<?php

class Telefono extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
        $this->view->telefono = [];
        $this->view->mensaje = "";
    }

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
        $numero  = $_POST['numero'];
        $tipo  = $_POST['tipo'];
        $descripcion  = $_POST['descripcion'];
        if($this->model->insert(['id_personal' => $id_personal, 'lada' => $lada, 'numero' => $numero,
            'tipo' => $tipo, 'descripcion' => $descripcion])){
            $mensaje = "Telefono creado";
        }else{
            $mensaje = "Telefono ya existe";    
            }
            $this->view->mensaje = $mensaje;
            $this->view->ultimoId = $id_personal;
            $this->view->render('telefono/nuevoRegistro');
    }
    function registrarTelefono(){
        $mensaje = "Favor de ingresar Telefono";
        $id_personal = $_POST['id_personal'];
        for ($i=1; $i < 4; $i++) {
        if (
            isset($_POST['lada_'.$i])&&($_POST['lada_'.$i]!=null)&&
            isset($_POST['numero_'.$i])&&($_POST['numero_'.$i]!=null)&&
            isset($_POST['tipo_'.$i])&&
            isset($_POST['descripcion_'.$i])
        ) {
            $id_personal = $_POST['id_personal'];
            $lada    = $_POST['lada_'.$i];
            $numero  = $_POST['numero_'.$i];
            $tipo  = $_POST['tipo_'.$i];
            $descripcion  = $_POST['descripcion_'.$i];
            if($this->model->insert(['id_personal' => $id_personal, 'lada' => $lada, 'numero' => $numero,
             'tipo' => $tipo, 'descripcion' => $descripcion])){
                $mensaje = "Telefono creado".$i;
            }else{
                $mensaje = "Telefono ya existe".$i;   
            }
        }
        }
        $this->view->mensaje = $mensaje;
        $this->view->ultimoId = $id_personal;
         $this->view->render('documentacion/index');
    }
    function vertelefonoid($param = null){
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
        $this->view->telefono = $telefono;
        $this->view->mensaje = "";
        $this->view->render('telefono/detalle');
    }

    function actualizartelefono(){
        $ant_lada=$_POST['ant_lada'];
        $ant_numero=$_POST['ant_numero'];
        $id_personal = $_POST['id_personal'];
        $lada    = $_POST['lada'];
        $numero  = $_POST['numero'];
        $tipo = $_POST['tipo'];
        $descripcion = $_POST['descripcion'];

        if($this->model->update(['id_personal' => $id_personal, 'lada' => $lada, 'numero' => $numero,
         'tipo' => $tipo,
         'descripcion' => $descripcion, 'ant_lada' => $ant_lada, 'ant_numero' => $ant_numero] )){
            $telefono = new Telefonos();
            $telefono->id_personal = $id_personal;
            $telefono->lada = $lada;
            $telefono->numero = $numero;
            $telefono->tipo = $tipo;
            $telefono->descripcion = $descripcion;
            $this->view->telefono = $telefono;
            $this->view->mensaje = "telefono actualizado correctamente";
        }else{
            $this->view->mensaje = "No se pudo actualizar el Persoanl";
        }
        
        $telefono = $this->model->get($id_personal);
        $this->view->id = $id_personal;
        $this->view->telefono = $telefono;
        $this->view->render('telefono/index');
    }

    function eliminartelefono($param = null){
        $id_personal = $param[0];
        $lada = $param[1];
        $numero = $param[2];

        if($this->model->delete($id_personal,$lada,$numero)){
            $mensaje = "telefono eliminado correctamente";
        }else{
            $mensaje = "No se pudo eliminar el telefono";
        }
        $this->view->mensaje = $mensaje;
        $telefono = $this->model->get($id_personal);
        $this->view->telefono = $telefono;
        $this->view->id = $id_personal;
        $this->view->render('telefono/index');
    }
}

?>