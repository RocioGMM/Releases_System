<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'user')){
	
include ("panel/conn1.php");
include ("panel/rempla_fech.php");

$c = $_POST["c"];if($c == ''){$c = $_REQUEST["c"];};
$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$tipo = $_POST["tipo"];if($tipo == ''){$tipo = $_REQUEST["tipo"];};
$id_categ = $_POST["id_categ"];if($id_categ == ''){$id_categ = $_REQUEST["id_categ"];};
//$id_categ = $_REQUEST["id_categ"];


	$sql0 = "SELECT * FROM evento_act WHERE id='".$id."' ORDER BY id ASC";
	$result0 = mysql_query($sql0, $conn1);
	$row0 = mysql_fetch_array($result0);
	$sql1 = "SELECT * FROM evento WHERE id='".$id."' ORDER BY id ASC";
	$result1 = mysql_query($sql1, $conn1);
	$row = mysql_fetch_array($result1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Administrador</title>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<link href="styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" rel="stylesheet" href="jquery.datetimepicker.css"/>


</head>

<body>
<div class="menubar">
  <a href="programacion.php" class="op log"></a>
<?php 	$sql7 = "SELECT * FROM  usuario WHERE id='".$_SESSION["iduser"]."' ORDER BY id ASC";
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
<span class="machi"><?php if($_SESSION["tipo"] == 'admin'){?>Ver Todos las ventas<?php }else{?>Ir a tu cuenta ><?php };?></span></a>
<?php };?>


  <a href="programacion.php" class="op lop">Inicio</a>
  <a href="estadisticas.php" class="op mop">Estadisticas</a>
<?php if($_SESSION["tipo"] == 'admin'){?>  <a href="usuarios.php" class="op rop">Usuarios</a><?php  };?>
</div>
<div class="tp">

  <div class="cf"></div>
</div>
<form method="post" action="panel/b_eve.php?id=<?php echo $row["id"];?>&id2=<?php echo $id;?>" name="frmRegistro">
<div class="onecol"><span class="titlecol-ad">Eliminar Venta </span>
  
    <input type="hidden" name="id" value="<?php echo $row["id"];?>"/>

<div class="campitem">
<?php echo $row["evento"];?>
<?php //  
        $sql9h= "SELECT * FROM cliente WHERE id='".$row["cliente"]."' ORDER BY id ASC";
        $result9h = mysql_query($sql9h, $conn1);
        $row9h = mysql_fetch_array($result9h);
        echo ' ('.$row9h["nombre_empresa"].')';
?>
</div>
  
  <div class="campitem dospor">
    <div class="campc">
      <input type="submit" name="add"  value="Eliminar" class="rax"/> 		
<!-- <a href="javascript:document.forma.submit();" class="ra">Guardar</a> -->
</div>
  </div>
  
  
  
  
  
  
  
  <div class="cf"></div>
</div>
</form>
</body>

<?php    $created = date("Y-m-d H:i:s");	?>

<!--<script type="text/javascript" src="./jquery.js"></script>-->
<script type="text/javascript" src="./jquery.datetimepicker.js"></script>
<script type="text/javascript">
$('#datetimepicker').datetimepicker()
<!--	.datetimepicker({value:'<?php //echo $created;?>',step:10});-->

$('#datetimepicker_mask').datetimepicker({
	mask:'9999/19/39 29:59'
});

$('#datetimepicker1').datetimepicker({
	datepicker:false,
	format:'H:i',
	step:5
});
$('#datetimepicker2').datetimepicker({
	yearOffset:222,
	lang:'ch',
	timepicker:false,
	format:'d/m/Y',
	formatDate:'Y/m/d',
	minDate:'-1970/01/02', // yesterday is minimum date
	maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});
$('#datetimepicker3').datetimepicker({
	inline:true
});
$('#datetimepicker4').datetimepicker();
$('#open').click(function(){
	$('#datetimepicker4').datetimepicker('show');
});
$('#close').click(function(){
	$('#datetimepicker4').datetimepicker('hide');
});
$('#reset').click(function(){
	$('#datetimepicker4').datetimepicker('reset');
});
$('#datetimepicker5').datetimepicker({
	datepicker:false,
	allowTimes:['12:00','13:00','15:00','17:00','17:05','17:20','19:00','20:00']
});
$('#datetimepicker6').datetimepicker();
$('#destroy').click(function(){
	if( $('#datetimepicker6').data('xdsoft_datetimepicker') ){
		$('#datetimepicker6').datetimepicker('destroy');
		this.value = 'create';
	}else{
		$('#datetimepicker6').datetimepicker();
		this.value = 'destroy';
	}
});
var logic = function( currentDateTime ){
	if( currentDateTime ){
		if( currentDateTime.getDay()==6 ){
			this.setOptions({
				minTime:'11:00'
			});
		}else
			this.setOptions({
				minTime:'8:00'
			});
	}
};
$('#datetimepicker7').datetimepicker({
	onChangeDateTime:logic,
	onShow:logic
});
$('#datetimepicker8').datetimepicker({
	onGenerate:function( ct ){
		$(this).find('.xdsoft_date')
			.toggleClass('xdsoft_disabled');
	},
	minDate:'-1970/01/2',
	maxDate:'+1970/01/2',
	timepicker:false
});
$('#datetimepicker9').datetimepicker({
	onGenerate:function( ct ){
		$(this).find('.xdsoft_date.xdsoft_weekend')
			.addClass('xdsoft_disabled');
	},
	weekends:['01.01.2014','02.01.2014','03.01.2014','04.01.2014','05.01.2014','06.01.2014'],
	timepicker:false
});


$('#datetimepicker10').datetimepicker({
	step:5,
	inline:true
});

$('#datetimepicker_start_time').datetimepicker({
	startDate:'+1970/05/01'
});

$('#datetimepicker_unixtime').datetimepicker({
	format:'unixtime'
});
$('#datetimepicker11').datetimepicker({
        hours12: false,
        format: 'Y-z H:i W',
        step: 1,
        opened: false,
        validateOnBlur: false,
        closeOnDateSelect: false,
        closeOnTimeSelect: false
});
</script>



</html>

<?php

	mysql_close($conn1);
	}
else{
	header("location: login.php");
	};		
	?>