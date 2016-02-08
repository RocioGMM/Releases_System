<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'user') || ($_SESSION["tipo"] == 'vendedor')){
	
include ("panel/conn1.php");
include ("panel/rempla_fech.php");


$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$mas = $_POST["mas"];if($mas == ''){$mas = $_REQUEST["mas"];};

$orden = $_POST["orden"];if($orden == ''){$orden = $_REQUEST["orden"];};
$ascdes = $_POST["ascdes"];if($ascdes == ''){$ascdes = $_REQUEST["ascdes"];};


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

 $fecha_hora1 = $hoy.' 23:59:00';
 $fecha_hora2 = date ( 'Y-m-j' , strtotime( "$hoy -1 month" ) ).' 00:00:00';
	?>
         
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=0.5">
<title></title>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href="styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" rel="stylesheet" href="jquery.datetimepicker.css"/>






		<!-- Add jQuery library -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="lib/jquery.mousewheel-3.0.6.pack.js"></script>
<!-- Add fancyBox -->
<link rel="stylesheet" href="source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="source/jquery.fancybox.pack.js?v=2.1.5"></script>
<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<link rel="stylesheet" href="source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<script type="text/javascript">
$(document).ready(function() {
	$(".various").fancybox({
		maxWidth	: 400,
		maxHeight	: 50,
		fitToView	: false,
		width		: '70%',
		height		: '19%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});
	</script>




</head>

<body>

<div class="gruap">

<div class="log-out">
  <div class="lo-logo"><img src="logopocket.png"  height="42" /></div>
  <div class="lo-logout"><a href="salir.php">Cerrar sesión</a></div>
</div>


    <div class="menubar" >
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
<span class="dayn"><?php echo $dia_hoy; ?>  </span>

</div>
<div class="btn-proys"><a href="programacion.php"><img src="checkicon.png" width="44" height="44" /></a></div>
<span class="titlesec">ESTADISTICAS</span>
</div>
    
<?php $comienzo_cuenta = date ( 'Y-m-j' , strtotime( "$hoy -1 year" ) );
 $fecha_hora_comienzo_cuenta = $comienzo_cuenta.' 00:00:00';// fecha de 30 dias antes primeras horas del dia
 $fecha_horaHoy = $hoy.' 23:59:00'; //fecha de hoy a ultimas horas del dia
 //// conprobamos que pedidos y cuantas veces se hicieron
 $cont = 0;
 $cant_reg = 0;

?>
<!--<div class="tp"><div class="subpanel">

 <?php if($_SESSION["tipo"] == 'admin'){?>
        <a href="datos.php" target="_self" class="losdatos"><img src="ic-sets.png" width="20" height="20" /></a>
<?php };?> 
</div>
 <div class="cf"></div>
</div>-->









<div class="onecol" style="margin-bottom:90px">


<span class="titlecol-ad">
<?php if($mas == '4'){echo 'CIERRE';}elseif($mas == '3'){echo 'COTIZACIONES';}else{echo 'TODA LA ACTIVIDAD';};?></span>

  <div class="statsmenu"><span class="ncolor">MÁS:</span> &nbsp;&nbsp;&nbsp;&nbsp; 
  <?php if($mas != '3'){?><a href="estadisticas.php?mas=3"> COTIZACIONES &gt;</a> <?php };?>
  <?php if($mas != '4'){?><a href="estadisticas.php?mas=4">CIERRE &gt;</a><?php };?>
  <?php if($mas != ''){?><a href="estadisticas.php?mas=">TODO &gt;</a><?php };?>
  </div>
 <div class="divline"></div>





<span class="titlecol tcolor conics"> VENDEDORES </span> 




<!-- ------------- FORMULARIO DE FECHAS ------------------>
<form method="post" action="estadisticas.php?est=<?php echo $est;?>&otro_hoy=<?php echo $otro_hoy;?>&semanal=his" name="frmRegistro">
<div class="filtro">
<div class="">
	<span class="indic">MOSTRAR DESDE </span>
	<div class="campx" ><?php //echo $movil;?> 
      <label for="textfield"></label>
      <input type="text" name="fechaest1" id="datetimepicker2" placeholder="Fecha Inicio" class="hospitalzz" value="<?php echo $_POST["fechaest1"];?>"/>
    </div>
    <span class="indic">A  </span>
    <div class="campx" ><?php //echo $movil;?> 
      <label for="textfield"></label>
      <input type="text" name="fechaest2" id="datetimepicker2b" placeholder="Fecha" class="hospitalzz" value="<?php echo $_POST["fechaest2"];?>"/>
    </div>
<input type="image" src="search-icon.png" name="add"  value="Checar" class="raxy" />	
</div>		
</div>
</form>
<!-- ------------- FIN DE FORMULARIO DE FECHAS ------------------>





 <?php //echo $buscar;
 $espaciado = 0;
 $veces_text = 0;
 $fechaest1 = $_POST["fechaest1"];
 $fechaest2 = $_POST["fechaest2"];

 if($fechaest1 == '' || $fechaest2 == ''){
	 $dia_sem1= date("w",mktime(0, 0, 0, substr($hoy,5,2), substr($hoy,8,2), substr($hoy,0,4)));	 //localizo el dia de la semana que comienzo el mes
	 $restadiasen = 6 - $dia_sem1;
	 //$fecha_hora2 = $hoy.' 00:00:00';
	 //$fecha_hora3 = $hoy.' 23:59:59';
	 $fecha_hora1 = date ( 'Y-m-j' , strtotime( "$fechaest1 -$dia_sem1 day" ) ).' 00:00:00';
	 $fecha_hora2 = date ( 'Y-m-j' , strtotime( "$hoy +$restadiasen day" ) ).' 23:59:00';
 }
else{
	 $fecha_hora1 = substr($fechaest1,6,4).'-'.substr($fechaest1,3,2).'-'.substr($fechaest1,0,2).' 00:00:00';
	 $fecha_hora2 = substr($fechaest2,6,4).'-'.substr($fechaest2,3,2).'-'.substr($fechaest2,0,2).' 23:59:59';
}; 
 



$cantven = 0;
$cantcierre = 0;
$cantcierreproc = 0;
$cantcotiza = 0;



if ($_SESSION["tipo"] == 'vendedor'){
		//$sql1 = "SELECT * FROM evento_act WHERE fecha='".$dia_testeo."' AND vendedor='".$_SESSION["vendedor"]."' ORDER BY fecha DESC";
		$sql1 = "SELECT * FROM vendedor WHERE id='".$_SESSION["vendedor"]."' ORDER BY nombre, apellido";
}else{
		$sql1 = "SELECT * FROM vendedor ORDER BY nombre, apellido";
	};
$result1 = mysql_query($sql1, $conn1);
while($row = mysql_fetch_array($result1)){
	$array[$cantven]["id"] = $row["id"];// recolecto la id correspondiente
//	echo $row["id"].'::'.$array[$cantven]["id"].' - ';
	if($orden == 'eveproc'){
		$cantcierreproc = 0;
		$sql3 = "SELECT * FROM evento WHERE fecha_captura<='".$fecha_hora2."' AND fecha_captura>='".$fecha_hora1."' AND vendedor = '".$row["id"]."' ";
		$result3 = mysql_query($sql3, $conn1);
		while($row3 = mysql_fetch_array($result3)){
		$sql7 = "SELECT * FROM evento_act WHERE  evento = '".$row3["id"]."'  AND evento_cat = '4' AND checkedeve != '1' ";
		$result7 = mysql_query($sql7, $conn1);
		$row7 = mysql_fetch_array($result7);
			$cantcierreproc = $cantcierreproc + 1;			
		};
		$array[$cantven]["valor"] = $cantcierreproc;
	};
	if($orden == 'cierre'){
		$cantcierre = 0;
		$sql3 = "SELECT * FROM evento_act WHERE fecha>='".$fecha_hora1."' AND fecha<'".$fecha_hora2."' AND evento_cat = '4' AND vendedor = '".$row["id"]."' ORDER BY fecha ASC";
		$result3 = mysql_query($sql3, $conn1);
		while($row3 = mysql_fetch_array($result3)){
			if($row3["checkedeve"] == '1'){$cantcierre = $cantcierre + 1;};			
		};
		$array[$cantven]["valor"] = $cantcierre;
		//echo 'aqui';
	};
	if($orden == 'cotizaciones'){
		$cantcotiza = 0;
		$sql3 = "SELECT * FROM evento_act WHERE fecha>='".$fecha_hora1."' AND fecha<'".$fecha_hora2."' AND evento_cat = '3' AND vendedor = '".$row["id"]."' ORDER BY fecha ASC";
		$result3 = mysql_query($sql3, $conn1);
		while($row3 = mysql_fetch_array($result3)){
			if($row3["checkedeve"] == '1'){$cantcotiza = $cantcotiza + 1;};			
		};
		$array[$cantven]["valor"] = $cantcotiza;
	};
	//echo $row["id"].'p'.$array[$cantven]["valor"].' - ';
	$cantven = $cantven + 1; 
	//echo $array[$cantven]["id"].':'.$array[$cantven]["valor"].'-';
};



//echo 'ayui'.$cantven.':e: ';
if($ascdes != ''){
	for($i = 0; $i < $cantven; $i++){//ORDENAR
		//echo $array[$i]["id"].'-';
		 if($ascdes == 'asc'){///////mayor arriba
		 	for($h = 0; $h < $cantven - 1; $h++){
			 	$imas = $h +1;

			 	//echo ' '.$h.'('.$array[$h]["id"].'.'.$array[$h]["valor"].'_'.$array[$imas]["id"].'.'.$array[$imas]["valor"];
			 	if($array[$imas]["valor"] < $array[$h]["valor"]){
			 		//echo '.si';
			 		$idprob = $array[$imas]["id"];//aseguro variables
			 		$valprob = $array[$imas]["valor"];
			 		$array[$imas]["id"] = $array[$h]["id"];//pongo el valor mayor
			 		$array[$imas]["valor"] = $array[$h]["valor"];
			 		$array[$h]["id"] = $idprob;//pongo el valor menor
			 		$array[$h]["valor"] = $valprob;
			 	};
			 	//echo '):';
		 	}
		 };/////////////////////////////////////
		 if($ascdes == 'desc'){///////menor arriba
		 	for($h = 0; $h < $cantven - 1; $h++){
			 	$imas = $h +1;
			 	//echo ' '.$h.'('.$array[$h]["id"].'.'.$array[$h]["valor"].'_'.$array[$imas]["id"].'.'.$array[$imas]["valor"];
			 	if($array[$imas]["valor"] > $array[$h]["valor"]){
			 		//echo '.si';
			 		$idprob = $array[$imas]["id"];//aseguro variables
			 		$valprob = $array[$imas]["valor"];
			 		$array[$imas]["id"] = $array[$h]["id"];//pongo el valor mayor
			 		$array[$imas]["valor"] = $array[$h]["valor"];
			 		$array[$h]["id"] = $idprob;//pongo el valor menor
			 		$array[$h]["valor"] = $valprob;
			 	};
			 	//echo 'i'.$idprob.'):';
		 	}
		 };/////////////////////////////////////
	}// FIN DEL FOR ORDENAR
};


for($i = 0; $i < $cantven; $i++){//recorro todos los vendedores en el orden elegido
	//echo $i.':::'.$array[$i]["id"].' - ';
$sql1 = "SELECT * FROM vendedor WHERE id='".$array[$i]["id"]."' ";
$result1 = mysql_query($sql1, $conn1);
$row = mysql_fetch_array($result1);
//while($row = mysql_fetch_array($result1)){



	//localizo el dia de la semana que comienzo el mes
//	$dia_sem= date("w",mktime(0, 0, 0, substr($row["fecha"],5,2), substr($row["fecha"],8,2), substr($row["fecha"],0,4)));	

		/*$sql2 = "SELECT * FROM evento WHERE id='".$row["evento"]."' ORDER BY id ASC";
		$result2 = mysql_query($sql2, $conn1);
		$row2 = mysql_fetch_array($result2); //*/

?>
<? 	$dia_registrado = substr($row["fecha"],0,4).'-'.substr($row["fecha"],5,2).'-'.substr($row["fecha"],8,2);
	//if ($dia_bandera != $dia_registrado){ $dia_bandera = $dia_registrado;
?>
  <?php if( $veces_text == 0){?>


<div class="cf"><div class="prints"> 
<a class="various" data-fancybox-type="iframe" href="enviamail.php?fechaest1=<?php echo $fechaest1;?>&fechaest2=<?php echo $fechaest2;?>&orden=<?php echo $orden;?>&ascdes=<?php echo $ascdes;?>" >
	<img src="ic-mail.png" width="23" height="23" /></a>
<a  href='javascript:window.print(); void 0;'><img src="ic-print.png" width="23" height="23" /></a></div></div>
<div id="stickem"></div>
  <div id="sticker">
  
    <div class="t-progres" ice:editable="*">VENDEDOR</div>
    <!--<div class="t-descb">FOLIO</div>-->
    	<div class="t-desit">EVENTOS EN PROCESO</div>
    	<div class="t-contact">COTIZACIONES</div>
    	<div class="time-s ti">CIERRES</div>
  </div>
  
  <div class="initem escprin">
    <div class="t-progres chi" ><a href="estadisticas.php">ORDENAR POR ALFABETO</a></div>
    <div class="t-desit chi">
    <a href="estadisticas.php?fechaest1=<?php echo $fechaest1;?>&fechaest2=<?php echo $fechaest2;?>&orden=eveproc&ascdes=desc"> MAYOR  </a>
        l  
    <a href="estadisticas.php?fechaest1=<?php echo $fechaest1;?>&fechaest2=<?php echo $fechaest2;?>&orden=eveproc&ascdes=asc"> MENOR  </a>
    </div>
    <div class="t-contact chi">
    <a href="estadisticas.php?fechaest1=<?php echo $fechaest1;?>&fechaest2=<?php echo $fechaest2;?>&orden=cotizaciones&ascdes=desc"> MAYOR  </a>
        l  
    <a href="estadisticas.php?fechaest1=<?php echo $fechaest1;?>&fechaest2=<?php echo $fechaest2;?>&orden=cotizaciones&ascdes=asc"> MENOR  </a>
    </div>
    <div class="time-s ti chi">
    <a href="estadisticas.php?fechaest1=<?php echo $fechaest1;?>&fechaest2=<?php echo $fechaest2;?>&orden=cierre&ascdes=desc"> MAYOR  </a>
        l  
    <a href="estadisticas.php?fechaest1=<?php echo $fechaest1;?>&fechaest2=<?php echo $fechaest2;?>&orden=cierre&ascdes=asc"> MENOR  </a>
    </div>
  </div>
  
  <div class="initem escprin">
    <div class="t-progres chi" ></div>
    <div class="t-desit clirs" id="totalproceso"> 20</div>
    <div class="t-contact clirs" id="totalcotizaciones"> 9</div>
    <div class="time-s ti clirs" id="totalcierre"> 7 </div>
  </div>
  
  
  
   
<?php };	 $veces_text = 1;	?>
  
  
  
  <div class="initem"<?php  if($espaciado == 1){echo 'style="margin-top:15px"';}//para el espaciado entre items
			else{echo 'style="margin-top:15px"';};	?>>
            
    
     
    <div class="t-progres imgalcost"><?php echo '('.$i.') '.$row["nombre"].' '.$row["apellido"];?></div>  
    
    
    <!--<div class="i-descb"> <?php echo $row["folio"]; ///////////	FOLIO?></div>-->
    
    <div class="t-desit">
    <?php $cantcierreproc = 0; $cantproc = 0;
/*$sql5 = "SELECT * FROM evento WHERE vendedor = '".$row["id"]."' ";
$result5 = mysql_query($sql5, $conn1);
while($row5 = mysql_fetch_array($result5)){//*/
		//echo $row5["id"].'-';
		// 
		$sql3 = "SELECT * FROM evento WHERE fecha_captura<='".$fecha_hora2."' AND fecha_captura>='".$fecha_hora1."' AND vendedor = '".$row["id"]."' ";
		$result3 = mysql_query($sql3, $conn1);
		while($row3 = mysql_fetch_array($result3)){
		$sql7 = "SELECT * FROM evento_act WHERE  evento = '".$row3["id"]."'  AND evento_cat = '4' AND checkedeve != '1' ";
		$result7 = mysql_query($sql7, $conn1);
		$row7 = mysql_fetch_array($result7);
			$cantcierreproc = $cantcierreproc + 1;			
		};
		//if($cantcierreproc == 0){$cantproc = $cantproc + 1;};
		//$cantcierreproc = 0;
//};
		echo $cantcierreproc;// EVENTOS EN PROCESO	
		$totalproceso = $totalproceso + $cantcierreproc;	?>   </div>
 


    
    <div class="contact">  <?php $cantcotiza = 0;
/*$sql5 = "SELECT * FROM evento WHERE vendedor = '".$row["id"]."' ";
$result5 = mysql_query($sql5, $conn1);
while($row5 = mysql_fetch_array($result5)){//*/
		$sql3 = "SELECT * FROM evento_act WHERE fecha>='".$fecha_hora1."' AND fecha<'".$fecha_hora2."' AND evento_cat = '3' AND vendedor = '".$row["id"]."' ORDER BY fecha ASC";
		$result3 = mysql_query($sql3, $conn1);
		while($row3 = mysql_fetch_array($result3)){
			if($row3["checkedeve"] == '1'){$cantcotiza = $cantcotiza + 1;};			
		};
//};
		echo $cantcotiza;// COTIZACIONES		
		$totalcotizaciones = $totalcotizaciones + $cantcotiza;?>
	</div>
    
 
 

    <div class="time-s ti">
    <?php $cantcierre = 0;
/*$sql5 = "SELECT * FROM evento WHERE vendedor = '".$row["id"]."' ";
$result5 = mysql_query($sql5, $conn1);
while($row5 = mysql_fetch_array($result5)){//*/
		$sql3 = "SELECT * FROM evento_act WHERE fecha>='".$fecha_hora1."' AND fecha<'".$fecha_hora2."' AND evento_cat = '4' AND vendedor = '".$row["id"]."' ORDER BY fecha ASC";
		$result3 = mysql_query($sql3, $conn1);
		while($row3 = mysql_fetch_array($result3)){
			if($row3["checkedeve"] == '1'){$cantcierre = $cantcierre + 1;};			
		};
//};
		echo $cantcierre;// CIERRES	
		$totalcierre = $totalcierre + $cantcierre;	?></div>
    
    
    <div class="ic-idel"><a href="estadisticas-i.php?id=<?php echo $row["id"];?>&fechaest1=<?php echo $fecha_hora1;?>&fechaest2=<?php echo $fecha_hora2;?>" target="_self">
    <img src="view-icon.png" width="44" height="44" border="0" /></a></div>
     

    
<?php };?>  
   <div class="cf"></div>
  </div>

  <div class="cf"></div>
</div>

</div>




<script type="text/javascript">
	document.getElementById('totalproceso').innerHTML = "<?php echo $totalproceso;?>";	
	document.getElementById('totalcotizaciones').innerHTML = "<?php echo $totalcotizaciones;?>";	
	document.getElementById('totalcierre').innerHTML = "<?php echo $totalcierre;?>";	
</script>




<?php    $created = date("Y-m-d H:i:s");    ?>

<!--<script type="text/javascript" src="./jquery.js"></script>-->
<script type="text/javascript" src="jquery.datetimepicker.js"></script>
<script type="text/javascript">
$('#datetimepicker').datetimepicker()
<!--    .datetimepicker({value:'<?php //echo $created;?>',step:10});-->

$('#datetimepicker_mask').datetimepicker({
    mask:'9999/19/39 29:59'
});
       
$('#datetimepicker1').datetimepicker({
    datepicker:false,
    format:'H:i',
    step:30
});
$('#datetimepicker2').datetimepicker({
    lang:'es',
    timepicker:false,
    format:'d/m/Y',
    formatDate:'d/m/y',
});    
$('#datetimepicker2b').datetimepicker({
    lang:'es',
    timepicker:false,
    format:'d/m/Y',
    formatDate:'d/m/y',
});      

$('#datetimepicker3').datetimepicker({
    lang:'es',
    timepicker:false,
    formatDate:'Y/m/d',
    inline:true
});
$('#datetimepicker3b').datetimepicker({ 
    datepicker:false,
    format:'H:i',
    step:30,
    inline:true
});
</script>







</body>
</html>

<?php

	mysql_close($conn1);
	}
else{
	header("location: login.php");
	};	
?>