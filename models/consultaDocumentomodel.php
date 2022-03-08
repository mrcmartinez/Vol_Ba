<?php

include_once 'models/personal.php';

class ConsultaDocumentoModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function getById($id){
        $item = new Personal();

        $query = $this->db->connect()->prepare("SELECT * FROM documentacion WHERE id_personal = :id_personal");
        try{
            $query->execute(['id_personal' => $id]);

            while($row = $query->fetch()){
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
                $item->descripcion = $row['descripcion'];
                $item->estatus = $row['estatus'];
            }

            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

}

?>