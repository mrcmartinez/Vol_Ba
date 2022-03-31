<?php
require 'models/capacitacion.php';
class CapacitacionesModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function get(){
        $items = [];
        try{
            $query = $this->db->connect()->query('SELECT * FROM capacitacion');
            
            while($row = $query->fetch()){
                $item = new Capacitacion();
                $item->id_personal = $row['id_personal'];
                $item->id_curso    = $row['id_curso'];
                $item->estatus  = $row['estatus'];
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function getById($id){
        // echo "entro get";
        $items = [];
            $query = $this->db->connect()->prepare("SELECT*FROM capacitacion WHERE id_curso = :id_curso");
            try{
            $query->execute(['id_curso' => $id]);
            while($row = $query->fetch()){
                $item = new Capacitacion();
                $item->id_curso = $row['id_curso'];
                $item->id_personal = $row['id_personal'];
                $item->estatus = $row['estatus'];
                array_push($items, $item);         
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function insert($datos){
        // insertar
        $query = $this->db->connect()->prepare('INSERT INTO CAPACITACION (ID_CURSO, ID_PERSONAL, ESTATUS) VALUES(:id_curso, :id_personal, :estatus)');
        try{
            $query->execute([
                'id_curso' => $datos['id_curso'],
                'id_personal' => $datos['id_personal'],
                'estatus' => $datos['estatus']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
        
        
    }
    // public function getById($id_curso){
    //     echo "entro a model";
    //     echo "echo id_cursoMoldell es: ".$id_curso;
    //     $item = new Capacitacion();
    //     try{
    //         $query = $this->db->connect()->prepare('SELECT * FROM capacitacion WHERE id_curso = :id_curso');

    //         $query->execute(['id_curso' => $id_curso]);
            
    //         while($row = $query->fetch()){
                
    //             $item->id_curso = $row['id_curso'];
    //             $item->id_personal    = $row['id_personal'];
    //             $item->estatus  = $row['estatus'];
    //         }
    //         return $item;
    //     }catch(PDOException $e){
    //         return null;
    //     }
    // }

}
?>