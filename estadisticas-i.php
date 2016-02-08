<?php
session_start();

if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'user') || ($_SESSION["tipo"] == 'vendedor')){
    
include ("panel/conn1.php");
include ("panel/rempla_fech.php");


$id = $_POST["id"];if($id == ''){$id = $_REQUEST["id"];};
$mas = $_POST["mas"];if($mas == ''){$mas = $_REQUEST["mas"];};


$created = date("Y-m-d H:i:s");
if($otro_hoy != ''){    $hoy = $otro_hoy;}
else{$hoy = date('Y-m-d');};
            $dia_hoy = substr($hoy,8,2);
            $mes_hoy = substr($hoy,5,2);
            $ano_hoy = substr($hoy,0,4);
            
            $cuenta_dias = 1;
            $empieza = '';
            $dia_cuadro = $ano_hoy.'-'.$mes_hoy.'-01';
            $dia_primero = $ano_hoy.'-'.$mes_hoy.'-01';
            
            $fecha_inicio = $ano_hoy.'-'.$mes_hoy.'-01'; //primer dia del mes
            
            $mes = mktime( 0, 0, 0, $mes_hoy, 1, $ano_hoy ); //encontrar ultimo dia del mes
            $ultimo_dia = date("t",$mes);
            $fecha_fin = $ano_hoy.'-'.$mes_hoy.'-'.$ultimo_dia;// ultimo dia del mes

$dia_testeo = $dia_cuadro;
for($h = 1 ; $h < 32 ; $h ++){
$sql1 = "SELECT * FROM pedidos WHERE fecha_entrega='".$dia_testeo."' ORDER BY fecha_entrega DESC";
$result1 = mysql_query($sql1, $conn1);
$row = mysql_fetch_array($result1);
if($row["id"] != ''){       $matriz_testeo[$h] = 'ok';      };
$dia_testeo = date ( 'Y-m-j' , strtotime( "$dia_testeo +1 day" ) );
}
$mes_sig = date ( 'Y-m-j' , strtotime( "$hoy +1 month" ) );
$mes_ant = date ( 'Y-m-j' , strtotime( "$hoy -1 month" ) );

 $fecha_hora1 = $hoy.' 23:59:00';
 $fecha_hora2 = date ( 'Y-m-j' , strtotime( "$hoy -1 month" ) ).' 00:00:00';
    ?>
         
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=0.5">
<title></title>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href="styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" rel="stylesheet" href="jquery.datetimepicker.css"/>


<!-- GRAFICADOR------------------->

<link href="css/jquery.circliful.css" rel="stylesheet" type="text/css" />
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<style type="text/css"></style>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/jquery.circliful.min.js"></script>

<!--- FIN de GRAFICADORRRR   ---------------------------->



</head>

<body>

<div class="gruap">

<div class="log-out">
  <div class="lo-logo"><img src="logopocket.png" height="42" /></div>
  <div class="lo-logout"><a href="salir.php">Cerrar sesión</a></div>
</div>


    <div class="menubar" >
  <a href="programacion.php" class="op log"></a>
<?php   $sql7 = "SELECT * FROM  usuario WHERE id='".$_SESSION["iduser"]."' ORDER BY id ASC";
        $result7 = mysql_query($sql7, $conn1);
        $row7 = mysql_fetch_array($result7); 
?>
  <a href="cuenta.php" class="op loname">Hola de nuevo, <?php echo $row7["nombre"];?>! <br />
<?php 
        if ($_SESSION["tipo"] != 'user'){
        $sql7 = "SELECT * FROM vendedor WHERE id='".$_SESSION["vendedor"]."' ORDER BY id ASC";
        $result7 = mysql_query($sql7, $conn1);
        $row7 = mysql_fetch_array($result7); 
?>
<span class="machi"><?php if($_SESSION["tipo"] == 'admin'){?>Ver Todas las Ventas<?php }else{?>Ir a tu cuenta ><?php };?></span></a>
<?php };?>


  <a href="programacion.php" class="op lop">Inicio</a>
  <a href="estadisticas.php" class="op mop">Estadisticas</a>
<?php if($_SESSION["tipo"] == 'admin'){?>  <a href="usuarios.php" class="op rop">Usuarios</a><?php  };?>
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
</div>
<div class="btn-proys"><a href="estadisticas.php"><img src="back-estads.png" width="44" height="44" /></a></div>
<span class="titlesec">ESTADISTICAS</span>
</div>
    
<?php $comienzo_cuenta = date ( 'Y-m-j' , strtotime( "$hoy -1 year" ) );
 $fecha_hora_comienzo_cuenta = $comienzo_cuenta.' 00:00:00';// fecha de 30 dias antes primeras horas del dia
 $fecha_horaHoy = $hoy.' 23:59:00'; //fecha de hoy a ultimas horas del dia
 //// conprobamos que pedidos y cuantas veces se hicieron
 $cont = 0;
 $cant_reg = 0;

/*if($mas == 'che'){$sql1 = "SELECT * FROM pedidos WHERE modo_pago='cheque' ORDER BY fecha_entrega ASC";    }
elseif($mas == 'efe'){$sql1 = "SELECT * FROM pedidos WHERE modo_pago='efectivo' ORDER BY fecha_entrega ASC";    }
else{
$sql1 = "SELECT * FROM doc_pedido_hosp WHERE fecha_entrega>='".$fecha_hora_comienzo_cuenta."' AND fecha_entrega<'".$fecha_horaHoy."' ORDER BY fecha_entrega ASC";
};*/
//
if($mas == 'lab'){$sql1 = "SELECT * FROM pedidos WHERE labador!='' ORDER BY fecha_entrega ASC"; }
elseif($mas == 'cli'){$sql1 = "SELECT * FROM pedidos WHERE cliente!='' ORDER BY fecha_entrega ASC"; }
elseif($mas == 'ser'){$sql1 = "SELECT * FROM pedidos WHERE servicio!='' ORDER BY fecha_entrega ASC";    }
elseif($mas == 'fre'){$sql1 = "SELECT * FROM pedidos WHERE fecha_entrega>'".$fecha_hora2."' ORDER BY fecha_entrega ASC";    }
else{$sql1 = "SELECT * FROM pedidos WHERE servicio!='' ORDER BY fecha_entrega ASC"; };
//elseif($mas == 'fre'){$sql1 = "SELECT * FROM pedidos WHERE fecha_entrega>'".$fecha_hora2."' ORDER BY fecha_entrega ASC";  }

//$sql1 = "SELECT * FROM pedidos WHERE fecha_entrega>='".$fecha_hora_treinta_d."' AND fecha_entrega<'".$fecha_horaHoy."' ORDER BY fecha_entrega ASC";
$result1 = mysql_query($sql1, $conn1);
while($row = mysql_fetch_array($result1)){
//  echo $row["servicio"];
    if($row["id"] != ''){
         if($mas == 'lab'){$id_hopn = $row["labador"];  
    }elseif($mas == 'cli'){ $id_hopn = $row["cliente"]; 
    }elseif($mas == 'ser' || $mas == ''){   $id_hopn = $row["servicio"];    };
//          if($matris_cant[$id] == ''){
            if($matris_cant[$id_hopn] == ''){
                $cont = $cont + 1;
                $matris_cant[$id_hopn] = 1;  
                $matris_id[$cont] = $id_hopn; /// pone el id 
                }
            else{
                $matris_cant[$id_hopn] = $matris_cant[$id_hopn] + 1;
                };
            $cant_reg = $cant_reg + 1;
            };
};
////////////////////////////////////////////////////////////////

///  acomodo segun quien tiene MAYOR PEDIDO
$contadorox = $cont * $cont + 1;
$e = 1;
for($h = 1 ; $h < $contadorox + 1 ; $h ++){
    $F1 = $matris_id[$e];   $F2 = $matris_id[$e+1];
    if($matris_cant[$F1] < $matris_cant[$F2]){
        $matris_id[$e] = $F2;   $matris_id[$e+1] = $F1;
        };
    $e = $e + 1;
    if($e == $cont){$e = 1;};
}
/////*/
//////////////////////////////////////////// solo si es CHEQUE V EFECTIVO
    if($mas == 'chefe'){    
            $tot_efe = 0;   
            $tot_che = 0;   
            $tot_tot = 0;   
            $sql1ef = "SELECT * FROM pedidos WHERE modo_pago='efectivo' OR  modo_pago='cheque' ORDER BY fecha_entrega ASC"; 
            $result1efe = mysql_query($sql1ef, $conn1);
            while($rowefe = mysql_fetch_array($result1efe)){
                if($rowefe["id"] != ''){
                    if($rowefe["modo_pago"] == 'efectivo'){     $tot_efe = $tot_efe + 1;    };
                    if($rowefe["modo_pago"] == 'cheque'){    $tot_che = $tot_che + 1;   };
                    $tot_tot = $tot_tot + 1;
                };
            };      
            $porcientoefe = $tot_efe * 100 / $tot_tot;
            $porcientoche = $tot_che * 100 / $tot_tot;
    }; //echo $porcientoefe.' - '.$porcientoche;
//////////////////////////////////////////// FIN de solo si es CHEQUE V EFECTIVO

?>
<div class="tp"><div class="subpanel">

 <?php if($_SESSION["tipo"] == 'admin'){?>
        <a href="datos.php" target="_self" class="losdatos"><img src="ic-sets.png" width="20" height="20" /></a>
<?php };?> 
</div>
 <div class="cf"></div>
</div>









<div class="onecol">







<!-- ------------- FORMULARIO DE FECHAS ------------------>
<form  action="estadisticas-i.php" name="frmRegistro">
<div class="filtro">
<div class="">
    <span class="indic">MOSTRAR DESDE </span>
    <div class="campx" ><?php //echo $movil;?> 
      <label for="textfield"></label>
      <input type="text" name="fechaest1" id="datetimepicker2" placeholder="Fecha Inicio" class="hospitalzz" value="<?php echo $_REQUEST["fechaest1"];?>"/>
    </div>
    <span class="indic">A  </span>
    <div class="campx" ><?php //echo $movil;?> 
      <label for="textfield"></label>
      <input type="text" name="fechaest2" id="datetimepicker2b" placeholder="Fecha" class="hospitalzz" value="<?php echo $_REQUEST["fechaest2"];?>"/>
    </div>
    <input type="hidden" name="id" value="<?php echo $_REQUEST["id"];?>"/>
<input type="image" src="search-icon.png" name="add"  value="Checar" class="raxy" />    
</div>      
</div>
</form>
<!-- ------------- FIN DE FORMULARIO DE FECHAS ------------------>






 <?php //echo $buscar;
 $espaciado = 0;
 $veces_text = 0;
 $fechaest1 = $_POST["fechaest1"];  
    if($fechaest1 == '' && $_REQUEST["fechaest1"] != ''){       
        $fechaest1 = substr($_REQUEST["fechaest1"],8,2).'-'.substr($_REQUEST["fechaest1"],5,2).'-'.substr($_REQUEST["fechaest1"],0,4).' 00:00:00';  
    };
 $fechaest2 = $_POST["fechaest2"];  
    if($fechaest2 == '' && $_REQUEST["fechaest2"] != ''){       
        $fechaest2 = substr($_REQUEST["fechaest2"],8,2).'-'.substr($_REQUEST["fechaest2"],5,2).'-'.substr($_REQUEST["fechaest2"],0,4).' 23:59:00';  
    };
 $fechaest1 = str_replace("%20", " ",  $fechaest1);
 $fechaest2 = str_replace("%20", " ",  $fechaest2);

 if($fechaest1 == '' || $fechaest2 == ''){
     $dia_sem1= date("w",mktime(0, 0, 0, substr($hoy,5,2), substr($hoy,8,2), substr($hoy,0,4)));     //localizo el dia de la semana que comienzo el mes
     $restadiasen = 6 - $dia_sem1;
     //$fecha_hora2 = $hoy.' 00:00:00';
     //$fecha_hora3 = $hoy.' 23:59:59';
     $fecha_hora1 = date ( 'Y-m-j' , strtotime( "$fechaest1 -$dia_sem1 day" ) ).' 00:00:00';
     $fecha_hora2 = date ( 'Y-m-j' , strtotime( "$hoy +$restadiasen day" ) ).' 23:59:00';
 }
else{
     $fecha_hora1 = substr($fechaest1,6,4).'-'.substr($fechaest1,3,2).'-'.substr($fechaest1,0,2).' 00:00:00';
     $fecha_hora2 = substr($fechaest2,6,4).'-'.substr($fechaest2,3,2).'-'.substr($fechaest2,0,2).' 23:59:59';
}; 

/*$sql1 = "SELECT * FROM evento_act WHERE fecha>='".$fecha_hora1."' AND fecha<'".$fecha_hora2."' AND vendedor = '".$id."' ORDER BY fecha ASC";
$result1 = mysql_query($sql1, $conn1);
while($row = mysql_fetch_array($result1)){//*/


 if ($_SESSION["tipo"] != 'vendedor'){        $vendedoract = $id;
}else{        $vendedoract = $_SESSION["vendedor"];};
 

        $sql2 = "SELECT * FROM evento WHERE vendedor='".$vendedoract."' ORDER BY fecha_captura DESC";
        $result2 = mysql_query($sql2, $conn1);
        while($row2 = mysql_fetch_array($result2)){

?>
<?  $dia_registrado = substr($row["fecha"],0,4).'-'.substr($row["fecha"],5,2).'-'.substr($row["fecha"],8,2);
    //if ($dia_bandera != $dia_registrado){ $dia_bandera = $dia_registrado;
?>
  <?php if( $veces_text == 0){

        $sql7 = "SELECT * FROM vendedor WHERE id='".$vendedoract."' ORDER BY id ASC";
        $result7 = mysql_query($sql7, $conn1);
        $row7 = mysql_fetch_array($result7); 
    ?>


<span class="titlecol-ad ades" > <?php echo $row7["nombre"].' '.$row7["apellido"];?> </span> 





<div class="divline"></div>

<div class="cf"><div class="prints"> 
<a class="various" data-fancybox-type="iframe" href="enviamail2.php?id=<?php echo $id;?>&fechaest1=<?php echo $fechaest1;?>&fechaest2=<?php echo $fechaest2;?>" >
    <img src="ic-mail.png" width="23" height="23" /></a>
<a  href='javascript:window.print(); void 0;'><img src="ic-print.png" width="23" height="23" /></a></div></div>

<div id="stickem"></div>
  <div id="sticker">  
    <div class="time-s ti" ice:editable="*">PROYECTO</div>
    <div class="t-contact">CLIENTE</div>
    <div class="t-actividad"><!--ACTIVIDAD--></div>
    <div class="t-desit">FECHA DE INICIO</div>
    <div class="t-progres">PROGRESO</div>
  </div>  
    
  <div class="initem totalis">
    <div class="time-s ti"></div>
    <div class="t-contact"></div>
    <div class="t-actividad"></div>
    <div class="t-desit"></div>
    <div class="t-progres">
    <?php
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
    ?>
      <div class="totals"><?php echo $total_llamadas1;?></div>
      <div class="totals"><?php echo $total_visitas1;?></div>
      <div class="totals"><?php echo $total_diagnosticos1;?></div>
      <div class="totals"><?php echo $total_cotizacion1;?></div>
      <div class="totals"><?php echo $total_muestra1;?></div>
      <div class="totals"><?php echo $total_cierre1;?></div>
    </div>
  </div> 
<?php };     $veces_text = 1;   ?>
    <div class="initem"<?php  if($espaciado == 1){echo 'style="margin-top:15px"';}//para el espaciado entre items
            else{echo 'style="margin-top:15px"';};  ?>>
            
    
    
    <a <?php  if ($_SESSION["tipo"] != 'user'){?> href="agregar-evento.php?id=<?php echo $row["id"];?>"<?php };?> target="_self">  
        <div class="time-s ti"><?php   echo $row2["evento"];// EVENTO?> </div>  
    </a>  

    
    
    <div class="contact">  <?php 
        $sql3 = "SELECT * FROM cliente WHERE id='".$row2["cliente"]."' ORDER BY id ASC";
        $result3 = mysql_query($sql3, $conn1);
        $row3 = mysql_fetch_array($result3);
        echo $row3["nombre_empresa"];// ·EMPRESA·      ?>
    </div>


    <div class="actividad"> <?php /*
        $sql3 = "SELECT * FROM evento_cat WHERE id='".$row["evento_cat"]."' ORDER BY id ASC";
        $result3 = mysql_query($sql3, $conn1);
        $row3 = mysql_fetch_array($result3);
        echo $row3["nombre"]; ///////////   ACTIVIDAD*/?></div>
    

    <div class="t-desit">    <?php echo substr($row2["fecha_captura"],8,2).' '.replacemes(substr($row2["fecha_captura"],5,2));?>     </div>
    
    <?php if($_SESSION["tipo"] != 'user'){?>
<div class="ic-idel"><a href="agregar-evento.php?id=<?php echo $row["id"];?>" target="_self"><img src="editaricon.png" width="44" height="44" border="0" /></a></div>
    <?php };?> 
 
 <?php //DETECTAR EL ULTIMO EVENTO CHECK
        $sql5 = "SELECT * FROM evento_act WHERE evento='".$row2["id"]."' AND checkedeve ='1' ORDER BY fecha DESC";// Llamada
        $result5 = mysql_query($sql5, $conn1);
        $row5 = mysql_fetch_array($result5); 
        $evento_ck_ult = $row5["id"];
?>

    <div class="t-progres imgalcost nitop"> 
    <?php 
        $sql5 = "SELECT * FROM evento_act WHERE evento='".$row2["id"]."' AND evento_cat ='1' ORDER BY id DESC";// Llamada
        $result5 = mysql_query($sql5, $conn1);
        $row5 = mysql_fetch_array($result5); 

        if($row5["id"] == $evento_ck_ult){
    ?>
            <img src="telefono.png" width="42" height="42" border="0" />

    <?php }elseif($row5["checkedeve"] == '1'){?>
            <img src="telefono.png" width="42" height="42" border="0" />
            
    <?php }else{?>
            <img src="gristelefono.png" width="42" height="42" border="0" />
    <?php };?>

    <?php 
        $sql5 = "SELECT * FROM evento_act WHERE evento='".$row2["id"]."' AND evento_cat ='2' ORDER BY id DESC";// Visita
        $result5 = mysql_query($sql5, $conn1);
        $row5 = mysql_fetch_array($result5); 

        if($row5["id"] == $evento_ck_ult){
    ?>
            <img src="casaicon.png" width="42" height="42" border="0" />

    <?php }elseif($row5["checkedeve"] == '1'){?>
            <img src="casaicon.png" width="42" height="42" border="0" />
            
    <?php }else{?>
            <img src="griscasa.png" width="42" height="42" border="0" />
    <?php };?>

    <?php 
        $sql5 = "SELECT * FROM evento_act WHERE evento='".$row2["id"]."' AND evento_cat ='5' ORDER BY id DESC";// Diagnostico
        $result5 = mysql_query($sql5, $conn1);
        $row5 = mysql_fetch_array($result5); 

        if($row5["id"] == $evento_ck_ult){
    ?>
            <img src="diagnostico.png" width="42" height="42" border="0" />

    <?php }elseif($row5["checkedeve"] == '1'){?>
            <img src="diagnostico.png" width="42" height="42" border="0" />
            
    <?php }else{?>
            <img src="grisdiagnostico.png" width="42" height="42" border="0" />
    <?php };?>

    <?php 
        $sql5 = "SELECT * FROM evento_act WHERE evento='".$row2["id"]."' AND evento_cat ='3' ORDER BY id DESC";// Cotizacion
        $result5 = mysql_query($sql5, $conn1);
        $row5 = mysql_fetch_array($result5); 

        if($row5["id"] == $evento_ck_ult){
    ?>
            <img src="monto.png" width="42" height="42" border="0" />

    <?php }elseif($row5["checkedeve"] == '1'){?>
            <img src="monto.png" width="42" height="42" border="0" />
            
    <?php }else{?>
            <img src="grismonto.png" width="42" height="42" border="0" />
    <?php };?>

    <?php 
        $sql5 = "SELECT * FROM evento_act WHERE evento='".$row2["id"]."' AND evento_cat ='6' ORDER BY id DESC";// Cierre
        $result5 = mysql_query($sql5, $conn1);
        $row5 = mysql_fetch_array($result5); 

        if($row5["id"] == $evento_ck_ult){
    ?>
            <img src="flechaabajo.png" width="42" height="42" border="0" />

    <?php }elseif($row5["checkedeve"] == '1'){?>
            <img src="flechaabajo.png" width="42" height="42" border="0" />
            
    <?php }else{?>
            <img src="grisflechaabajo.png" width="42" height="42" border="0" />
    <?php };?>

    <?php 
        $sql5 = "SELECT * FROM evento_act WHERE evento='".$row2["id"]."' AND evento_cat ='4' ORDER BY id DESC";// Muestra
        $result5 = mysql_query($sql5, $conn1);
        $row5 = mysql_fetch_array($result5); 

        if($row5["id"] == $evento_ck_ult){
    ?>
            <img src="palomitaverde.png" width="42" height="42" border="0" />

    <?php }elseif($row5["checkedeve"] == '1'){?>
            <img src="palomitaverde.png" width="42" height="42" border="0" />
            
    <?php }else{?>
            <img src="palomagris.png" width="42" height="42" border="0" />
    <?php };?>

    </div>
    
    
    
    
    <!--<div class="i-stat">
    <?php if($row["entregado"] == '1'){?>Entregado<br /><?php }?>
    <?php if($row["pagado"] == '1'){?>Pagado<?php }//*/?>
    <?php if($row["entregado"] != '1' && $row["pagado"] != '1'){?>Capturado <?php };//*/?>
    </div>-->
    
     

    <br />
<?php };?>  
  
  </div>
  
  
  
  
  
  


  
  
 
  <div class="cf"></div>
</div>

</div>







<?php    $created = date("Y-m-d H:i:s");    ?>

<!--<script type="text/javascript" src="./jquery.js"></script>-->
<script type="text/javascript" src="jquery.datetimepicker.js"></script>
<script type="text/javascript">
$('#datetimepicker').datetimepicker()
<!--    .datetimepicker({value:'<?php //echo $created;?>',step:10});-->

$('#datetimepicker_mask').datetimepicker({
    mask:'9999/19/39 29:59'
});
       
$('#datetimepicker1').datetimepicker({
    datepicker:false,
    format:'H:i',
    step:30
});
$('#datetimepicker2').datetimepicker({
    lang:'es',
    timepicker:false,
    format:'d/m/Y',
    formatDate:'d/m/y',
});    
$('#datetimepicker2b').datetimepicker({
    lang:'es',
    timepicker:false,
    format:'d/m/Y',
    formatDate:'d/m/y',
});      

$('#datetimepicker3').datetimepicker({
    lang:'es',
    timepicker:false,
    formatDate:'Y/m/d',
    inline:true
});
$('#datetimepicker3b').datetimepicker({ 
    datepicker:false,
    format:'H:i',
    step:30,
    inline:true
});
</script>







<script>
$( document ).ready(function() {
        $('#myStathalf').circliful();
        $('#myStat').circliful();
        $('#myStathalf2').circliful();
        $('#myStat2').circliful();
        $('#myStat2s').circliful();
        $('#myStat3').circliful();
    });
</script>

</body>
</html>

<?php

    mysql_close($conn1);
    }
else{
    header("location: login.php");
    };  
?>