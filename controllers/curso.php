<?php



class Curso extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
        $this->view->consulta= "";
    }

    // function render(){
    //     $consulta  = "";
    //     $filtro="Activo";
    //     $cursos = $this->view->datos = $this->model->get();
    //     // $this->view->$filtro;
    //     $this->view->radio = $filtro;
    //     $this->view->cursos = $cursos;
    //     $this->view->render('curso/consulta');
    // }
    function listar($param = null){
        
        $consulta  = "";
        $filtro="Activo";
        $fecha="";
        if (isset($_POST['caja_busqueda'])) {
            $consulta  = $_POST['caja_busqueda'];
            $filtro  = $_POST['radio_busqueda'];
            $fecha  = $_POST['caja_fecha'];
        }
        // echo "consulta es: ".$consulta;
        $cursos = $this->view->datos = $this->model->getBusqueda($consulta,$filtro,$fecha);
        $this->view->cursos = $cursos;
        $this->view->consulta = "Usted busco:". $consulta;
        $this->view->radio = $filtro;
        if (isset($param[0])) {
            $this->view->idCurso = $param[0];
            $this->view->render('curso/consulta');
        }else{
            $this->view->render('curso/consulta');
        }
        
    }
    function nuevo(){
        $this->view->render('curso/nuevo');
    }
    function crear(){
        echo "entro a crear";
        // $id = $_POST['id'];
        $nombre    = $_POST['nombre'];
        $descripcion  = $_POST['descripcion'];
        $responsable  = $_POST['responsable'];
        $fecha  = $_POST['fecha'];
        $hora  = $_POST['hora'];
        $estatus  = $_POST['estatus'];

        if($this->model->insert(['nombre' => $nombre, 'descripcion' => $descripcion,
                                 'responsable' => $responsable, 'fecha' => $fecha, 'hora' => $hora, 'estatus' => $estatus])){
            //header('location: '.constant('URL').'nuevo/cursoCreado');
            $this->view->mensaje = "Curso creado correctamente";
            $this->view->render('curso/nuevo');
        }else{
            $this->view->mensaje = "ID ya está registrada";
            $this->view->render('curso/nuevo');
        }
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
            $curso = new Curso();
            $curso->id = $id;
            $curso->nombre = $nombre;
            $curso->descripcion = $descripcion;
            $curso->responsable = $responsable;
            $curso->fecha = $fecha;
            $curso->hora = $hora;
            $curso->estatus = $estatus;

            $this->view->curso = $curso;
            $this->view->mensaje = "Curso actualizado correctamente";
        }else{
            $this->view->mensaje = "No se pudo actualizar al curso";
        }
        $this->view->render('curso/detalle');
    }

    function eliminarCurso($param = null){
        $id = $param[0];
        echo "el id a eliminar es: ".$id;

        if($this->model->delete($id)){
            $mensaje ="Curso eliminado correctamente";
            //$this->view->mensaje = "Curso eliminado correctamente";
        }else{
            $mensaje = "No se pudo eliminar al curso";
            //$this->view->mensaje = "No se pudo eliminar al curso";
        }

        $this->render();

        echo $mensaje;
    }

    
}

?>