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


<!----------------------------------------      AUTOCOMPLETAR   ----------------------------------- -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
        
        <script type="text/javascript">
                $(document).ready(function(){
                    $("#busclie").autocomplete({
                      source:'getautocomplete.php',
                      multiple: true,
                      minLength:1
                    });
                });
        
        </script> 
        <!---------------------------------------------------------------------------------------- -->


</head>

<body>

<div class="log-out">
  <div class="lo-logo"><img src="logopocket.png"  height="42" /></div>
  <div class="lo-logout"><a href="salir.php">Cerrar sesión</a></div>
</div>

    <div class="menubar" > 
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
  <a href="estadisticas.php" class="op mop">Estadisticas</a>
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
<span class="titlesec">CLIENTES</span>
</div>
  
  
  <div class="tp">
	<div class="subpanel"><!--
		<a href="datos.php"><img src="ic-sets.png" width="20" height="20" /></a>
		<a href="index.php"><img src="ic-home.png" width="20" height="20" style="margin-right:12px"/></a>-->
	</div>
	<div class="cf"></div>
</div>  
    
<div class="onecol"><span class="titlecol-ad">Clientes</span>
<form action="" method="post" class="cuscliform" >
  <input type="text" name="busclie" id="busclie" placeholder=" Buscar Cliente" class="buscli1"/> 
  <input type="submit" name="add"  value="Buscar" class="buscli2"/>
</form>
<div class="icons-men"><a href="agregar-cliente.php"><img src="add-user.png" width="64" height="42" /></a></div>
<div class="divline"></div>
  
  <div class="initem">
    <div class="t-uname">EMPRESA </div>
    <div class="t-uemail">CONTACTO</div>
    <div class="t-contact">EMAIL</div>
    <div class="t-contact">TELEFONO</div>
    <div class="ic-i" style="height:20px"></div>
  </div>
<?php 
      if($_POST["busclie"] != ''){
        $porciones = explode(" (", $_POST["busclie"]);
        $porciones_con = str_replace(")", "", $porciones["1"]);
        $sql1 = "SELECT * FROM cliente WHERE nombre_empresa like '%".$porciones["0"]."%' OR contacto like '%".$porciones_con."%' ORDER BY nombre_empresa ASC";
      }else{
        $sql1 = "SELECT * FROM cliente ORDER BY nombre_empresa ASC";
      };  		
		  $result1 = mysql_query($sql1, $conn1);
		  while($row1 = mysql_fetch_array($result1)){
?>
  <div class="initem"<?php if($row1["vendedor"] ==''){echo 'style="color:#FF0000 !important;"';};?>>
    <div class="uname"><?php echo $row1["nombre_empresa"].' '.$row1["apellido"];?></div>
    <div class="uemail"><?php echo $row1["contacto"];?></div>
    <div class="contact"><?php echo $row1["email"];?></div>
    <div class="contact"><?php echo 'Tel: '.$row1["telefono"].'<br>Cell:'.$row1["celular"];?></div>
 
 
<div style="	float: right;	height: 37px;	width: 155px;	margin-top: 2px;	margin-bottom: 1px;"> 
<?php //if($_SESSION["tipo"] == 'admin'){?>
<div class="ic-idel"><a href="eliminar-cliente.php?id=<?php echo $row1["id"];?>" target="_self"><img src="delete1.png" width="44" height="44" border="0" /></a></div>
<?php //};?>
<div class="ic-idel"><a href="agregar-cliente.php?tipo=mod&id=<?php echo $row1["id"];?>"><img src="editaricon.png" width="44" height="44" border="0" /></a></div>
<div class="ic-i"><a href="ver-cliente.php?id=<?php echo $row1["id"];?>"><img src="masicon.png" width="44" height="44" border="0" /></a></div>
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