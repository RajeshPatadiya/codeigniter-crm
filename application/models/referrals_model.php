<?php

class Referrals_model extends CI_Model{

	function getReferralsByCustomer($cId){
		$sql = 'SELECT `customers`.`id`, `customers`.`name`, customers.state, customers.sex, customers.called, `relationships`.`title` AS relationship, `customers_phones`.`phone`, max(customers_phones.id) AS max_cp_id
				FROM (`referrals`)
				JOIN `customers` ON `customers`.`id` = `referrals`.`referral_id`
				JOIN `relationships` ON `relationships`.`id` = `referrals`.`relationships_id`
				JOIN `customers_phones` ON `customers_phones`.`customers_id` = `customers`.`id`
				WHERE `referrals`.`customers_id` = ?
				GROUP BY `referrals`.`referral_id`';
		$query = $this->db->query($sql, array($cId));
		//rd($sql);die;
		if($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}
	
	function getCustomersByReferral($rId) {
		$sql = 'SELECT `customers`.`id`, `customers`.`name`, `relationships`.`title` AS rel_title 
				FROM (`referrals`) 
				JOIN `customers` ON `customers`.`id` = `referrals`.`customers_id` 
				JOIN `relationships` ON `relationships`.`id` = `referrals`.`relationships_id`
				WHERE `referrals`.`referral_id` = ?';
		$query = $this->db->query($sql, array($rId));
		if($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}
	
	function addReferral($refData) {
		$insert_query = $this->db->insert_string('referrals', $refData);
		$insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
		//if ($this->db->insert('referrals', $refData) ) {
		if($this->db->query($insert_query)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
}