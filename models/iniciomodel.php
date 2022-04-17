<?php

class inicioModel extends Model{

    public function __construct(){
        parent::__construct();
    }
    public function select($datos){
        // echo "entro a modeloInicio";
        $row=false;
        // print_r($datos);
        // insertar datos en la BD
        try{
            $conn=$this->db->connect();
            $query = $conn->prepare('SELECT* FROM usuario WHERE nombre_usuario = :nombre_usuario AND password = :password');

            $query->execute(['nombre_usuario' => $datos['nombre_usuario'], 'password' => $datos['password']]);
            
            $row = $query->fetch(PDO::FETCH_NUM);
            
            return $row;
            // return array(true, $id);
        }catch(PDOException $e){
            //echo $e->getMessage();
            //echo "Ya existe esa matrícula";
            // return array(false);
            return $row;
        }
        
    }
}

?>