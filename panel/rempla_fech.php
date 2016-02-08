<?php
//						include ("conn1.php");
						
						
function replacemes($str)
{
if($str == '01'){$mes1 = 'Enero';};
if($str == '02'){$mes1 = 'Febrero';}; 
if($str == '03'){$mes1 = 'Marzo';}; 
if($str == '04'){$mes1 = 'Abril';}; 
if($str == '05'){$mes1 = 'Mayo';}; 
if($str == '06'){$mes1 = 'Junio';}; 
if($str == '07'){$mes1 = 'Julio';}; 
if($str == '08'){$mes1 = 'Agosto';}; 
if($str == '09'){$mes1 = 'Septiembre';}; 
if($str == '10'){$mes1 = 'Octubre';}; 
if($str == '11'){$mes1 = 'Noviembre';}; 
if($str == '12'){$mes1 = 'Diciembre';};
					return $mes1;
}							
function replacemesshort($str)
{
if($str == '01'){$mes1 = 'ENE';};
if($str == '02'){$mes1 = 'FEB';}; 
if($str == '03'){$mes1 = 'MAR';}; 
if($str == '04'){$mes1 = 'ABR';}; 
if($str == '05'){$mes1 = 'MAY';}; 
if($str == '06'){$mes1 = 'JUN';}; 
if($str == '07'){$mes1 = 'JUL';}; 
if($str == '08'){$mes1 = 'AGO';}; 
if($str == '09'){$mes1 = 'SEP';}; 
if($str == '10'){$mes1 = 'OCT';}; 
if($str == '11'){$mes1 = 'NOV';}; 
if($str == '12'){$mes1 = 'DIC';};
					return $mes1;
}					
						
function replacemes_it($str)
{
if($str == '01'){$mes1 = 'Gennaio';};
if($str == '02'){$mes1 = 'Febbraio';}; 
if($str == '03'){$mes1 = 'Marzo';}; 
if($str == '04'){$mes1 = 'Aprile';}; 
if($str == '05'){$mes1 = 'Maggio';}; 
if($str == '06'){$mes1 = 'Giugno';}; 
if($str == '07'){$mes1 = 'Luglio';}; 
if($str == '08'){$mes1 = 'Agosto';}; 
if($str == '09'){$mes1 = 'Settembre';}; 
if($str == '10'){$mes1 = 'Ottobre';}; 
if($str == '11'){$mes1 = 'Novembre';}; 
if($str == '12'){$mes1 = 'Dicembre';};
					return $mes1;
}				
						
function replacedia_sem($str)
{
if($str == '0'){$fech1 = 'DOMINGO';};
if($str == '1'){$fech1 = 'LUNES';};
if($str == '2'){$fech1 = 'MARTES';}; 
if($str == '3'){$fech1 = 'MIERCOLES';}; 
if($str == '4'){$fech1 = 'JUEVES';}; 
if($str == '5'){$fech1 = 'VIERNES';}; 
if($str == '6'){$fech1 = 'SABADO';}; 
					return $fech1;
}


		
		function get_string_between($comodin1, $comodin2, $string)
{
    $string = " ".$string;
    $ini = strpos($string,$comodin1);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string,$comodin2,$ini) - $ini;
    $str= substr($string,$ini,$len);
	$ex_final = str_replace("(","",$str);
							  
return $ex_final;

}

?>