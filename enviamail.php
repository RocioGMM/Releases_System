
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<style>	
	body {	  margin: 0px;  padding: 0px;  font-family: "Open Sans", sans-serif;  font-weight: 300;  color: #777;	}
	.form{max-width:399px;margin-top:35px;} 
</style>
<?php
include ("panel/conn1.php");
include ("panel/rempla_fech.php");
 $fechaest1 = $_POST["fechaest1"];
 $fechaest2 = $_POST["fechaest2"];

 $fechaest1 = str_replace("%20", " ",  $fechaest1);
 $fechaest2 = str_replace("%20", " ",  $fechaest2);

 $email = $_POST["email"];if($email == ''){$email = $_REQUEST["email"];};
 $orden = $_POST["orden"];if($orden == ''){$orden = $_REQUEST["orden"];};
 $ascdes = $_POST["ascdes"];if($ascdes == ''){$ascdes = $_REQUEST["ascdes"];};

 if($_POST["envio"] == ''){
?>
<form method="post" action="enviamail.php" name="frmRegistro" enctype="multipart/form-data" class="form" >
<input type="hidden" name="fechaest1" value="<?php echo $fechaest1;?>"/>
<input type="hidden" name="fechaest2" value="<?php echo $fechaest2;?>"/>
<input type="hidden" name="orden" value="<?php echo $orden;?>"/>
<input type="hidden" name="ascdes" value="<?php echo $ascdes;?>"/>
Ingrese un EMAIL
<input type="text" name="email" id="textfield" placeholder="E-Mail"/>
<input type="submit" name="envio"  value="Enviar" class="rax"/> 	
</form>
<?php
};

if($_POST["envio"] != ''){
 $espaciado = 0;
 $veces_text = 0;

 if($fechaest1 == '' || $fechaest2 == ''){
	 $dia_sem1= date("w",mktime(0, 0, 0, substr($hoy,5,2), substr($hoy,8,2), substr($hoy,0,4)));	 //localizo el dia de la semana que comienzo el mes
	 $restadiasen = 6 - $dia_sem1;
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

$cuerpomess = '
<style>
	body {	  margin: 0px;  padding: 0px;  font-family: "Open Sans", sans-serif;  font-weight: 300;  color: #777;	}
	.cuerpodelbx{width:100%;}
	.tituloscelestes{	  color: #0fa7bf;  font-size: 18px;  	}
	.t-progres {	    width: 30%;  padding-top: 7px;	}
	.t-desit{		   width: 18%;   padding-top: 7px;	}
	.t-contact {	    width: 18%;  margin-left: 2%;  padding-top: 7px;	}
	.time-s{		width: 10% !important;	  padding-top: 7px;	}
	.backgris{background-color:#f1f1f1 !important;}
	#sticker{
  margin-bottom: 15px;
  background-color: #CCC;
  padding-top: 3px;
  padding-bottom: 10px;
  background-color: rgba(255, 255, 255, 0.95);
  height: 24px;
  width: 100%;}
</style>
<table class="cuerpodelbx">
	<tr id="sticker">  
    	<td class="t-progres tituloscelestes" ice:editable="*">VENDEDOR</td>
    	<td class="t-desit tituloscelestes">EVENTOS EN PROCESO</td>
    	<td class="t-contact tituloscelestes">COTIZACIONES</td>
    	<td class="time-s tituloscelestes">CIERRES</td>
  	</tr>
';

for($i = 0; $i < $cantven; $i++){//recorro todos los vendedores en el orden elegido
	//echo $i.':::'.$array[$i]["id"].' - ';
$sql1 = "SELECT * FROM vendedor WHERE id='".$array[$i]["id"]."' ";
$result1 = mysql_query($sql1, $conn1);
$row = mysql_fetch_array($result1);

$array[$i]["nombre"] = $row["nombre"].' '.$row["apellido"];

		$cantcierreproc = 0; $cantproc = 0;
		$sql3 = "SELECT * FROM evento WHERE fecha_captura<='".$fecha_hora2."' AND fecha_captura>='".$fecha_hora1."' AND vendedor = '".$row["id"]."' ";
		$result3 = mysql_query($sql3, $conn1);
		while($row3 = mysql_fetch_array($result3)){
		$sql7 = "SELECT * FROM evento_act WHERE  evento = '".$row3["id"]."'  AND evento_cat = '4' AND checkedeve != '1' ";
		$result7 = mysql_query($sql7, $conn1);
		$row7 = mysql_fetch_array($result7);
			$cantcierreproc = $cantcierreproc + 1;			
		};
$array[$i]["cantcierreproc"] = $cantcierreproc;// EVENTOS EN PROCESO	
$totalproceso = $totalproceso + $cantcierreproc;
		$cantcotiza = 0;
		$sql3 = "SELECT * FROM evento_act WHERE fecha>='".$fecha_hora1."' AND fecha<'".$fecha_hora2."' AND evento_cat = '3' AND vendedor = '".$row["id"]."' ORDER BY fecha ASC";
		$result3 = mysql_query($sql3, $conn1);
		while($row3 = mysql_fetch_array($result3)){
			if($row3["checkedeve"] == '1'){$cantcotiza = $cantcotiza + 1;};			
		};
$array[$i]["cantcotiza"] = $cantcotiza;// COTIZACIONES		
$totalcotizaciones = $totalcotizaciones + $cantcotiza;
		$cantcierre = 0;
		$sql3 = "SELECT * FROM evento_act WHERE fecha>='".$fecha_hora1."' AND fecha<'".$fecha_hora2."' AND evento_cat = '4' AND vendedor = '".$row["id"]."' ORDER BY fecha ASC";
		$result3 = mysql_query($sql3, $conn1);
		while($row3 = mysql_fetch_array($result3)){
			if($row3["checkedeve"] == '1'){$cantcierre = $cantcierre + 1;};			
		};
$array[$i]["cantcierre"] = $cantcierre;// CIERRES	
$totalcierre = $totalcierre + $cantcierre;
 };	///////////////////////////////////////////////////////////				FIN DEL FOR 			

$cuerpomess .= '
  <tr class="initem escprin">
    <td class="t-progres chi" ></td>
    <td class="t-desit clirs" id="totalproceso">'.$totalproceso.'</td>
    <td class="t-contact clirs" id="totalcotizaciones">'.$totalcotizaciones.'</td>
    <td class="time-s ti clirs" id="totalcierre">'.$totalcierre.'</td>
  </tr>
'; 
$cuentais = 0;
for($i = 0; $i < $cantven; $i++){//recorro todos los vendedores en el orden elegido
	if($cuentais == '0'){$classt = 'backgris';}else{$classt = '';};
	$cuentais = $cuentais + 1;
	if($cuentais=='2'){$cuentais = '0';};
	$cuerpomess .= ' 
	  <tr id="sticker" class="'.$classt.'">  
	    	<td class="t-progres">'.$array[$i]["nombre"].'</td>
	    	<td class="t-desit">'.$array[$i]["cantcierreproc"].'</td>
	    	<td class="t-contact">'.$array[$i]["cantcotiza"].'</td>
	    	<td class="time-s">'.$array[$i]["cantcierre"].'</td>
	  </tr>
	  ';
  }

$cuerpomess .= '</table>';

	$host = $_SERVER['HTTP_HOST'];
	$asunto = "Estadisticas de vendedores";
	//$to = "rociomorenomuro@hotmail.com"; 
	$email = strip_tags($_POST["email"]);
	$to = $_POST["email"];

	$headers = "From: Concretec <noreply@" . $host . ">\r\n";
	//$headers .= "Reply-To: ". $to . "\r\n";
//	$headers .= "Reply-To: ". strip_tags($_POST['email']) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//echo $cuerpomess;
	if(mail($to, $asunto, $cuerpomess, $headers)){ 
		echo 'El E-Mail Fue enviado correctamente';
	}

	else{
		echo "No se ha podido enviar el mensaje";
	};
};