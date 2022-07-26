<?php

include_once 'models/asistencia.php';

class ConsultaAsistenciaModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function get($id){
        $items = [];
            $query = $this->db->connect()->prepare("SELECT CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) As nombre, a.id_personal, a.fecha,a.estatus,a.hora, m.descripcion
            FROM asistencia as a 
            INNER JOIN personal as p
            ON a.id_personal = p.id_personal
            LEFT JOIN motivo as m
            ON m.fecha = a.fecha 
            AND m.id_personal = a.id_personal 
            where a.id_personal=:id_personal ");
            try{
            $query->execute(['id_personal' => $id]);
            while($row = $query->fetch()){
                $item = new Asistencia();
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
                $item->fecha = $row['fecha'];
                $item->hora = $row['hora'];
                $item->estatus = $row['estatus'];
                $item->descripcion = $row['descripcion'];
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
            $query = $this->db->connect()->query("SELECT CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) As nombre, a.id_personal, a.fecha,a.estatus,a.hora,m.descripcion
            FROM asistencia as a
            INNER JOIN personal as p
            ON a.id_personal = p.id_personal
            LEFT JOIN motivo as m
            ON m.fecha = a.fecha 
            AND m.id_personal = a.id_personal 
            WHERE (a.id_personal like '%".$c."%') AND a.estatus like '%".$f."%' AND a.fecha BETWEEN '$fInicio' AND '$fTermino' ORDER BY $orden");
            while($row = $query->fetch()){
                $item = new Asistencia();
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
                $item->fecha = $row['fecha'];
                $item->hora = $row['hora'];
                $item->estatus = $row['estatus'];
                $item->descripcion = $row['descripcion'];
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
            ON a.id_personal = p.id_personal WHERE fecha = '$fecha' ORDER BY nombre");
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

    public function buscar($datos){
        $items = [];
            $query = $this->db->connect()->prepare("SELECT id_personal from personal WHERE estatus=:estatus AND turno=:turno");
            try{
            $query->execute([
                'turno' => $datos['turno'],
                'estatus' => $datos['estatus']
                ]);
            while($row = $query->fetch()){
                $row['id_personal'];
                array_push($items, $row);      
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    function prueba($datos){
        echo $datos; 
        echo "</br>";
    }
    public function insertManual($datos){
        $query = $this->db->connect()->prepare('INSERT ignore into asistencia(id_personal) SELECT id_personal from personal WHERE estatus=:estatus AND turno=:turno');
        try{
            $query->execute([
                'turno' => $datos['turno'],
                'fecha' => $datos['fecha'],
                'estatus' => $datos['estatus']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }    
    }
    public function buscarManual($datos){
        $query = $this->db->connect()->prepare('INSERT INTO ASISTENCIA (id_personal, fecha) VALUES(:id_personal, :fecha)');
        try{
            $query->execute([
                'id_personal' => $datos['id_personal'],
                'fecha' => $datos['fecha']
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
    public function delete($id,$fecha){
        $query = $this->db->connect()->prepare("DELETE FROM asistencia WHERE id_personal = :id_personal AND fecha = :fecha");
        try{
            $query->execute([
                'id_personal'=> $id,
                'fecha'=> $fecha
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function consultarAgenda($id){
        $nomb="";
        $query = $this->db->connect()->prepare("SELECT p.id_personal, CONCAT(p.apellido_paterno, ' ', p.apellido_materno, ' ', p.nombre ) As nombre, va.telefonos from vista_agenda as va INNER JOIN personal as p ON p.id_personal = va.id_personal where va.id_personal=:id_personal;");
        try{
            $query->execute(['id_personal' => $id]);
            while($row = $query->fetch()){
                $nomb=$row['nombre'];
                $tel=$row['telefonos'];
            }
            return array($nomb,$tel);
        }catch(PDOException $e){
            return array(null,null);
        }
    }
    public function insertMotivo($datos){
        $query = $this->db->connect()->prepare('INSERT INTO motivo (ID_PERSONAL, FECHA, DESCRIPCION) VALUES(:id_personal, :fecha, :descripcion)');
        try{
            $query->execute([
                'id_personal' => $datos['id_personal'],
                'fecha' => $datos['fecha'],
                'descripcion' => $datos['descripcion']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}
?>