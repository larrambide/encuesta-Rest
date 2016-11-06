<?php

if(count($_POST) > 0){
	$rr = $_POST;
}else{
	$r = file_get_contents('php://input');
	$rr = json_decode($r,1);
}

$res = $rr['results'];

$r = json_decode($res,1);

$sql = 'insert into encuesta (genero,edad,servicio,comida,limpieza,precio,fecha_alta,hora_alta) values ('.$r[1].','.$r[2].','.$r[3].','.$r[4].','.$r[5].','.$r[6].',"'.date("Y-m-d").'","'.date("H:i:s").'")';

mysql_query($sql);

echo $sql;

?>