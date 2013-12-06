<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('DX_Auth');
		$this->load->library('tabs');
		//$this->dx_auth->check_uri_permissions();
		if($this->dx_auth->is_logged_in()) {
		
		} else {
			redirect('/auth/login', 'location');
		}
	}

	public function index() {
		$this->load->model('customers_model');
		$data['loggedIn'] = $this->dx_auth->get_username();
		$data['loggedId'] = $this->dx_auth->get_user_id();
		$data['customers'] = $this->customers_model->getAll();
		$data['tabs'] = json_encode($this->tabs->getTabs($data['loggedId']));
		//rd($data);die;
		$this->template->load('layout', 'welcome', $data);
	}
	
	public function savetab() {
		$uId = $this->input->post('uId');
		$customerId = $this->input->post('customerId');
		if( $this->tabs->addTab('customer', $uId, $customerId) ) {
			print'true';
		} else {
			print'false';
		}
	}
	
	public function removetab() {
		$uId = $this->dx_auth->get_user_id();
		$customerId = $this->input->post('cId');
		if( $this->tabs->removeTab('customer', $uId, $customerId) ) {
			print'true';
		} else {
			print'false';
		}
	}
	
	public function trysearch() {
		$searchText			=	$this->input->post('searchText');
		//rd($searchText);die;
		//try to search from customers table;
		$this->db->select('*');
		$this->db->from('customers');
		if( isset($searchText) && !empty($searchText) ) {
			$this->db->like('LOWER(name)', strtolower($searchText), 'both');
		}
		$query = $this->db->get();
		//rd($query);die;
		$this->load->model('states_model');
		$data['states'] = $this->states_model->getAll();
		//search by phone
		if($query->num_rows < 1) {
			$this->db->select('*');
			$this->db->from('customers_phones');
			//$fixednumber = numberFixAU($searchText);
			//rd($searchText);rd(mb_strlen($searchText)); die;
			if(mb_strlen($searchText) == 8) {

				$this->db->like('phone', $searchText, 'before');
			} else {
				$this->db->like('phone', numberFixAU($searchText));
			}
			$query = $this->db->get();
			$res = array();
			$this->load->model('customers_model');
			foreach($query->result_array() AS $uIds) {
				$res[] = $this->customers_model->getById($uIds['customers_id']);
			}
			$data['customers'] = $res;
			$data['uId'] = $uId = $this->dx_auth->get_user_id();
			$html = $this->load->view('/search/trysearch2', $data, true);
			print $html;
		} else {
			//
			$data['customers'] = $query->result_array(); 
			$data['uId'] = $uId = $this->dx_auth->get_user_id();
			$html = $this->load->view('/search/trysearch', $data, true);
			print $html;
		}
	} 
	
	public function tryreports() {
		$searchUserID	=	(string)$this->input->post('searchUserID');
		$leadStatus	=	(string)$this->input->post('leadStatus');
		$quality	=	(int)$this->input->post('quality');
		$lastCalled	=	(string)$this->input->post('lastCalled');
		//
		$nowDTime = date('Y-m-d h:i:s');
		switch($lastCalled) {
			case'-24h':
				$rDate = date("Y-m-d H:i:s", strtotime($nowDTime.' -24 hours'));
			break;
			case'-7d':
				$rDate = date("Y-m-d H:i:s", strtotime($nowDTime.' -7 days'));
			break;
			case'-14d':
				$rDate = date("Y-m-d H:i:s", strtotime($nowDTime.' -14 days'));
			break;
			case'-30d':
				$rDate = date("Y-m-d H:i:s", strtotime($nowDTime.' -30 days'));
			break;
			case'-60d':
				$rDate = date("Y-m-d H:i:s", strtotime($nowDTime.' -60 days'));
			break;
			case'-90d':
				$rDate = date("Y-m-d H:i:s", strtotime($nowDTime.' -90 days'));
			break;
		}
		//rd($rDate);
		//

  // OLD WAY...
		// PROBLEMS.
		// * Does not get all customers.
		// * Wont work on get customers without services.
		//$sql = 'SELECT customers_services.*, customers.id AS c_id, customers.name AS c_name, customers.customerQuality AS c_quality, services.title AS s_title
		//		FROM customers_services
		//		JOIN `customers` ON `customers`.`id` = `customers_services`.`customers_id`
		//		JOIN `services` ON `services`.`id` = `customers_services`.`services_id`';

		$sql = 'SELECT customers_services.*, customers.id AS c_id, customers.name AS c_name, customers.customerQuality AS c_quality, services.title AS s_title, referrals.users_id AS ref_user_id
				FROM customers
				JOIN `customers_services` ON `customers_services`.`customers_id` = `customers`.`id`
				JOIN `services` ON `services`.`id` = `customers_services`.`services_id`
				LEFT JOIN `referrals` ON `referrals`.`customers_id` = `customers`.`id`';
				if($leadStatus !== '0') {
					$sql .= " WHERE customers_services.leadStatus = '$leadStatus'";
				}
				if($quality !== 0) {
					$sql .= " AND customers.customerQuality = '$quality'";
				}
				if($lastCalled !== '0') {
					$sql .= " AND postedDate BETWEEN '$rDate' AND '$nowDTime'";
				}
				if($searchUserID == 'MyLeads') {
		 		$data['loggedId'] = $this->dx_auth->get_user_id();
					$sql .= " AND referrals.users_id = '$data[loggedId]'";
				}
		$sql .= ' GROUP BY c_id';
		//rd($sql);
		$query = $this->db->query($sql);
		
		$data['results'] = $query->result_array();
		$data['uId'] = $this->dx_auth->get_user_id();
		//rd($data);
		$html = $this->load->view('/search/tryreports', $data, true);
		print $html;
		//
	}
	
	public function validatephonenumber() {
		$number = $this->input->post('phone');
		//rd(check_numberFixAU($number));die;
		if(check_numberFixAU($number) == true) {
			print 'true';
		} else {
			print 'false';
		}
	}
	
}