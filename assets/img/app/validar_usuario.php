<?php
require 'conexion.php';
$usu_usuario=$_POST['usuario'];
$usu_password=md5($_POST['password']);

//$usu_usuario="mau";
//$usu_password="123";

$sentencia=$conexion->prepare("SELECT * FROM usuario WHERE nombre_usuario=? AND password=?");
$sentencia->bind_param('ss',$usu_usuario,$usu_password);
$sentencia->execute();

$resultado = $sentencia->get_result();
if ($fila = $resultado->fetch_assoc()) {
         echo json_encode($fila,JSON_UNESCAPED_UNICODE);     
}
$sentencia->close();
$conexion->close();
?>