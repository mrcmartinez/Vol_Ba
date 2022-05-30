<?php

class Inicio extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
        //echo "<p>Nuevo controlador Inicio</p>";
    }

    function render(){
        $this->view->render('inicio/index');
    }
    function cerrar_sesion(){
        // echo "hola";
        session_start();
        session_unset();
        session_destroy();
        $this->view->render('inicio/index');
        echo "sesion cerrada";

    }

    function iniciarSesion(){
        session_start();

        if (isset($_GET[base_url().'personal/cerrar_sesion'])) {
            session_unset();
            session_destroy();
            echo "sesion cerrada";
        }
        if (isset($_SESSION['rol'])) {
            switch($_SESSION['rol']){
                case "Administrador":
                    header('location:'. base_url().'personal');
                    // $this->view->render('personal/index');
                    // header('location: ayuda/index.php');
                    break;
                case "Supervisor":
                    header('location:'. base_url().'personal');
                    break;
                    default;
            }
        }
        if (isset($_POST['nombre_usuario'])&&isset($_POST['password'])) {
            $nombre_usuario=$_POST['nombre_usuario'];
            $password=$_POST['password'];
            $row=$this->model->select(['nombre_usuario' => $nombre_usuario,'password' => $password]);

            if ($row == true) {
                echo "el usuario o contraseña son correctos";
                $rol=$row[3];
                $usuario=$row[1];
                $_SESSION['rol']=$rol;
                $_SESSION['user']=$usuario;
                switch($_SESSION['rol']){
                    case "Administrador":
                        // $this->view->mensaje="";
                        // $this->view->render('personal/index');
                        include_once 'controllers/personal.php';
                        // $p = new personal();
                        // $p.$this->listarPersonal();
                        header('location:'. base_url().'personal');
                        break;
                    case "Supervisor":
                        // $this->view->mensaje="";
                        // $this->view->render('ayuda/index');
                        header('location:'. base_url().'documento');
                        break;
                        default;
                }
            }else{
                $this->view->mensaje = "el usuario o contraseña son incorrectos";
                $this->view->code = "error";
                $this->render();
                // header('location:'. base_url().'inicio');
                //  $this->view->mensaje = "el usuario o contraseña son incorrectos";
                //  echo "el usuario o contraseña son incorrectos";
            }
            // $id = $conn->lastInsertId();
            // echo 'El id de la última fila insertada fue: ' . $id;
            // echo "rols: ".$rol;

            // echo "rol controlador es: ".$rol;
                // $mensaje = $mensaje."Se entrego: ".$nombre."\n";
            // $this->view->mensaje2 = $matricula;
            // $this->view->render('personal/index');
                
        }
        // 
        
        // 
    }
}

?>