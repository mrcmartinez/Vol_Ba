<?php

class inicioModel extends Model{

    public function __construct(){
        parent::__construct();
    }
    public function select($datos){
        echo "entro a modeloInicio";
        $row=false;
        // print_r($datos);
        // insertar datos en la BD
        try{
            $conn=$this->db->connect();
            $query = $conn->prepare('SELECT* FROM usuario WHERE username = :username AND password = :password');

            $query->execute(['username' => $datos['username'], 'password' => $datos['password']]);
            
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