<?php
require 'models/cursos.php';
class CursoModel extends Model{

    public function __construct(){
        parent::__construct();
    }
    public function insert($datos){
        // insertar
        $query = $this->db->connect()->prepare('INSERT INTO CURSO (NOMBRE, DESCRIPCION, RESPONSABLE, FECHA, HORA, ESTATUS) VALUES(:nombre, :descripcion, :responsable, :fecha, :hora, :estatus)');
        try{
            $query->execute([
                'nombre' => $datos['nombre'],
                'descripcion' => $datos['descripcion'],
                'responsable' => $datos['responsable'],
                'fecha' => $datos['fecha'],
                'hora' => $datos['hora'],
                'estatus' => $datos['estatus']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
        
        
    }
    public function get(){
        $items = [];
        try{
            $query = $this->db->connect()->query('SELECT * FROM curso');
            
            while($row = $query->fetch()){
                $item = new Cursos();
                $item->id = $row['id'];
                $item->nombre    = $row['nombre'];
                $item->descripcion  = $row['descripcion'];
                $item->responsable  = $row['responsable'];
                $item->fecha  = $row['fecha'];
                $item->hora  = $row['hora'];
                $item->estatus  = $row['estatus'];
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getById($id){
        $item = new Cursos();
        try{
            $query = $this->db->connect()->prepare('SELECT * FROM curso WHERE id = :id');

            $query->execute(['id' => $id]);
            
            while($row = $query->fetch()){
                
                $item->id = $row['id'];
                $item->nombre    = $row['nombre'];
                $item->descripcion  = $row['descripcion'];
                $item->responsable  = $row['responsable'];
                $item->fecha  = $row['fecha'];
                $item->hora  = $row['hora'];
                $item->estatus  = $row['estatus'];
            }
            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

    public function update($item){
        $query = $this->db->connect()->prepare('UPDATE curso SET nombre = :nombre, descripcion = :descripcion, responsable = :responsable, fecha = :fecha, hora = :hora, estatus = :estatus WHERE id = :id');
        try{
            $query->execute([
                'id' => $item['id'],
                'nombre' => $item['nombre'],
                'descripcion' => $item['descripcion'],
                'responsable' => $item['responsable'],
                'fecha' => $item['fecha'],
                'hora' => $item['hora'],
                'estatus' => $item['estatus']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function delete($id){
        echo "id model es: ".$id;
        $query = $this->db->connect()->prepare('DELETE FROM curso WHERE id = :id');
        try{
            $query->execute([
                'id' => $id
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}
?>