<?php

class field{
	var $name = '';
	var $alias = '';
	var $table = '';
	var $value = '';
	var $related_value = '';
	var $agregation = '';
	var $relation = '';
	var $relation_where = '';
	var $use_relation = '';
	var $is_validated = true;
	var $validate_method = '';
	var $validate_data = array();
	
	/*function get_related($value = 0){
		$valor = '';
		$campo = $this->relation->desc_name;
		if($this->use_relation == 'one'){
			if($this->relation->$campo->agregation == ''){
				$sql = 'select '.$campo.' from '.$this->relation->table.' where '.$this->relation->id_name.' = "'.$value.'"';
			}else{
				$sql = 'select '.$this->relation->$campo->agregation.' as '.$this->relation->desc_name.' from '.$this->relation->table.' where '.$this->relation->id_name.' = "'.$value.'"';
			}
			//echo $sql;
			$res = mysql_query($sql);
			$ress = mysql_fetch_row($res);
			$valor = $ress[0];
		}
		
		if($this->use_relation == 'list'){
			if($this->relation->$campo->agregation == ''){
				$where = ($this->relation_where == '')? ' where 1 = 1' : 'where '.$this->relation_where;
				$sql = 'select '.$this->relation->id_name.','.$campo.' from '.$this->relation->table.' '.$where;
			}else{
				$sql = 'select '.$this->relation->id_name.','.$this->relation->$campo->agregation.' as '.$this->relation->desc_name.' from '.$this->relation->table.' '.$where;
			}
			$valor = array();
			$res = mysql_query($sql);
			$n = 0;
			while($row = mysql_fetch_array($res)){
				$valor[$n] = array();
				$valor[$n]['id'] = $row[$this->relation->id_name];
				$valor[$n]['description'] = $row[$this->relation->desc_name];
				$valor[$n]['default'] =($row[$this->relation->id_name] == $value)? 1 : 0;
				$n++;
			}
		}
		
		if($this->use_relation == 'model'){
			$rel = $this->relation->select($this->relation_where);
			$valor = $rel;
			$valor['default'] = $value;
		}
		
		//echo $sql;
		return $valor;
	}*/

	function validate_text($err_msg,$mandatory,$min,$max,$exp = ''){
		$res = true;
		$text = $this->value;
		$this->validate_method = 'text';
		$this->validate_data = array('text'=>$text,'err_msg'=>$err_msg,'mandatory'=>$mandatory,'min'=>$min,'max'=>$max,'exp'=>$exp);
		if(($mandatory == false && strlen($text) > 0) || $mandatory == true){
			if(strlen($text) < $min || strlen($text) > $max || ($exp != '' && preg_match($exp,$text) == false)){
				$res = false;
				$this->is_validated = false;
			}
		}
		return $res;
	}

	function validate_date($err_msg,$mandatory,$min,$max,$format,$exp = ''){
		$res = true;
		$text = $this->value;
		$this->validate_method = 'date';
		$this->validate_data = array('text'=>$text,'err_msg'=>$err_msg,'mandatory'=>$mandatory,'min'=>$min,'max'=>$max,'exp'=>$exp);
		if(($mandatory == false && strlen($text) > 0) || $mandatory == true){
			/*$fd = strptime($text,$format);
			$fdmk = mktime(0,0,0,$fd['tm_mon']+1,$fd['tm_mday'],$fd['tm_year']+1900);

			$ny = date("Y",$fdmk);
			$nm = date("m",$fdmk);
			$nd = date("d",$fdmk);*/

			//if(($exp != '' && preg_match($exp,$text) == false) || checkdate($nm,$nd,$ny) == false){
			if(($exp != '' && preg_match($exp,$text) == false)){
				$res = false;
				$this->is_validated = false;
			}
		}
		return $res;
	}

	function validate_email($err_msg,$mandatory){
		$res = true;
		$text = $this->value;
		$this->validate_method = 'text';
		$this->validate_data = array('text'=>$text,'err_msg'=>$err_msg,'mandatory'=>$mandatory);
		if(($mandatory == false && strlen($text) > 0) || $mandatory == true){
			$exp = "/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/";
			if(preg_match($exp,$text) == false){
				$res = false;
				$this->is_validated = false;
			}
		}
		return $res;
	}
}

?>