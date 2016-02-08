<?php
session_start();
set_time_limit(5555);
ini_set('post_max_size','100M');
ini_set('upload_max_filesize','100M');
ini_set('max_execution_time','1000');
ini_set('max_input_time','1000');

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){

include ("conn1.php");

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};


$acc = $_POST["acc"];
$tipolv = $_POST["tipolv"];
$expediente = $_POST["expediente"];
$link = $_POST["link"];
$encadenamiento = $_POST["encadenamiento"];
$afectacion = $_POST["afectacion"];
$M2 = $_POST["M2"];
$superficie = $_POST["superficie"];
$RPA = $_POST["RPA"];
$contrato = $_POST["contrato"];
$superficie_escrituras = $_POST["superficie_escrituras"];
$nombre = $_POST["nombre"];
$nro_lote = $_POST["nro_lote"];
$ultima_actualizacion = date("Y-m-d H:i:s");
$libramiento = $_POST["id"];
$tipo = $_POST["tipo"];
$estado = $_POST["estado"];
$fecha = date("Y-m-d H:i:s");
$comentario = $_POST["comentario"];
$vi = $_POST["vi"];
$docu_acred = $_POST["docu_acred"];
$docu_regitro_publ = $_POST["docu_regitro_publ"];
$observaciones = $_POST["observaciones"];
$certificado_gravamen = $_POST["certificado_gravamen"];
$certificado_no_adeudo = $_POST["certificado_no_adeudo"];
$clave_catastral = $_POST["clave_catastral"];
$observaciones2 = $_POST["observaciones2"];


	$archivo = date("Ymd").''.$_FILES['userfile1']['name'];
	$archivo = str_replace(" ","",$archivo);
	$archivo = str_replace("(","",$archivo);
	$archivo = str_replace(")","",$archivo);
	$archivo = str_replace(",","",$archivo);
	$archivo = str_replace("ñ","n",$archivo);
	$archivo = str_replace("á","a",$archivo);
	$archivo = str_replace("é","e",$archivo);
	$archivo = str_replace("í","i",$archivo);
	$archivo = str_replace("ó","o",$archivo);
	$archivo = str_replace("ú","u",$archivo);
	$archivo = str_replace("*","",$archivo);
	$archivo = str_replace("#","",$archivo);
	$archivo = str_replace("Ñ","n",$archivo);
	$archivo = str_replace("Á","a",$archivo);
	$archivo = str_replace("É","e",$archivo);
	$archivo = str_replace("Í","i",$archivo);
	$archivo = str_replace("Ó","o",$archivo);
	$archivo = str_replace("Ú","u",$archivo);
	$archivo = str_replace("Ã","a",$archivo);
	$archivo = str_replace("!","",$archivo);
	$archivo = str_replace("¡","",$archivo);
	$archivo = str_replace("?","",$archivo);
	$tipo1 = $_FILES['userfile1']['type'];
	$peso1 = $_FILES['userfile1']['size'];	

if($_SESSION["tipo"] == 'admin') {
	 $lugar = $_POST["lugar"];
}else{
	 $lugar = $_SESSION["lugar"];
};

if($lugar == ''){$lugar = '1';};


if ($id == ''){ 
        $sqlver= "SELECT * FROM libramientos WHERE expediente='".$expediente."' ORDER BY id ASC";       
        $resultver = mysql_query($sqlver, $conn1);
        $rowver = mysql_fetch_array($resultver);

	if ($rowver["id"] == ''){ ////////////////////////////// ver si el libramiento existe
	$sql11 = "INSERT INTO libramientos(lugar, expediente, nombre, nro_lote, ultima_actualizacion, fecha, docu_acred, docu_regitro_publ, 
		observaciones, certificado_gravamen, certificado_no_adeudo, clave_catastral, observaciones2, encadenamiento, afectacion, M2, superficie,
		RPA, contrato, superficie_escrituras, tipo) 
	VALUES('".$lugar."', '".$expediente."', '".$nombre."', '".$nro_lote."', '".$ultima_actualizacion."', '".$ultima_actualizacion."',
		'".$docu_acred."', '".$docu_regitro_publ."', '".$observaciones."', '".$certificado_gravamen."', '".$certificado_no_adeudo."', 
		'".$clave_catastral."',	'".$observaciones2."', '".$encadenamiento."', '".$afectacion."', '".$M2."', '".$superficie."', '".$RPA."', 
		'".$contrato."', '".$superficie_escrituras."', '".$tipolv."')";
	$result = mysql_query($sql11);

        $sql9h= "SELECT * FROM libramientos WHERE expediente='".$expediente."' AND ultima_actualizacion='".$ultima_actualizacion."' AND ORDER BY id ASC";       
        $result9h = mysql_query($sql9h, $conn1);
        $row9h = mysql_fetch_array($result9h);
        $libramiento = $row9h["id"];
		
		if($tipo != ''){
				if ($_FILES['userfile1']['name'] != ''){
						if (!(strpos($tipo1, "msword")) && !(strpos($tipo1, "pdf")) && !(strpos($tipo1, "x-download")) && !(strpos($tipo1, "octet-stream")) && !(strpos($tipo1, "zip")) && !(strpos($tipo1, "jpeg")) && !(strpos($tipo1, "x-shockwave-flash")) && ($peso < 2000000)){
								header("location: agregar_libra.php?err=imgprin");
							}
						else{
							if (move_uploaded_file($_FILES['userfile1']['tmp_name'], "../archivo/".$archivo)){
								$sql2 = "INSERT INTO progreso(libramiento, tipo, archivo, estado, fecha, comentario, link) 
								VALUES('".$libramiento."', '".$tipo."', '".$archivo."', '".$estado."', '".$fecha."', '".$comentario."', '".$link."')";
								$result2 = mysql_query($sql2);
								}
							else{
								header("location: ../agregar-libra.php?lugar=".$lugar."&id=".$libramiento.'&err=upload');
								};
							};
				}else{
					$sql2 = "INSERT INTO progreso(libramiento, tipo, estado, fecha, comentario, link) 
					VALUES('".$libramiento."', '".$tipo."', '".$estado."', '".$fecha."', '".$comentario."', '".$link."')";
					$result2 = mysql_query($sql2);
				};
			};
				//*/

		}/////////////////////// fin de IF ver si el libramiento existe
		else{
			header("location: ../agregar-libra.php?lugar=".$lugar."&id=".$rowver["id"]);
		};
								
}else{
	if($acc == 'mod'){
			$sql1lb = "UPDATE libramientos SET lugar='".$lugar."', expediente='".$expediente."', nombre='".$nombre."',
			nro_lote='".$nro_lote."', ultima_actualizacion='".$ultima_actualizacion."', docu_acred='".$docu_acred."',
			docu_regitro_publ='".$docu_regitro_publ."', observaciones='".$observaciones."', certificado_gravamen='".$certificado_gravamen."', 
			certificado_no_adeudo='".$certificado_no_adeudo."',	clave_catastral='".$clave_catastral."', observaciones2='".$observaciones2."', 
			encadenamiento='".$encadenamiento."', afectacion='".$afectacion."', M2='".$M2."', superficie='".$superficie."',	RPA='".$RPA."', 
			contrato='".$contrato."', superficie_escrituras='".$superficie_escrituras."', tipo='".$tipolv."'  WHERE id=".$id;
			$resultlb = mysql_query($sql1lb);
			$sss = $id;
	};
	if ($_FILES['userfile1']['name'] != ''){
			if (!(strpos($tipo1, "msword")) && !(strpos($tipo1, "pdf")) && !(strpos($tipo1, "x-download")) && !(strpos($tipo1, "octet-stream")) && !(strpos($tipo1, "zip")) && !(strpos($tipo1, "jpeg")) && !(strpos($tipo1, "x-shockwave-flash")) && ($peso < 2000000)){
					header("location: agregar_libra.php?err=imgprin");
				}
			else{
				if (move_uploaded_file($_FILES['userfile1']['tmp_name'], "../archivo/".$archivo)){
					$sql2 = "INSERT INTO progreso(libramiento, tipo, archivo, estado, fecha, comentario, link) 
					VALUES('".$libramiento."', '".$tipo."', '".$archivo."', '".$estado."', '".$fecha."', '".$comentario."', '".$link."')";
					$result2 = mysql_query($sql2);
					}
				else{
					header("location: ../agregar-libra.php?lugar=".$lugar."&id=".$libramiento.'&err=upload');
					};
				};
	}elseif($tipo != ''){
		$sql2 = "INSERT INTO progreso(libramiento, tipo, estado, fecha, comentario, link) 
		VALUES('".$libramiento."', '".$tipo."', '".$estado."', '".$fecha."', '".$comentario."', '".$link."')";
		$result2 = mysql_query($sql2);
		
		$sql1lb = "UPDATE libramientos SET ultima_actualizacion='".$ultima_actualizacion."'  WHERE id=".$libramiento;
		$resultlb = mysql_query($sql1lb);
	};
};
		
	if($id == ''){			
		$sql1= "SELECT * FROM libramientos WHERE expediente='".$expediente."' ORDER BY id DESC";  
		$result1 = mysql_query($sql1, $conn1);
		$total_registrosdeldia = mysql_num_rows($result1);
		header("location: ../agregar-libra.php?lugar=".$lugar."&sss=".$sss."&id=".$libramiento);		
	}
	else{
		header("location: ../agregar-libra.php?lugar=".$lugar."&id=".$libramiento);
	};
	
				mysql_close($conn1);
				$llego = 'ok';
};
?>