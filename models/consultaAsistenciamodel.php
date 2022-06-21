<?php

include_once 'models/asistencia.php';

class ConsultaAsistenciaModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function get($id){
        $items = [];
            $query = $this->db->connect()->prepare("SELECT CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) As nombre, a.id_personal, a.fecha,a.estatus,a.hora
            FROM asistencia as a 
            INNER JOIN personal as p
            ON a.id_personal = p.id_personal where a.id_personal=:id_personal");
            try{
            $query->execute(['id_personal' => $id]);
            while($row = $query->fetch()){
                $item = new Asistencia();
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
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
    public function getAll(){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) As nombre, a.id_personal, a.fecha,a.estatus,a.hora
            FROM asistencia as a 
            INNER JOIN personal as p
            ON a.id_personal = p.id_personal");
            
            while($row = $query->fetch()){
                $item = new Asistencia();
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
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
    public function getBusqueda($c,$f,$fInicio,$fTermino,$orden){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) As nombre, a.id_personal, a.fecha,a.estatus,a.hora
            FROM asistencia as a 
            INNER JOIN personal as p
            ON a.id_personal = p.id_personal WHERE (a.id_personal like '%".$c."%') AND a.estatus like '%".$f."%' AND fecha BETWEEN '$fInicio' AND '$fTermino' ORDER BY $orden DESC");
            while($row = $query->fetch()){
                $item = new Asistencia();
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
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
    public function getList($fecha){
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) As nombre, p.actividad, a.id_personal, a.fecha,a.estatus,a.hora
            FROM asistencia as a 
            INNER JOIN personal as p
            ON a.id_personal = p.id_personal WHERE fecha = '$fecha'");
            while($row = $query->fetch()){
                $item = new Asistencia();
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
                $item->fecha = $row['fecha'];
                $item->hora = $row['hora'];
                $item->actividad = $row['actividad'];
                $item->estatus = $row['estatus'];
                array_push($items, $item);    
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function update($item){
        $query = $this->db->connect()->prepare('UPDATE ASISTENCIA SET estatus = :estatus,hora=:hora WHERE (fecha = :fecha AND id_personal = :id_personal)');
        try{
            $query->execute([
                'id_personal' => $item['id_personal'],
                'fecha' => $item['fecha'],
                'hora' => $item['hora'],
                'estatus' => $item['estatus']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function insertManual($datos){
        $query = $this->db->connect()->prepare('INSERT ignore into asistencia(id_personal) SELECT id_personal from personal WHERE estatus=:estatus AND turno=:turno');
        try{
            $query->execute([
                'turno' => $datos['turno'],
                'estatus' => $datos['estatus']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }    
    }
    public function insertApoyo($datos){
        $query = $this->db->connect()->prepare('INSERT INTO asistencia (id_personal, fecha, hora, estatus) VALUES(:id_personal, :fecha, :hora, :estatus)');
        try{
            $query->execute([
                'id_personal' => $datos['id_personal'],
                'fecha' => $datos['fecha'],
                'hora' => $datos['hora'],
                'estatus' => $datos['estatus']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }    
    }
}
?>