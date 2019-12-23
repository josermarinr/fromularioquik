<?php
include_once('../mysqli.inc.php');

$conexion=mysqli_connect ($cfg_servidor,$cfg_usuario,$cfg_password,$cfg_basephp1);
mysqli_set_charset($conexion,"utf8");

/* $VALOR_CSS = urlencode($_POST["css"]);
$VALOR_HTML = urlencode($_POST["html"]);
$VALOR_TEACHER = urlencode($_POST["teacher"]); */

$_first_name = $_POST["firstname"];
$_last_name = $_POST["lastname"];
$_id_passport = $_POST["idpassport"];
$_email = $_POST["email"];
$_password = md5($_POST["password"]);
$_headquarters = $_POST["headquarters"];
$_profile = "student";

$datos =array(
  'first_name' => $_first_name,
  'last_name' => $_last_name,
  'id_passport' => $_id_passport,
  'email' => $_email,
  'password' => $_password,
  'headquarters' => $_headquarters,
  'profile' => $_profile
	);
	
$sql =sprintf(
    'INSERT INTO users (%s) VALUES (\'%s\')',
    implode(',',array_keys($datos)),
    implode('\',\'',array_values($datos))
);

if (mysqli_query($conexion,$sql)) {	
	$datos["id"]=$conexion->insert_id;
	echo "<h1>Datos Guardados con exito.</h1>";
	print("<script>window.location.replace('login.php');</script>"); 
}
else{  
	echo "<h1>Error al guardar los datos.</h1>".mysqli_error($conexion);
    exit();
	}
$conexion->close();
?>