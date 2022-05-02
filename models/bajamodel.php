<?php
include_once 'models/bajas.php';
class BajaModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getBusqueda($fInicio,$fTermino){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT * FROM bajas WHERE fecha BETWEEN '$fInicio' AND '$fTermino' ORDER BY fecha DESC");
            while($row = $query->fetch()){
                $item = new Bajas();
                $item->id_personal = $row['id_personal'];
                $item->fecha = $row['fecha'];
                $item->motivo = $row['motivo'];
                array_push($items, $item);    
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
}