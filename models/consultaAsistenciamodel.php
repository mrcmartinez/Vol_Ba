<?php

include_once 'models/asistencia.php';

class ConsultaAsistenciaModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function get($id){
        $items = [];
            $query = $this->db->connect()->prepare("SELECT*FROM asistencia WHERE id_personal = :id_personal");
            try{
            $query->execute(['id_personal' => $id]);
            while($row = $query->fetch()){
                $item = new Asistencia();
                $item->id_personal = $row['id_personal'];
                $item->fecha = $row['fecha'];
                $item->estatus = $row['estatus'];
                array_push($items, $item);      
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function getAll(){
        $items = [];
        try{
            $query = $this->db->connect()->query('SELECT * FROM asistencia');
            
            while($row = $query->fetch()){
                $item = new Asistencia();
                $item->id_personal = $row['id_personal'];
                $item->fecha = $row['fecha'];
                $item->estatus = $row['estatus'];
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function getBusqueda($c,$f,$fInicio,$fTermino){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT * FROM asistencia WHERE (id_personal like '%".$c."%') AND estatus like '%".$f."%' AND fecha BETWEEN '$fInicio' AND '$fTermino' ORDER BY fecha DESC");
            while($row = $query->fetch()){
                $item = new Asistencia();
                $item->id_personal = $row['id_personal'];
                $item->fecha = $row['fecha'];
                $item->estatus = $row['estatus'];
                array_push($items, $item);    
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
}
?>