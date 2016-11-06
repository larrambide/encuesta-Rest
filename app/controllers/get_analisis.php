<?php
header('Content-Type: application/json');

if(count($_POST) > 0){
	$rr = $_POST;
}else{
	$t = file_get_contents('php://input');
	$rr = json_decode($t,1);
}

$r = array();

$wheres = ' where 1=1 ';
$wage = '';
$wgender = '';

if($rr['gender'] > 0){
	$wheres .= ' and genero = '.$rr['gender'];
	$wgender = ' and genero = '.$rr['gender'];
}

if($rr['age'] > 0){
	$wheres .= ' and edad = '.$rr['age'];
	$wage = ' and edad = '.$rr['age'];
}

$sql = 'select avg(servicio) as avg_s, avg(comida) as avg_c, avg(limpieza) as avg_l, avg(precio) as avg_p from encuesta '.$wheres;

$res = mysql_query($sql);
$ress = mysql_fetch_row($res);

//---comparativa de genero

$sql_ch = 'select avg(servicio) as avg_s, avg(comida) as avg_c, avg(limpieza) as avg_l, avg(precio) as avg_p from encuesta where genero = 1 '.$wage;
$res_ch = mysql_query($sql_ch);
$ress_ch = mysql_fetch_row($res_ch);

$sql_cm = 'select avg(servicio) as avg_s, avg(comida) as avg_c, avg(limpieza) as avg_l, avg(precio) as avg_p from encuesta where genero = 2 '.$wage;
$res_cm = mysql_query($sql_cm);
$ress_cm = mysql_fetch_row($res_cm);

$r = array(
	'servicio' => $ress[0],
	'comida' => $ress[1],
	'limpieza' => $ress[2],
	'precio' => $ress[3],

	'c_servicio' => ($ress_cm[0] > $ress_ch[0])? 2 : 1,
	'c_comida' => ($ress_cm[1] > $ress_ch[1])? 2 : 1,
	'c_limpieza' => ($ress_cm[2] > $ress_ch[2])? 2 : 1,
	'c_precio' => ($ress_cm[3] > $ress_ch[3])? 2 : 1,

);

//--calcular si servicio es muy bueno o muy malo o regular

echo json_encode($r);

?>