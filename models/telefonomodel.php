<?php
include_once 'models/telefonos.php';
class TelefonoModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert($datos){
        // insertar datos en la BD
        try{
            $query = $this->db->connect()->prepare('INSERT INTO telefono (id_personal, lada, numero,tipo,descripcion) VALUES(:id_personal, :lada, :numero, :tipo, :descripcion)');
            $query->execute(['id_personal' => $datos['id_personal'], 'lada' => $datos['lada'], 'numero' => $datos['numero'], 'tipo' => $datos['tipo'], 'descripcion' => $datos['descripcion']]);
            return true;
        }catch(PDOException $e){
            //echo $e->getMessage();
            //echo "Ya existe esa matrícula";
            return false;
        }
        
    }
    public function get($id){
        // echo "entro get";
        $items = [];
            $query = $this->db->connect()->prepare("SELECT*FROM telefono WHERE id_personal = :id_personal");
            try{
            $query->execute(['id_personal' => $id]);
            while($row = $query->fetch()){
                $item = new Telefonos();
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
                $item->lada = $row['lada'];
                $item->numero = $row['numero'];
                $item->tipo = $row['tipo'];
                $item->descripcion = $row['descripcion'];
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

    public function getById($id,$lada,$numero){
        $item = new Telefonos();

        $query = $this->db->connect()->prepare("SELECT * FROM telefono WHERE id_personal = :id_personal AND lada = :lada AND numero = :numero");
        try{
            $query->execute(['id_personal' => $id,'lada' => $lada,'numero' => $numero]);

            while($row = $query->fetch()){
                $item->id_personal = $row['id_personal'];
                $item->lada = $row['lada'];
                $item->numero = $row['numero'];
                $item->tipo = $row['tipo'];
                $item->descripcion = $row['descripcion'];
            }

            return $item;
        }catch(PDOException $e){
            return null;
        }
    }


    public function update($item){
        echo "item es :".print_r($item);
        // echo " ITEM anterior_lada es este: ".$item['id_personal'];
        // echo "session";
        $ant_lada=$_SESSION['verLada'];
        $ant_numero=$_SESSION['verNumero'];
        echo "ant_ladasssssssss: ".$ant_lada;
        $query = $this->db->connect()->prepare("UPDATE telefono SET lada = :lada, numero = :numero, 
        tipo = :tipo,descripcion = :descripcion WHERE id_personal = :id_personal AND lada = $ant_lada AND numero = $ant_numero");
        try{
            $query->execute([
                'id_personal'=> $item['id_personal'],
                'lada'=> $item['lada'],
                'numero'=> $item['numero'],
                'tipo'=> $item['tipo'],
                'descripcion'=> $item['descripcion']
            ]);
            // echo "comienza ueryy: ".print_r($query);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }


    public function delete($id,$lada,$numero){
        $query = $this->db->connect()->prepare("DELETE FROM telefono WHERE id_personal = :id_personal AND lada = :lada AND numero = :numero");
        try{
            $query->execute([
                'id_personal'=> $id,
                'lada'=> $lada,
                'numero'=> $numero
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}

?>