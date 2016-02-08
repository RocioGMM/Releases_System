<?php
session_start();

include ("panel/conn1.php");
header("location: index.php");

$user = $_REQUEST["user"];
$pass = $_REQUEST["pass"];


?><!doctype html>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
<meta charset="UTF-8">
<title>Administrador</title>
<style type="text/css"></style>
<link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="header-bar"></div>
<table width="350" height="115" border="0" align="center" cellpadding="5" cellspacing="1"><tr><td>
<div class="wrap">
 <h2>Administrador</h2>
<form name="form1" action="login.php" method="post">
      
       
   <div style="text-align:center;">
   <div style="background-color:#FFF; width:350px; text-align:center;	border:solid 20px transparent; border-radius:7px; box-shadow: 3px 3px 7px #777;">
       <table width="250" height="115" border="0" align="center" cellpadding="5" cellspacing="1">
        <tr> 
         <td class="contentArea">
		 <div class="errorMessage" align="center"><?php echo $errorMessage; ?></div>
		  <table width="100%" border="0" cellpadding="2" cellspacing="1" class="text">
           <tr align="center">
           </tr>
           <tr class="text">
            <td width="100" align="right">Usuario</td>
            <td width="5" align="center">:</td>
            <td><input name="user" type="text" class="box" id="txtUserName" value="" size="10" maxlength="20" /></td>
           </tr>
           <tr>
            <td width="100" align="right">Contrase&ntilde;a</td>
            <td width="5" align="center">:</td>
            <td><input name="pass" type="password" class="box" id="txtPassword" value="" size="10" /></td>
           </tr>
           <tr>
            <td colspan="2">&nbsp;</td>
            <td></td>
           </tr>
           <tr>
            <td colspan="2">&nbsp;</td>
            <td><input name="btnLogin" type="submit"  id="btnLogin" value="Login" class="btn" /></td>
           </tr>
          </table></td>
        </tr>
       </table>
      </div>
       <p>&nbsp;</p>
      </form>
      
  <div class="cf"></div>
</div>
</td></tr></table>
</div>
</body>
</html>
