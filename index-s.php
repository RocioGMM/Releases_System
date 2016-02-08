<?php
session_start();

include ("panel/conn1.php");


  $sql = "SELECT * FROM usuario ";
  $rs = mysql_query($sql, $conn1);
  $row = mysql_fetch_array($rs);



$user = $_POST["user"];
$pass = $_POST["pass"];

///echo $_POST["user"].' - pass: '.$_POST["pass"];

if ($user <> '' && $pass <> ''){

	$sql = "SELECT * FROM usuario WHERE user='".$user."' AND pass='".$pass."'";
	$rs = mysql_query($sql, $conn1);

	if ($row = mysql_fetch_array($rs)){		
	
  	/*$sql9cc= "SELECT * FROM ciudad WHERE id='".$row["ciudad"]."'";
  	$result9cc = mysql_query($sql9cc, $conn1);
  	$row9cc = mysql_fetch_array($result9cc);	//*/
	
		$_SESSION["user"] = $user;
		$_SESSION["tipo"] = $row["tipo"];
		$_SESSION["usuarios"] = $row["usuarios"];
		/*$_SESSION["estado"] = $row9cc["estado"];
		$_SESSION["ciudad"] = $row["ciudad"];//*/

		if ($row["tipo"] == 'admin'){		
      //echo 'User: '.$row["user"].' - Pass: '.$row["pass"].' - Tipo: '.$row["tipo"]; 
			header("location: programacion.php");
      //echo 'sii';
			};
		if ($row["tipo"] == 'user'){		
//			echo 'usuario';
			header("location: programacion.php?tipo=".$row["tipo"]."&usuarios=".$row["usuarios"]);	
			};
		};
	mysql_close($conn1);
	};
?>

<!doctype html>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<meta charset="UTF-8">
<title>Administrador</title>
<style type="text/css"></style>
<link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="menubar">

</div>

<br><br><br>


<div class="campitem-cliente">
<form name="form1" action="../sistema/index.php" method="post"> 
<div class="errorMessage" align="center"><?php echo $errorMessage; ?></div>
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="user" id="txtUserName" placeholder="Usuario" value=""/>
    </div>
    <div class="campb dospor">
    <input type="password" name="pass" id="txtPassword" placeholder="Clave" value=""/>
    </div>
      </form>
  </div>


<input name="btnLogin" type="submit"  id="btnLogin" value="Login" class="btn" />
  
  

</div>
</body>
</html>
