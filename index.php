<?php
session_start();
//header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html; charset=utf-8');
//header("Accept-Encoding: gzip");

require('core/giga.php');
require('core/routes.php');
require('core/model.php');
require('core/db.php');
require('core/field.php');
require('core/helper.php');

require('app/settings.php');
require('app/routes.php');
require('core/visualizer.php');
	
?>