<?php
require 'conexion.php';
date_default_timezone_set('America/Mexico_City');
$fecha= date('Y-m-d');
$dia = "";
switch (date("l")) {
    case "Sunday":
           $dia = "Domingo";
    break;
    case "Monday":
           $dia = "Lunes";
    break;
    case "Tuesday":
          $dia = "Martes";
    break;
    case "Wednesday":
          $dia = "Miercoles";
    break;
    case "Thursday":
          $dia = "Jueves";
    break;
    case "Friday":
          $dia = "Viernes";
    break;
}
//echo $day;
//insert into 'asistencia'(id_personal) select id_personal from personal WHERE estatus="Activo";
$sentencia=$conexion->prepare("insert ignore into asistencia(id_personal) select id_personal from personal WHERE estatus='Activo' AND turno='$dia'");
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