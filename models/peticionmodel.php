<?php
require 'models/peticiones.php';
class PeticionModel extends Model{

    public function __construct(){
        parent::__construct();
    }
    public function get(){
        $items = [];
        try{
            $query = $this->db->connect()->query('SELECT * FROM peticion');
            while($row = $query->fetch()){
                $item = new Peticiones();
                $item->folio = $row['folio'];
                $item->id_personal = $row['id_personal'];
                $item->fecha_apertura = $row['fecha_apertura'];
                $item->tipo = $row['tipo'];
                $item->estatus  = $row['estatus'];
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function insert($datos){
        $query = $this->db->connect()->prepare('INSERT INTO PETICION (ID_PERSONAL, FECHA_APERTURA, TIPO, FECHA_SOLICITADA, DIA_SOLICITADO,DESCRIPCION,ESTATUS) VALUES(:id_personal, :fecha_apertura, :tipo, :fecha_solicitada, :dia_solicitado, :descripcion, :estatus)');
        try{
            $query->execute([
                'id_personal' => $datos['id_personal'],
                'fecha_apertura' => $datos['fecha_apertura'],
                'tipo' => $datos['tipo'],
                'fecha_solicitada' => $datos['fecha_solicitada'],
                'dia_solicitado' => $datos['dia_solicitado'],
                'descripcion' => $datos['descripcion'],
                'estatus' => $datos['estatus']
                
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }    
    }

    public function getById($id){
        $item = new Peticiones();
        try{
            $query = $this->db->connect()->prepare('SELECT * FROM peticion WHERE folio = :folio');
            $query->execute(['folio' => $id]);
            while($row = $query->fetch()){
                $item->folio = $row['folio'];
                $item->id_personal    = $row['id_personal'];
                $item->fecha_apertura  = $row['fecha_apertura'];
                $item->tipo  = $row['tipo'];
                $item->descripcion  = $row['descripcion'];
                $item->fecha_solicitada  = $row['fecha_solicitada'];
                $item->dia_solicitado  = $row['dia_solicitado'];
                $item->estatus  = $row['estatus'];
            }
            return $item;
        }catch(PDOException $e){
            return null;
        }
    }
    public function getBusqueda($c,$f,$d){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT * FROM curso WHERE nombre like '%".$c."%' AND fecha like '%".$d."%' AND estatus like '%".$f."%'");
            while($row = $query->fetch()){
                $item = new Cursos();
                $item->id = $row['id']; 
                $item->nombre = $row['nombre'];
                $item->descripcion = $row['descripcion'];
                $item->responsable = $row['responsable'];
                $item->fecha = $row['fecha'];
                $item->hora = $row['hora'];
                $item->estatus = $row['estatus'];
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function update($item){
        $query = $this->db->connect()->prepare('UPDATE Personal SET turno = :turno WHERE id_personal = :id_personal');
        try{
            $query->execute([
                'id_personal' => $item['id_personal'],
                'turno' => $item['dia_solicitado']
            ]);
            $query = $this->db->connect()->prepare('UPDATE peticion SET estatus = :estatus WHERE folio = :folio');
            $query->execute([
                'folio' => $item['folio'],
                'estatus' => "Autorizado"
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function delete($id,$estatus){
        if ($estatus=="Activo") {
            $query = $this->db->connect()->prepare("UPDATE curso SET estatus = 'Terminado' WHERE id = :id");
        }else{
            $query = $this->db->connect()->prepare("UPDATE curso SET estatus = 'Activo' WHERE id = :id");
        }
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