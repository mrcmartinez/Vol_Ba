
<?php
include_once 'models/candidatos.php';
// include_once 'models/qrcodigo.php';
class CandidatoModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert($datos){
        $query = $this->db->connect()->prepare('INSERT INTO CANDIDATO (NOMBRE,FECHA_NACIMIENTO,
        FECHA_SOLICITUD,TELEFONO,ESTATUS) VALUES(:nombre,
         :fecha_nacimiento,:fecha_solicitud,
         :telefono,:estatus)');
        try{
            $query->execute(['nombre' => $datos['nombre'],'fecha_nacimiento' => $datos['fecha_nacimiento'],
            'fecha_solicitud' => $datos['fecha_solicitud'],'telefono' => $datos['telefono'],
            'estatus' => $datos['estatus']]);
            return true;
        }catch(PDOException $e){
            return false;
        }    
    }
    public function getBusqueda($c,$f){
         $items = [];
         try{
             $query = $this->db->connect()->query("SELECT * FROM candidato WHERE (nombre like '%".$c."%') AND estatus like '%".$f."%' ORDER BY nombre");
 
             while($row = $query->fetch()){
                 $item = new Candidatos();
                 $item->id_candidato = $row['id_candidato'];
                 $item->nombre = $row['nombre'];
                 $item->fecha_nacimiento = $row['fecha_nacimiento'];
                 $item->fecha_solicitud = $row['fecha_solicitud'];
                 $item->telefono = $row['telefono'];
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
            $query = $this->db->connect()->prepare("UPDATE candidato SET estatus = :estatus WHERE id_candidato = :id_candidato");
        try{
            $query->execute([
                'id_candidato'=> $id,
                'estatus'=> $estatus
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
    public function pruebaModel(){
        echo "entro a pruebaModel";
    }
    public function insertQr($datos){
        // echo "entro a modelQR";
        // print_r($datos);
        $query = $this->db->connect()->prepare('INSERT INTO CODE (id_personal, identificador, fecha_modificacion) VALUES(:id_personal, :identificador, :fecha_modificacion)');
        try{
            $query->execute([
                'id_personal' => $datos['id_personal'],
                'identificador' => $datos['identificador'],
                'fecha_modificacion' => $datos['fecha_modificacion']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function consultarIden($id){
        $iden="";
        $query = $this->db->connect()->prepare("SELECT * FROM code WHERE id_personal = :id_personal");
        try{
            $query->execute(['id_personal' => $id]);
            while($row = $query->fetch()){
                $iden=$row['identificador'];
            }
            return $iden;
        }catch(PDOException $e){
            return null;
        }
    }
    public function consultarId($id){
        $nomb="";
        $query = $this->db->connect()->prepare("SELECT nombreCompleto from vistapersonalv where id_personal=:id_personal");
        try{
            $query->execute(['id_personal' => $id]);
            while($row = $query->fetch()){
                $nomb=$row['nombreCompleto'];
            }
            return $nomb;
        }catch(PDOException $e){
            return null;
        }
    }
}

?>