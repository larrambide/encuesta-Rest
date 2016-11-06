<?php

class helper{
	var $base_url = '';
	
	function get_list_options($lista){
		$res = '';
		foreach($lista as $num => $val){
			$def = ($val['default'] == 1)? 'selected="selected"' : '';
			$res .= '<option value="'.$val['id'].'" '.$def.'>'.$val['description'].'</option>';
		}
		return $res;
	}
	
	function form_select($field){
		$res = '';
		$res .= '<select id="'.$field->model.'__'.$field->name.'" name="'.$field->model.'['.$field->name.']">';
			$res .= $this->get_list_options($field->related_value);
		$res .= '</select>';
		return $res;
	}
	
	function form_option($field){
		$res = '';
		foreach($field->related_value as $num => $val){
			$def = ($val['default'] == 1)? 'checked="checked"' : '';
			$res .= '<input type="radio" id="'.$field->model.'__'.$field->name.'__'.$val['id'].'" name="'.$field->model.'['.$field->name.']" value="'.$val['id'].'" '.$def.' />';
		}
		return $res;
	}

	function get_attrs($field,$attrs,$from){
		$res = '';
		if(!array_key_exists('id',$attrs) && $from == 'from_field' && $field != '*'){
			$res .= ' id="'.$field->model.'__'.$field->name.'"';
		}
		if(!array_key_exists('name',$attrs) && $from == 'from_field' && $field != '*'){
			$res .= ' name="'.$field->model.'['.$field->name.']"';
		}
		if(!array_key_exists('value',$attrs) && $from == 'from_field' && $field != '*'){
			$res .= ' value="'.$field->value.'"';
		}
		if(!array_key_exists('for',$attrs) && $from == 'from_label' && $field != '*'){
			$res .= ' for="'.$field->model.'__'.$field->name.'"';
		}
		foreach($attrs as $key => $value){
			$res .= $key.'="'.$value.'"';
		}

		return $res;
	}

	function form_label($field,$alt='',$attrs=array()){
		$res = '';
		$lb = ($alt == '')? $field->name : $alt;
		$res .= '<label '.$this->get_attrs($field,$attrs,'from_label').'>'.$lb.'</label>';
		return $res;
	}
	
	function form_text($field,$attrs=array()){
		$res = '';
		$res .= '<input type="text" '.$this->get_attrs($field,$attrs,'from_field').' />';
		return $res;
	}

	function form_area($field,$attrs=array()){
		$res = '';
		$res .= '<textarea '.$this->get_attrs($field,$attrs,'from_field').'>'.$field->value.'</textarea>';
		return $res;
	}

	function form_datetime($field,$attrs=array()){
		$res = '';
		$res .= '<input type="text" '.$this->get_attrs($field,$attrs,'from_field').' />';
		$id = (array_key_exists('id',$attrs))? $attrs['id'] : '"#'.$field->model.'__'.$field->name.'"';
		$res .= '<script type="text/javascript">$('.$id.').datetimepicker({"format":"Y-m-d H:i","lang":"es"});</script>';
		return $res;
	}

	function form_date($field,$attrs=array()){
		$res = '';
		$res .= '<input type="text" '.$this->get_attrs($field,$attrs,'from_field').' />';
		$id = (array_key_exists('id',$attrs))? $attrs['id'] : '"#'.$field->model.'__'.$field->name.'"';
		$res .= '<script type="text/javascript">$('.$id.').datetimepicker({"timepicker":false,"format":"Y-m-d","lang":"es"});</script>';
		return $res;
	}

	function form_time($field,$attrs=array()){
		$res = '';
		$res .= '<input type="text" '.$this->get_attrs($field,$attrs,'from_field').' />';
		$id = (array_key_exists('id',$attrs))? $attrs['id'] : '"#'.$field->model.'__'.$field->name.'"';
		$res .= '<script type="text/javascript">$('.$id.').datetimepicker({"datepicker":false,"format":"H:i","lang":"es"});</script>';
		return $res;
	}
	
	function form_hidden($field,$attrs=array()){
		$res = '';
		$res .= '<input type="hidden" '.$this->get_attrs($field,$attrs,'from_field').' />';
		return $res;
	}
	
	function form_pass($field,$attrs=array()){
		$res = '';
		$res .= '<input type="password" '.$this->get_attrs($field,$attrs,'from_field').' />';
		return $res;
	}
	
	function form_file($field,$attrs=array()){
		$res = '';
		$res .= '<input type="file" '.$this->get_attrs($field,$attrs,'from_field').' />';
		$res .= '<input type="hidden" name="'.$field->model.'['.$field->name.'__original]" value="'.$field->value.'" />';
		return $res;
	}

	function redir($ruta){
		header("LOCATION: ".$this->base_url.$ruta);
		//echo $this->base_url.$ruta;
	}

	function row($num,$imp,$par){
		if($num % 2 == 0){
			return $par;
		}else{
			return $imp;
		}
	}

	function equal($val1,$val2,$val_t,$val_f){
		if($val1 == $val2){
			return $val_t;
		}else{
			return $val_f;
		}
	}

	function get_pagination($tot_rows,$got_rows,$max){
		$tot_pags = ($tot_rows % $max == 0)? $tot_rows / $max : (($tot_rows-1) / $max) + 1;
		return $tot_pags;
	}

	function make_md5($field){
		$field->value = md5($field->value);
	}
}

?>