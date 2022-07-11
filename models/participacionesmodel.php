<?php
require 'models/participacion.php';
class ParticipacionesModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function get(){
        $items = [];
        try{
            $query = $this->db->connect()->query('SELECT * FROM participacion');
            while($row = $query->fetch()){
                $item = new Participacion();
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
        $items = [];
            $query = $this->db->connect()->prepare("SELECT p.nombre, c.id_curso, c.id_personal,c.estatus 
            FROM participacion as c 
            INNER JOIN candidato as p
            ON c.id_personal = p.id_candidato WHERE c.id_curso=:id_curso");
            try{
            $query->execute(['id_curso' => $id]);
            while($row = $query->fetch()){
                $item = new Participacion();
                $item->id_curso = $row['id_curso'];
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
                $item->estatus = $row['estatus'];
                array_push($items, $item);         
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function insert($datos){
        $query = $this->db->connect()->prepare('INSERT INTO PARTICIPACION (ID_CURSO, ID_PERSONAL, ESTATUS) VALUES(:id_curso, :id_personal, :estatus)');
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
    public function update($item){
        $query = $this->db->connect()->prepare('UPDATE PARTICIPACION SET estatus = :estatus WHERE (id_curso = :id_curso AND id_personal = :id_personal)');
        try{
            $query->execute([
                'id_curso' => $item['id_curso'],
                'id_personal' => $item['id_personal'],
                'estatus' => $item['estatus']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}
?>