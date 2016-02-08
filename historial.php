<?php
include ("panel/conn1.php");

include ("panel/rempla_fech.php");

$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$evento_cat = $_POST["evento_cat"];if($evento_cat == ''){$evento_cat = $_REQUEST["evento_cat"];};
// AND checkedeve='1'
$sql8 = "SELECT * FROM evento_act WHERE evento='".$id."' AND evento_cat='".$evento_cat."' AND fecha!='0000-00-00 00:00:00'  AND checkedeve='1' ORDER BY id ASC";
$result8 = mysql_query($sql8, $conn1);
$total_regi = mysql_num_rows($result8);

	

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href="styles.css" rel="stylesheet" type="text/css" />
</head>

<body>


<a href="#" class="callmade <?php if($evento_cat == '2'){ echo 'vis';}; ?>">
    <span class="tareum"><?php echo $total_regi;?></span> <span class="tamev">HISTORIAL<br />
<span class="date-hist">Última: 2098528</span></span>
   
   
   <span class="tamevhis">HISTORIAL<br /> 
<span class="date-hist">
<?php while($row8 = mysql_fetch_array($result8)){?>
<?php echo substr($row8["fecha"],8,2).' / '.replacemesshort(substr($row8["fecha"],5,2)).' - '.substr($row8["fecha"],11,5);?><br />
<?php  };	?>


</span></span>
    </a>

</body>
</html>
