<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'user')){

include ("conn1.php");


$id = $_POST["id"];

$user = $_POST["user"];
$pass = $_POST["pass"];
$tipo = $_POST["tipo"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$email = $_POST["email"];

$domicilio = $_POST["domicilio"];
$ciudad = $_POST["ciudad"];
$estado = $_POST["estado"];
$ciudad = $_POST["ciudad"];

$telefono = $_POST["telefono"];
$celular = $_POST["celular"];

$bande = '';

	if ($id == ''){

			if($tipo == 'vendedor'){
				$bande .= '0-';

				$sql1 = "INSERT INTO vendedor(domicilio, pais, telefono, nombre, apellido, email, ciudad, estado, celular) 
				VALUES('".$domicilio."', '".$pais."', '".$telefono."', '".$nombre."', '".$apellido."', '".$email."', '".$ciudad."', '".$estado."', '".$celular."')";
				$result = mysql_query($sql1);	

				$sql3 = "SELECT * FROM vendedor WHERE nombre='".$nombre."' AND apellido='".$apellido."' ORDER BY id DESC";
				$result3 = mysql_query($sql3, $conn1);
				$row3 = mysql_fetch_array($result3);	

				$vendedor = $row3["id"];
			}
			else{
				$vendedor = '0';
				$bande .= '0b-';
			};

			$sql1 = "INSERT INTO usuario(tipo, user, pass, nombre, apellido, email, ciudad, vendedor) 
			VALUES('".$tipo."', '".$user."', '".$pass."', '".$nombre."', '".$apellido."', '".$email."', '".$ciudad."', '".$vendedor."')";
			$result = mysql_query($sql1);
				$bande .= '1-';

	}
	else{

			$sql1 = "UPDATE usuario SET tipo='".$tipo."', user='".$user."', pass='".$pass."',  nombre='".$nombre."',  apellido='".$apellido."',  email='".$email."', 
			 ciudad='".$ciudad."'  WHERE id=".$id;
			$result = mysql_query($sql1);

				$sql3 = "SELECT * FROM usuario WHERE id='".$id."' ORDER BY id DESC";
				$result3 = mysql_query($sql3, $conn1);
				$row3 = mysql_fetch_array($result3);

			if($tipo == 'vendedor'){
				$sql1 = "UPDATE vendedor SET domicilio='".$domicilio."', pais='".$pais."', telefono='".$telefono."',  nombre='".$nombre."',  apellido='".$apellido."',  
				email='".$email."',  ciudad='".$ciudad."',  estado='".$estado."',  celular='".$celular."' WHERE id=".$row3["vendedor"];				
				$result = mysql_query($sql1);	
			};

	};
	
	
	

		
			header("location: ../gracias.php?tipo=user&bande=".$bande);




	mysql_close($conn1);
	}
else{
	header("location: ../login.php");
	};
	?>