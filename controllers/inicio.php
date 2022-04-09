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

        if (isset($_GET[base_url().'/nuevo/cerrar_sesion'])) {
            session_unset();
            session_destroy();
            echo "sesion cerrada";
        }
        if (isset($_SESSION['rol'])) {
            switch($_SESSION['rol']){
                case "admin":
                    header('location:'. base_url().'/nuevo');
                    // $this->view->render('nuevo/index');
                    // header('location: ayuda/index.php');
                    break;
                case "supervisor":
                    header('location: ../ayuda');
                    break;
                    default;
            }
        }
        if (isset($_POST['username'])&&isset($_POST['password'])) {
            $username=$_POST['username'];
            $password=$_POST['password'];
            $row=$this->model->select(['username' => $username,'password' => $password]);

            if ($row == true) {
                echo "el usuario o contraseña son correctos";
                $rol=$row[3];
                $_SESSION['rol']=$rol;
                switch($_SESSION['rol']){
                    case "admin":
                        // $this->view->mensaje="";
                        // $this->view->render('nuevo/index');
                        header('location:'. base_url().'/nuevo');
                        break;
                    case "supervisor":
                        // $this->view->mensaje="";
                        // $this->view->render('ayuda/index');
                        header('location:'. base_url().'/ayuda');
                        break;
                        default;
                }
            }else{
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