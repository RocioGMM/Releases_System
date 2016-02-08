<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){
	
include ("panel/conn1.php");
include ("panel/rempla_fech.php");

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$vi = $_POST["vi"];if($vi == ''){$vi = $_REQUEST["vi"];};
$tipo = $_POST["tipo"];if($tipo == ''){$tipo = $_REQUEST["tipo"];};

if ($id != ''){
	$sql1 = "SELECT * FROM cliente WHERE id='".$id."' ";
	$result1 = mysql_query($sql1, $conn1);
	$row = mysql_fetch_array($result1);
};


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

<link href="styles.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="log-out">
  <div class="lo-logo"><img src="logoconcre.png" width="206" height="42" /></div>
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
<span class="machi"><?php if($_SESSION["tipo"] == 'admin'){?>Ver Todos los proyectos<?php }else{?>Ir a tu cuenta ><?php };?></span></a>
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
<div class="btn-proys"><a href="cliente.php"><img src="back-clientes.png" width="44" height="44" /></a></div>
<span class="titlesec">CLIENTES</span>
</div>  
    


<div class="tp">
<div class="subpanel">
<!--<a href="datos.php"><img src="ic-sets.png" width="20" height="20" /></a>
<a href="index.php"><img src="ic-home.png" width="20" height="20" style="margin-right:12px"/></a>
--></div>
  <div class="cf"></div>
</div>



<form method="post" action="panel/a_doc.php?id=<?php echo $id;?>&vi=<?php echo $vi;?>" name="frmRegistro">
<div class="onecol"><span class="titlecol-ad"><?php if($tipo == ''){echo 'Agregar';}else{echo 'Modificar';};?> cliente </span>
  



  <div class="campitem-cliente">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="razonsocial" id="textfield" placeholder="RS:" value="<?php echo $row["razonsocial"];?>"/>
    </div><div class="campb dospor">
      <label for="textfield"></label>
      <input type="text" name="rfc" id="textfield" placeholder="RFC:" value="<?php echo $row["rfc"];?>"/>      
    </div>
  </div>



  <div class="campitem-cliente">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="nombre" id="textfield" placeholder="Empresa:" value="<?php echo $row["nombre_empresa"];?>"/>
    </div>
    <div class="campb dosporch">
      <label for="textfield"></label>
      <input type="text" name="contacto" id="textfield" placeholder="Nobre de Contacto" value="<?php echo $row["contacto"];?>"/>
    </div>
  </div>



  
  <div class="campitem-cliente">    
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="celular" id="textfield" placeholder="Celular" value="<?php echo $row["celular"];?>"/>
      
    </div>
  
  <div class="campb dospor"> 
      <label for="textfield"></label>       
      <input type="text" name="telefono" id="textfield" placeholder="Teléfono" value="<?php echo $row["telefono"];?>"/>
    </div>
  </div>


  
  
  <div class="campitem-cliente">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="email" id="textfield" placeholder="E-Mail" value="<?php echo $row["email"];?>"/>
    </div>
    
    <div class="campb dospor">
      <label for="textfield"></label>
      <input type="text" name="domicilio" id="textfield" placeholder="domicilio" value="<?php echo $row["domicilio"];?>"/>
    </div>
    
  </div>
  
  
  <div class="campitem-cliente">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="colonia" id="textfield" placeholder="Colonia" value="<?php echo $row["colonia"];?>"/>
    </div>
    
    <div class="campb  dospor">
      <label for="textfield"></label>
      <input type="text" name="ciudad" id="textfield" placeholder="Ciudad" value="<?php echo $row["ciudad"];?>"/>
    </div>
  </div>


  
  
  <div class="campitem-cliente">
  <div class="campb "> 
      <label for="textfield"></label> 
      <input type="text" name="estado" id="textfield" placeholder="Estado" value="<?php echo $row["estado"];?>"/>
    </div>

    <div class="campb dospor">
      <label for="textfield"></label>
      <input type="text" name="cp" id="textfield" placeholder="Codigo Postal" value="<?php echo $row["cospos"];?>"/>
    </div>
  </div>


  <div class="cf"></div>
  
  <div class="save-btns">
      <input type="submit" name="add"  value="Guardar" class="rax"/> </div>
  </div>
  
  
  
  
  
  
  
  <div class="cf"></div>
</div>
</form>
<?php //*?/?>
</body>
</html>

<?php

		mysql_close($conn1);
	}
else{
	header("location: login.php");
	};
	?>