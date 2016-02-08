<?php 
session_start();
set_time_limit(5555);
ini_set('post_max_size','100M');
ini_set('upload_max_filesize','100M');
ini_set('max_execution_time','1000');
ini_set('max_input_time','1000');
if((isset($_SESSION["user"])) && ($_SESSION["tipo"] == 'admin') || ($_SESSION["tipo"] == 'user') || ($_SESSION["tipo"] == 'vendedor')){
  
  include ("panel/conn1.php");

  $sql1 = "SELECT * FROM libramientos WHERE id='".$_REQUEST["id"]."' ";
  $result1 = mysql_query($sql1, $conn1);
  //$total_registrosdeldia = mysql_num_rows($result1);
  $row1 = mysql_fetch_array($result1);


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Administrador</title>
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<link href="styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="menubar">
  <a href="programacion.php" class="op lop">Inicio</a>
  <a href="reportes.php" class="op mop">Reportes</a>
<?php if($_SESSION["tipo"] == 'admin'){?>  <a href="usuarios.php" class="op rop">Usuarios</a><?php  };?>
<?php if($_REQUEST["acc"]=='mod'){?>   <a href="agregar-libra.php?id=<?= $_REQUEST["id"]?>" class="op atr" >Atras</a><?php  };?>
</div>

<div class="tp">
  <div class="cf"></div>
</div>

<div class="onecol"><span class="titlecol">

<span class="texto_vm_des">
  <?php 
    echo $row1["tipo"].'<br>';
    if($_REQUEST["id"] == ''){echo 'Agregar';}elseif($_REQUEST["acc"] == 'mod'){echo 'Modificacion de ';}else{echo 'Detalle de';};
  ?>  
  Liberacion de derechos de Via  
</span>

<?php if($_REQUEST["id"] != ''){ 
    if($_REQUEST["acc"] != 'mod'){ 
    echo ' - '.$row1["expediente"].'<br><span class="texto_vm_des">Nombre del Afectado: </span>'.$row1["nombre"];
    echo 'Afectacion: '.$row1["afectacion"].' m2';
?>
    <div id="mostr_oc_txt1" style="display:block;" onclick="muestra_oculta('mostr_oc'),muestra_oculta('mostr_oc_txt1'),muestra_oculta('mostr_oc_txt2')">+</div>
    <div id="mostr_oc_txt2" style="display:none;" onclick="muestra_oculta('mostr_oc'),muestra_oculta('mostr_oc_txt1'),muestra_oculta('mostr_oc_txt2')">-</div>
    <?php }; if($_REQUEST["acc"] != 'mod'){?>
        <a href="agregar-libra.php?id=<?= $_REQUEST["id"]?>&acc=mod" style="display:block;" class="modificar2">Mod</a>
        <a style="display:block;" class="modificar3" onclick="muestra_oculta('add_prog'),muestra_oculta('Guardar')">+ Progr</a>
    <?php }; if($_REQUEST["acc"] == 'mod'){?>
        <a href="javascript:window.print()" style="display:block;" class="modificar4"><img src="printer.svg" alt="" /></a>
    <?php };?>

  <div id="mostr_oc" style="display:none;">
    <?php if($_REQUEST["acc"] != 'mod'){
       echo '<div class="vermas_addmod"><span class="texto_vm_des">Cadenamiento:</span> '.$row1["encadenamiento"];
       echo '<br><span class="texto_vm_des">Superficie Total:</span> '.$row1["superficie"];
       echo '<br><span class="texto_vm_des">RPA:</span> '.$row1["RPA"];
       echo '<br><span class="texto_vm_des">Contrato:</span> '.$row1["contrato"];
       echo '<br><span class="texto_vm_des">Superficie Total Escrituras de Propiedad:</span> '.$row1["superficie_escrituras"].'</div>';

       echo '<div class="vermas_addmod"><span class="texto_vm_des">Documentos que acreditan la Propiedad:</span> '.$row1["docu_acred"];
       echo '<br><span class="texto_vm_des">Datos de registro publico de Propiedad:</span> '.$row1["docu_regitro_publ"];
       echo '<br><span class="texto_vm_des">Observaciones:</span> '.$row1["observaciones"].'</div>';

       echo '<div class="vermas_addmod"><span class="texto_vm_des">Certificado de Libertad de Gravamen:</span> '.$row1["certificado_gravamen"];
       echo '</div>';


       echo '<div class="vermas_addmod"><span class="texto_vm_des">Constancia o certificado de no adeudos fiscales (predial y agua):</span> '.$row1["certificado_no_adeudo"];
       echo '<br><span class="texto_vm_des">Clave Catastral:</span> '.$row1["clave_catastral"].'</div>';
       echo '<br><div class="vermas_addmod"><span class="texto_vm_des">Observaciones:</span> '.$row1["observaciones2"].'</div>';
      };
    ?>
  </div>
  <script>
  function muestra_oculta(id){
        if (document.getElementById){ //se obtiene el id
        var el = document.getElementById(id); //se define la variable "el" igual a nuestro div
        el.style.display = (el.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
        }
    }
  </script>
<?php };?>
</span>






<form method="post" action="panel/a_lib.php" name="frmRegistro" enctype="multipart/form-data" >
<input type="hidden" name="id" value="<?php echo $_REQUEST["id"];?>"/>
<input type="hidden" name="acc" value="<?php echo $_REQUEST["acc"];?>"/>
<input type="hidden" name="lugar" value="<?php echo $_REQUEST["lugar"];?>"/>


<?php if($_REQUEST["id"] == '' || $_REQUEST["acc"] == 'mod'){?>
  <div class="campitem">

        <div class="campb">
            <label for="textfield"></label>
            <div>Tipo</div>
            <div class="print_yes"><?= $row1["tipo"]?></div>
            <select name="tipolv" id="textfield"  class="hospitalx print_sin" style="height: 44px;">
                  <option value="Contrato" <?php if($row1["tipo"] == 'Contrato'){echo ' selected';};?>>Contrato</option>
                  <option value="Convenio" <?php if($row1["tipo"] == 'Convenio'){echo ' selected';};?>>Convenio</option>                  
            </select>
        </div>
  </div>

<div class="campitem">      
        <div class="campb">
            <label for="textfield"></label>
            <div>Folio</div><div class="print_yes"><?= $row1["expediente"]?></div>
            <input type="text" name="expediente" class="campoinput print_sin"  placeholder="Folio" value="<?= $row1["expediente"]?>" />
        </div>
        <div class="campb dospor">
        <div>Nombre del Afectado</div><div class="print_yes"><?= $row1["nombre"]?></div>
        <input type="text" name="nombre" id="textfield" class="print_sin" placeholder="" value="<?= $row1["nombre"]?>" />
        </div>
        <div class="campb ">
        <div>Afectacion</div><div class="print_yes"><?= $row1["afectacion"]?> m2</div>
        <input type="text" name="afectacion" class="campoinput_af print_sin" placeholder=" " value="<?= $row1["afectacion"]?>" /> 
        <span class="print_sin">  m2 </span>       
        </div>
        
        <div class="campb dospor">
        <!--<div>m2</div>
        <input type="text" name="M2" id="textfield" placeholder="M2" value="<?= $row1["M2"]?>" />-->
        </div>
  </div>

  <div class="campitem">
    <div class="campb">
      <label for="textfield"></label>
      <div>Cadenamiento</div><div class="print_yes"><?= $row1["encadenamiento"]?> </div>
      <input type="text" name="encadenamiento" class="campoinput print_sin"   value="<?= $row1["encadenamiento"]?>"/>
    </div>
    <div class="campb dospor">
    <div>Superficie Total</div><div class="print_yes"><?= $row1["superficie"]?> </div>
    <input type="text" name="superficie" id="textfield" class="print_sin" value="<?= $row1["superficie"]?>"/>
    </div>
    <div class="campb ">
    <div>RPA<input type="checkbox" name="RPA"  class="print_sin" value="si" <?php if($row1["RPA"]=='si'){echo 'checked';}; ?> /></div>
    <div class="print_yes"><?= $row1["RPA"]?> </div>    
    </div>
    <div class="campb dospor">
    <div>Contrato <input type="checkbox" name="contrato" class="print_sin" value="si" <?php if($row1["RPA"]=='si'){echo 'checked';}; ?>/></div>
    <div class="print_yes"><?= $row1["contrato"]?> </div>    
    </div>
    <div class="campb ">
    <div>Superficie Total Escrituras de Propiedad</div><div class="print_yes"><?= $row1["superficie_escrituras"]?> </div>
    <input type="text" name="superficie_escrituras" class="print_sin" id="textfield" value="<?= $row1["superficie_escrituras"]?>"/>
    </div>
  </div>

  <div class="campitem">
    <div class="campb">
    <div>Documentos que acreditan la Propiedad</div><div class="print_yes"><?= $row1["docu_acred"]?> </div>
      <input type="text" name="docu_acred" id="textfield" class="print_sin" value="<?= $row1["docu_acred"]?>" placeholder=""/>
    </div>
    <div class="campb dospor">
    <div>Datos de registro publico de Propiedad</div><div class="print_yes"><?= $row1["docu_regitro_publ"]?> </div>
      <input type="text" name="docu_regitro_publ" id="textfield" value="<?= $row1["docu_regitro_publ"]?>" class="print_sin"/>
    </div>
    <div class="campf">
    <div>Observaciones</div><div class="print_yes"><?= $row1["observaciones"]?> </div>
      <textarea name="observaciones"placeholder="" class="textareaform print_sin" /><?= $row1["observaciones"]?></textarea>
    </div>
  </div>

  <div class="campitem">
    <div class="campb">      
    <div>Certificado de Libertad de Gravamen</div>
      <input type="text" name="certificado_gravamen" id="textfield" value="<?= $row1["certificado_gravamen"]?>" class="print_sin"/>
    </div>
  </div>

  <div class="campitem">
    <div class="campb">      
    <div>Constancia o certificado de no adeudos fiscales (predial y agua)</div>
    <div class="print_yes"><?= $row1["certificado_gravamen"]?> </div>
      <input type="text" name="certificado_no_adeudo" id="textfield" value="<?= $row1["certificado_no_adeudo"]?>"  class="print_sin"/>
    </div>
    <div class="campb dospor">
    <div>Clave Catastral</div><div class="print_yes"><?= $row1["certificado_gravamen"]?> </div>
      <input type="text" name="clave_catastral" id="textfield" value="<?= $row1["clave_catastral"]?>"  class="print_sin"/>
    </div>
  </div>

  <div class="campitem">
    <div class="campf">
    <div>Observaciones</div><div class="print_yes"><?= $row1["certificado_gravamen"]?> </div>
      <textarea name="observaciones2"  placeholder="" class="textareaform print_sin" /><?= $row1["observaciones2"]?></textarea>
    </div>
  </div>

  <?php }

elseif($_REQUEST["acc"] != 'mod'){///////////////////////////////////////////////////////////////////////////////////

  ?>
  <div class="onecol vermas_addmod saca_borde" style="float:left;"><span class="titlecol"> Progreso. </span></div>


  <div class="campitem" style="display:none;" id="add_prog">
    <div class="campb">
      <label for="textfield"></label>
      <input type="text" name="fecha" id="datetimepicker2" placeholder="Fecha : dd/mm/aaaa" class="campoinputmedia" />
      <input type="file" name="userfile1" id="csv-file" class="campoinputmedia cima2" onchange="selectarch()" />

    </div>
    <div class="campb dospor">
    <select name="tipo" id="" class="campoinput">
      <option value="" disabled="disabled" selected>Tipo</option>
       <?php
        $sql9h= "SELECT * FROM progreso_tipo ORDER BY id ASC";       
        $result9h = mysql_query($sql9h, $conn1);
        while($row9h = mysql_fetch_array($result9h)){
          if($row1["tipo"] == 'Contrato'){ $nom1 = $row9h["nombre"]; }
          else{ $nom1 = $row9h["nombre2"]; };
          if($nom1 != 'N/A'){
      ?>
      <option value="<?= $row9h["id"] ?>"><?php 
      if($row1["tipo"] == 'Contrato'){ echo utf8_encode($row9h["nombre"]); }
      else{ echo utf8_encode($row9h["nombre2"]); };
      ?></option>
      <?php }; };?>
    </select>
    </div>

    <div class="campc">
      <textarea name="comentario" cols="" rows="" placeholder="Comentario"/></textarea>
    </div>
    <div class="campd dospor">
            <div><input type="text" name="link" placeholder="Link de Archivo" class="campoinput" /></div>
            <div class="check_text_tb">
                  <div class="check_text">Estado</div>
                  <div id="check_rojo" onclick="rojoo_check()" style:"border-color: transparent;">
                        <input type="radio" name="estado" value="FF0000" class="checkbox_semaforo" checked />
                  </div>      
                  <div id="check_amarillo" onclick="amari_check()" style:"border-color: transparent;">
                        <input type="radio" name="estado" value="FFFF00" class="checkbox_semaforo" />
                  </div>     
                  <div id="check_verde" onclick="verde_check()" style:"border-color: transparent;">
                        <input type="radio" name="estado" value="01DF01" class="checkbox_semaforo" />
                  </div>
            </div>
    </div>
  </div>
<script>
  function selectarch(){
    document.getElementById("csv-file").style.backgroundColor = "#01DF01";
  }
  function verde_check(){
    document.getElementById("check_verde").style.borderColor = "#999999";
    document.getElementById("check_amarillo").style.borderColor = "transparent";
    document.getElementById("check_rojo").style.borderColor = "transparent";
    document.getElementsByName('estado')[2].checked=true;
  }
  function amari_check(){
    document.getElementById("check_amarillo").style.borderColor = "#999999";
    document.getElementById("check_rojo").style.borderColor = "transparent";
    document.getElementById("check_verde").style.borderColor = "transparent";
    document.getElementsByName('estado')[1].checked=true;
  }
  function rojoo_check(){
    document.getElementById("check_rojo").style.borderColor = "#999999";
    document.getElementById("check_amarillo").style.borderColor = "transparent";
    document.getElementById("check_verde").style.borderColor = "transparent";
    document.getElementsByName('estado')[0].checked=true;
  }
</script>

<?php };///////////////////////////////////////////////////////////////////////////////////7?>
  
  
  <div class="cf"></div>

  
  <div class="campitem dospor">
    <div class="campc">
      
    <!--<a href="." class="ra">Guardar</a>-->
    <input type="submit" value="Guardar" name="submit0" class="ra-bu" id="Guardar" <?php 
      if($_REQUEST["acc"] != 'mod' && $_REQUEST["id"] != ''){
          echo 'style="display:none;"';
      };
    ?>>
    </div>
  </div>


  </form>
  
  

       <?php $tipo_pro = 0;
        $sqlp= "SELECT * FROM progreso WHERE libramiento='".$_REQUEST["id"]."' ORDER BY tipo, id DESC ";       
        $resultp = mysql_query($sqlp, $conn1);
        while($rowp = mysql_fetch_array($resultp)){ 
          $sqlp1= "SELECT * FROM progreso_tipo WHERE id='".$rowp["tipo"]."' ORDER BY id ASC";       
          $resultp1 = mysql_query($sqlp1, $conn1);
          $rowp1 = mysql_fetch_array($resultp1);
            if($_REQUEST["acc"] != 'mod'){
      ?>
          <?php if($rowp["tipo"] != $tipo_pro){$tipo_pro = $rowp["tipo"];?>
              <div class="tipo_progreso"><?= utf8_encode($rowp1["nombre"])?></div>
          <?php };?>
        <div class="campitem">
          <?php if($rowp["archivo"] != ''){?>   <a href="archivo/<?= $rowp["archivo"]?>" target="_blank" class="archivo_progreso">Descargar</a>   <?php };//*/?>
          <?php if($rowp["link"] != ''){?>   <a href="<?= $rowp["link"]?>" target="_blank" class="archivo_progreso">Descargar</a>   <?php };//*/?>
          
          <div class="comentario_progreso"><?= $rowp["comentario"]?>.</div>
          <a onclick="confirmar('<?= $rowp["id"]?>')" class="del_pro"></a>
        </div>

      <?php }; };?>
  
  
  <script language="Javascript"> 
      function confirmar(id){ 
          confirmar=confirm("¿Estas seguro/a que quieres borrar este progreso?"); 
          if (confirmar) {
            // si pulsamos en aceptar
            var url_pro = "panel/b_pro.php?id=" + id + "&id2=<?= $_REQUEST["id"]?>&lugar=<?= $_REQUEST["lugar"]?>";
            window.location.href = url_pro;
          }
          else {
            // si pulsamos en cancelar
          };           
      } 
  </script>
  
  <div class="cf"></div>
</div>



<?php    $created = date("Y-m-d H:i:s");  ?>

<!--<script type="text/javascript" src="./jquery.js"></script>-->
<script type="text/javascript" src="jquery.datetimepicker.js"></script>
<script type="text/javascript">

$('#datetimepicker').datetimepicker()
  .datetimepicker({value:'2015/04/15 05:03',step:10});

$('#datetimepicker_mask').datetimepicker({
  mask:'9999/19/39 29:59'
});

$('#datetimepicker1').datetimepicker({
  datepicker:false,
  format:'H:i',
  step:5
});
$('#datetimepicker2').datetimepicker({
  yearOffset:222,
  lang:'ch',
  timepicker:false,
  format:'d/m/Y',
  formatDate:'Y/m/d',
  minDate:'-1970/01/02', // yesterday is minimum date
  maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});
$('#datetimepicker3').datetimepicker({
  inline:true
});
</script>


</body>
</html>

<?php
  mysql_close($conn1);
  }
else{
  header("location: index.php");
  //echo $_SESSION["user"];
  };  
?>

