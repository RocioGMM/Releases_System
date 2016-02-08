<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){

include ("conn1.php");
	
$id = $_REQUEST["id"];
$id2 = $_REQUEST["id2"];
$lugar = $_REQUEST["lugar"];

	
	$sql1 = "DELETE FROM progreso WHERE id=".$id;
	$result = mysql_query($sql1);
	header("location: ../agregar-libra.php?id=".$id2."&lugar=".$lugar);

	
	mysql_close($conn1);
	}
else{
	header("location: login.php");
	};
?>