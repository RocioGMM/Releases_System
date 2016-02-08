<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'user') || ($_SESSION["tipo"] == 'vendedor')){
	
include ("panel/conn1.php");
include ("panel/rempla_fech.php");


$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$accion = $_POST["accion"];if($accion == ''){$accion = $_REQUEST["accion"];};
$tipo = $_POST["tipo"];if($tipo == ''){$tipo = $_REQUEST["tipo"];};


$created = date("Y-m-d H:i:s");
if($otro_hoy != ''){	$hoy = $otro_hoy;}
else{$hoy = date('Y-m-d');};
			$dia_hoy = substr($hoy,8,2);
			$mes_hoy = substr($hoy,5,2);
			$ano_hoy = substr($hoy,0,4);
			
			$cuenta_dias = 1;
			$empieza = '';
			$dia_cuadro = $ano_hoy.'-'.$mes_hoy.'-01';
			$dia_primero = $ano_hoy.'-'.$mes_hoy.'-01';
			
			$fecha_inicio = $ano_hoy.'-'.$mes_hoy.'-01'; //primer dia del mes
			
			$mes = mktime( 0, 0, 0, $mes_hoy, 1, $ano_hoy ); //encontrar ultimo dia del mes
			$ultimo_dia = date("t",$mes);
			$fecha_fin = $ano_hoy.'-'.$mes_hoy.'-'.$ultimo_dia;// ultimo dia del mes

$dia_testeo = $dia_cuadro;
for($h = 1 ; $h < 32 ; $h ++){
$sql1 = "SELECT * FROM pedidos WHERE fecha_entrega='".$dia_testeo."' ORDER BY fecha_entrega DESC";
$result1 = mysql_query($sql1, $conn1);
$row = mysql_fetch_array($result1);
if($row["id"] != ''){ 		$matriz_testeo[$h] = 'ok'; 		};
$dia_testeo = date ( 'Y-m-j' , strtotime( "$dia_testeo +1 day" ) );
}
$mes_sig = date ( 'Y-m-j' , strtotime( "$hoy +1 month" ) );
$mes_ant = date ( 'Y-m-j' , strtotime( "$hoy -1 month" ) );
	?>
   
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href="styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="menubar">
<a href="programacion.php" class="op log"></a>
  <a href="programacion.php" class="op lop">INICIO</a>
  <?php if($_SESSION["tipo"] == 'admin' || $_SESSION["estadisticas"] == '1'){?>   <a href="estadisticas.php" class="op mop">Estadisticas</a><?php };?>
<?php if($_SESSION["tipo"] == 'admin' || $_SESSION["usuarios"] == '1'){?>  <a href="usuarios.php" class="op rop">Usuarios</a><?php };	?>

</div>


<div class="bann-int">
<div class="today">

<?php  
  $created = date("Y-m-d H:i:s");
  $dia_hoy = substr($created,8,2);
  $mes_hoy = substr($created,5,2); 
?>
<span class="day"><?php echo replacemes($mes_hoy);?></span>
<span class="dayn"><?php echo $dia_hoy;?> </span>
</div>
<div class="btn-proys"><a href="programacion.php"><img src="checkicon.png" width="44" height="44" /></a></div>
<span class="titlesec">¡GRACIAS!</span>
</div>



<div class="tp">
<div class="subpanel"><a href="index.php" style="display:none"><img src="ic-home.png" width="20" height="20" style="margin-right:12px"/></a></div>
  <div class="cf"></div>
</div>
<div class="onecol"><span class="titlecol">
<?php 
			if($tipo == 'doc'){echo 'El Cliente se a guardado correctamente - <a href="cliente.php">VOLVER</a>';};
			if($tipo == 'hosp'){echo 'El Servicio se a agregado correctamente - <a href="servicios.php">VOLVER</a>';};
			if($tipo == 'ped'){echo 'La Captura se realizado correctamente - <a href="programacion.php">VOLVER</a>';};
			if($tipo == 'pedm'){echo 'La Captura se modificado correctamente - <a href="programacion.php">VOLVER</a>';};
			if($tipo == 'prod'){echo 'El Producto se a agregado correctamente - <a href="programacion.php">VOLVER</a>';};
			if($tipo == 'user'){echo 'El Usuario se a agregado correctamente - <a href="usuarios.php">VOLVER</a>';};
?>

</span>
<div class="divline"></div>
  
  

  <div class="cf"></div>
</div>
</body>
</html>

<?php

	mysql_close($conn1);
	}
else{
	header("location: login.php");
	};	
?>