<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'user') || ($_SESSION["tipo"] == 'vendedor')){
	
include ("panel/conn1.php");
include ("panel/rempla_fech.php");

$mas = $_POST["mas"];if($mas == ''){$mas = $_REQUEST["mas"];};
$otro_hoy = $_POST["otro_hoy"];if($otro_hoy == ''){$otro_hoy = $_REQUEST["otro_hoy"];};
$buscar = $_POST["buscar"];if($buscar == ''){$buscar = $_REQUEST["buscar"];};

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=0.5">
<title>Administrador</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

<link href="styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
input.cambusc {
	border: 1px solid #948EB7;
	color: #666;
	display: block;
	float: left;
	margin-top: 0px;
	margin-right: 7px;
	margin-bottom: 0px;
	margin-left: 0px;
	padding-top: 3px;
	padding-bottom: 3px;
	padding-left: 3px;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="includes/ice/ice.js" type="text/javascript"></script>
</head>

<body>
	<!--<a href="datos.php" target="_self" class="losdatos2"><img src="ic-sets.png" width="20" height="20" /></a>-->
<div class="gruap">

<div class="log-out">
  <div class="lo-logo"><img src="logoconcre.png" width="206" height="42" /></div>
  <div class="lo-logout"><a href="salir.php">Cerrar sesión</a></div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	var s = $("#sticker");
	var pos = s.position();	
	var stickermax = $(document).outerHeight() - $("#footer").outerHeight() - s.outerHeight() - 40; //40 value is the total of the top and bottom margin
	$(window).scroll(function() {
		var windowpos = $(window).scrollTop();
		//s.html("Distance from top:" + pos.top + "<br />Scroll position: " + windowpos);
		if (windowpos >= pos.top && windowpos < stickermax) {
			s.attr("style", ""); //kill absolute positioning
			s.addClass("stick"); //stick it
		} else if (windowpos >= stickermax) {
			s.removeClass(); //un-stick
			s.css({position: "absolute", top: stickermax + "px"}); //set sticker right above the footer
			
		} else {
			s.removeClass(); //top of page
		}
	});
	//alert(stickermax); //uncomment to show max sticker postition value on doc.ready
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	var s = $("#stickem");
	var pos = s.position();	
	var stickermax = $(document).outerHeight() - $("#footer").outerHeight() - s.outerHeight() - 40; //40 value is the total of the top and bottom margin
	$(window).scroll(function() {
		var windowpos = $(window).scrollTop();
		//s.html("Distance from top:" + pos.top + "<br />Scroll position: " + windowpos -1px);
		if (windowpos >= pos.top && windowpos < stickermax) {
			s.attr("style", ""); //kill absolute positioning
			s.addClass("stickem"); //stick it
		} else if (windowpos >= stickermax) {
			s.removeClass(); //un-stick
			s.css({position: "absolute", top: stickermax + "px"}); //set sticker right above the footer
			
		} else {
			s.removeClass(); //top of page
		}
	});
	//alert(stickermax); //uncomment to show max sticker postition value on doc.ready
});
</script>
<div class="menubar">
  <a href="programacion.php" class="op log"></a>
  <a href="programacion.php" class="op lop">Inicio</a>
  <?php if ($_SESSION["tipo"] != 'vendedor'){?><a href="estadisticas.php" class="op mop">Estadisticas</a><?php };?>
<?php if($_SESSION["tipo"] == 'admin'){?>  <a href="usuarios.php" class="op rop">Usuarios</a><?php }else{	?>
  <div class="opb ropb"></div>
  <?php };?>
</div>

<div class="bann">
<div class="subpanel">
 
<!--<a href="datos.php" target="_self" class="losdatos"><img src="ic-sets.png" width="20" height="20" /></a>-->
<!--<div class="elbusc">
<form method="post" action="programacion.php" name="frmRegistro">
 <input type="text" name="buscar" id="textfield" placeholder="Buscar" class="cambusc"/> 
 <input type="image" name="add" src="finder.png" value="Buscar"/>
</form></div>--> 

</div>

    <?php 	
			$created = date("Y-m-d H:i:s");
			//$created = date ( 'Y-m-d H:i:s' , strtotime( "$created -7 hour" ) );//resta 7 horas porque el server esta adelandado 7 horas			
			//echo $created;

if($otro_hoy != ''){	$hoy = $otro_hoy;}
else{  		$hoy = substr($created,0,4).'-'.substr($created,5,2).'-'.substr($created,8,2);		};
//echo $hoy;
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
$sql1 = "SELECT * FROM evento_act WHERE fecha='".$dia_testeo."' ORDER BY fecha DESC";
$result1 = mysql_query($sql1, $conn1);
$row = mysql_fetch_array($result1);
if($row["id"] != ''){ 		$matriz_testeo[$h] = 'ok'; 		};
$dia_testeo = date ( 'Y-m-j' , strtotime( "$dia_testeo +1 day" ) );
}
$mes_sig = date ( 'Y-m-j' , strtotime( "$hoy +1 month" ) );
$mes_ant = date ( 'Y-m-j' , strtotime( "$hoy -1 month" ) );
	?>
         
<div class="today"><span class="day">
<?php $dia_sem= date("w",mktime(0, 0, 0, substr($hoy,5,2), substr($hoy,8,2), substr($hoy,0,4)));	 //localizo el dia de la semana que comienzo el mes
echo replacedia_sem($dia_sem);// dia de la semana en texto?></span>
  <span class="dayn"><?php echo $dia_hoy;// dia del mes en numero?> </span></div>
<div class="cal">
<a href="programacion.php?otro_hoy=<?php echo $mes_ant;?>" class="cal-l"></a>
<a href="programacion.php?est=4&otro_hoy=<?php echo $mes_sig;?>" class="cal-r"></a>
<div class="mbar"> <?php echo replacemes($mes_hoy).' '.$ano_hoy;//mes y año?> </div>
  <div class="daysbar">
  <span class="day-w">dom</span><span class="day-w">lun</span><span class="day-w">mar</span><span class="day-w">mie</span><span class="day-w">jue</span><span class="day-w">vie</span><span class="day-w">sab</span>
  </div>
  <div class="cfl"></div>


<?php /////////////////////////////  CALENDARIO

//echo '<span class="day-a">'.$fecha_inicio.'</span>';
$dias_cap = '::';
$contador_X = 0; //es el contador para saber que dia de la semana cae el 1º dia
$cantidad_dias_rep = 0;
//for ($cantidad_dias_rep = 0; $cantidad_dias_rep < 2;) {	 	// Sigue hasta que se le indica que llega el dia domingo de la sem del ultimo dia (si=1)
//for($cantidad_dias_rep = 1 ; $cantidad_dias_rep < 2 ){
	$empieza = '';
	
for($cantidad_dias_rep = 1 ; $cantidad_dias_rep < 35 ; $cantidad_dias_rep ++){ 
//echo $cantidad_dias_rep.'.';

if($empieza != 'ok'){
$dia= date("w",mktime(0, 0, 0, substr($dia_cuadro,5,2), substr($dia_cuadro,8,2), substr($dia_cuadro,0,4)));	 //localizo el dia de la semana que comienzo el mes
if($contador_X == $dia){		$empieza = 'ok';		};  /// una vez que encuentro el dia empiezo a avanzar
if($contador_X != $dia){echo '<span class="day-a">.</span>';	};
$contador_X = $contador_X + 1;
};

if($empieza == 'ok'){//////////////////////////////  A partir de aqui empiezo a contar

//////////////////////////////////////////////////////////							
// if($matriz_testeo[ (int) substr($dia_cuadro,8,2)] == 'ok' && $empieza == 'ok' && $mes_hoy == substr($dia_cuadro,5,2)){ //condicion de si hay algo ese dia

$hoy0= $dia_cuadro.' 00:00:00';
$hoy3= $dia_cuadro.' 23:59:00';

$sqlf = "SELECT * FROM evento_act WHERE  fecha>='".$hoy0."' AND fecha<'".$hoy3."' ORDER BY fecha ASC";	
$resultf = mysql_query($sqlf, $conn1);
$rowf = mysql_fetch_array($resultf);
//$dias_cap .= '... ('.$hoy0.'*'.$hoy3.') '.$rowf["id"];


						$mescc = mktime( 0, 0, 0, substr($hoy,5,2), 1, substr($hoy,0,4) ); //encontrar ultimo dia del mes
						$ultimo_diacc = date("t",$mescc);
						$fech_compl_ultimo = substr($hoy,0,4).'-'.substr($hoy,5,2).'-'.$ultimo_diacc;
//						echo '('.$ultimo_diacc.')';
						//if(substr($dia_cuadro,8,2) == $ultimo_diacc){ $empieza = 'ultimo';		};//*/
						$mes_cuadro_cc = substr($dia_cuadro,5,2);
	//	if ($dia_cuadro <= $fech_compl_ultimo){
		if ($mes_cuadro_cc == $mes_hoy){
			if ($hoy == $dia_cuadro){	echo '<span class="day-a cact">';
			}else{echo '<span class="day-a'; 		if($rowf["id"] != ''){ echo ' cact2';}; 		echo '">';};				
							echo '<a href="programacion.php?est=4&otro_hoy='.$dia_cuadro.'" class="day-a">';							
							$dia_calend = substr($dia_cuadro,8,2);
							//echo str_pad(substr($dia_cuadro,8,2), 2, "0", STR_PAD_LEFT); 
							echo str_pad($dia_calend, 2, "0", STR_PAD_LEFT);// pone "0" (cero) a la izquierda si hace falta
							echo '</a>';
			echo '</span>';
		}
							$cuenta_dias = $cuenta_dias + 1;		
							//$dia_ultimo = $dia_cuadro;
						//	$dia_cuadro = date ( 'Y-m-j' , strtotime( "$dia_cuadro00 +1 day" ) );
						
					//		$dia_siguiente = substr($dia_cuadro,8,2) + 1;
							$dia_siguiente = date ( 'Y-m-j' , strtotime( "$dia_cuadro +1 day" ) ); 
					//		$dia_cuadro = substr($dia_cuadro,0,4).'-'.substr($dia_cuadro,5,2).'-'.$dia_siguiente; 
							$dia_cuadro = $dia_siguiente;	
							if($dia_cuadro == $fecha_fin){$cantidad_dias_rep =1;};//*/

};
?>
<?php 	}// del for*/   //  CALENDARIO?>
  </div>		<?php //echo $created;?>
<div class="bite"><a href="agregar-evento.php" class="baddb">.</a>EVENTO<?php //echo $dias_cap;?></div>
<div class="bite"><a href="cliente.php" class="badd">.</a>CLIENTE<?php //echo $dias_cap;?></div>


<div class="cf"></div><!--
    <div class="icons-men"><a href="doctor.php"><img src="ic-usuario.png" width="31" height="20" />DOCTORES</a></div>
    <div class="icons-men" style=" margin-right:50px;"><a href="productos.php"><img src="ic-usuario.png" width="31" height="20" />PRODUCTOS</a></div>
    -->
    
</div>


<div class="onecolc"> 


 <?php //echo $buscar;
 $espaciado = 0;
 $veces_text = 0;
 $fecha_hora1 = $hoy.' 00:00:00';
 $fecha_hora3 = $hoy.' 23:59:59';
 $dia_sem1= date("w",mktime(0, 0, 0, substr($hoy,5,2), substr($hoy,8,2), substr($hoy,0,4)));	 //localizo el dia de la semana que comienzo el mes
 $restadiasen = 6 - $dia_sem1;
 $fecha_hora2 = date ( 'Y-m-j' , strtotime( "$hoy +$restadiasen day" ) ).' 23:59:00';
// echo $fecha_hora1.'__    __'.$fecha_hora3;
 //echo 'frefre'.$fecha_hora2;

$sql1 = "SELECT * FROM evento_act WHERE fecha>='".$fecha_hora1."' AND fecha<'".$fecha_hora2."' ORDER BY fecha ASC";
$result1 = mysql_query($sql1, $conn1);
while($row = mysql_fetch_array($result1)){
	//localizo el dia de la semana que comienzo el mes
	$dia_sem= date("w",mktime(0, 0, 0, substr($row["fecha"],5,2), substr($row["fecha"],8,2), substr($row["fecha"],0,4)));	

		$sql2 = "SELECT * FROM evento WHERE id='".$row["evento"]."' ORDER BY id ASC";
		$result2 = mysql_query($sql2, $conn1);
		$row2 = mysql_fetch_array($result2); 

	if( $veces_text == 0){	
		$diacambio = substr($row["fecha"],8,2);
		};
?>
<? 	$dia_registrado = substr($row["fecha"],0,4).'-'.substr($row["fecha"],5,2).'-'.substr($row["fecha"],8,2);
	if ($dia_bandera != $dia_registrado){ $dia_bandera = $dia_registrado;?>
<span class="titlecol tcolor"<?php if(substr($row["fecha"],8,2) != $dia_hoy){echo ' style="margin-top:25px"';};?>><!--PROGRAMACIÓN --><?php echo replacedia_sem($dia_sem);?>
<?php echo ', '.substr($row["fecha"],8,2).' '.replacemes(substr($row["fecha"],5,2));// dia de la semana en texto y numero?>



<?php
$fecha_hora1b = substr($row["fecha"],0,10).' 00:00:00';
$fecha_hora2b = substr($row["fecha"],0,10).' 23:59:59';
$sql1c = "SELECT * FROM evento_act WHERE fecha>='".$fecha_hora1b."' AND fecha<'".$fecha_hora2b."' ORDER BY fecha ASC";
$result1c = mysql_query($sql1c, $conn1);
$total_registros = mysql_num_rows($result1c);
?>
<span class="eventnum"><?php echo $total_registros;?></span> <span class="tamev">Evento<?php if($total_registros > 1){echo 's';};?></span>
</span> 
 

<div class="divline"></div>
<div id="stickem"></div>
  <?php if( $veces_text == 0 || $diacambio != substr($row["fecha"],8,2) ){?>
  <div id="sticker">
  
    <div class="time-s ti" ice:editable="*">HORA</div>
    <div class="t-contact">CLIENTE</div>
    <div class="t-actividad">ACTIVIDAD</div>
    <div class="t-desit">PROYECTO</div>
    <div class="t-progres">PROGRESO</div>
  </div>   
<?php };	 $veces_text = 1;	};?>
  <div class="initem"<?php  if($espaciado == 1){echo 'style="margin-top:15px"';}//para el espaciado entre items
			else{echo 'style="margin-top:15px"';};	?>>
            
    
    <a href="agregar-evento.php?id=<?php echo $row["id"];?>" target="_self">  
    	<div class="time-j ti"><?php echo substr($row["fecha"],11,5);?></div>  
    </a>  
    
    
    <div class="contact">  <?php
		$sql3 = "SELECT * FROM cliente WHERE id='".$row2["cliente"]."' ORDER BY id ASC";
		$result3 = mysql_query($sql3, $conn1);
		$row3 = mysql_fetch_array($result3);
		echo $row3["nombre_empresa"];// ·EMPRESA·		?>
	</div>


    <div class="actividad"> <?php 
		$sql3 = "SELECT * FROM evento_cat WHERE id='".$row["evento_cat"]."' ORDER BY id ASC";
		$result3 = mysql_query($sql3, $conn1);
		$row3 = mysql_fetch_array($result3);
        echo $row3["nombre"]; ///////////	ACTIVIDAD?></div>
    

    <div class="t-desit">    	<?php 	echo $row2["evento"];// EVENTO?>   </div>
    
    <?php if($_SESSION["tipo"] == 'admin'){?>
<div class="ic-idel"><a href="agregar-evento.php?id=<?php echo $row["id"];?>" target="_self"><img src="editaricon.png" width="44" height="44" border="0" /></a></div>
    <?php };?> 
 
 

    <div class="t-progres imgalcost"> 
    <?php 
    	$sql5 = "SELECT * FROM evento_act WHERE evento='".$row["evento"]."' AND evento_cat ='1' ORDER BY id DESC";// Llamada
		$result5 = mysql_query($sql5, $conn1);
		$row5 = mysql_fetch_array($result5); 

    	if($row5["id"] == $row["id"]){
    ?>
    		<img src="telefono.png" width="42" height="42" border="0" />

    <?php }elseif($row5["checkedeve"] == '1'){?>
    		<img src="telefono.png" width="42" height="42" border="0" />
    		
    <?php }else{?>
    		<img src="gristelefono.png" width="42" height="42" border="0" />
    <?php };?>

    <?php 
    	$sql5 = "SELECT * FROM evento_act WHERE evento='".$row["evento"]."' AND evento_cat ='2' ORDER BY id DESC";// Visita
		$result5 = mysql_query($sql5, $conn1);
		$row5 = mysql_fetch_array($result5); 

    	if($row5["id"] == $row["id"]){
    ?>
    		<img src="azulcasa.png" width="42" height="42" border="0" />

    <?php }elseif($row5["checkedeve"] == '1'){?>
    		<img src="casaicon.png" width="42" height="42" border="0" />
    		
    <?php }else{?>
    		<img src="griscasa.png" width="42" height="42" border="0" />
    <?php };?>

    <?php 
    	$sql5 = "SELECT * FROM evento_act WHERE evento='".$row["evento"]."' AND evento_cat ='5' ORDER BY id DESC";// Diagnostico
		$result5 = mysql_query($sql5, $conn1);
		$row5 = mysql_fetch_array($result5); 

    	if($row5["id"] == $row["id"]){
    ?>
    		<img src="amarillodiagnostico.png" width="42" height="42" border="0" />

    <?php }elseif($row5["checkedeve"] == '1'){?>
    		<img src="diagnostico.png" width="42" height="42" border="0" />
    		
    <?php }else{?>
    		<img src="grisdiagnostico.png" width="42" height="42" border="0" />
    <?php };?>

    <?php 
    	$sql5 = "SELECT * FROM evento_act WHERE evento='".$row["evento"]."' AND evento_cat ='3' ORDER BY id DESC";// Cotizacion
		$result5 = mysql_query($sql5, $conn1);
		$row5 = mysql_fetch_array($result5); 

    	if($row5["id"] == $row["id"]){
    ?>
    		<img src="rojomonto.png" width="42" height="42" border="0" />

    <?php }elseif($row5["checkedeve"] == '1'){?>
    		<img src="monto.png" width="42" height="42"" border="0" />
    		
    <?php }else{?>
    		<img src="grismonto.png" width="42" height="42" border="0" />
    <?php };?>

    <?php 
    	$sql5 = "SELECT * FROM evento_act WHERE evento='".$row["evento"]."' AND evento_cat ='4' ORDER BY id DESC";// Cierre
		$result5 = mysql_query($sql5, $conn1);
		$row5 = mysql_fetch_array($result5); 

    	if($row5["id"] == $row["id"]){
    ?>
    		<img src="palomitaverde.png" width="42" height="42" border="0" />

    <?php }elseif($row5["checkedeve"] == '1'){?>
    		<img src="flechaabajo.png" width="42" height="42" border="0" />
    		
    <?php }else{?>
    		<img src="palomagris.png" width="42" height="42" border="0" />
    <?php };?>

    <?php 
    	$sql5 = "SELECT * FROM evento_act WHERE evento='".$row["evento"]."' AND evento_cat ='6' ORDER BY id DESC";// Muestra
		$result5 = mysql_query($sql5, $conn1);
		$row5 = mysql_fetch_array($result5); 

    	if($row5["id"] == $row["id"]){
    ?>
    		<img src="azulflechaabajo.png" width="42" height="42" border="0" />

    <?php }elseif($row5["checkedeve"] == '1'){?>
    		<img src="flechaabajo.png" width="42" height="42" border="0" />
    		
    <?php }else{?>
    		<img src="grisflechaabajo.png" width="42" height="42"" border="0" />
    <?php };?>

    </div>
    
    
    
    <!--<div class="i-stat">
    <?php if($row["entregado"] == '1'){?>Entregado<br /><?php }?>
    <?php if($row["pagado"] == '1'){?>Pagado<?php }//*/?>
    <?php if($row["entregado"] != '1' && $row["pagado"] != '1'){?>Capturado	<?php };//*/?>
    </div>-->
    
     

    <br />
<?php };?>  
  
  </div>
  
  
  
  
  
  <?php /*if ($mas != 'ok' && $mas != 'ant'){?>		
  <div class="more1"><a href="programacion.php?mas=ok" target="_self" class="more1">VER MÁS &gt;</a>
  <a href="programacion.php?mas=ant" target="_self" class="more1"> VER ANTERIORES &gt;</a></div>		
  <?php }else{?>
  <div class="more1"><a href="javascript:history.back()" target="_self" class="more1">VOLVER &gt;</a></div>
  <?php };//*/?>
  
  
  
  <div class="cf"></div>
</div>

</div>
</body>
</html>
<?php

	mysql_close($conn1);
	}
else{
	header("location: index.php");
	};	
?>
