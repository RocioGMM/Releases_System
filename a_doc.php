<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){

include ("conn1.php");

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};

$contacto = $_POST["contacto"];
$nombre = $_POST["nombre"];
$email = $_POST["email"];
$celular = $_POST["celular"];
$telefono = $_POST["telefono"];
$colonia = $_POST["colonia"];
$domicilio = $_POST["domicilio"];
$celular = $_POST["celular"];
$ciudad = $_POST["ciudad"];
$estado = $_POST["estado"];
$cospos = $_POST["cp"];
$razonsocial = $_POST["razonsocial"];
$vi = $_POST["vi"];if($vi == ''){$vi = $_REQUEST["vi"];};
$rfc = $_POST["rfc"];
if($_SESSION["tipo"] == 'admin') {
	 $vendedor = $_POST["vendedor"];
}else{
	 $vendedor = $_SESSION["vendedor"];
};

	if ($id == ''){ $aqui = '0';
$sql11 = "INSERT INTO cliente(contacto, nombre_empresa, email, celular, telefono, colonia, domicilio, calle, ciudad, estado, cospos, rfc, razonsocial, vendedor) 
VALUES('".$contacto."', '".$nombre."', '".$email."', '".$celular."', '".$telefono."', '".$colonia."', '".$domicilio."', '".$calle."', '".$ciudad."', '".$estado."', 
	'".$cospos."', '".$rfc."', '".$razonsocial."', '".$vendedor."')";
$result = mysql_query($sql11);
								
	}else{
		$sql1 = "UPDATE cliente SET contacto='".$contacto."', email='".$email."', telefono='".$telefono."',  nombre_empresa='".$nombre."',  celular='".$celular."',  
		colonia='".$colonia."',  domicilio='".$domicilio."',  estado='".$estado."',  cospos='".$cp."', rfc='".$rfc."', razonsocial='".$razonsocial."',
		vendedor='".$vendedor."' WHERE id=".$id;				
		$result = mysql_query($sql1);
	};
		
	if($vi == ''){			header("location: ../gracias.php?tipo=doc&cliente=".$aqui);		}
	else{			header("location: ../agregar-evento.php");		};
	
				mysql_close($conn1);
				$llego = 'ok';
};
?>