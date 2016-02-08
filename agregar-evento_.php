<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'user')){
	
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
  <div class="lo-logo"><img src="aologo.png" width="204" height="48" /></div>
  <div class="lo-logout"><a href="salir.php">Cerrar sesión</a></div>
</div>

<div class="menubar">
  <a href="programacion.php" class="op lop">Programacíon</a>
  <a href="estadisticas.php" class="op mop">Estadisticas</a>
<?php if($_SESSION["tipo"] == 'admin' || $_SESSION["usuarios"] == '1'){?>  <a href="usuarios.php" class="op rop">Usuarios</a><?php }else{	?>
  <div class="opb ropb"></div>
  <?php };?>
</div>

<div class="bann-int">EVENTOS</div>
<div class="tp">
	<div class="subpanel">
		<a href="datos.php"><img src="ic-sets.png" width="20" height="20" /></a>
		<a href="index.php"><img src="ic-home.png" width="20" height="20" style="margin-right:12px"/></a>
	</div>
	<div class="cf"></div>
</div>


<form method="post" action="panel/a_eve.php?tipo=<?php echo $tipo;?>&id=<?php echo $id;?>" name="frmRegistro" enctype="multipart/form-data" >
<input type="hidden" name="id" value="<?php echo $id?>"/>

<div class="onecol"><span class="titlecol-ad"><?php if($tipo == ''){echo 'Agregar';}else{echo 'Modificar';};?> evento </span>
  


<div class="cf"></div>
  


<?php if($_SESSION["tipo"] == 'admin'){?>
  <div class="campitem">

    <div class="campb ">
      <select name="cliente" id="textfield"  class="hospitalx" style="height: 33px;">
      <option value=""disabled="disabled" selected>Vendedor</option>
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
    
    <!--<div class="campb dosporch">
      <label for="textfield"></label>
      <input type="text" name="eventoname" id="textfield" placeholder="Evento" value="<?php echo $row["eventoname"];?>"/>
    </div>-->

  </div>
 <?php 		};	?> 

<div class="cf"></div>

  <div class="campitem">
    
    <div class="campb ">
      <label for="textfield"></label>
      <input type="text" name="eventoname" id="textfield" placeholder="Evento" value="<?php echo $row["eventoname"];?>"/>
    </div>

    <div class="campb dosporch">
      <select name="cliente" id="textfield"  class="hospitalx" style="height: 33px;">
      <option value=""disabled="disabled" selected>Cliente </option>
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


<div class="cf"></div>


  <div class="campitem">
    <div class="campc">
      <textarea name="comentarios"  cols="" rows="" placeholder="Comentario"><?php echo $row["comentarios"];?></textarea>
    </div>
  </div>

<div class="cf"></div>

<span class="titlecol tcolor" style="margin-top:25px">TAREAS

<span class="tareum">10</span> <span class="tamev">Tareas</span>
</span>
<div class="t-progres-edit imgalcost">
<img src="telefono.png" width="42" height="42" border="0" />
<img src="azulcasa.png" width="42" height="42" border="0" />
<img src="grisdiagnostico.png" width="42" height="42" border="0" />
<img src="grismonto.png" width="42" height="42" border="0" />
<img src="grisflechaabajo.png" width="42" height="42" border="0" />
<img src="palomagris.png" width="42" height="42" border="0" />
</div>

<div class="cf"></div>


<?php
	$cantidadeveact = '0';
	if($id == ''){	$sql3 = "SELECT * FROM evento_cat ORDER BY nombre DESC";		}
	else{$sql3 = "SELECT * FROM evento_act WHERE evento='".$row0["evento"]."' ORDER BY id ASC";};
		$result3 = mysql_query($sql3, $conn1);
		while($row3 = mysql_fetch_array($result3)){

	if($id == ''){$sql2 = "SELECT * FROM evento_cat WHERE id='".$row3["id"]."' ORDER BY fecha DESC";}
	else{$sql2 = "SELECT * FROM evento_cat WHERE id='".$row3["evento_cat"]."' ORDER BY fecha DESC";};
		$result2 = mysql_query($sql2, $conn1);
		$row2 = mysql_fetch_array($result2);

		$cantidadeveact = $cantidadeveact + '1';
?>
<input type="hidden" name="id<?php echo $cantidadeveact?>" value="<?php if($id != ''){	echo $row3["id"]; 	};?>"/>
<input type="hidden" name="evento_cat<?php echo $cantidadeveact?>" value="<?php echo $row2["id"]; 	?>"/>

  <div class="campitem">
    
    <div class="campd dospor">
      <label for="textfield"></label>
<input type="text" name="fecha<?php echo $cantidadeveact?>" id="<?php if ($movil == 'movil'){ echo 'datetimepicker3';	}else {		echo 'datetimepicker2';	};?>
<?php echo $cantidadeveact?>" placeholder="Fecha" 
value="<?php if($id != ''){echo substr($row3["fecha"],8,2).'/'.substr($row3["fecha"],5,2).'/'.substr($row3["fecha"],0,4);	};?>" class="hospitalx"/>
    </div>

    <div class="campd dospor">    
     <label for="textfield"></label>
     <input type="text" name="hora<?php echo $cantidadeveact?>" id="<?php if ($movil == 'movil'){ echo 'datetimepicker3b';	}else {		echo 'datetimepicker1';	};?>
     <?php echo $cantidadeveact?>" placeholder="Hora" 
     value="<?php if($id != ''){echo substr($row3["fecha"],11,2).':'.substr($row3["fecha"],14,2);	};?>" class="hospitalx"/>
    </div>

        
    <div class="campe" style="text-align: left;	padding-top: 7px;">    
      <label for="textfield"></label>
      <input name="checkedeve<?php echo $cantidadeveact?>" type="radio" value="1" style="margin-left: 11px;"
      <?php if($id != ''){if ($row3["checkedeve"]=="1"){?> checked="checked" <?php }; };?>/>
      <?php echo $row2["nombre"]?>
    </div>

<div class="cf"></div>

<?php if($row2["folio"] == '1'){?>
    <div class="campd dospor">    
     <label for="textfield"></label>
     <input type="text" name="folio<?php echo $cantidadeveact?>"  placeholder="Folio" 
     value="<?php if($id != ''){echo $row3["folio"];	};?>" class="hospitalx"/>
    </div>
<?php }; if($row2["importe"] == '1'){?>
    <div class="campd dospor">    
     <label for="textfield"></label>
     <input type="text" name="importe<?php echo $cantidadeveact?>"  placeholder="Importe" 
     value="<?php if($id != ''){echo $row3["importe"];	};?>" class="hospitalx"/>
    </div>
<?php }; if($row2["archivo"] == '1'){?>
    <div class="campd dospor">    
     <label for="textfield"></label>
     <input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
     <input name="userfile<?php echo $cantidadeveact?>" type="file" class="hospitalx" />
    </div>
 <?php };?>
  </div>
  <?php };	?>

<input type="hidden" name="cantidadeveact" value="<?php echo $cantidadeveact?>"/>
 

  
 
<div class="campitem"><div class="campc"><input type="submit" name="add"  value="Guardar" class="rax"/> 		
<!-- <a href="javascript:document.forma.submit();" class="ra">Guardar</a> -->
</div>



</div>
  
  
  
  
  
  
  
  <div class="cf"></div>
</div>
</div>
</form>
</body>

<?php    $created = date("Y-m-d H:i:s");	?>

<script type="text/javascript" src="./jquery.js"></script>
<script type="text/javascript" src="jquery.datetimepicker.js"></script>
<script type="text/javascript">
$('#datetimepicker').datetimepicker()
<!--	.datetimepicker({value:'<?php //echo $created;?>',step:10});-->

$('#datetimepicker_mask').datetimepicker({
	mask:'9999/19/39 29:59'
});




<?php for($i = 1 ; $i < $cantidadeveact + 1 ; $i++){//apertura del for de muchas horas?>
$('#datetimepicker1<?php echo $i?>"').datetimepicker({
	datepicker:false,
	format:'H:i',
	step:30
})<?php /*if($id != ''){?>
.datetimepicker({value:'<?php echo substr($row["fecha_entrega"],11,2).':'.substr($row["fecha_entrega"],14,2);?>',step:10})
<?php };//*/?> 
;
$('#datetimepicker2<?php echo $i?>"').datetimepicker({
//	yearOffset:222,
	lang:'es',
	timepicker:false,
	format:'Y/m/d',
//	format:'d/m/Y',
	formatDate:'Y/m/d',
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
	inline:true
})<?php if($id != ''){?>
.datetimepicker({value:'<?php echo substr($row["fecha_entrega"],11,2).':'.substr($row["fecha_entrega"],14,2);?>',step:10})
<?php };?> 
;
$('#datetimepicker4').datetimepicker();
$('#open').click(function(){
	$('#datetimepicker4').datetimepicker('show');
});
$('#close').click(function(){
	$('#datetimepicker4').datetimepicker('hide');
});
$('#reset').click(function(){
	$('#datetimepicker4').datetimepicker('reset');
});
$('#datetimepicker5').datetimepicker({
	datepicker:false,
	allowTimes:['12:00','13:00','15:00','17:00','17:05','17:20','19:00','20:00']
});
$('#datetimepicker6').datetimepicker();
$('#destroy').click(function(){
	if( $('#datetimepicker6').data('xdsoft_datetimepicker') ){
		$('#datetimepicker6').datetimepicker('destroy');
		this.value = 'create';
	}else{
		$('#datetimepicker6').datetimepicker();
		this.value = 'destroy';
	}
});
var logic = function( currentDateTime ){
	if( currentDateTime ){
		if( currentDateTime.getDay()==6 ){
			this.setOptions({
				minTime:'11:00'
			});
		}else
			this.setOptions({
				minTime:'8:00'
			});
	}
};
$('#datetimepicker7').datetimepicker({
	onChangeDateTime:logic,
	onShow:logic
});
$('#datetimepicker8').datetimepicker({
	onGenerate:function( ct ){
		$(this).find('.xdsoft_date')
			.toggleClass('xdsoft_disabled');
	},
	minDate:'-1970/01/2',
	maxDate:'+1970/01/2',
	timepicker:false
});
$('#datetimepicker9').datetimepicker({
	onGenerate:function( ct ){
		$(this).find('.xdsoft_date.xdsoft_weekend')
			.addClass('xdsoft_disabled');
	},
	weekends:['01.01.2014','02.01.2014','03.01.2014','04.01.2014','05.01.2014','06.01.2014'],
	timepicker:false
});


$('#datetimepicker10').datetimepicker({
	step:5,
	inline:true
});

$('#datetimepicker_start_time').datetimepicker({
	startDate:'+1970/05/01'
});

$('#datetimepicker_unixtime').datetimepicker({
	format:'unixtime'
});
$('#datetimepicker11').datetimepicker({
        hours12: false,
        format: 'Y-z H:i W',
        step: 1,
        opened: false,
        validateOnBlur: false,
        closeOnDateSelect: false,
        closeOnTimeSelect: false
});
</script>



</html>

<?php

	mysql_close($conn1);
	}
else{
	header("location: login.php");
	};		
	?>