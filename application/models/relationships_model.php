<?php

class Relationships_model extends CI_Model{

	function getAll($counter=100){
		$sql = 'SELECT `relationships`.`id`, `relationships`.`title`
				FROM (`relationships`) 
				ORDER BY `relationships`.`id` ASC
				LIMIT ?';
		$query = $this->db->query($sql, array($counter));
		if($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}

	}
}