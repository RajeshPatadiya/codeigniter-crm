<?php

class Qualities_model extends CI_Model{

	function getAll($counter=100){
		$sql = 'SELECT `customers_qualities`.`id`, customers_qualities.quality, `customers_qualities`.`title`
				FROM (`customers_qualities`) 
				ORDER BY `customers_qualities`.`id` ASC
				LIMIT ?';
		$query = $this->db->query($sql, array($counter));
		if($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}

	}
}