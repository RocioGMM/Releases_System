<?php
include ("panel/conn1.php");
include ("panel/rempla_fech.php");

$otro_hoy = $_POST["otro_hoy"];if($otro_hoy == ''){$otro_hoy = $_REQUEST["otro_hoy"];};
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=0.5">
<title>Administrador</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

<link href="styles.css" rel="stylesheet" type="text/css" />
</head>

<body>


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

<!--
<div class="today"><span class="day">
<?php $dia_sem= date("w",mktime(0, 0, 0, substr($hoy,5,2), substr($hoy,8,2), substr($hoy,0,4)));	 //localizo el dia de la semana que comienzo el mes
echo replacedia_sem($dia_sem);// dia de la semana en texto?></span>
  <span class="dayn"><?php echo $dia_hoy;// dia del mes en numero?> </span></div>
-->
  <div class="cal" style="margin:0 !important">
<a href="calendario.php?otro_hoy=<?php echo $mes_ant;?>" class="cal-l"></a>
<a href="calendario.php?est=4&otro_hoy=<?php echo $mes_sig;?>" class="cal-r"></a>
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
							echo '<a href="calendario.php?est=4&otro_hoy='.$dia_cuadro.'" class="day-a">';							
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

</body>
</html>