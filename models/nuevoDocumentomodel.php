<?php

class NuevoDocumentoModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert($datos){
        // insertar datos en la BD
        try{
            $query = $this->db->connect()->prepare('INSERT INTO documentacion (id_personal, nombre, descripcion, estatus) VALUES(:id_personal, :nombre, :descripcion, :estatus)');
            $query->execute(['id_personal' => $datos['id_personal'], 'nombre' => $datos['nombre'], 'descripcion' => $datos['descripcion'], 'estatus' => $datos['estatus']]);
            return true;
        }catch(PDOException $e){
            //echo $e->getMessage();
            //echo "Ya existe esa matrícula";
            return false;
        }
        
    }
}

?>