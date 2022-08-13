<?php
require 'models/faltas.php';
class ConsultaFaltasModel extends Model{

    public function __construct(){
        parent::__construct();
    }
    public function get(){
        $items = [];
        try{
            $query = $this->db->connect()->query('SELECT * FROM vista_faltas_totales');
            while($row = $query->fetch()){
                $item = new Faltas();
                $item->id_personal = $row['id_personal'];
                $item->nombre    = $row['nombre'];
                $item->turno  = $row['turno'];
                $item->horario  = $row['horario'];
                $item->fecha_ingreso  = $row['fecha_ingreso'];
                $item->total_faltas  = $row['total_faltas'];
                $item->fecha_faltas  = $row['fecha_faltas'];
                $item->estatus  = $row['estatus'];
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

}
?>