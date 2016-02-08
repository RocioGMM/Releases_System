<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'user')){
	
include ("panel/conn1.php");
include ("panel/rempla_fech.php");

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$tipo = $_POST["tipo"];if($tipo == ''){$tipo = $_REQUEST["tipo"];};

if ($id != '' && $tipo == 'mod'){
  $sql1 = "SELECT * FROM usuario WHERE id='".$id."' ORDER BY id ASC";
  $result1 = mysql_query($sql1, $conn1);
  $row = mysql_fetch_array($result1);
  $sql2 = "SELECT * FROM vendedor WHERE id='".$row["vendedor"]."' ORDER BY id ASC";
  $result2 = mysql_query($sql2, $conn1);
  $row2 = mysql_fetch_array($result2);
	};
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>POCKETPHONE</title>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

<link href="styles.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="log-out">
  <div class="lo-logo"><img src="logosdi.svg"  height="42" /></div>
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
<span class="machi"><?php if($_SESSION["tipo"] == 'admin'){?>Ver Todos las  ventas<?php }else{?>Ir a tu cuenta ><?php };?></span></a>
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
<div class="btn-proys"><a href="usuarios.php"><img src="back-users.png" width="44" height="44" /></a></div>
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
<form method="post" action="panel/a_user.php?id=<?php echo $id;?>" name="frmRegistro">
<input type="hidden" name="id" value="<?php echo $id?>"/>

<div class="onecol"><span class="titlecol-ad"><?php if($tipo == ''){echo 'Agregar';}else{echo 'Modificar';};?> usuario </span>
<div class="cf"></div>

<div class="campitem-cliente">
    <div class="campc">
      <label for="textfield2"></label>
      <form id="form1" name="form1" method="post" action="">

 
  <input type="hidden" name="city_habilita" value="1" />
  
	
   <input type="radio" name="tipo" id="checkbox" value="vendedor"  <?php if($row["tipo"] == 'vendedor'){ echo 'checked="checked"';};?> />
        <label for="checkbox"></label>
      Vendedor   
      
   <!--<input type="radio" name="tipo" id="checkbox2" value="user"  <?php if($row["tipo"] == 'user'){ echo 'checked="checked"';};?>  />
      <label for="checkbox2"></label>
      Supervisor-->
      
   <input type="radio" name="tipo" id="checkbox2" value="admin"  <?php if($row["tipo"] == 'admin'){ echo 'checked="checked"';};?>  />
      <label for="checkbox2"></label>
      Admin
           
      </form>



    </div>
    <div class="campb dospor"><label for="textfield2"></label></div>
  </div>




  <div class="campitem-cliente">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="nombre" id="textfield" placeholder="Nombre" value="<?php echo $row["nombre"];?>"/>
    </div>
    <div class="campb dospor">
    <input type="text" name="apellido" id="textfield" placeholder="Apellido" value="<?php echo $row["apellido"];?>"/>
    </div>
  </div>
  <div class="campitem-cliente">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="user" id="textfield" placeholder="Usuario" value="<?php echo $row["user"];?>"/>
    </div>
    <div class="campb dospor">
    <input type="password" name="pass" id="textfield" placeholder="Password" value="<?php echo $row["pass"];?>"/>
    </div>
  </div>
  
  <div class="campitem-cliente">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="email" id="textfield" placeholder="E-mail" value="<?php echo $row["email"];?>"/>
    </div>
    

    <input type="hidden" name="ciudad" value="33"/>
  </div>
  


 <div class="cf"></div>
  <div class="t-uname"><br />
*SÓLO PARA VENDEDOR<br />
<br />
</div>
   <div class="cf"></div>
   
  <div class="campitem-cliente">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="domicilio" id="textfield" placeholder="Domicilio" value="<?php echo $row2["domicilio"];?>"/>
    </div>
    <div class="campb dospor">
    <input type="text" name="ciudad" id="textfield" placeholder="Ciudad" value="<?php echo $row2["ciudad"];?>"/>
    </div>
  </div>

    <div class="campitem-cliente">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="estado" id="textfield" placeholder="Estado" value="<?php echo $row2["estado"];?>"/>
    </div>
    <div class="campb dospor">
    <input type="text" name="pais" id="textfield" placeholder="País" value="<?php echo $row2["pais"];?>"/>
    </div>
  </div>

    <div class="campitem-cliente">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="telefono" id="textfield" placeholder="Teléfono" value="<?php echo $row2["telefono"];?>"/>
    </div>
    <div class="campb dospor">
    <input type="text" name="celular" id="textfield" placeholder="Celular" value="<?php echo $row2["celular"];?>"/>
    </div>
  </div>

 <div class="cf"></div>



  <div class="save-btns">
    <div class="campc"> <!--<a href="." class="ra">Guardar</a>-->
      <input type="submit" name="add"  value="Guardar" class="rax"/> </div>
  </div>
  
  
  
  
  
  
  
  <div class="cf"></div>
</div>
</form>



<!--
<script type="text/javascript">
function vent() {
  if(document.getElementById('datavend').style.display == 'block') {
    document.getElementById('datavend').style.display = 'none';
  }else {
    document.getElementById('datavend').style.display = 'block';
  }
}
</script>-->


</body>
</html>

<?php

		mysql_close($conn1);
	}
else{
	header("location: login.php");
	};
	?>