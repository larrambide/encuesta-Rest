<?php

$app = new giga();
$helper = new helper();
$route = new routes();
$db = new db();

$app->name = 'encuestas_sa';
$app->base_url = 'http://localhost/site/encuestas/';

$app->public_route = 'public/';

$app->view_auto_load = false;

$db->db_app = 'mysql';
$db->db_name = 'encuestas';
$db->db_host = 'localhost';
$db->db_user = 'root';
$db->db_pass = 'lili';
$db->db_active = true;
$db->db_connect();

date_default_timezone_set('America/Mexico_City');


//-basic
$app->set_css('basic',array('app.css'));
$app->set_js('basic',array('core/angular/angular.min.js','core/charts/charts.js','app.js'));

//---

//--picker
//$app->set_css('datepicker',array('jquery.datetimepicker.css'));
//$app->set_js('datepicker',array('datetimepicker/jquery.datetimepicker.js'));
//---




?>