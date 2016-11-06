<?php

class routes{
	var $r = array();
	var $n = 6;
	var $list_routes = array();
	var $found_route = '';
	var $is_found = false;
	var $request_method = '';

	var $public_route = 'public/';

	var $found_controll_route = '';
	var $found_view_route = '';

	var $modules = array();
	var $modules_base_route = array();
	
	function initialize($get){
		$this->r[0] = (array_key_exists('v1',$get))? $get['v1'] : false;
		$this->r[1] = (array_key_exists('v2',$get))? $get['v2'] : false;
		$this->r[2] = (array_key_exists('v3',$get))? $get['v3'] : false;
		$this->r[3] = (array_key_exists('v4',$get))? $get['v4'] : false;
		$this->r[4] = (array_key_exists('v5',$get))? $get['v5'] : false;
		$this->r[5] = (array_key_exists('v6',$get))? $get['v6'] : false;
	}
	
	function set_route($metodo,$vista,$ruta){
		$this->list_routes[] = array($metodo,$vista,$ruta);
	}

	function set_module_route($metodo,$vista,$ruta,$module){
		$this->modules[] = $module;
		//$this->list_routes[] = array($metodo,$vista,$ruta);
		$this->list_routes[] = array($metodo,$vista,$module.'/'.$ruta);
	}

	function get_module_public_route($module = ''){
		if($module != ''){
			return 'modules/'.$module.'/';
		}else{
			return 'modules/'.$this->r[0].'/public/';
		}
	}

	function get_module_app_route($module = ''){
		if($module != ''){
			return 'modules/'.$module.'/app/';
		}else{
			return 'modules/'.$this->r[0].'/app/';
		}
	}
	
	function get_route($get,$method){
		$this->initialize($get);
		$this->request_method = $method;

		$ruta_valida = true;
		foreach($this->list_routes as $num => $ruta){
			$ruta_valida = true;
			$one_ruta = explode('/',$ruta[2]);
			for($a=count($one_ruta)+1;$a<=count($this->r);$a++){
				$one_ruta[] = false;
			}
			for($i=0;$i<count($this->r);$i++){
				//echo $ruta[2];
				if(isset($one_ruta[$i]) && $one_ruta[$i] != $this->r[$i]){
					//echo $one_ruta[$i].' - '.$this->r[$i].'<br />';
					$ruta_valida = false;
				}
				if(substr($one_ruta[$i],0,1) == '(' && substr($one_ruta[$i],-1) == ')'){
					$exp = $one_ruta[$i];
					//$exp = str_replace('(','',$rr[$m]);
					//$exp = str_replace(')','',$rr[$m]);
					if(preg_match($exp,$this->r[$i])){
						//echo $this->r[0];
						$ruta_valida = true;
					}
				}
				if($ruta_valida == false){$i = count($this->r);}
			}
			//print_r($one_ruta);
			if($ruta_valida == true && $this->is_found == false && ($this->request_method == $ruta[0] || $ruta[0] == '*')){
				if(is_object($ruta[1])){
					$this->found_route = $ruta[1]();
				}else{
					$this->found_route = $ruta[1];
				}
				$this->is_found = true;
				//echo $this->found_route.' la buena<br />';
				//echo print_r($this->modules,1);
			}
			if($this->is_found == false && $num == count($this->list_routes) - 1){
				$this->found_route = 'none';
				$this->is_found = true;
				//echo $this->found_route.' la buena<br />';
			}
			//echo print_r($this->r[0],1).'aa';
			if(strlen($this->r[0]) > 0 && in_array($this->r[0],$this->modules) && $this->is_found == true){
				$this->found_controll_route = 'modules/'.$this->r[0].'/app/controllers/'.$this->found_route.'.php';
				$this->found_view_route = 'modules/'.$this->r[0].'/app/views/'.$this->found_route.'.php';
			}
			if(strlen($this->r[0]) == 0 || (!in_array($this->r[0],$this->modules) && $this->is_found == true)){
				$this->found_controll_route = 'app/controllers/'.$this->found_route.'.php';
				$this->found_view_route = 'app/views/'.$this->found_route.'.php';
			}
		}
	}
}

?>