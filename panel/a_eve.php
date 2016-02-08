<?php 
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){

include ("conn1.php");


$id = $_POST["id"];

$eventoname = $_POST["eventoname"];
$cliente = $_POST["cliente"];
$comentarios = $_POST["comentarios"];
$fecha_captura = date("Y-m-d H:i:s");

$cantidadeveact = $_POST["cantidadeveact"];

if($_SESSION["tipo"] != 'admin'){
	$vendedor = $_SESSION["vendedor"];
}else{
	$vendedor = $_POST["vendedor"];
};

if ($cliente != ''){

	if ($id == ''){//////////agregar
			$sql1 = "INSERT INTO evento(cliente, fecha_captura, comentarios, evento, vendedor) VALUES('".$cliente."', '".$fecha_captura."', '".$comentarios."', '".$eventoname."', '".$vendedor."')";

	}else{//////////modificar
			$sql1 = "UPDATE evento SET cliente='".$cliente."', comentarios='".$comentarios."', evento='".$eventoname."' WHERE id=".$id;
	};
			$result = mysql_query($sql1);
			//mysql_close($conn1);

	//////////////////////////////////////////////////////comienzo de tareas	
		if ($id == ''){//////////agregar
			$sql3 = "SELECT * FROM evento WHERE fecha_captura='".$fecha_captura."' ORDER BY id DESC";
			$result3 = mysql_query($sql3, $conn1);
			$row3 = mysql_fetch_array($result3);
			$evento = $row3["id"];
		};
		if($evento == ''){$evento = $id;};




					for($e = 1 ; $e < $_POST["cant_producto"] + 1 ; $e++){/////// PRODUCTOS
						$id_producto = 'id_producto'.$e;
						$id_producto_ven = 'id_producto_ven'.$e;
						$venta = 'venta'.$e;
						$precio = 'precio'.$e;
						if($_POST[$id_producto_ven] == ''){
							$sql112 = "INSERT INTO producto_venta(producto, venta, precio, evento)
								VALUES('".$_POST[$id_producto]."', '".$_POST[$venta]."', '".$_POST[$precio]."', '".$evento."')";
						}else{
							$sql112 = "UPDATE producto_venta SET venta='".$_POST[$venta]."', precio='".$_POST[$precio]."' WHERE id=".$_POST[$id_producto_ven];
						};
						$result112 = mysql_query($sql112);
						
					}



			//---> pone los distintos evento_act en la BD
					for($i = 1 ; $i < $cantidadeveact + 1 ; $i++){/////// TAREAS
						$evento_cat0 = 'evento_cat'.$i;	
							$evento_cat = $_POST[$evento_cat0];
						$evento_cat_nombre = 'evento_cat_nombre'.$i;
						$importe = 'importe'.$i;
						$folio = 'folio'.$i;
						$archivo = 'userfile'.$i;
						$serie = 'serie'.$i;
						$fecha = 'fecha'.$i;
						$fechafin = 'fechafin'.$i;
						$hora = 'hora'.$i;
						$checkedeve = 'checkedeve'.$i;
						$fechaev = substr($_POST[$fecha],6,4).'-'.substr($_POST[$fecha],3,2).'-'.substr($_POST[$fecha],0,2).' '.$_POST[$hora];
						$idi = 'id'.$i;

						$nombrearch = date("YmdHi").''.$_FILES[$archivo]['name'];
						$tipo1 = $_FILES[$archivo]['type'];
						$peso = $_FILES[$archivo]['size'];
						
						////////// AGREGAR EVENTO_CAT
						if($evento_cat == '0'){
							$sql5 = "INSERT INTO evento_cat(nombre, fecha, archivo, serie, folio, importe, checkedeve, se_publica) 
										VALUES('".$_POST[$evento_cat_nombre]."', '1', '0', '0', '0', '0', '1', 's')";
										$result5 = mysql_query($sql5);
							$sql7 = "SELECT * FROM evento_cat WHERE nombre='".$_POST[$evento_cat_nombre]."' ORDER BY id DESC";
							$result7 = mysql_query($sql7, $conn1);
							$row7 = mysql_fetch_array($result7);
							$evento_cat = $row7["id"];
						};

			///////////////////////////////////////////////////////////////////////////////
			if ($_POST[$idi] == ''){
				if($i > '6'){$fechamuestr1777 = '('.$fechaev.')';};
				if($fechaev == '0000-00-00 00:00:00' && $fechaev == '-- ' && $i > '6'){

				}else{
						if($_FILES[$archivo]['name'] != ''){
							if (!(strpos($tipo1, "msword")) && !(strpos($tipo1, "pdf")) && !(strpos($tipo1, "x-download")) && !(strpos($tipo1, "octet-stream")) 
								&& !(strpos($tipo1, "zip")) && !(strpos($tipo1, "jpeg")) && !(strpos($tipo1, "x-shockwave-flash")) && ($peso < 20000000)){
									header("location: ../agregar-evento.php?id=".$evento);
								}
							else{
									if (move_uploaded_file($_FILES[$archivo]['tmp_name'], "../archivos/".$nombrearch)){
										$sql2 = "INSERT INTO evento_act(evento, evento_cat, fecha, archivo, folio, importe, checkedeve, vendedor, serie, fechafin) 
										VALUES('".$evento."', '".$evento_cat."', '".$fechaev."', '".$nombrearch."', '".$_POST[$folio]."', '".$_POST[$importe]."', 
											'".$_POST[$checkedeve]."', '".$vendedor."', '".$_POST[$serie]."', '".$fechafin."')";
										$result2 = mysql_query($sql2);
										}
									else{	$err = '1';	
										};
								};
						}else{
										$sql2 = "INSERT INTO evento_act(evento, evento_cat, fecha, folio, importe, checkedeve, vendedor, serie, fechafin) 
										VALUES('".$evento."', '".$evento_cat."', '".$fechaev."', '".$_POST[$folio]."', '".$_POST[$checkedeve]."', 
											'".$_POST[$checkedeve]."', '".$vendedor."', '".$_POST[$serie]."', '".$fechafin."')";
										$result2 = mysql_query($sql2);

						};
					};
			}
			///////////////////////////////////////////////////////////////////////////////
			else{
							//$evento = $id;
			//---> pone los distintos evento_act en la BD
					
						if($_FILES[$archivo]['name'] != ''){
							if (!(strpos($tipo1, "msword")) && !(strpos($tipo1, "pdf")) && !(strpos($tipo1, "x-download")) && !(strpos($tipo1, "octet-stream")) 
								&& !(strpos($tipo1, "zip")) && !(strpos($tipo1, "jpeg")) && !(strpos($tipo1, "x-shockwave-flash")) && ($peso < 20000000)){
									header("location: ../agregar-evento.php?id=".$evento);
									}
							else{
									if (move_uploaded_file($_FILES[$archivo]['tmp_name'], "../archivos/".$nombrearch)){
										$sql2 = "UPDATE evento_act SET fecha='".$fechaev."', archivo='".$nombrearch."', folio='".$_POST[$folio]."', 
										importe='".$_POST[$importe]."', checkedeve='".$_POST[$checkedeve]."', serie='".$_POST[$serie]."', fechafin='".$fechafin."' 
										WHERE id=".$_POST[$idi];
										$result2 = mysql_query($sql2);
									}else{	$err = '1';	};
							};
						}else{
										$sql2 = "UPDATE evento_act SET fecha='".$fechaev."', folio='".$_POST[$folio]."', importe='".$_POST[$importe]."', 
										checkedeve='".$_POST[$checkedeve]."', serie='".$_POST[$serie]."', fechafin='".$fechafin."' WHERE id=".$_POST[$idi];
										$result2 = mysql_query($sql2);

						};
					};
			///////////////////////////////////////////////////////////////////////////////
					}// fin del FOR
			//
		
		
					
			//
			//header("location: ../programacion.php?".$_FILES['userfile5']['name']);
};	
//echo 'yea';

		
			if($err == '1'){	header("location: ../agregar-evento.php?id=".$evento);	}
			else{	header("location: ../programacion.php?comentarios=".$comentarios."&SERIE.=".$_POST[$serie1]."&id=".$id."&fechamuestr=".$fechamuestr1777);		};


	mysql_close($conn1);
	}
else{
	header("location: ../login.php");
	};
	?>