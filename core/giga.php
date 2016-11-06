<?php

class giga{
	var $version = '1';
	var $name = '';
	var $base_url = '';
	var $base_route = '';
	var $is_module = false;

	var $global_data = array();

	var $controll_auto_load = true;
	var $view_auto_load = true;

	var $public_route = 'public/';
	
	var $js = array();
	var $css = array();

	var $modules = array();

	function load_from_app($app){
		$this->is_module = $app->is_module;
		$this->base_url = $app->base_url;
		$this->base_route = $app->base_route;
		$this->public_route = $app->public_route;
		$this->global_data = $app->global_data;
		$this->controll_auto_load = $app->controll_auto_load;
		$this->view_auto_load = $app->view_auto_load;
		$this->js = $app->js;
		$this->css = $app->css;
	}

	function set_global($name,$value){
		$this->global_data[$name] = $value;
	}
	
	function set_js($key,$js){
		$this->js[$key] = $js;
	}
	
	function set_css($key,$css){
		$this->css[$key] = $css;
	}
	
	function include_js($key,$use_module = false){
		$res = '';
		if($key != false && array_key_exists($key,$this->js)){
			foreach($this->js[$key] as $n => $v){
				$pos1 = strpos($v,'http://');
				$pos2 = strpos($v,'https://');
				if($pos1 === false && $pos2 === false){
					if($use_module == false){
						$res .= '<script type="text/javascript" src="'.$this->public_route.'js/'.$v.'"></script>'."\n";
					}else{
						$res .= '<script type="text/javascript" src="modules/'.$this->base_route.'/'.$this->public_route.'js/'.$v.'"></script>'."\n";
					}
				}else{
					$res .= '<script type="text/javascript" src="'.$v.'"></script>'."\n";
				}
			}
		}
		return $res;
	}
	
	function include_css($key,$use_module = false){
		$res = '';
		if($key != false && array_key_exists($key,$this->css)){
			foreach($this->css[$key] as $n => $v){
				$pos1 = strpos($v,'http://');
				$pos2 = strpos($v,'https://');
				if($pos1 === false && $pos2 === false){
					if($use_module == false){
						$res .= '<link type="text/css" rel="stylesheet" href="'.$this->public_route.'css/'.$v.'" />'."\n";
					}else{
						$res .= '<link type="text/css" rel="stylesheet" href="modules/'.$this->base_route.'/'.$this->public_route.'css/'.$v.'" />'."\n";
					}
				}else{
					$res .= '<link type="text/css" rel="stylesheet" href="'.$v.'" />'."\n";
				}
			}
		}
			return $res;
	}

	function make_curl($method,$type,$url,$data=array(),$headers=''){
		$response = json_encode(array());
		if($method == 'get'){
			$handler = curl_init();
			curl_setopt($handler,CURLOPT_URL,$url);
			curl_setopt($handler,CURLOPT_HTTPGET,true);
			if($type == 'json'){
				curl_setopt($handler,CURLOPT_HTTPHEADER,array(
					'Content-Type: application/json',
					'Accept: application/json'
				));
			}
			curl_setopt($handler, CURLOPT_RETURNTRANSFER,1);
			$response = curl_exec($handler);
			curl_close($handler);
		}
		if($method == 'post'){
			$elements = array();
			foreach($data as $name=>$value){  
				$elements[] = "{$name}=".urlencode($value);  
			}
			$handler = curl_init();
			curl_setopt($handler,CURLOPT_URL,$url);
			curl_setopt($handler,CURLOPT_POST,true);
			curl_setopt($handler,CURLOPT_POSTFIELDS,$elements);
			if($type == 'json'){
				curl_setopt($handler,CURLOPT_HTTPHEADER,array(
					'Content-Type: application/json',
					'Accept: application/json'
				));
			}
			curl_setopt($handler, CURLOPT_RETURNTRANSFER,1);
			$response = curl_exec($handler);
			curl_close($handler);
		}
		return $response;
	}

	function get_response($type,$view_file,$data){
		$response = '';
		extract($data);
		extract($this->global_data);
		if($type == 'html'){
			if($this->is_module == false){
				require('app/views/'.$view_file);
			}else{
				require('modules/'.$this->base_route.'/app/views/'.$view_file);
			}
		}
		if($type == 'json'){
			//use $res_data to send json data

			//$res = array('code' => 200);
			$res_data = $data;
			if($view_file != ''){
				if($this->is_module == false){
					require('app/views/'.$view_file);
				}else{
					require('modules/'.$this->base_route.'/app/views/'.$view_file);
				}
			}
			//$res['res_data'] = $res_data;
			$response = json_encode($res_data);
		}

		return $response;
	}

	function add_module($name){
		$this->modules[] = $name;
	}
}

?>