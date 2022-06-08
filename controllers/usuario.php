<?php



class Usuario extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->usuario = [];
        $this->view->mensaje = "";
        $this->view->consulta= "";
    }

    function listar(){
        $usuario = $this->view->datos = $this->model->get();
        $this->view->usuario = $usuario;
            $this->view->render('usuario/index');
    }
    function nuevo(){
        $this->view->render('usuario/nuevo');
    }
    function crear(){
        $nombre_usuario = $_POST['nombre_usuario'];
        //$pass  = $_POST['password'];
        $password=md5($_POST['password']);
        $rol  = $_POST['rol'];
        if($this->model->insert(['nombre_usuario' => $nombre_usuario, 'password' => $password,
                                 'rol' => $rol])){
            $this->view->mensaje = "Usuario creado correctamente";
            $this->view->render('usuario/nuevo');
        }else{
            $this->view->mensaje = "ID ya está registrada";
            $this->view->render('curso/nuevo');
        }
    }
    function verUsuario($param = null){
        $idUsuario = $param[0];
        $usuario = $this->model->getById($idUsuario);
        $this->view->usuario = $usuario;
        $this->view->render('usuario/detalle');
    }

    function actualizarUsuario($param = null){
        $id_usuario = $_POST['id_usuario'];
        $nombre_usuario    = $_POST['nombre_usuario'];
        $password  = md5($_POST['password']);
        $rol  = $_POST['rol'];
        if($this->model->update(['id_usuario' => $id_usuario,'nombre_usuario' => $nombre_usuario, 'password' => $password,
                                'rol' => $rol])){
            $this->view->mensaje = "usuario actualizado correctamente";
            $this->listar();
        }else{
            $this->view->mensaje = "No se pudo actualizar el usuario";
            $this->view->render('usuario/detalle');
        }
    }

    function eliminarUsuario($param = null){
        $id = $param[0];
        $estatus = $param[1];
        if($this->model->delete($id,$estatus)){
            $mensaje ="Curso eliminado correctamente";
        }else{
            $mensaje = "No se pudo eliminar al curso";
        }
        $this->listar();
    }   
}
?>