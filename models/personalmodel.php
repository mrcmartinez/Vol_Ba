
<?php
include_once 'models/personalBanco.php';

class PersonalModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert($datos){
        try{
            $conn=$this->db->connect();
            $query = $conn->prepare('INSERT INTO PERSONAL (NOMBRE, APELLIDO_PATERNO,
                                                     APELLIDO_MATERNO,CALLE,COLONIA,NUMERO_EXTERIOR,
                                                     FECHA_NACIMIENTO,ESTADO_CIVIL,NUMERO_HIJOS,SEGURO_MEDICO,ESCOLARIDAD,TURNO,ACTIVIDAD,FECHA_INGRESO,ESTATUS) VALUES(:nombre,
                                                      :apellido_paterno,:apellido_materno,:calle,:colonia,
                                                      :numero_exterior,:fecha_nacimiento,:estado_civil,
                                                      :numero_hijos,:seguro_medico,:escolaridad,:turno,:actividad,:fecha_ingreso,:estatus)');
            $query->execute(['nombre' => $datos['nombre'], 'apellido_paterno' => $datos['apellido_paterno'],
                            'apellido_materno' => $datos['apellido_materno'],'calle' => $datos['calle'],
                            'colonia' => $datos['colonia'],'numero_exterior' => $datos['numero_exterior'],
                            'fecha_nacimiento' => $datos['fecha_nacimiento'],
                            'estado_civil' => $datos['estado_civil'],'numero_hijos' => $datos['numero_hijos'],'seguro_medico' => $datos['seguro_medico'],
                            'escolaridad' => $datos['escolaridad'],'turno' => $datos['turno'],'actividad' => $datos['actividad'],'fecha_ingreso' => $datos['fecha_ingreso'],'estatus' => $datos['estatus']]);
            $id = $conn->lastInsertId();
            return array(true, $id);
        }catch(PDOException $e){
            return array(false);
        }   
    }
    public function getBusqueda($c,$f){
         $items = [];
         try{
             $query = $this->db->connect()->query("SELECT * FROM vistapersonalv WHERE (nombreCompleto like '%".$c."%' OR nombreCompletoR like '%".$c."%' OR turno like '%".$c."%' OR actividad like '%".$c."%') AND estatus like '%".$f."%'");
 
             while($row = $query->fetch()){
                 $item = new PersonalBanco();
                 $item->id_personal = $row['id_personal'];
                 $item->nombre = $row['nombre'];
                 $item->apellido_paterno = $row['apellido_paterno'];
                 $item->apellido_materno = $row['apellido_materno'];
                 $item->turno = $row['turno'];
                 $item->actividad = $row['actividad'];
                 $item->estatus = $row['estatus'];
                 array_push($items, $item);         
             }
             return $items;
         }catch(PDOException $e){
             return [];
         }
     }
    public function getById($id){
        $item = new PersonalBanco();
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
                $item->fecha_nacimiento = $row['fecha_nacimiento'];
                $item->estado_civil = $row['estado_civil'];
                $item->numero_hijos = $row['numero_hijos'];
                $item->seguro_medico = $row['seguro_medico'];
                $item->turno = $row['turno'];
                $item->actividad = $row['actividad'];
                $item->escolaridad = $row['escolaridad'];
                $item->fecha_ingreso = $row['fecha_ingreso'];
            }
            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

    public function update($item){
        $query = $this->db->connect()->prepare("UPDATE personal SET nombre = :nombre, estatus = :estatus, 
        apellido_paterno = :apellido_paterno,apellido_materno = :apellido_materno, calle = :calle, colonia = :colonia,
        numero_exterior = :numero_exterior, fecha_nacimiento = :fecha_nacimiento, estado_civil = :estado_civil,
        numero_hijos = :numero_hijos,seguro_medico = :seguro_medico, escolaridad = :escolaridad, turno = :turno, actividad = :actividad WHERE id_personal = :id_personal");
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
                'fecha_nacimiento'=> $item['fecha_nacimiento'],
                'estado_civil'=> $item['estado_civil'],
                'numero_hijos'=> $item['numero_hijos'],
                'seguro_medico'=> $item['seguro_medico'],
                'escolaridad'=> $item['escolaridad'],
                'turno'=> $item['turno'],
                'actividad'=> $item['actividad']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function delete($id,$estatus){
        if ($estatus=="Activo") {
            $query = $this->db->connect()->prepare("UPDATE personal SET estatus = 'Baja' WHERE id_personal = :id_personal");
        }else {
            $query = $this->db->connect()->prepare("UPDATE personal SET estatus = 'Activo' WHERE id_personal = :id_personal");
        }
        try{
            $query->execute([
                'id_personal'=> $id
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function insertBaja($datos){
        $query = $this->db->connect()->prepare('INSERT INTO bajas (ID_PERSONAL, FECHA, MOTIVO) VALUES(:id_personal, :fecha, :motivo)');
        try{
            $query->execute([
                'id_personal' => $datos['id_personal'],
                'fecha' => $datos['fecha'],
                'motivo' => $datos['motivo']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }    
    }
    public function updateIngreso($datos){
        $query = $this->db->connect()->prepare("UPDATE personal SET fecha_ingreso = :fecha_ingreso WHERE id_personal = :id_personal");
        try{
            $query->execute([
                'id_personal' => $datos['id_personal'],
                'fecha_ingreso' => $datos['fecha_ingreso']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }    
    }
}

?>