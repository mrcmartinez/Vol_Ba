<?php
//require 'conexion.php';
$conexion = mysqli_connect('localhost','root','','volba');
if(!$conexion){
	echo "error en la conexion";
}
$result=array();
$result['datos']=array();
$query = "SELECT * from usuarioPrueba";
$response = mysqli_query($conexion,$query);
while($row=mysqli_fetch_array($response)){
	$index['id']=$row['0'];
	$index['nombre']=$row['1'];
	$index['correo']=$row['2'];
	$index['direccion']=$row['3'];
	array_push($result['datos'],$index);
}
$result['exito']='1';
echo json_encode($result);
?>