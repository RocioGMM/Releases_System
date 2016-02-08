<?php
 mysql_connect("localhost","m2000175_vende","58poPUvure");
 mysql_select_db("m2000175_vende");
// 	$conexion = new mysqli('mysql.congresodemediacion.com','mediacionuser','conmed009','congresonacional',3306);
 $term=$_GET["term"];
// $term=$_REQUEST["term"];
 
 $term2=$term;
 
 $cantidad_d_comas = substr_count($term, ',');//Cuenta la cantidad de comas para saber en que instructor tenemos que trabajar
 
 $variable = explode(",", $term2);///  Extraigo los instructores por separado en un array
 
 if($cantidad_d_comas == '2'){
 $query=mysql_query("SELECT * FROM cliente where nombre_empresa like '%".$variable['2']."%' OR contacto like '%".$term."%' order by nombre_empresa ");
 $json=array();
 
    while($student=mysql_fetch_array($query)){
//		if($student["nombre_corto"] != $variable['0']){
         $json[]=array(
                    'value'=> $variable['0'].",".$variable['1'].",".$student["nombre_empresa"],
                    'label'=>$student["nombre_empresa"],
                        );
	//	};
    }
 };
 
 
 if($cantidad_d_comas == '1'){
 $query=mysql_query("SELECT * FROM cliente where nombre_empresa like '%".$variable['1']."%' OR contacto like '%".$term."%' order by nombre_empresa ");
 $json=array();
 
    while($student=mysql_fetch_array($query)){
         $json[]=array(
                    'value'=> $variable['0'].",".$student["nombre_empresa"],
                    'label'=>$student["nombre_empresa"],
                        );
    }
 };
 
 if($cantidad_d_comas == '0'){
 $query=mysql_query("SELECT * FROM cliente where nombre_empresa like '%".$term."%' OR contacto like '%".$term."%' order by nombre_empresa ");
 $json=array();
 
    while($student=mysql_fetch_array($query)){
         $json[]=array(
                    'value'=> $student["nombre_empresa"].' ('.$student["contacto"].')',
                    'label'=>$student["nombre_empresa"],
                        );
         //echo $student["nombre_empresa"].' ('.$student["contacto"].')';
    }
 };
 
 echo json_encode($json);
// echo '<p>'.$cantidad_d_comas.' - '.$variable['0'].','.$variable['1'];
?>