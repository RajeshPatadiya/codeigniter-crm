<?php

class Customers_model extends CI_Model {

	function saveCustomer($data) {
		if( $this->db->insert('customers', $data) ) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

	function getAll($counter=100){
		$q = $this->db->get('customers');
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		} else {
			return FALSE;
		}

	}
	
	function getById($id) {
		$query = $this->db->get_where('customers', array('id' => $id), 1, 0);
		$row = $query->row(); 
		return $row;
	}
	
	function updateDetails($cId, $data) {
		if( $this->db->update('customers', $data, array('id' => $cId)) ) {
			return true;
		} else {
			return false;
		}
	}
	
	function getServices($cId) {
		$this->db->select('customers_services.*, services.id AS service_id, services.title AS service_title');
		$this->db->from('customers_services');
		$this->db->where('customers_id', $cId);
		$this->db->join('services', 'services.id = customers_services.services_id');
		$this->db->order_by('customers_services.id', 'DESC');
		$query = $this->db->get();
		$rows = $query->result_array(); 
		return $rows;
	}
	
	function getPhones($cId) {
		$query = $this->db->get_where('customers_phones', array('customers_id' => $cId));
		$this->db->order_by('customers_phones.id', 'DESC');
		$rows = $query->result_array(); 
		return $rows;
	}
	
	function addPhone($cId, $phone) {
	 //$phone = numberFixAU($phone);
		$data = array('customers_id'=>$cId, 'phone'=>$phone);
		if( $this->db->insert('customers_phones', $data) ) {
			return true;
		} else {
			return false;
		}
	}
	
	function editPhone($id, $val) {
		if( $this->db->update('customers_phones', array('phone'=>numberFixAU($val)), array('id' => $id)) ) {
			return true;
		} else {
			return false;
		}
	}
	
	function saveService($status, $serviceId, $customerId) {
		$data = array(
			'leadStatus' => $status,
			'services_id'=>	$serviceId,
			'customers_id'=> $customerId,
			'postedDate'=>date('Y-m-d h:i:s')
		);
		if ($this->db->insert('customers_services', $data) ) {
			return true;
		} else {
			return false;
		}
	}
	
	/*function getReferrals($cId) {
		$this->db->select('customers.*, customers_phones.phone');
		$this->db->from('customers_phones INNER JOIN customers ON (customers_phones.customers_id = customers.id)');
		$this->db->where('customers.referral_id', $cId);
		$this->db->group_by('customers.name');
		$this->db->order_by('customers.id', 'DESC');
		$query = $this->db->get();
		$rows = $query->result_array(); 
		return $rows;
	}*/
	
	function addReferral($data) {
	//rd($data);die;
		if ($this->db->insert('customers', $data) ) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
	
	function updateServiceStatus($lsId, $newStatus) {
		if( $this->db->update('customers_services', array('leadStatus'=>$newStatus), array('id' => $lsId)) ) {
			return true;
		} else {
			return false;
		}
	}
	
	function getCustomerByNumber($num) {
		$query = $this->db->get_where('customers_phones', array('phone' => $num));
		$row = $query->row_array();
		if(isset($row['id'])) {
			return $row;
		} else {
			return false;
		}
	}
	
	function getCustomersByNumber($num) {
		$query = $this->db->get_where('customers_phones', array('phone' => $num));
		$row = $query->result_array();
		if(isset($row[0]['id'])) {
			return $row;
		} else {
			return false;
		}
	}

}

?>