<?php
require 'conexion.php';
$sentencia=$conexion->prepare("UPDATE personal set estatus = 'Activo-Pendiente' WHERE id_personal IN (SELECT id_personal from vistafaltas);");
if($sentencia->execute()){
$results ="ok";
echo "datos actualizados correctamente";
}else{
$results="error";
echo "error al actualizar";
}
$sentencia->close();
$conexion->close();
?>