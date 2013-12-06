<?php

class Services_model extends CI_Model{

	function getAll($counter=100){
		$sql = 'SELECT `services`.`id`, `services`.`title`
				FROM (`services`) 
				ORDER BY `services`.`id` ASC
				LIMIT ?';
		$query = $this->db->query($sql, array($counter));
		if($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}
	
}