<?php
// require 'models/usuarios.php';
class QrModel extends Model{

    public function __construct(){
        parent::__construct();
    }
    public function insertQr($datos){
        echo "entro a modelQR";
        print_r($datos);
        // $query = $this->db->connect()->prepare('INSERT INTO CODE (id_personal, identificador, fecha) VALUES(:id_personal, :identificador, :fecha)');
        // try{
        //     $query->execute([
        //         'id_personal' => $datos['id_personal'],
        //         'identificador' => $datos['identificador'],
        //         'fecha' => $datos['fecha']
        //     ]);
        //     return true;
        // }catch(PDOException $e){
        //     return false;
        // }
    }
    public function pruebaModel(){
        echo "entro a pruebaModel";
    }
}
?>