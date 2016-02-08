<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){
	
include ("panel/conn1.php");
include ("panel/rempla_fech.php");


$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href="styles.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <div class="menubar" style="background-color:#000">
      <a href="programacion.php" class="op lop">Programacíon</a>
    <?php if($_SESSION["tipo"] == 'admin' || $_SESSION["estadisticas"] == '1'){?>   <a href="estadisticas.php" class="op mop">Estadisticas</a><?php };?>
    <?php if($_SESSION["tipo"] == 'admin' || $_SESSION["usuarios"] == '1'){?>  <a href="usuarios.php" class="op rop">Usuarios</a><?php };?>
    </div>
    
    
<div class="onecol"><span class="titlecol">Clientes</span>
<div class="icons-men"><a href="agregar-cliente.php"><img src="ic-usuario.png" width="31" height="20" /></a></div>
<div class="divline"></div>
  
  <div class="initem">
    <div class="t-uname">NOMBRE </div>
    <div class="t-uemail">CORREO</div>
    <div class="t-contact">TELEFONO</div>
    <div class="t-contact">DOMICILIO</div>
    <div class="ic-i" style="height:20px"></div>
  </div>
<?php 
  		  $sql1 = "SELECT * FROM cliente ORDER BY nombre_empresa ASC";
		  $result1 = mysql_query($sql1, $conn1);
		  while($row1 = mysql_fetch_array($result1)){
?>
  <div class="initem">
    <div class="uname"><?php echo $row1["nombre_empresa"].' '.$row1["apellido"];?></div>
    <div class="uemail"><?php echo $row1["correo"];?></div>
    <div class="contact"><?php echo 'Tel: '.$row1["telefono"].'<br>Cell:'.$row1["celular"];?></div>
    <div class="contact"><?php echo $row1["domicilio"];?></div>
 
 
    <div style="	float: right;	height: 37px;	width: 110px;	margin-top: 2px;	margin-bottom: 1px;"> <?php if($_SESSION["tipo"] == 'admin'){?>
<div class="ic-i" style=" margin-left:15px; margin-top:7px;"><a href="eliminar-cliente.php?id=<?php echo $row1["id"];?>" target="_self"><img src="delete1.png" width="30" height="30" border="0" /></a></div><?php };?>
  	<div class="ic-i"><a href="agregar-cliente.php?tipo=mod&id=<?php echo $row1["id"];?>"><img src="ic-editar.png" width="37" height="37" border="0" /></a></div>
</div>
    
  </div>
  <?php };?>
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