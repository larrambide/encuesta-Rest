<?php

class db{
	var $db_app = 'mysql';
	var $db_host = 'localhost';
	var $db_port = '3306';
	var $db_user = '';
	var $db_pass = '';
	var $db_name = '';
	var $db_con = '';

	var $db_active = false;

	function db_connect(){
		if($this->db_active == true && $this->db_app == 'mysql'){
			$con = mysql_connect($this->db_host,$this->db_user,$this->db_pass);
			mysql_select_db($this->db_name,$con);
			/*mysql_query("SET character_set_results=utf8",$con);
			mb_language('uni'); 
			mb_internal_encoding('UTF-8');*/
			mysql_query("set names 'utf8'",$con);

			mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $con);
			return $con;
		}
		if($this->db_active == true && $this->db_app == 'access'){
			$db = getcwd() . "\\" . 'pruebas.accdb';
			// Se define la cadena de conexión
			$dsn = "DRIVER={Microsoft Access Driver (*.accdb)};DBQ=".$db;
			// Se realiza la conexón con los datos especificados anteriormente
			$con = odbc_connect( $dsn, '', '' );
			return $con;
		}
	}
}

?>