<?php
include_once 'models/documentos.php';
class DocumentoModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert($datos){
        // print_r($datos);
        // insertar datos en la BD
        try{
            $query = $this->db->connect()->prepare('INSERT INTO documentacion (id_personal, nombre, descripcion, estatus) VALUES(:id_personal, :nombre, :descripcion, :estatus)');
            $query->execute(['id_personal' => $datos['id_personal'], 'nombre' => $datos['nombre'], 'descripcion' => $datos['descripcion'], 'estatus' => $datos['estatus']]);
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

        

            $query = $this->db->connect()->prepare("SELECT*FROM documentacion WHERE id_personal = :id_personal");
            try{
            $query->execute(['id_personal' => $id]);
            while($row = $query->fetch()){
                $item = new Documentos();
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
                $item->nombre = $row['nombre'];
                $item->descripcion = $row['descripcion'];
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
            $query = $this->db->connect()->query('SELECT * FROM documentacion');
            
            while($row = $query->fetch()){
                $item = new Documentos();
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
                $item->descripcion = $row['descripcion'];
                $item->estatus = $row['estatus'];
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function delete($id,$nombre){
        $query = $this->db->connect()->prepare("DELETE FROM documentacion WHERE id_personal = :id_personal AND nombre = :nombre");
        try{
            $query->execute([
                'id_personal'=> $id,
                'nombre'=> $nombre
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}

?>