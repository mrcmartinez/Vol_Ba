<?php
require 'models/usuarios.php';
class UsuarioModel extends Model{

    public function __construct(){
        parent::__construct();
    }
    public function insert($datos){
        // insertar
        $query = $this->db->connect()->prepare('INSERT INTO USUARIO (NOMBRE_USUARIO, PASSWORD, ROL) VALUES(:nombre_usuario, :password, :rol)');
        try{
            $query->execute([
                'nombre_usuario' => $datos['nombre_usuario'],
                'password' => $datos['password'],
                'rol' => $datos['rol']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function get(){
        $items = [];
        try{
            $query = $this->db->connect()->query('SELECT * FROM USUARIO');
            
            while($row = $query->fetch()){
                $item = new USUARIOS();
                $item->id_usuario = $row['id_usuario'];
                $item->nombre_usuario    = $row['nombre_usuario'];
                $item->password  = $row['password'];
                $item->rol  = $row['rol'];
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getById($id){
        $item = new Cursos();
        try{
            $query = $this->db->connect()->prepare('SELECT * FROM curso WHERE id = :id');

            $query->execute(['id' => $id]);
            
            while($row = $query->fetch()){
                
                $item->id = $row['id'];
                $item->nombre    = $row['nombre'];
                $item->descripcion  = $row['descripcion'];
                $item->responsable  = $row['responsable'];
                $item->fecha  = $row['fecha'];
                $item->hora  = $row['hora'];
                $item->estatus  = $row['estatus'];
            }
            return $item;
        }catch(PDOException $e){
            return null;
        }
    }
    public function getBusqueda($c,$f,$d){
        // echo "hola getBus";
        // echo $c;
        // echo $f;
        // echo $d;
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT * FROM curso WHERE nombre like '%".$c."%' AND fecha like '%".$d."%' AND estatus like '%".$f."%'");

            while($row = $query->fetch()){
                $item = new Cursos();
                $item->id = $row['id']; 
                $item->nombre = $row['nombre'];
                $item->descripcion = $row['descripcion'];
                $item->responsable = $row['responsable'];
                $item->fecha = $row['fecha'];
                $item->hora = $row['hora'];
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
                // $item->completo = $row['nombreConcat'];
                array_push($items, $item);
                //         
            }
            //  $this->view->$completo;
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }
    public function update($item){
        $query = $this->db->connect()->prepare('UPDATE curso SET nombre = :nombre, descripcion = :descripcion, responsable = :responsable, fecha = :fecha, hora = :hora, estatus = :estatus WHERE id = :id');
        try{
            $query->execute([
                'id' => $item['id'],
                'nombre' => $item['nombre'],
                'descripcion' => $item['descripcion'],
                'responsable' => $item['responsable'],
                'fecha' => $item['fecha'],
                'hora' => $item['hora'],
                'estatus' => $item['estatus']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function delete($id,$estatus){
        // echo " id model es: ".$id;
        // echo " estatus model es: ".$estatus;

        if ($estatus=="Activo") {
            // echo "es para activo";
            $query = $this->db->connect()->prepare("UPDATE curso SET estatus = 'Terminado' WHERE id = :id");
        }else{
            // echo "es para terminado";
            $query = $this->db->connect()->prepare("UPDATE curso SET estatus = 'Activo' WHERE id = :id");
        }
        try{
            $query->execute([
                'id' => $id
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}
?>