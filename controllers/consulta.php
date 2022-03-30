<?php require 'libraries/session.php';?>
<?php

class Consulta extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->personal = [];
        $this->view->mensaje = "";
        $this->view->consulta= "";
        
        //echo "<p>Nuevo controlador Inicio</p>";
    }

    // function render(){
    //     $personal = $this->model->get();
    //     $this->view->personal = $personal;
    //     $this->view->render('consulta/index');
    // }
    function listar($param = null){
        $consulta  = "";
        $filtro="Activo";
        if (isset($_POST['caja_busqueda'])) {
            $consulta  = $_POST['caja_busqueda'];
            $filtro  = $_POST['radio_busqueda'];
        }
        // echo "consulta es: ".$consulta;
        $personal = $this->model->getBusqueda($consulta,$filtro);
        $this->view->personal = $personal;
        $this->view->consulta = "Usted busco:". $consulta;
        $this->view->radio = $filtro;
        if (isset($param[0])) {
            $this->view->idCurso = $param[0];
            $this->view->render('consulta/asignar');
        }else{
            $this->view->render('consulta/index');
        }
        
    }

    function verPersonal($param = null){
        $idPersonal = $param[0];
        $personal = $this->model->getById($idPersonal);

        session_start();
        $_SESSION['id_verPersonal'] = $personal->id_personal;
        $this->view->personal = $personal;
        $this->view->mensaje = "";
        $this->view->render('consulta/detalle');
    }
    function verInformacion($param = null){
        $idPersonal = $param[0];
        $completo = $param[1];
        $personal = $this->model->getById($idPersonal);

        // session_start();
        // $_SESSION['id_verPersonal'] = $personal->id_personal;
        $this->view->personal = $personal;
        $this->view->mensaje = "";
        $this->view->completo=$completo;
        $this->view->render('consulta/informacion');
    }

    function actualizarPersonal(){
        // session_start();
        $id_personal = $_POST['id_personal'];
        $nombre    = $_POST['nombre'];
        $estatus  = $_POST['estatus'];
        $apellido_paterno = $_POST['apellido_paterno'];
        $apellido_materno = $_POST['apellido_materno'];
        $calle = $_POST['calle'];
        $colonia = $_POST['colonia'];
        $numero_exterior = $_POST['numero_exterior'];

        $edad = $_POST['edad'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $estado_civil = $_POST['estado_civil'];

        $numero_hijos = $_POST['numero_hijos'];
        $escolaridad = $_POST['escolaridad'];

        // unset($_SESSION['id_verPersonal']);

        if($this->model->update(['id_personal' => $id_personal, 'nombre' => $nombre, 'estatus' => $estatus,
         'apellido_paterno' => $apellido_paterno,
         'apellido_materno' => $apellido_materno,
         'calle' => $calle,
         'colonia' => $colonia,
         'numero_exterior' => $numero_exterior,
         'edad' => $edad,
         'fecha_nacimiento' => $fecha_nacimiento,
         'estado_civil' => $estado_civil,
         'numero_hijos' => $numero_hijos,
         'escolaridad' => $escolaridad] )){
            // actualizar Personal exito
            $personal = new Personal();
            $personal->id_personal = $id_personal;
            $personal->nombre = $nombre;
            $personal->estatus = $estatus;
            $personal->apellido_paterno = $apellido_paterno;
            $personal->apellido_materno = $apellido_materno;
            $personal->calle = $calle;
            $personal->colonia = $colonia;
            $personal->numero_exterior = $numero_exterior;

            $personal->edad = $edad;
            $personal->fecha_nacimiento = $fecha_nacimiento;
            $personal->estado_civil = $estado_civil;
            $personal->numero_hijos = $numero_hijos;
            $personal->escolaridad = $escolaridad;
            // mostrar los que se actualizaron
            
            $this->view->personal = $personal;
            $this->view->mensaje = "Personal actualizado correctamente";
        }else{
            // mensaje de error
            $this->view->mensaje = "No se pudo actualizar el Persoanl";
        }
        // $this->view->idUpdate = $id_personal;;
        $this->view->render('consulta/detalle');
    }

    function eliminarPersonal($param = null){
        $id_personal = $param[0];
        $estatus = $param[1];
        echo "estatus".$estatus;
        if($this->model->delete($id_personal,$estatus)){
            //$this->view->mensaje = "Personal eliminado correctamente";
            $mensaje = "Personal eliminado correctamente";
        }else{
            // mensaje de error
            //$this->view->mensaje = "No se pudo eliminar el Personal";
            $mensaje = "No se pudo eliminar el personal";
        }
        $this->listar();
        // echo $mensaje;
    }
}

?>