<?php

class Inicio extends Controller{

    function __construct(){
        parent::__construct();
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

        if (isset($_GET[base_url().'/personal/cerrar_sesion'])) {
            session_unset();
            session_destroy();
            echo "sesion cerrada";
        }
        if (isset($_SESSION['rol'])) {
            switch($_SESSION['rol']){
                case "Administrador":
                    header('location:'. base_url().'/personal');
                    // $this->view->render('personal/index');
                    // header('location: ayuda/index.php');
                    break;
                case "Supervisor":
                    header('location: ../ayuda');
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
                $_SESSION['rol']=$rol;
                switch($_SESSION['rol']){
                    case "Administrador":
                        // $this->view->mensaje="";
                        // $this->view->render('personal/index');
                        header('location:'. base_url().'/personal');
                        break;
                    case "Supervisor":
                        // $this->view->mensaje="";
                        // $this->view->render('ayuda/index');
                        header('location:'. base_url().'/ayuda');
                        break;
                        default;
                }
            }else{
                 header('location:'. base_url().'/inicio');
                 echo "el usuario o contraseña son incorrectos";
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