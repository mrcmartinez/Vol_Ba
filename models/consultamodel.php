<?php

include_once 'models/personal.php';

class ConsultaModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function get(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT concat_ws(' ', apellido_paterno, apellido_materno,
                                                                    nombre) as nombreConcat,id_personal,estatus FROM personal;");

            while($row = $query->fetch()){
                $item = new Personal();
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
                $item->estatus = $row['estatus'];
                $item->completo = $row['nombreConcat'];
                array_push($items, $item);
                //         
            }
            //  $this->view->$completo;
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getById($id){
        $item = new Personal();

        $query = $this->db->connect()->prepare("SELECT * FROM personal WHERE id_personal = :id_personal");
        try{
            $query->execute(['id_personal' => $id]);

            while($row = $query->fetch()){
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
                $item->apellido_paterno = $row['apellido_paterno'];
                $item->estatus = $row['estatus'];
                $item->apellido_materno = $row['apellido_materno'];
                $item->calle = $row['calle'];
                $item->colonia = $row['colonia'];
                $item->numero_exterior = $row['numero_exterior'];
                $item->edad = $row['edad'];
                $item->fecha_nacimiento = $row['fecha_nacimiento'];
                $item->estado_civil = $row['estado_civil'];
                $item->numero_hijos = $row['numero_hijos'];
                $item->escolaridad = $row['escolaridad'];
            }

            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

    public function update($item){
        $query = $this->db->connect()->prepare("UPDATE personal SET nombre = :nombre, estatus = :estatus, 
        apellido_paterno = :apellido_paterno,apellido_materno = :apellido_materno, calle = :calle, colonia = :colonia,
        numero_exterior = :numero_exterior, edad = :edad, fecha_nacimiento = :fecha_nacimiento, estado_civil = :estado_civil,
        numero_hijos = :numero_hijos, escolaridad = :escolaridad WHERE id_personal = :id_personal");
        try{
            $query->execute([
                'id_personal'=> $item['id_personal'],
                'nombre'=> $item['nombre'],
                'estatus'=> $item['estatus'],
                'apellido_paterno'=> $item['apellido_paterno'],
                'apellido_materno'=> $item['apellido_materno'],
                'calle'=> $item['calle'],
                'colonia'=> $item['colonia'],
                'numero_exterior'=> $item['numero_exterior'],

                'edad'=> $item['edad'],
                'fecha_nacimiento'=> $item['fecha_nacimiento'],
                'estado_civil'=> $item['estado_civil'],
                'numero_hijos'=> $item['numero_hijos'],
                'escolaridad'=> $item['escolaridad']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function delete($id){
        $query = $this->db->connect()->prepare("DELETE FROM personal WHERE id_personal = :id_personal");
        try{
            $query->execute([
                'id_personal'=> $id,
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}

?>