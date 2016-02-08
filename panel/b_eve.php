<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin')){

include ("conn1.php");
	
$id = $_REQUEST["id"];
$id2 = $_REQUEST["id2"];

	
	$sql1 = "DELETE FROM evento WHERE id=".$id;
	$result = mysql_query($sql1);
	$sql1 = "DELETE FROM evento_act WHERE evento=".$id;
	$result = mysql_query($sql1);
	header("location: ../programacion.php?id".$id2);

	
	mysql_close($conn1);
	}
else{
	header("location: login.php");
	};
?>