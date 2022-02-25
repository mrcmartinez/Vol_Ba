<?php

class NuevotelefonoModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert($datos){
        // insertar datos en la BD
        try{
            $query = $this->db->connect()->prepare('INSERT INTO telefono (id_personal, lada, numero) VALUES(:id_personal, :lada, :numero)');
            $query->execute(['id_personal' => $datos['id_personal'], 'lada' => $datos['lada'], 'numero' => $datos['numero']]);
            return true;
        }catch(PDOException $e){
            //echo $e->getMessage();
            //echo "Ya existe esa matrícula";
            return false;
        }
        
    }
}

?>