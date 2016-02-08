<?php
session_start();

if($_SESSION["tipo"] == 'admin' || $_SESSION["tipo"] == 'user'){

include ("conn1.php");
	

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};

$user = $_POST["user"];
$pass = $_POST["pass"];
$tipo = $_POST["tipo"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$email = $_POST["email"];
$ciudad = $_POST["ciudad"];
$estado = $_POST["estado"];
$usuarios = $_POST["usuarios"];
$estadisticas = $_POST["estadisticas"];
$city_habilita = $_POST["city_habilita"];
if($tipo != 'admin' || $_SESSION["tipo"] == 'user'){ 	$tipo = 'user';		};

if ($nombre == ''){
	header("location: e_a_sec.php");
	}
else{	
$sql1 = "UPDATE usuario SET tipo='".$tipo."', user='".$user."', pass='".$pass."', user='".$user."', nombre='".$nombre."', apellido='".$apellido."', email='".$email."', ciudad='".$ciudad."', estado='".$estado."', usuarios='".$usuarios."', estadisticas='".$estadisticas."', city_habilita='".$city_habilita."' WHERE id=".$id;
	$result = mysql_query($sql1);
	header("location: ../usuarios.php?tipo=mod&id=".$id);
	};
	
		mysql_close($conn1);
	}
else{
	header("location: ../login.php");
	};
?>