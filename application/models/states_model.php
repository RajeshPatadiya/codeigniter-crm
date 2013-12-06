<?php

class States_model extends CI_Model{

	function getAll($counter=100){
		$sql = 'SELECT `states`.`id`, `states`.`state`
				FROM (`states`) 
				ORDER BY `states`.`id` ASC
				LIMIT ?';
		$query = $this->db->query($sql, array($counter));
		if($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
		
	}
}