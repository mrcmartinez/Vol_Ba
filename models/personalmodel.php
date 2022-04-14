
<?php
include_once 'models/personalBanco.php';

class PersonalModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert($datos){
        // insertar datos en la BD
        try{
            $conn=$this->db->connect();
            $query = $conn->prepare('INSERT INTO PERSONAL (NOMBRE, APELLIDO_PATERNO,
                                                     APELLIDO_MATERNO,CALLE,COLONIA,NUMERO_EXTERIOR,
                                                     EDAD,FECHA_NACIMIENTO,ESTADO_CIVIL,NUMERO_HIJOS,ESCOLARIDAD,TURNO,ACTIVIDAD,ESTATUS) VALUES(:nombre,
                                                      :apellido_paterno,:apellido_materno,:calle,:colonia,
                                                      :numero_exterior,:edad,:fecha_nacimiento,:estado_civil,
                                                      :numero_hijos,:escolaridad,:turno,:actividad,:estatus)');
            $query->execute(['nombre' => $datos['nombre'], 'apellido_paterno' => $datos['apellido_paterno'],
                            'apellido_materno' => $datos['apellido_materno'],'calle' => $datos['calle'],
                            'colonia' => $datos['colonia'],'numero_exterior' => $datos['numero_exterior'],
                            'edad' => $datos['edad'],'fecha_nacimiento' => $datos['fecha_nacimiento'],
                            'estado_civil' => $datos['estado_civil'],'numero_hijos' => $datos['numero_hijos'],
                            'escolaridad' => $datos['escolaridad'],'turno' => $datos['turno'],'actividad' => $datos['actividad'],'estatus' => $datos['estatus']]);
            $id = $conn->lastInsertId();
            echo 'El id de la última fila insertada fue: ' . $id;
            // return true;
            return array(true, $id);
        }catch(PDOException $e){
            //echo $e->getMessage();
            //echo "Ya existe esa matrícula";
            return array(false);
        }
        
    }
    public function get(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT concat_ws(' ', apellido_paterno, apellido_materno,
                                                                    nombre) as nombreConcat,id_personal,turno,actividad,estatus FROM personal;");

            while($row = $query->fetch()){
                $item = new PersonalBanco();
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
                $item->turno = $row['turno'];
                $item->actividad = $row['actividad'];
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
    public function getBusqueda($c,$f){
        //  echo "hola getBus";
        //  echo $c;
        //  echo $f;
         $items = [];

         try{
 
             $query = $this->db->connect()->query("SELECT concat_ws(' ', apellido_paterno, apellido_materno,
                                                                     nombre) as nombreConcat,id_personal,turno,actividad,estatus FROM personal WHERE (nombre like '%".$c."%' OR apellido_paterno like '%".$c."%' OR apellido_materno like '%".$c."%') AND estatus like '%".$f."%'");
 
             while($row = $query->fetch()){
                 $item = new PersonalBanco();
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
                 $item->turno = $row['turno'];
                 $item->actividad = $row['actividad'];
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
                $item->edad = $row['edad'];
                $item->fecha_nacimiento = $row['fecha_nacimiento'];
                $item->estado_civil = $row['estado_civil'];
                $item->numero_hijos = $row['numero_hijos'];

                $item->turno = $row['turno'];
                $item->actividad = $row['actividad'];

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
        numero_hijos = :numero_hijos, escolaridad = :escolaridad, turno = :turno, actividad = :actividad WHERE id_personal = :id_personal");
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
        echo "estatus model".$estatus;
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
}

?>