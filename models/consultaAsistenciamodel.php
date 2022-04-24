<?php

include_once 'models/asistencia.php';

class ConsultaAsistenciaModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function get($id){
        // echo "entro get";
        $items = [];

        

            $query = $this->db->connect()->prepare("SELECT*FROM asistencia WHERE id_personal = :id_personal");
            try{
            $query->execute(['id_personal' => $id]);
            while($row = $query->fetch()){
                $item = new Asistencia();
                $item->id_personal = $row['id_personal'];
                // $item->nombre = $row['nombre'];
                // $item->apellido_paterno = $row['apellido_paterno'];
                // $item->apellido_materno = $row['apellido_materno'];
                // $item->calle = $row['calle'];
                // $item->colonia = $row['colonia'];
                // $item->numero_exterior = $row['numero_exterior'];
                // $item->edad = $row['edad'];
                // $item->fecha_nacimiento = $row['fecha_nacimiento'];
                // $item->estado_civil = $row['estado_civil'];
                // $item->numero_hijos = $row['numero_hijos'];
                // $item->escolaridad = $row['escolaridad'];
                $item->fecha = $row['fecha'];
                $item->estatus = $row['estatus'];
                array_push($items, $item);
                //         
            }
            //  $this->view->$completo;
            // echo "itemssssss: " .print_r($items);
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
                //         
            }
            //  $this->view->$completo;
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
}

?>