
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<style>	
	body {	  margin: 0px;  padding: 0px;  font-family: "Open Sans", sans-serif;  font-weight: 300;  color: #777;	}
	.form{max-width:399px;margin-top:35px;} 
</style>
<?php
include ("panel/conn1.php");
include ("panel/rempla_fech.php");

 $id = $_REQUEST["id"];if($id==''){	$id = $_POST["id"];	};

 $fechaest1 = $_POST["fechaest1"];if($fechaest1 == ''){$fechaest1 = $_REQUEST["fechaest1"];};
 $fechaest2 = $_POST["fechaest2"];if($fechaest2 == ''){$fechaest2 = $_REQUEST["fechaest2"];};

 $fechaest1 = str_replace("%20", " ",  $fechaest1);
 $fechaest2 = str_replace("%20", " ",  $fechaest2);

 $email = $_POST["email"];if($email == ''){$email = $_REQUEST["email"];};
 $orden = $_POST["orden"];if($orden == ''){$orden = $_REQUEST["orden"];};
 $ascdes = $_POST["ascdes"];if($ascdes == ''){$ascdes = $_REQUEST["ascdes"];};

 if($_POST["envio"] != ''){
?>
<form method="post" action="enviamail2.php?id=<?php echo $id;?>" name="frmRegistro" enctype="multipart/form-data" class="form" >
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



$cuerpomess = '
<style>
	body {	  margin: 0px;  padding: 0px;  font-family: "Open Sans", sans-serif;  font-weight: 300;  color: #777;	}
	.cuerpodelbx{width:100%;}
	.tituloscelestes{	  color: #0fa7bf;  font-size: 18px;  	}
	.t-progres {	    width: 15%;  padding-top: 7px;	}
	.t-desit{		   width: 18%;   padding-top: 7px; margin-left: 2%;	}
	.t-contact {	    width: 18%;  margin-left: 2%;  padding-top: 7px;	}
	.time-s{		width: 40% !important;	  padding-top: 7px;margin-left: 2%;	}
	.backgris{background-color:#f1f1f1 !important;}
	#sticker{  margin-bottom: 15px;  background-color: #CCC;  padding-top: 3px;  padding-bottom: 10px;  background-color: rgba(255, 255, 255, 0.95);  height: 24px;
  width: 100%;}
    .totals{  width: 42px;  margin-right: 9px;  color: #53b768;  font-size: 12px;  text-align: center;}
</style>
<table class="cuerpodelbx">
	<tr id="sticker">  
    	<td class="t-progres tituloscelestes" ice:editable="*">PROYECTO</td>
    	<td class="t-desit tituloscelestes">CLIENTE</td>
    	<td class="t-contact tituloscelestes">FECHA DE INICIO</td>
    	<td class="time-s tituloscelestes">PROGRESO</td>
  	</tr>
';
//echo 'iiiiii '.$id;

		$sql11a = "SELECT * FROM evento_act WHERE vendedor='".$id."' AND evento_cat ='1' AND checkedeve='1' ORDER BY id DESC";// Llamada
        $result11a = mysql_query($sql11a, $conn1); 
        $total_llamadas1 = mysql_num_rows($result11a);       
        $sql11a = "SELECT * FROM evento_act WHERE vendedor='".$id."' AND evento_cat ='2' AND checkedeve='1' ORDER BY id DESC";// Visita
        $result11a = mysql_query($sql11a, $conn1);        
        $total_visitas1 = mysql_num_rows($result11a);       
        $sql11a = "SELECT * FROM evento_act WHERE vendedor='".$id."' AND evento_cat ='5' AND checkedeve='1' ORDER BY id DESC";// diagnostico
        $result11a = mysql_query($sql11a, $conn1);        
        $total_diagnosticos1 = mysql_num_rows($result11a);       
        $sql11a = "SELECT * FROM evento_act WHERE vendedor='".$id."' AND evento_cat ='3' AND checkedeve='1' ORDER BY id DESC";// cotizacion
        $result11a = mysql_query($sql11a, $conn1);        
        $total_cotizacion1 = mysql_num_rows($result11a);       
        $sql11a = "SELECT * FROM evento_act WHERE vendedor='".$id."' AND evento_cat ='6' AND checkedeve='1' ORDER BY id DESC";// Muestra
        $result11a = mysql_query($sql11a, $conn1);        
        $total_muestra1 = mysql_num_rows($result11a);       
        $sql11a = "SELECT * FROM evento_act WHERE vendedor='".$id."' AND evento_cat ='4' AND checkedeve='1' ORDER BY id DESC";// Cierre
        $result11a = mysql_query($sql11a, $conn1);        
        $total_cierre1 = mysql_num_rows($result11a); 


$cuerpomess .= '
  <tr class="t-progres">

    	<td class="t-progres tituloscelestes" ice:editable="*"></td>
    	<td class="t-desit tituloscelestes"></td>
    	<td class="t-contact tituloscelestes"></td>
    	<td class="time-s tituloscelestes"><table><tr>
      		<td class="totals">'.$total_llamadas1.'</td>
      		<td class="totals">'.$total_visitas1.'</td>
      		<td class="totals">'.$total_diagnosticos1.'</td>
      		<td class="totals">'.$total_cotizacion1.'</td>
      		<td class="totals">'.$total_muestra1.'</td>
      		<td class="totals">'.$total_cierre1.'</td>
      	<tr></table></td>
  </tr>
'; 
$cuentais = 0;


$sql2 = "SELECT * FROM evento WHERE vendedor='".$id."' ORDER BY fecha_captura DESC";
$result2 = mysql_query($sql2, $conn1);
while($row2 = mysql_fetch_array($result2)){
		$sql9h= "SELECT * FROM cliente WHERE id='".$row2["cliente"]."' ORDER BY nombre_empresa ASC";
        $result9h = mysql_query($sql9h, $conn1);
        $row9h = mysql_fetch_array($result9h);
        if($cuentais == '0'){$classt = 'backgris';}else{$classt = '';};
		$cuentais = $cuentais + 1;
		if($cuentais=='2'){$cuentais = '0';};

		$sql5 = "SELECT * FROM evento_act WHERE evento_cat ='1' AND evento='".$row2["id"]."' AND checkedeve='1' ORDER BY id DESC";// Llamada
		$result5 = mysql_query($sql5, $conn1);
		$row5 = mysql_fetch_array($result5); 
		if($row5["id"] == ''){	$iconotel = 'gristelefono.png';		}
		else{	$iconotel = 'telefono.png';	};

    	$sql5 = "SELECT * FROM evento_act WHERE evento_cat ='2' AND evento='".$row2["id"]."' AND checkedeve='1' ORDER BY id DESC";// Llamada
		$result5 = mysql_query($sql5, $conn1);
		$row5 = mysql_fetch_array($result5); 
		if($row5["id"] == ''){	$iconocas = 'griscasa.png';		}
		else{	$iconocas = 'casaicon.png';	};

    	$sql5 = "SELECT * FROM evento_act WHERE evento_cat ='5' AND evento='".$row2["id"]."' AND checkedeve='1' ORDER BY id DESC";// Llamada
		$result5 = mysql_query($sql5, $conn1);
		$row5 = mysql_fetch_array($result5); 
		if($row5["id"] == ''){	$iconodia = 'grisdiagnostico.png';		}
		else{	$iconodia = 'diagnostico.png';	};

    	$sql5 = "SELECT * FROM evento_act WHERE evento_cat ='3' AND evento='".$row2["id"]."' AND checkedeve='1' ORDER BY id DESC";// Llamada
		$result5 = mysql_query($sql5, $conn1);
		$row5 = mysql_fetch_array($result5); 
		if($row5["id"] == ''){	$iconocot = 'grismonto.png';		}
		else{	$iconocot = 'monto.png';	};

    	$sql5 = "SELECT * FROM evento_act WHERE evento_cat ='6' AND evento='".$row2["id"]."' AND checkedeve='1' ORDER BY id DESC";// Llamada
		$result5 = mysql_query($sql5, $conn1);
		$row5 = mysql_fetch_array($result5); 
		if($row5["id"] == ''){	$iconomues = 'grisflechaabajo.png';		}
		else{	$iconomues = 'telefono.png';	};

    	$sql5 = "SELECT * FROM evento_act WHERE evento_cat ='4' AND evento='".$row2["id"]."' AND checkedeve='1' ORDER BY id DESC";// Llamada
		$result5 = mysql_query($sql5, $conn1);
		$row5 = mysql_fetch_array($result5); 
		if($row5["id"] == ''){	$iconocie = 'palomagris.png';		}
		else{	$iconocie = 'palomitaverde.png';	};

	$cuerpomess .= ' 
	  <tr id="sticker" class="'.$classt.'"> 	    	
    	<td class="t-progres tituloscelestes" ice:editable="*">'.$row2["evento"].'</td>
    	<td class="t-desit tituloscelestes">'.$row9h["nombre_empresa"].'</td>
    	<td class="t-contact tituloscelestes">'.substr($row2["fecha_captura"],8,2).' '.replacemes(substr($row2["fecha_captura"],5,2)).'</td>
    	<td class="time-s tituloscelestes"><table><tr>
      		<td class="totals"><img src="http://northwest.com.mx/ejecutivos/'.$iconotel.'" width="42" height="42" border="0" /></td>
      		<td class="totals"><img src="http://northwest.com.mx/ejecutivos/'.$iconocas.'" width="42" height="42" border="0" /></td>
      		<td class="totals"><img src="http://northwest.com.mx/ejecutivos/'.$iconodia.'" width="42" height="42" border="0" /></td>
      		<td class="totals"><img src="http://northwest.com.mx/ejecutivos/'.$iconocot.'" width="42" height="42" border="0" /></td>
      		<td class="totals"><img src="http://northwest.com.mx/ejecutivos/'.$iconomues.'" width="42" height="42" border="0" /></td>
      		<td class="totals"><img src="http://northwest.com.mx/ejecutivos/'.$iconocie.'" width="42" height="42" border="0" /></td>
      	<tr></table></td>
	  </tr>
	  ';
  };//*/

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