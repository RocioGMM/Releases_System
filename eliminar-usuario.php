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


	$sql1 = "SELECT * FROM usuario WHERE id='".$id."' ";
	$result1 = mysql_query($sql1, $conn1);
	$row = mysql_fetch_array($result1);
//echo 'iiiiiiiiii'.$row["id"];
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href="styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" rel="stylesheet" href="jquery.datetimepicker.css"/>


</head>

<body>

<div class="log-out">
  <div class="lo-logo"><img src="logopocket.png" height="42" /></div>
  <div class="lo-logout"><a href="salir.php">Cerrar sesión</a></div>
</div>

    <div class="menubar">
    <a href="programacion.php" class="op log"></a>
      <a href="programacion.php" class="op lop">inicio</a>
    <?php if($_SESSION["tipo"] == 'admin' || $_SESSION["estadisticas"] == '1'){?>   <a href="estadisticas.php" class="op mop">Estadisticas</a><?php };?>
    <?php if($_SESSION["tipo"] == 'admin' || $_SESSION["usuarios"] == '1'){?>  <a href="usuarios.php" class="op rop">Usuarios</a><?php };?>
    </div>
  
  <div class="bann-int">
<div class="today">
<span class="day">SEPTIEMBRE</span>
<span class="dayn">26 </span>
</div>
<div class="btn-proys"><a href="usuarios.php"><img src="back-users.png" width="44" height="44" /></a></div>
<span class="titlesec">USUARIOS</span>
</div>
    
    
<div class="tp">
<div class="subpanel">
 <?php if($_SESSION["tipo"] == 'admin'){?>
        <a href="datos.php" target="_self" class="losdatos"><img src="ic-sets.png" width="20" height="20" /></a>
<?php };?> 
</div>
  <div class="cf"></div>
</div>
<form method="post" action="panel/b_user.php?id=<?php echo $id;?>&tipo=<?php echo $tipo;?>" name="frmRegistro">
<div class="onecol"><span class="titlecol-ad">Eliminar Usuario </span>
  

<div class="cf"></div>

<div class="campitem-cliente">
  
  <div class="campb"> Nombre: <?php echo $row["nombre"]." ".$row["apellido"];?></div>
    <div class="campb dospor">
    <input type="hidden" name="id" value="<?php echo $id?>"/>
	Correo: <?php echo $row["email"];?>     
  </div></div>
    
  <div class="campitem-cliente">        
    <div class="campb">Usuario: <?php echo $row["user"];?> </div>   
  </div>

    
  <div class="campitem-cliente">        
    <div class="campb">Clave:  <?php echo $row["pass"];?> </div>   
  </div>
  
  <div class="cf"></div>
  

  
  
  <div class="save-btns">
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