<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'user')){
	
include ("panelmed/conn1.php");
include ("panelmed/rempla_fech.php");

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$tipo = $_POST["tipo"];if($tipo == ''){$tipo = $_REQUEST["tipo"];};

if ($id != '' && $tipo == 'mod'){
	$sql1 = "SELECT * FROM productos WHERE id='".$id."' ORDER BY nombre ASC";
	$result1 = mysql_query($sql1, $conn1);
	$row = mysql_fetch_array($result1);
	};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ao soluciones ortopedicas</title>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

<link href="styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="menubar">
  <a href="programacion.php" class="op lop">Programacíon</a>
  <a href="estadisticas.php" class="op mop">Estadisticas</a>
<?php if($_SESSION["tipo"] == 'admin' || $_SESSION["usuarios"] == '1'){?>  <a href="usuarios.php" class="op rop">Usuarios</a><?php }else{	?>
  <div class="opb ropb"></div>
  <?php };?>
</div>
<div class="tp">
  <div class="cf"></div>
</div>
<form method="post" action="panelmed/<?php if($tipo == ''){echo 'a_prod';}; if($tipo == 'mod'){echo 'm_prod';};?>.php?id=<?php echo $id;?>" name="frmRegistro">
<div class="onecol"><span class="titlecol"><?php if($tipo == ''){echo 'Agregar';}else{echo 'Modificar';};?> producto </span>
  <div class="campitem">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="nombre" id="textfield" placeholder="Producto" value="<?php echo $row["nombre"];?>"/>
    </div>
    <div class="campb dospor">
     Si: <input name="activo" type="radio" value="s" <?php if ($row["activo"]=="s" || $tipo==""){?> checked="checked" <?php }?>/>
     No: <input name="activo" type="radio" value="n" <?php if ($row["activo"]=="n"){?> checked="checked" <?php }?>/>
    </div>
  </div>
  
  
  
  <div class="cf"></div>
  <div class="campitem">
    <div class="campc"></div>
  </div>
  <div class="campitem dospor">
    <div class="campc"><!-- <a href="." class="ra">Guardar</a>-->
      <input type="submit" name="add"  value="Guardar" class="rax"/> </div>
  </div>
  
  
  
  
  
  
  
  <div class="cf"></div>
</div>
</form>
</body>
</html>

<?php

		mysql_close($conn1);
	}
else{
	header("location: login.php");
	};
	?>