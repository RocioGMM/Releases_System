<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'user')){
	
include ("panel/conn1.php");
include ("panel/rempla_fech.php");


$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};


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
<meta name="viewport" content="width=device-width, initial-scale=0.5">
<title></title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href="styles.css" rel="stylesheet" type="text/css" /> 
</head> 
 
<body>
<div class="gruap">

<div class="log-out">
  <div class="lo-logo"><img src="logosdi.svg" height="42" /></div>
  <div class="lo-logout"><a href="salir.php">Cerrar sesión</a></div>
</div>


    <div class="menubar">
  <a href="programacion.php" class="op log"></a>
<?php   $sql7 = "SELECT * FROM  usuario WHERE id='".$_SESSION["iduser"]."' ORDER BY id ASC";
        $result7 = mysql_query($sql7, $conn1);
        $row7 = mysql_fetch_array($result7); 
?>
  <a href="cuenta.php" class="op loname">Hola de nuevo, <?php echo $row7["nombre"];?>! <br />
<?php 
    if ($_SESSION["tipo"] != 'user'){
    $sql7 = "SELECT * FROM vendedor WHERE id='".$_SESSION["vendedor"]."' ORDER BY id ASC";
        $result7 = mysql_query($sql7, $conn1);
        $row7 = mysql_fetch_array($result7); 
?>
<span class="machi"><?php if($_SESSION["tipo"] == 'admin'){?>Ver Todas las ventas<?php }else{?>Ir a tu cuenta ><?php };?></span></a>
<?php };?>


  <a href="programacion.php" class="op lop">Inicio</a>
  <a href="reportes.php" class="op mop">Reportes</a>
<?php if($_SESSION["tipo"] == 'admin'){?>  <a href="usuarios.php" class="op rop">Usuarios</a><?php  };?>
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
<span class="titlesec">USUARIOS</span>
</div>  
    
<div class="tp">
<div class="subpanel">
 <?php /*if($_SESSION["tipo"] == 'admin'){?>
        <a href="datos.php" target="_self" class="losdatos"><img src="ic-sets.png" width="20" height="20" /></a>
<?php };//*/?> 
</div>
  <div class="cf"></div>
</div>
<div class="onecol"><span class="titlecol-ad">Usuarios</span>
  <div class="icons-men"><a href="agregar-usuario.php"><img src="add-user.png" width="64" height="42" /></a></div>
<div class="divline"></div>
  
  <div class="initem">
    <div class="t-uname">NOMBRE </div>
    <div class="t-uemail">E-MAIL</div>
    <div class="t-ucontact">USUARIO</div>
    <div class="t-ucontact">CLAVE</div>
    <div class="t-ucontact">TIPO</div>
    <div class="ic-i" style="height:20px"></div>
  </div>
<?php 
		  if($_SESSION["tipo"] == 'admin'){
		  		$sql1 = "SELECT * FROM usuario ORDER BY id ASC";
		  };
		  if($_SESSION["tipo"] == 'user'){
		  		$sql1 = "SELECT * FROM usuario WHERE tipo = 'user' ORDER BY id ASC";
		  };
		  $result1 = mysql_query($sql1, $conn1);
		  while($row1 = mysql_fetch_array($result1)){
?>
  <div class="initem">
    <div class="uname"><?php echo $row1["nombre"];?></div>
    <div class="uemail"><?php echo $row1["email"];?></div>
    <div class="uuserpass"><?php echo $row1["user"];?></div>
    <div class="uuserpass"><?php $replacenode = "/[A-Za-z0-9]/"; echo  preg_replace ($replacenode,"*",$row1["pass"]); ?></div>
    <div class="uuserpass">
    <?php       if($row1["tipo"] == 'user'){echo 'Supervisor';}else{echo $row1["tipo"];};    ?>
    </div>
  	
	
          <div style="	float: right;	height: 37px;	width: 110px;	margin-top: 2px;	margin-bottom: 1px;">  
    <?php if($_SESSION["tipo"] == 'admin'){?>
<div class="ic-idel"><a href="eliminar-usuario.php?id=<?php echo $row1["id"];?>" target="_self"><img src="delete1.png" width="44" height="44" border="0" /></a></div>
    <?php };?>
    <div class="ic-i"><a href="agregar-usuario.php?tipo=mod&id=<?php echo $row1["id"];?>"><img src="editaricon.png" width="44" height="44" border="0" /></a></div>
   </div> 
    
     
    
  </div>
  <?php };?>
  <div class="cf"></div>
</div>
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