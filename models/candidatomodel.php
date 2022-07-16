
<?php
include_once 'models/candidatos.php';
// include_once 'models/qrcodigo.php';
class CandidatoModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert($datos){
        $query = $this->db->connect()->prepare('INSERT INTO CANDIDATO (NOMBRE,EDAD,
        FECHA_SOLICITUD,TELEFONO,ESTATUS) VALUES(:nombre,
         :edad,:fecha_solicitud,
         :telefono,:estatus)');
        try{
            $query->execute(['nombre' => $datos['nombre'],'edad' => $datos['edad'],
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
             $query = $this->db->connect()->query("SELECT * FROM candidato WHERE (nombre like '%".$c."%') AND estatus like '%".$f."%' ORDER BY fecha_solicitud");
 
             while($row = $query->fetch()){
                 $item = new Candidatos();
                 $item->id_candidato = $row['id_candidato'];
                 $item->nombre = $row['nombre'];
                 $item->edad = $row['edad'];
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
}

?>