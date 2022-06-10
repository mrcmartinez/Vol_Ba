<?php
require 'conexion.php';
date_default_timezone_set('America/Mexico_City');
$id_personal=$_POST['id_personal'];
$fecha= date('Y-m-d');
$estatus="Asistencia";
$hora=date("H:i:s");
//$id_personal=1;

$sentencia=$conexion->prepare("insert into asistencia values ('".$id_personal."','".$fecha."','".$hora."','".$estatus."')");
//$sentencia->execute();

if($sentencia->execute()){
$results ="ok";
echo "datos insertados correctamente";
}else{
$results="error";
echo "error al insertar";
}
$sentencia->close();
$conexion->close();
?>