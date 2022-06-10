<?php
require 'conexion.php';
$fecha= date('Y-m-d');
$dia = "";
switch (date("l")) {
    case "Saturday":
           $dia = "Sabado";
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

$sql="SELECT COUNT(*) as total from asistencia WHERE fecha = '$fecha' and estatus ='Asistencia'";
$resultado=mysqli_query($conexion,$sql) or die ('Error en el query database');
if($resultado){
$results ="ok";
echo "prueba correctamente";
$fila = mysqli_fetch_assoc($resultado);
echo $fila['total'];
	if($fila['total']==0){
	echo "es cero";
	echo "aqui al no existir 1 asistencia no hace faltas";
	}else{
	echo "no es cero";
	echo "aqui al existir 1 asistencia valida faltas";
	$sentencia=$conexion->prepare("insert ignore into asistencia(id_personal) select id_personal from personal WHERE estatus='Activo' AND turno='$dia'");
	$sentencia->execute();
	}
}else{
$results="error";
echo "error prueba";
}
$resultado->close();
$conexion->close();
?>