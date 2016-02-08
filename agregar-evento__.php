<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'vendedor')){
	
include ("panel/conn1.php");
include ("panel/rempla_fech.php");

$c = $_POST["c"];if($c == ''){$c = $_REQUEST["c"];};
$e = $_POST["e"];if($e == ''){$e = $_REQUEST["e"];};
$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$tipo = $_POST["tipo"];if($tipo == ''){$tipo = $_REQUEST["tipo"];};
$id_categ = $_POST["id_categ"];if($id_categ == ''){$id_categ = $_REQUEST["id_categ"];};
$movil = $_POST["movil"];if($movil == ''){$movil = $_REQUEST["movil"];};
//$id_categ = $_REQUEST["id_categ"];

if ($id != ''){
	$sql0 = "SELECT * FROM evento_act WHERE id='".$id."' ORDER BY id ASC";
	$result0 = mysql_query($sql0, $conn1);
	$row0 = mysql_fetch_array($result0);
	$sql1 = "SELECT * FROM evento WHERE id='".$row0["evento"]."' ORDER BY id ASC";
	$result1 = mysql_query($sql1, $conn1);
	$row = mysql_fetch_array($result1);
	$bandera = 'ok';
 };

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=0.5">
<title>Administrador</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href="styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" rel="stylesheet" href="jquery.datetimepicker.css"/>




	<!-- Add jQuery library -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="lib/jquery.mousewheel-3.0.6.pack.js"></script>
<!-- Add fancyBox -->
<link rel="stylesheet" href="source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="source/jquery.fancybox.pack.js?v=2.1.5"></script>
<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<link rel="stylesheet" href="source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<script type="text/javascript">
		$(document).ready(function() {
	$(".various").fancybox({
		maxWidth	: 270,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});
	</script>


<!--
<script type="text/javascript">
function surfto(form)
{
var myindex = form.categoria.selectedIndex;
window.open(form.categoria.options[myindex].value,"_top");
}
</script>
-->



<!----------------------------------------      AUTOCOMPLETAR 	----------------------------------- -->
      <!--  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        
        <script type="text/javascript">
                $(document).ready(function(){
						$("#hospital").autocomplete({
							source:'getautocomplete.php',
							multiple: true,
							minLength:1
						});
                });
				
        </script>   
        
        <script type="text/javascript">
                $(document).ready(function(){
						$("#doctor").autocomplete({
							source:'getautocompletedoc.php',
							multiple: true,
							minLength:1
						});
                });
				
        </script>
        
        <script type="text/javascript">
                $(document).ready(function(){
						$("#producto").autocomplete({
							source:'getautocompleteprod.php',
							multiple: true,
							minLength:1
						});
                });
				
        </script> 
        
        <script type="text/javascript">
                $(document).ready(function(){
						$("#intrumentista").autocomplete({
							source:'getautocompleteintrumentista.php',
							multiple: true,
							minLength:1
						});
                });
				
        </script> -->
        <!---------------------------------------------------------------------------------------- -->
    
</head>

<body>

<div class="gruap">

<div class="log-out">
  <div class="lo-logo"><img src="logoconcre.png" width="206" height="42" /></div>
  <div class="lo-logout"><a href="salir.php">Cerrar sesión</a></div>
</div>

<div class="menubar">
  <a href="programacion.php" class="op log"></a>
  <a href="programacion.php" class="op lop">Inicio</a>
  <a href="estadisticas.php" class="op mop">Estadisticas</a>
<?php if($_SESSION["tipo"] == 'admin'){?>  <a href="usuarios.php" class="op rop">Usuarios</a><?php };?>
</div>


<div class="bann-int">
<div class="today">
<?php 	
	$created = date("Y-m-d H:i:s");
	$dia_hoy = substr($created,8,2);
	$mes_hoy = substr($created,5,2); 
?>
<span class="day"><?php echo replacemes($mes_hoy);?></span>
<span class="dayn"><?php echo $dia_hoy; ?>  </span>

<!--<iframe src="calendario.php"width="303" height="205" scrolling="no" style="  position: absolute;border: 0;top: -91px;left: 116px;"></iframe>-->

</div>
<div class="btn-proys"><a href="programacion.php"><img src="checkicon.png" width="44" height="44" /></a></div>
<span class="titlesec">PROYECTOS</span>
</div>

<div class="tp">
	<div class="subpanel"><!--
		<a href="datos.php"><img src="ic-sets.png" width="20" height="20" /></a>
		<a href="index.php"><img src="ic-home.png" width="20" height="20" style="margin-right:12px"/></a>-->
	</div>
	<div class="cf"></div>
</div>


<form method="post" action="panel/a_eve.php?tipo=<?php echo $tipo;?>&id=<?php echo $id;?>" name="frmRegistro" enctype="multipart/form-data" >
<input type="hidden" name="id" value="<?php echo $id?>"/>

<div class="onecol" id="lugari"><span class="titlecol-ad"><?php if($tipo == ''){echo 'Agregar';}else{echo 'Modificar';};?> proyecto </span>


<div class="cf"></div>

  <div class="campitem-cliente">
    
    <div class="campb ">
      <label for="textfield"></label>
      <input type="text" name="eventoname" id="textfield" placeholder="Proyecto" value="<?php echo $row["evento"];?>"/>
    </div>

    <div class="campb dosporch">
      <select name="cliente" id="textfield"  class="hospitalx" style="height: 44px;">
      <option value="" disabled="disabled" selected>Cliente </option>
      <?php //  
        $sql9h= "SELECT * FROM cliente ORDER BY nombre_empresa ASC";
        $result9h = mysql_query($sql9h, $conn1);
        while($row9h = mysql_fetch_array($result9h)){ 
      ?>    
      <option value="<?php echo $row9h["id"]?>"<?php 
                  if($row["cliente"] == $row9h["id"]){
                  echo ' selected';};?>><?php echo $row9h["nombre_empresa"]?></option>
      <?php };///?>
      </select>
    </div>

  </div>


 <a href="http://bmxlife.tv/sistema/agregar-cliente.php?vi=1" class="addbtn"></a>


<?php if($_SESSION["tipo"] == 'admin'){?>
  <div class="campitem-cliente">

    <div class="campb ">
      <select name="vendedor" id="textfield"  class="hospitalx" style="height: 44px;">
      <option value=""disabled="disabled" selected>Asignar vendedor</option>
      <?php //  
        $sql9h= "SELECT * FROM vendedor ORDER BY nombre, apellido ASC";
        $result9h = mysql_query($sql9h, $conn1);
        while($row9h = mysql_fetch_array($result9h)){ 
      ?>    
      <option value="<?php echo $row9h["id"]?>"<?php 
                  if($row["vendedor"] == $row9h["id"]){
                  echo ' selected';};?>><?php echo $row9h["nombre"].' '.$row9h["apellido"]?></option>
      <?php };///?>
      </select>
    </div>
    
    
    <div class="campb dosporch" style="margin-top:15px">
    <span class="grin">*Debes programar una llamada para guardar proyecto.</span>
    </div>
    
    <!--<div class="campb dosporch">
      <label for="textfield"></label>
      <input type="text" name="eventoname" id="textfield" placeholder="Evento" value="<?php echo $row["eventoname"];?>"/>
    </div>-->

  </div>
 <?php 		};	?> 

<div class="cf"></div>


  

<div class="cf"></div>

<span class="titlecol tcolor" >PROGRESO
<?php
if($id == ''){$total_registrosact = '6';}
else{
		$sql3 = "SELECT * FROM evento_act WHERE evento='".$row["id"]."' ";
		$result3 = mysql_query($sql3, $conn1);
		$total_registrosact = mysql_num_rows($result3);
	};
?>
<span class="tareum"><?php echo $total_registrosact;?></span> <span class="tamev">Tareas &nbsp;&nbsp;&nbsp; </span>
</span>

<!-- ----------------------- PROGRESS ICON ----------------------------- -->
<div class="t-progres-edit">
    <?php 
    	$sql5 = "SELECT * FROM evento_act WHERE evento_cat ='1' AND evento='".$row["id"]."' AND checkedeve='1' ORDER BY id DESC";// Llamada
		$result5 = mysql_query($sql5, $conn1);
		$row5 = mysql_fetch_array($result5); 
		if($row5["id"] == ''){	$iconotel = 'gristelefono.png';		}
		else{	$iconotel = 'telefono.png';	};

    	$sql5 = "SELECT * FROM evento_act WHERE evento_cat ='2' AND evento='".$row["id"]."' AND checkedeve='1' ORDER BY id DESC";// Llamada
		$result5 = mysql_query($sql5, $conn1);
		$row5 = mysql_fetch_array($result5); 
		if($row5["id"] == ''){	$iconocas = 'griscasa.png';		}
		else{	$iconocas = 'casaicon.png';	};

    	$sql5 = "SELECT * FROM evento_act WHERE evento_cat ='5' AND evento='".$row["id"]."' AND checkedeve='1' ORDER BY id DESC";// Llamada
		$result5 = mysql_query($sql5, $conn1);
		$row5 = mysql_fetch_array($result5); 
		if($row5["id"] == ''){	$iconodia = 'grisdiagnostico.png';		}
		else{	$iconodia = 'diagnostico.png';	};

    	$sql5 = "SELECT * FROM evento_act WHERE evento_cat ='3' AND evento='".$row["id"]."' AND checkedeve='1' ORDER BY id DESC";// Llamada
		$result5 = mysql_query($sql5, $conn1);
		$row5 = mysql_fetch_array($result5); 
		if($row5["id"] == ''){	$iconocot = 'grismonto.png';		}
		else{	$iconocot = 'monto.png';	};

    	$sql5 = "SELECT * FROM evento_act WHERE evento_cat ='6' AND evento='".$row["id"]."' AND checkedeve='1' ORDER BY id DESC";// Llamada
		$result5 = mysql_query($sql5, $conn1);
		$row5 = mysql_fetch_array($result5); 
		if($row5["id"] == ''){	$iconomues = 'grisflechaabajo.png';		}
		else{	$iconomues = 'telefono.png';	};

    	$sql5 = "SELECT * FROM evento_act WHERE evento_cat ='4' AND evento='".$row["id"]."' AND checkedeve='1' ORDER BY id DESC";// Llamada
		$result5 = mysql_query($sql5, $conn1);
		$row5 = mysql_fetch_array($result5); 
		if($row5["id"] == ''){	$iconocie = 'palomagris.png';		}
		else{	$iconocie = 'palomitaverde.png';	};
	?>
	<img src="<?php echo $iconotel;?>" width="42" height="42" border="0" />
	<img src="<?php echo $iconocas;?>" width="42" height="42" border="0" />
	<img src="<?php echo $iconodia;?>" width="42" height="42" border="0" />
	<img src="<?php echo $iconocot;?>" width="42" height="42" border="0" />
	<img src="<?php echo $iconomues;?>" width="42" height="42" border="0" />
	<img src="<?php echo $iconocie;?>" width="42" height="42" border="0" />
</div>
<!-- ----------------------- FIN DE PROGRESS ICON ----------------------------- -->
<div class="cf"></div>


<?php
	$cantidadeveact = '0';
//	if($id == ''){	$sql3 = "SELECT * FROM evento_cat ORDER BY id ASC";		}
	//else{$sql3 = "SELECT * FROM evento_act WHERE evento='".$row0["evento"]."' ORDER BY id ASC";};
		$sql3 = "SELECT * FROM evento_cat WHERE se_publica='s' ORDER BY orden ASC";
		$result3 = mysql_query($sql3, $conn1);
		while($row3 = mysql_fetch_array($result3)){

	if($id != ''){
		$total_regi = 0;
		$sql2c = "SELECT * FROM evento_act WHERE evento='".$row["id"]."' AND evento_cat='".$row3["id"]."' AND checkedeve='1' ORDER BY id ASC";
		$result2c = mysql_query($sql2c, $conn1);
		$total_regi = mysql_num_rows($result2c);

		$sql2 = "SELECT * FROM evento_act WHERE evento='".$row["id"]."' AND evento_cat='".$row3["id"]."' ORDER BY id ASC";
		$result2 = mysql_query($sql2, $conn1);		
		$row2 = mysql_fetch_array($result2);
		//echo ' ::iiiiiiiiiii '.$row3["id"];
	};
		$cantidadeveact = $cantidadeveact + '1';
?>
  <div class="campitem" 
  <?php if ($row3["id"] == 1){echo 'id="telcone"';}	elseif ($row3["id"] == 2){echo 'id="viscone"';}	elseif ($row3["id"] == 6){echo 'id="muescone"';};?>>
            
<input type="hidden" name="id<?php echo $cantidadeveact?>" value="<?php echo $row2["id"];?>"/>
<input type="hidden" name="evento_cat<?php echo $cantidadeveact?>" value="<?php echo $row3["id"]; 	?>"/>
<input type="hidden" name="evento_cat_nombre<?php echo $cantidadeveact?>" value=""/>
    <div class="campe" >    

      <span class="lbelbg"><?php echo $row3["nombre"]?></span>

      <label for="textfield"></label>
      <input name="checkedeve<?php echo $cantidadeveact?>" type="checkbox" value="1" style="margin-left: 11px;"
      <?php if($id != ''){if ($row2["checkedeve"]=="1"){?> checked="checked" <?php }; };?> 
      <?php if($row3["id"] == '1'){  echo 'id="escuchallla" onchange="escucharidllamada()"';
  	   }elseif($row3["id"] == '2'){  echo 'id="escuchallvis" onchange="escucharidvisita()"';};?>/>
    </div>


<?php if($id != ''){	if($row3["id"] == '1' || $row3["id"] == '2'){
		$sql8 = "SELECT * FROM evento_act WHERE evento='".$row["id"]."' AND evento_cat='".$row3["id"]."' AND fecha!='0000-00-00 00:00:00' ORDER BY id DESC";
		$result8 = mysql_query($sql8, $conn1);
		$row8 = mysql_fetch_array($result8);
	?>
	<a data-fancybox-type="iframe" href="historial.php?id=<?php echo $row["id"];?>&evento_cat=<?php echo $row3["id"];?>" 
	class="callmade various <?php if($row3["id"] == '2'){echo 'vis';}; 	?>">
    <!--<a href="#" class="callmade <?php if($row3["id"] == '2'){echo 'vis';}; 	?>">-->
    <span class="tareum"><?php echo $total_regi;?></span> <span class="tamev">HISTORIAL<br />
<span class="date-hist">Última: <?php echo substr($row2["fecha"],8,2).' / '.replacemesshort(substr($row2["fecha"],5,2)).' - '.substr($row2["fecha"],11,5);?></span></span></a>

<?php if($row3["id"] == '1'){?><div class="addcall-now" id="addotro<?php echo $cantidadeveact?>" <?php if($row2["checkedeve"]!="1"){echo 'style="display:none"';};?>>
								<a onclick="clonetel()"><img src="addcall-act.png" width="49" height="30" /></a></div><?php };?>
<?php if($row3["id"] == '2'){?><div class="addcall-now" id="addotro<?php echo $cantidadeveact?>" <?php if($row2["checkedeve"]!="1"){echo 'style="display:none"';};?>>
								<a onclick="clonevis()"><img src="addvisit-act.png" width="49" height="30" /></a></div><?php };?>
	
	<!--<a data-fancybox-type="iframe" href="historial.php?id=<?php echo $row["id"];?>&evento_cat=<?php echo $row3["id"];?>" 
	class="callmade various <?php if($row3["id"] == '2'){echo 'vis';}; 	?>" <?php if($row2["checkedeve"]!="1"){echo 'style="display:none"';};?>>
    </a>-->

<?php }; };?>
 


<div class="horafecha">
  <div class="campd fechs">
      <label for="textfield"></label>
<input type="text" name="fecha<?php echo $cantidadeveact?>" id="<?php if ($movil == 'movil'){ echo 'datetimepicker3';	}else {		echo 'datetimepicker2';	};
 echo $cantidadeveact?>" placeholder="Fecha" 
value="<?php if($id != ''){echo substr($row2["fecha"],8,2).'/'.substr($row2["fecha"],5,2).'/'.substr($row2["fecha"],0,4);	};?>" class="hospitalx" />
    </div>
 
    <div class="campd fechs">    
     <label for="textfield"></label>
     <input type="text" name="hora<?php echo $cantidadeveact?>" id="<?php if ($movil == 'movil'){ echo 'datetimepicker3b';	}else {		echo 'datetimepicker1';	};
      echo $cantidadeveact?>" placeholder="Hora" 
     value="<?php if($id != ''){echo substr($row2["fecha"],11,2).':'.substr($row2["fecha"],14,2);	};?>" class="hospitalx"/>
  </div><a href="#" class="addbtn-dat"></a></div>
  <span class="indic">PROGRAMAR</span>




<?php if($row3["archivo"] == '1'){?>
<div class="subirarchivo">
<input id="uploadFile" placeholder="Elegir archivo" disabled="disabled"  class="elimp" />
    <div class="fileUpload btn-u btn-primary">         
     <input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
     <input id="uploadBtn" name="userfile<?php echo $cantidadeveact?>" type="file" class="simbolupload"  />

    </div>
<?php  if($row2["archivo"] != ''){?><a href="<?php echo 'archivos/'.$row2["archivo"];?>">Descargar</a><?php };?>
    </div>

<?php }; if($row3["importe"] == '1'){?>
    <div class="campd folioimpor">    
     <label for="textfield"></label>
     <input type="text" name="importe<?php echo $cantidadeveact?>"  placeholder="Importe" 
     value="<?php if($id != ''){echo $row2["importe"];	};?>" class="hospitalx importe"/>
    </div>
    
<?php }; if($row3["folio"] == '1'){?>
    <div class="campd folioimpor">    
     <label for="textfield"></label>
     <input type="text" name="folio<?php echo $cantidadeveact?>"  placeholder="Folio" 
     value="<?php if($id != ''){echo $row2["folio"];	};?>" class="hospitalx"/>
    </div>

<?php }; if($row3["serie"] == '1'){?>
    <div class="campd folioimpor">    
     <label for="textfield"></label>
     <input type="text" name="serie<?php echo $cantidadeveact?>"  placeholder="Serie" 
     value="<?php if($id != ''){echo $row2["serie"];	};?>" class="hospitalx"/>
    </div>
 <?php };?>
 

  </div>
 <?php };	?>

<input type="hidden" id="cantidadeveact" name="cantidadeveact" value="<?php echo $cantidadeveact?>"/>
 
<div class="campitem">
    <div class="campe" >    
<span class="lbelbg" style="margin-top:34px">COMENTARIOS</span>
    </div>
    
    <div class="campc">
      <textarea name="comentarios"  cols="" rows="" placeholder="Comentario"><?php echo $row["comentarios"];?></textarea>
    </div>
  </div>
  
  <div class="actions-bar">
  <a class="addbtn-tarea" onclick="mostaddtarea()" id="addt1"></a>
  <span class="indic" id="addt2">AGREGAR TAREA</span>
  <span class="indic" id="addt3" style="display:none;">
	  <!--<a onclick="clonetel()">LLAMADA</a> / 
	  <a onclick="clonevis()">VISITA</a>-->
	  <input type="text" name="tarea"  id="tarea"  placeholder="NUEVA TAREA" class="hospitalx"/>
	  <a class="addbtn-tarea" onclick="clonetare()" id="addt1"></a>
  </span>
  
  <a href="http://bmxlife.tv/sistema/agregar-evento.php" class="addbtn-nuevo"></a> 
  <span class="indic">PROGRAMAR NUEVO PROYECTO</span>
  </div>
<div class="save-btns">
<a href="#" class="addbtn-editp"></a> 
<input type="submit" name="add"  value="Guardar" class="rax"/> 		
<!-- <a href="javascript:document.forma.submit();" class="ra">Guardar</a> -->

</div>

  
  
  
  
  
  
  
  <div class="cf"></div>
</div>
</div>
</form>
</body>

<script> // EVITAR EL SUBMIT AL APRETAR LA TECLA ENTER
function pulsar(e) { 
  tecla = (document.all) ? e.keyCode :e.which; 
  return (tecla!=13); 
} 
</script>


<script type="text/javascript">
	function mostaddtarea() {		
		document.getElementById('addt1').style.display='none';
		document.getElementById('addt2').style.display='none';
		document.getElementById('addt3').style.display='block';
	}
	function clonetel() {
		var clonedDiv = $('#telcone').clone(); // Clono
		clonedDiv.attr("id", "telclone2"); // Cambio ID
		var segundo_p = document.getElementById('lugari');// Despues de quien lo quiero meter
		var segundo_p2 = document.getElementById('telcone');// Despues de quien lo quiero meter
		$('#telcone').append(clonedDiv);
		 var porId=document.getElementById('cantidadeveact').value;// Obtenemos el valor de la cantidad actual de elementos por el id del input bandera
		 porId2 = parseInt(porId);
		 var nuevovalor = porId2 + 1;

		 document.getElementById('cantidadeveact').value = nuevovalor;//pongo el nuevo valor de cantidad de actividades

		 //var segundo_p = document.getElementById('telclone2').getElementsByClassName("example color");// Despues de quien lo quiero meter
		 var primero = document.getElementById("telclone2").getElementsByTagName("a");// SACO EL HISTORIAL DE LLAMADA
		 primero[0].style.display = "none";

		 

		 var segundo_c = document.getElementById("telclone2").getElementsByTagName("div");// cambio el name del CHECK
		 segundo_e = segundo_c[0].getElementsByTagName("input");
		 segundo_e[0].name = "checkedeve"+nuevovalor;
		 segundo_e[0].id = "escuchallla";//pongo el id de "escuchar si cambia"
		 segundo_e[0].checked = "";

		 segundo_c[1].style.display = "none";//SACO EL AGREGAR LLAMADA	
		 segundo_c[1].id = "addotro"+nuevovalor;	// le cambio el id
		 //primero[2].style.display = "none";// SACO EL ISTORIAL ICONO DE ALLADO DEL H



		 var padre_f = document.getElementById("telcone").getElementsByTagName("span");//Saco el titulo "programar"
		 padre_f[4].style.display = "none";
		 var padre_c = document.getElementById("telcone").getElementsByTagName("div");
		 padre_c[1].style.display = "none";//SACO EL AGREGAR LLAMADA	
		 padre_i = padre_c[2].getElementsByTagName("a");
		 padre_i[0].style.display = "none";//SACO icono der, calendario
		 //var padre = document.getElementById("telcone").getElementsByTagName("a");	 
		 //padre[2].style.display = "none";// SACO EL ISTORIAL ICONO DE ALLADO DEL H
		 padre_e = padre_c[0].getElementsByTagName("input");//saco el id de "escuchar si cambia"
		 padre_e[0].id = "";


		 var segundo_f = document.getElementById("telclone2").getElementsByTagName("input");// cambio el name del INPUT	ID y evento_cat 
		 segundo_f[0].name = "id"+nuevovalor;
		 segundo_f[0].value = "";
		 segundo_f[1].name = "evento_cat"+nuevovalor;

		 var segundo_g = document.getElementById("telclone2").getElementsByTagName("div");// cambio el name de FECHA 
		 segundo_h = segundo_g[2].getElementsByTagName("div");
		 segundo_i = segundo_h[0].getElementsByTagName("input");
		 segundo_i[0].name = "fecha"+nuevovalor;
		 segundo_i[0].id = "datetimepicker2"+nuevovalor;
		 segundo_i[0].value = "";

		 var segundo_g = document.getElementById("telclone2").getElementsByTagName("div");// cambio el name de HORA 
		 segundo_h = segundo_g[2].getElementsByTagName("div");
		 segundo_i = segundo_h[1].getElementsByTagName("input");
		 segundo_i[0].name = "hora"+nuevovalor;
		 segundo_i[0].id = "datetimepicker1"+nuevovalor;
		 segundo_i[0].value = "";

		 
		 document.getElementById('telclone2').id = "";// Despues de quien lo quiero meter
		
		//Debuelvo el voton agregar +
		document.getElementById('addt1').style.display='block';
		document.getElementById('addt2').style.display='block';
		document.getElementById('addt3').style.display='none';
		
			var datepiker1 = "#datetimepicker1"+nuevovalor;
			$(datepiker1).datetimepicker({
				datepicker:false,
				format:'H:i',
				step:30
			});
			var datepiker2 = "#datetimepicker2"+nuevovalor;
			$(datepiker2).datetimepicker({
				lang:'es',
				timepicker:false,
				format:'d/m/Y',
				formatDate:'d/m/y',
			});

	}

	function clonevis() {
		var clonedDiv = $('#viscone').clone(); // Clono
		clonedDiv.attr("id", "telclone2"); // Cambio ID
		var segundo_p = document.getElementById('lugari');// Despues de quien lo quiero meter
		var segundo_p2 = document.getElementById('telcone');// Despues de quien lo quiero meter
		$('#viscone').append(clonedDiv);
		 var porId=document.getElementById('cantidadeveact').value;// Obtenemos el valor de la cantidad actual de elementos por el id del input bandera
		 porId2 = parseInt(porId);
		 var nuevovalor = porId2 + 1;
		 
		 document.getElementById('cantidadeveact').value = nuevovalor;//pongo el nuevo valor de cantidad de actividades

		 var padre_f = document.getElementById("viscone").getElementsByTagName("span");//Saco el titulo "programar"
		 padre_f[4].style.display = "none";
		 var padre_c = document.getElementById("viscone").getElementsByTagName("div");
		 padre_c[1].style.display = "none";//SACO EL AGREGAR LLAMADA	
		 padre_i = padre_c[2].getElementsByTagName("a");
		 padre_i[0].style.display = "none";//SACO icono der, calendario
		 //var padre = document.getElementById("telcone").getElementsByTagName("a");	 
		 //padre[2].style.display = "none";// SACO EL ISTORIAL ICONO DE ALLADO DEL H
		 padre_e = padre_c[0].getElementsByTagName("input");//saco el id de "escuchar si cambia"
		 padre_e[0].id = "";

		 //var segundo_p = document.getElementById('telclone2').getElementsByClassName("example color");// Despues de quien lo quiero meter
		 var primero = document.getElementById("telclone2").getElementsByTagName("a");// cambio el name del CHECK
		 primero[0].style.display = "none";

		 var segundo_c = document.getElementById("telclone2").getElementsByTagName("div");// cambio el name del CHECK
		 segundo_e = segundo_c[0].getElementsByTagName("input");
		 segundo_e[0].id = "escuchallvis";//pongo el id de "escuchar si cambia"
		 segundo_e[0].name = "checkedeve"+nuevovalor;
		 segundo_e[0].checked = "";

		 segundo_c[1].style.display = "none";//SACO EL AGREGAR LLAMADA		
		 segundo_c[1].id = "addotro"+nuevovalor;	 	 
		 //primero[2].style.display = "none";// SACO EL ISTORIAL ICONO DE ALLADO DEL H

		 var segundo_f = document.getElementById("telclone2").getElementsByTagName("input");// cambio el name del INPUT	ID y evento_cat 
		 segundo_f[0].name = "id"+nuevovalor;
		 segundo_f[0].value = ""; 
		 segundo_f[1].name = "evento_cat"+nuevovalor;

		 var segundo_g = document.getElementById("telclone2").getElementsByTagName("div");// cambio el name de FECHA 
		 segundo_h = segundo_g[2].getElementsByTagName("div");
		 segundo_i = segundo_h[0].getElementsByTagName("input");
		 segundo_i[0].name = "fecha"+nuevovalor;
		 segundo_i[0].id = "datetimepicker2"+nuevovalor;
		 segundo_i[0].value = "";

		 var segundo_g = document.getElementById("telclone2").getElementsByTagName("div");// cambio el name de HORA 
		 segundo_h = segundo_g[2].getElementsByTagName("div");
		 segundo_i = segundo_h[1].getElementsByTagName("input");
		 segundo_i[0].name = "hora"+nuevovalor;
		 segundo_i[0].id = "datetimepicker1"+nuevovalor;
		 segundo_i[0].value = "";

		 
		 document.getElementById('telclone2').id = "";// Despues de quien lo quiero meter
		
		//Debuelvo el voton agregar +
		document.getElementById('addt1').style.display='block';
		document.getElementById('addt2').style.display='block';
		document.getElementById('addt3').style.display='none';

			var datepiker1 = "#datetimepicker1"+nuevovalor;
			$(datepiker1).datetimepicker({
				datepicker:false,
				format:'H:i',
				step:30
			});
			var datepiker2 = "#datetimepicker2"+nuevovalor;
			$(datepiker2).datetimepicker({
				lang:'es',
				timepicker:false,
				format:'d/m/Y',
				formatDate:'d/m/y',
			});


	}



	function clonetare() {
		var clonedDiv = $('#viscone').clone(); // Clono
		clonedDiv.attr("id", "telclone2"); // Cambio ID
		var segundo_p = document.getElementById('lugari');// Despues de quien lo quiero meter
		var segundo_p2 = document.getElementById('telcone');// Despues de quien lo quiero meter
		$('#muescone').append(clonedDiv);
		 var porId=document.getElementById('cantidadeveact').value;// Obtenemos el valor de la cantidad actual de elementos por el id del input bandera
		 porId2 = parseInt(porId);
		 var nuevovalor = porId2 + 1;
		 
		 document.getElementById('cantidadeveact').value = nuevovalor;//pongo el nuevo valor de cantidad de actividades

		 //var segundo_p = document.getElementById('telclone2').getElementsByClassName("example color");// Despues de quien lo quiero meter
		 var primero = document.getElementById("telclone2").getElementsByTagName("a");// cambio el name del CHECK
		 primero[0].style.display = "none";

		 var segundo_c = document.getElementById("telclone2").getElementsByTagName("div");// cambio el name del CHECK
		 segundo_e = segundo_c[0].getElementsByTagName("input");
		 segundo_e[0].name = "checkedeve"+nuevovalor;
		 segundo_e[0].checked = "";
		 

		 segundo_c[1].remove();//SACO EL AGREGAR LLAMADA		 
		 //primero[2].remove();// SACO EL ISTORIAL ICONO DE ALLADO DEL H


		 var segundo_f = document.getElementById("telclone2").getElementsByTagName("input");// cambio el name del INPUT	ID y evento_cat 
		 segundo_f[0].name = "id"+nuevovalor;
		 segundo_f[0].value = "";
		 segundo_f[1].name = "evento_cat"+nuevovalor;
		 segundo_f[2].name = "evento_cat_nombre"+nuevovalor;
		 segundo_f[1].value = "0";
		 var nombretarea=document.getElementById("tarea").value;
		 segundo_f[2].value = nombretarea;


		 segundo_1e = segundo_c[0].getElementsByTagName("span");// cambio el name del TITULO
		 segundo_1e[0].firstChild.nodeValue = nombretarea;


		 var segundo_g = document.getElementById("telclone2").getElementsByTagName("div");// cambio el name de FECHA 
		 segundo_h = segundo_g[1].getElementsByTagName("div");
		 segundo_i = segundo_h[0].getElementsByTagName("input");
		 segundo_i[0].name = "fecha"+nuevovalor;
		 segundo_i[0].id = "datetimepicker2"+nuevovalor;
		 segundo_i[0].value = "";

		 var segundo_g = document.getElementById("telclone2").getElementsByTagName("div");// cambio el name de HORA 
		 segundo_h = segundo_g[1].getElementsByTagName("div");
		 segundo_i = segundo_h[1].getElementsByTagName("input");
		 segundo_i[0].name = "hora"+nuevovalor;
		 segundo_i[0].id = "datetimepicker1"+nuevovalor;
		 segundo_i[0].value = "";

		 
		 document.getElementById('telclone2').id = "";// Despues de quien lo quiero meter
		
		//Debuelvo el voton agregar +
		document.getElementById('addt1').style.display='block';
		document.getElementById('addt2').style.display='block';
		document.getElementById('addt3').style.display='none';

			var datepiker1 = "#datetimepicker1"+nuevovalor;
			$(datepiker1).datetimepicker({
				datepicker:false,
				format:'H:i',
				step:30
			});
			var datepiker2 = "#datetimepicker2"+nuevovalor;
			$(datepiker2).datetimepicker({
				lang:'es',
				timepicker:false,
				format:'d/m/Y',
				formatDate:'d/m/y',
			});


	}

function escucharidllamada() {
	if (document.getElementById('escuchallla').checked) {
		document.getElementById('addotro1').style.display='block';
		}
	else{
		document.getElementById('addotro1').style.display='none';
	}
}


function escucharidvisita() {
	if (document.getElementById('escuchallvis').checked) {
		document.getElementById('addotro2').style.display='block';
		}
	else{
		document.getElementById('addotro2').style.display='none';
	}
}

</script>






<?php    $created = date("Y-m-d H:i:s");	?>

<!--<script type="text/javascript" src="./jquery.js"></script>-->
<script type="text/javascript" src="jquery.datetimepicker.js"></script>
<script type="text/javascript">
$('#datetimepicker').datetimepicker()
<!--	.datetimepicker({value:'<?php //echo $created;?>',step:10});-->

$('#datetimepicker_mask').datetimepicker({
	mask:'9999/19/39 29:59'
});



       
<?php for($i = 1 ; $i < $cantidadeveact + 1 ; $i++){//apertura del for de muchas horas?>
$('#datetimepicker1<?php echo $i?>').datetimepicker({
	datepicker:false,
	format:'H:i',
	step:30,
	
})<?php /*if($id != ''){?>
.datetimepicker({value:'<?php echo substr($row["fecha_entrega"],11,2).':'.substr($row["fecha_entrega"],14,2);?>',step:10})
<?php };//*/?> 
;
$('#datetimepicker2<?php echo $i?>').datetimepicker({
//	yearOffset:222,
	lang:'es',
	timepicker:false,
	format:'d/m/Y',
	
//	format:'d/m/Y',
	formatDate:'d/m/y',
//	minDate:'-1970/01/02', // yesterday is minimum date
//	maxDate:'+1970/01/02' // and tommorow is maximum date calendar
})<?php /*if($id != ''){?>
.datetimepicker({value:'<?php echo substr($row["fecha_entrega"],0,4).'/'.substr($row["fecha_entrega"],5,2).'/'.substr($row["fecha_entrega"],8,2);?>',step:10})
<?php };//*/?> 
;
<?php } //cierre del for de muchas horas?>

      

$('#datetimepicker3').datetimepicker({
<?php /*if($id != ''){?>
	mask:'<?php echo substr($row["fecha_entrega"],0,4).'/'.substr($row["fecha_entrega"],5,2).'/'.substr($row["fecha_entrega"],8,2).' '.substr($row["fecha_entrega"],11,2).':'.substr($row["fecha_entrega"],14,2);?> ',
<?php };*/?> 
	lang:'es',
	timepicker:false,
//	format:'d/m/Y',
	formatDate:'Y/m/d',
	inline:true
})<?php if($id != ''){?>
.datetimepicker({value:'<?php echo substr($row["fecha_entrega"],0,4).'/'.substr($row["fecha_entrega"],5,2).'/'.substr($row["fecha_entrega"],8,2).' '.substr($row["fecha_entrega"],11,2).':'.substr($row["fecha_entrega"],14,2);?>',step:10})
<?php };?> 
;
$('#datetimepicker3b').datetimepicker({
<?php if($id != ''){?>
	mask:'<?php echo substr($row["fecha_entrega"],0,4).'/'.substr($row["fecha_entrega"],5,2).'/'.substr($row["fecha_entrega"],8,2).' '.substr($row["fecha_entrega"],11,2).':'.substr($row["fecha_entrega"],14,2);?> ',
<?php };?> 
	datepicker:false,
	format:'H:i',
	step:30,
	inline:true,
	allowTimes:['08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','80:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00']
})<?php if($id != ''){?>
.datetimepicker({value:'<?php echo substr($row["fecha_entrega"],11,2).':'.substr($row["fecha_entrega"],14,2);?>',step:10})
<?php };?> 
;
</script>



<script type="text/javascript">
    
    document.getElementById("uploadBtn").onchange = function () {
    document.getElementById("uploadFile").value = this.value;
};  
</script>  


</html>

<?php

	mysql_close($conn1);
	}
else{
	header("location: login.php");
	};		
	?>