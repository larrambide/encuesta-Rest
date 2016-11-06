<?php

foreach($app->modules as $key => $value){
	require('modules/'.$value.'/index.php');
}

$route->get_route($_GET,$_SERVER['REQUEST_METHOD']);

if(file_exists($route->found_controll_route) && $app->controll_auto_load == true){
	require($route->found_controll_route);
}

if(file_exists($route->found_view_route) && $app->view_auto_load == true){
	require($route->found_view_route);
}


?>