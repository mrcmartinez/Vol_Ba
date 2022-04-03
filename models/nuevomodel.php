<?php

class NuevoModel extends Model{

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
}

?>