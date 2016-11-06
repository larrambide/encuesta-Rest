<?php

//campos normales
//campos alias
//agregacion
//wheres
//havings
//orders
//limits
//groups
//unions

//funciones deseadas
/*

--listas

select
*--de una sola tabla
*--con joins
--unions

--first
--next
--prev
--last

**solo a una tabla
*update
insert (uno o muchos)
*delete

***con where
*delete
*update

**casos
*-select de una tabla
*-select de una tabla con where
*-select de multiples tablas
*-select de multiples tablas con where
*-select by id
*-select con limit
*-select con paginación

-select con order
-select con having
-select con union
-select con extras (sql_calc_found_rows, top, unique)

*-carga de un modelo tras select

*-crear modelo limpio

*-update a todo
*-update con where
*-update by id
*-update al mismo

*-insert
*-actualiar id tras insert

*-delete todo
*-delete con where
*-delete by id
*-delete al mismo

*-carga de un modelo tras update
*-carga de un modelo tras insert

//----relaciones
-uno a muchos
-muchos a uno
-uno a uno


*/


class model{
	var $name = '';
	var $tables = array();
	var $fields = array();
	var $id_name = 'id';
	var $desc_name = 'description';
	var $is_validated = true;

	var $current_id = 0;

	var $sql_act = '';
	var $sql_fields = '';
	var $sql_tables = '';
	var $sql_where = '';
	var $sql_order = '';
	var $sql_grup = '';
	var $sql_having = '';
	var $sql_limit = '';
	
	var $last_query = '';
	var $sql_to_execute = '';

	var $relations_one = array();
	//var $relations_many = array();

	var $res_code = array();

	/*function has_many($field,$model,$name){
		$this->relations_many[$field] = $model;
	}*/

	function has_one($field,$model,$get_all = false){
		$this->relations_one[$field] = array('model'=>$model, 'get_all'=>$get_all);
	}

	function get_has_one($field,$val){
		$model = $this->relations_one[$field]['model'];
		if($this->relations_one[$field]['get_all'] == true){
			/*if($model->sql_where != ''){
				$model->sql_where = $model->id_name.' = "'.$val.'" or '.$model->sql_where;
			}else{
				$model->sql_where = $model->id_name.' = "'.$val.'"';
			}*/
			$model->select();
			$model->exe();
		}else{
			$model->sql_where = '';
			$model->select_id($val,$model->tables[0]);
			$model->exe();
		}
		$lista = array();
		foreach($model->res_code['rows'] as $key => $value){
			$defa = ($value[$model->id_name] == $val)? true : false;
			$lista[] = array('id'=>$value[$model->id_name],'description'=>$value[$model->desc_name],'defa'=>$defa);
		}
		return array('val'=>$val, 'list'=>$lista);
	}

	function model($name){
		$this->name = $name;
		$this->add_table($name);
	}

	function add_table($name){
		$this->tables[] = $name;
	}
	
	function add_field($field = '', $alias = '', $table = ''){
		if($alias == ''){
			$f = $field;
		}else{
			$f = $alias;
		}
		//echo $f;
		if(count($this->tables) == 1){
			$this->fields[] = $f;
			$this->$f = new field();
			$this->$f->name = $field;
			$this->$f->alias = $alias;
			$this->$f->table = $this->tables[0];
		}
		if(count($this->tables) > 1 && $table != '' && !in_array($f,$this->fields)){
			$this->fields[] = $f;
			$this->$f = new field();
			$this->$f->name = $field;
			$this->$f->alias = $alias;
			$this->$f->table = $table;
		}
	}

	function where($txt){
		$this->sql_where = $txt;
	}

	function limit($ini,$tot){
		$this->sql_limit = ' limit '.$ini.','.$tot;
	}

	function pagination($page,$per_page){
		$ini = ($page * $per_page) - $per_page;
		$this->sql_limit = ' limit '.$ini.','.$per_page;
	}

	function query_fields($fields){
		$this->sql_fields = $fields;
	}

	function query_tables($tables){
		$this->sql_tables = $tables;
	}

	function set_model($num){
		$id = $this->id_name;
		if(in_array($id,$this->fields)){
			$this->current_id = $this->res_code['rows'][$num][$id];
		}
		
		$row = $this->res_code['rows'][$num];
		foreach($row as $key => $value){
			$this->$key->value = $value;
		}
	}

	function new_model(){
		foreach($this->fields as $key => $value){
			if($value != $this->id_name){
				$this->$value->value = '';
			}else{
				$this->$value->value = 'auto';
			}
		}
	}

	function select(){
		$this->sql_act = 'select';
		$sql = 'select SQL_CALC_FOUND_ROWS ';
		if($this->sql_fields == ''){
			$fields = array();
			foreach($this->fields as $key => $value){
				if($this->$value->table == '*'){
					if($this->$value->alias == ''){
						$fields[] = $this->$value->name;
					}else{
						$fields[] = $this->$value->name.' as '.$this->$value->alias;
					}
				}else{
					if($this->$value->alias == ''){
						$fields[] = $this->$value->table.'.'.$this->$value->name;
					}else{
						$fields[] = $this->$value->table.'.'.$this->$value->name.' as '.$this->$value->alias;
					}
				}
				
			}
			$sql .= ' '.implode(',',$fields);
		}else{
			$sql .= ' '.$this->sql_fields;
		}

		if($this->sql_tables == ''){
			$sql .= ' from '.implode(',',$this->tables);
		}else{
			$sql .= ' from '.$this->sql_tables;
		}

		$this->sql_to_execute = $sql;
	}

	function select_id($id,$table){
		$this->sql_act = 'select';
		$sql = 'select SQL_CALC_FOUND_ROWS ';
		if($this->sql_fields == ''){
			$fields = array();
			foreach($this->fields as $key => $value){
				if($this->$value->table == $table){
					if($this->$value->alias == ''){
						$fields[] = $this->$value->table.'.'.$this->$value->name;
					}else{
						$fields[] = $this->$value->table.'.'.$this->$value->name.' as '.$this->$value->alias;
					}
				}
			}
			$sql .= ' '.implode(',',$fields);
		}else{
			$sql .= ' '.$this->sql_fields;
		}
		$sql .= ' from '.$table.' where '.$this->id_name.' = "'.$id.'"';
		//echo $sql;
		$this->sql_to_execute = $sql;
	}

	function insert($table){
		$this->sql_act = 'insert';
		$sql = 'insert into  '.$table;
		$fields = array();
		$values = array();
		
		if($this->sql_fields == ''){
			$use_fields = $this->fields;
		}else{
			$use_fields = explode(',',$this->sql_fields);
		}

		foreach($use_fields as $key => $value){
			if($this->$value->table == $table){
				if($this->$value->name != $this->id_name || ($this->$value->name == $this->id_name && $this->$value->value != 'auto')){
					$fields[] = $this->$value->name;
					$values[] = $this->$value->value;
				}
			}
		}
		$sql .= ' ('.implode(',',$fields).') values("'.implode('","',$values).'") ';

		$this->sql_to_execute = $sql;
		//echo $sql;
	}

	function update($table){
		$this->sql_act = 'update';
		$sql = 'update '.$table.' set ';
		$fields = array();
		$values = array();
		if($this->sql_fields == ''){
			$use_fields = $this->fields;
		}else{
			$use_fields = explode(',',$this->sql_fields);
		}
		$idd = $this->id_name;
		foreach($use_fields as $key => $value){
			if($this->$value->table == $table){
				if($this->$value->name != $this->$idd->name || ($this->$value->name == $this->$idd->name && $this->$value->value != 'auto')){
					$fields[] = $this->$value->name.'="'.$this->$value->value.'"';
				}
			}
		}
		$sql .= ' '.implode(',',$fields);
		$this->sql_to_execute = $sql;
	}

	function update_id($id,$table){
		$this->sql_act = 'update_id';
		$sql = 'update '.$table.' set ';
		$fields = array();
		$values = array();
		if($this->sql_fields == ''){
			$use_fields = $this->fields;
		}else{
			$use_fields = explode(',',$this->sql_fields);
		}
		$idd = $this->id_name;
		foreach($use_fields as $key => $value){
			if($this->$value->table == $table){
				
				if($this->$value->name != $this->$idd->name || ($this->$value->name == $this->$idd->name && $this->$value->value != 'auto')){
					$fields[] = $this->$value->name.'="'.$this->$value->value.'"';
				}
			}
		}
		$sql .= ' '.implode(',',$fields);
		if($id == 'this'){$id = $this->current_id;}
		$this->sql_to_execute = $sql.' where '. $this->$idd->name.' = "'.$id.'"';
		//echo $this->sql_to_execute;
	}

	function delete($table){
		$this->sql_act = 'delete';
		$sql = 'delete from '.$table;
		$this->sql_to_execute = $sql;
	}

	function delete_id($id,$table){
		$this->sql_act = 'delete_id';
		if($id == 'this'){$id = $this->current_id;}
		$idd = $this->id_name;
		$sql = 'delete from '.$table.' where '.$this->$idd->name.' = "'.$id.'"';
		$this->sql_to_execute = $sql;
	}

	function exe(){
		//echo $this->sql_to_execute;

		if($this->sql_act == 'select'){
			$sql = $this->sql_to_execute;
			if($this->sql_where != ''){
				$sql .= ' where '.$this->sql_where;
			}
			if($this->sql_limit != ''){
				$sql .= $this->sql_limit;
			}
			//echo $sql;
			$res = mysql_query($sql);
			$res_code = array();
			$fr =  mysql_query('select FOUND_ROWS()');
			$frs =  mysql_fetch_row($fr);
			$res_code['tot_rows'] =$frs[0];
			$res_code['get_rows'] = 0;
			$res_code['rows'] = array();

			if($this->sql_fields == ''){
				$fields = $this->fields;
			}else{
				$fields = explode($this->sql_fields);
			}

			$n = 0;
			while($row = mysql_fetch_array($res)){
				foreach($fields as $key => $value){
					if(array_key_exists($value,$row)){
						if(array_key_exists($value,$this->relations_one)){
							$res_code['rows'][$n][$value] = $this->get_has_one($value,$row[$value]);
						}else{
							$res_code['rows'][$n][$value] = $row[$value];
						}
						
					}
				}
				$n++;
			}
			$res_code['get_rows'] = $n;

			$this->res_code = $res_code;
		}

		if($this->sql_act == 'select_id'){
			$sql = $this->sql_to_execute;
			//echo $sql;
			$res = mysql_query($sql);
			$res_code = array();
			$res_code['tot_rows'] = 0;
			$res_code['get_rows'] = 0;
			$res_code['rows'] = array();

			if($this->sql_fields == ''){
				$fields = $this->fields;
			}else{
				$fields = explode($this->sql_fields);
			}
			$n = 0;
			while($row = mysql_fetch_array($res)){
				foreach($fields as $key => $value){
					$res_code['rows'][$n][$value] = $row[$value];
				}
				$n++;
			}
			$this->res_code = $res_code;
		}

		if($this->sql_act == 'insert'){
			$sql = $this->sql_to_execute;
			mysql_query($sql);
			if(in_array($this->id_name,$this->fields)){
				$id = $this->id_name;
				$this->$id->value = mysql_insert_id();
			}
		}

		if($this->sql_act == 'update'){
			$sql = $this->sql_to_execute;
			if($this->sql_where != ''){
				$sql .= ' where '.$this->sql_where;
			}
			//echo '--'.$sql;
			mysql_query($sql);
		}

		if($this->sql_act == 'update_id'){
			$sql = $this->sql_to_execute;
			//echo '--'.$sql;
			mysql_query($sql);
		}
		
		if($this->sql_act == 'delete'){
			$sql = $this->sql_to_execute;
			if($this->sql_where != ''){
				$sql .= ' where '.$this->sql_where;
			}
			mysql_query($sql);
		}

		if($this->sql_act == 'delete_id'){
			$sql = $this->sql_to_execute;
			mysql_query($sql);
		}

		$this->sql_where = '';
		$this->sql_limit = '';
		$this->last_query = $sql;
		$this->sql_to_execute = '';
	}
	
	
	
	/*function load_model($data){
		//print_r($data);
		foreach($this->fields as $n => $v){
			if(array_key_exists($v,$data)== false){
				$data[$v] = '';
			}
			if($this->$v->agregation == '' && $this->$v->use_relation == ''){
				$this->$v->value = $data[$v];
			}
			if($this->$v->use_relation != ''){
				$this->$v->value = $data[$v]['value'];
				$this->$v->related_value = $data[$v]['related_value'];
			}
		}
	}*/

	/*function sql($sql){
		$data = array();
		//echo $sql;
		$res = mysql_query($sql);
		
		$data['rows'] = array();
		$data['got_rows'] = 0;
		$data['tot_rows'] = 0;

		$tot_rows = mysql_query('select FOUND_ROWS()');
		$total_rows = mysql_fetch_row($tot_rows);
		$data['tot_rows'] = $total_rows[0];

		$m = 0;
		while($row = mysql_fetch_array($res)){
			foreach($this->fields as $n => $v){
				if($this->$v->use_relation != ''){
					$data['rows'][$m][$v] = array('value'=>$row[$v],'related_value'=>$this->$v->get_related($row[$v]));
				}else{
					$data['rows'][$m][$v] = $row[$v];
				}
			}
			$m++;
		}
		$data['got_rows'] = $m;
		
		$this->select_res = $data;
		//print_r($this->select_res);
		return $data;
	}*/

	function validate_model(){
		$res = true;
		foreach($this->fields as $n => $v){
			if($this->$v->is_validated == false){
				$res = false;
			}
		}
		return $res;
	}

	function get_not_validates(){
		$res = array();
		foreach($this->fields as $n => $v){
			if($this->$v->is_validated == false){
				$res[$v] = $this->$v->validate_data['err_msg'];
			}
		}
		return $res;
	}
}

?>