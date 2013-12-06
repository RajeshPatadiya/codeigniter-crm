<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('DX_Auth');
		$this->load->model('customers_model');
		$this->load->model('states_model');
		$this->load->model('qualities_model');
		$this->load->model('referrals_model');
		$this->load->model('services_model');
		$this->load->model('relationships_model');
		//$this->dx_auth->check_uri_permissions();
		if($this->dx_auth->is_logged_in()) {
		
		} else {
			redirect('/auth/login', 'location');
		}
	}
	
	public function savenullcustomer() {
		$uId = $this->input->post('uId');
		$name = $this->input->post('name');
		$state = $this->input->post('state');
		$sex = $this->input->post('sex');
		$data = array(	'name'=>$name,
						'state'=>$state,
						'sex'=>$sex,
						'users_id'=>$uId);
		$res = $this->customers_model->saveCustomer($data);
		if( $res === false) {
			print'false';
		} else {
			//rd($res);die;
			print $res;
		}
	}

	public function getcustomer($cId) {
		$data['customer'] = $this->customers_model->getById($cId);
		$data['c_referral'] = $this->referrals_model->getReferralsByCustomer($cId);
		$data['uId'] = $this->dx_auth->get_user_id();
		$data['c_services'] = $this->customers_model->getServices($cId);
		$data['c_phones'] = $this->customers_model->getPhones($cId);
		$data['c_referrals'] = $this->referrals_model->getCustomersByReferral($cId);
		$data['services'] = $this->services_model->getAll();
		$data['states'] = $this->states_model->getAll();
		$data['qualities'] = $this->qualities_model->getAll();
		$data['relationships'] = $this->relationships_model->getAll();
		//rd($data);die;
		$res = array(	'customer'	=>	$data['customer'],
						'details'	=>	$this->load->view('/customer/details', $data, true));
		print(json_encode($res));
	}
	
	public function getcustomerservices() {
		$this->load->model('services_model');
		$cId = $this->input->post('cId');
		$data['c_services'] = $this->customers_model->getServices($cId);
		$data['services'] = $this->services_model->getAll();
		$data['cId'] = $cId;
		$content['html'] = $this->load->view('/customer/block_services', $data, true);
		print(json_encode($content));
	}
	
	public function loadmodal() {
		$template = $this->input->post('template');
		$variable = $this->input->post('variable');
		$content = $this->load->view('/customer/'.$template, array('variable'=>$variable), true);
		print $content;
	}
	
	public function savephone() {
		$num = numberFixAU($this->input->post('num'));
		$cId = $this->input->post('cId');
		if ($this->customers_model->addPhone($cId, $num) )
			echo 'true';
		else
			echo 'false';
	}
	
	public function editphonenumber() {
		$phoneId = $this->input->post('numId');
		$newVal = $this->input->post('newVal');
		if($this->customers_model->editPhone($phoneId, $newVal)) {
			print'true';
		} else {
			print'false';
		}
	}
	
	public function getservices() {
		$this->load->model('services_model');
		$data['services'] = $this->services_model->getAll();
		print json_encode($data);
	}
	
	public function getreferrals() {
		$data['cId'] = $this->input->post('cId');
		$data['uId'] = $this->dx_auth->get_user_id();
		$data['c_referral'] = $this->referrals_model->getReferralsByCustomer($data['cId']);
		$data['states'] = $this->states_model->getAll();
		$data['relationships'] = $this->relationships_model->getAll();
		$content = $this->load->view('/customer/referral_section_block', $data, true);
		print $content;
	}
	
	public function saveservice() {
		$cId = $this->input->post('cId');
		$status = $this->input->post('status');
		$serviceId = $this->input->post('sId');
		if($this->customers_model->saveService($status, $serviceId, $cId)) {
			print 'true';
		} else {
			print 'false';
		}
	}
	
	public function editleadstatus() {
		$lsId = $this->input->post('lsId');
		$newStatus = $this->input->post('newStatus');
		if($this->customers_model->updateServiceStatus($lsId, $newStatus)) {
			print'true';
		} else {
			print'false';
		}
	}
	
	public function savereferral() {
		$cId = $this->input->post('cId');
		$ref_cId = $this->input->post('ref_cId'); //referral ID
		$phData['phone'] = numberFixAU($this->input->post('phone'));
		$cData['name'] = nameCapFix($this->input->post('name'));
		$cData['state'] = $this->input->post('state');
		$cData['users_id'] = $this->dx_auth->get_user_id();
		$cData['sex'] = $this->input->post('sex');
		$cData['called'] = date('Y-m-d h:i:s');
		$refData['relationships_id'] = $this->input->post('relation');
		$refData['customers_id'] = $cId;
		$refData['users_id'] = $this->dx_auth->get_user_id();
		$refData['referral_id'] = 0;
		if(isset($ref_cId) && $ref_cId!==0) { // add referral and DO NOT create new customer
			if( ($this->checkCustomerName($ref_cId, $cData['name']) == true) && ($this->checkCustomerPhone($ref_cId, $phData['phone']) == true) ) {
				$refData['referral_id'] = $ref_cId;
				if($this->referrals_model->addReferral($refData)) {
					print'true 2';
				} else {
					print 'false 2';
				}
			} else {
				$res = $this->customers_model->addReferral($cData);
				if( $res !== false ) {
					$refData['referral_id'] = $res;
					$this->customers_model->addPhone($res, $phData['phone']);
					$this->referrals_model->addReferral($refData);
					print 'true 1';
				} else {
					print 'false 1';
				}
			}
		} else { //add referal & CREATE NEW CUSTOMER
			$res = $this->customers_model->addReferral($cData);
			$refData['referral_id'] = $res;
			if( ($res !== false) && $this->customers_model->addPhone($res, $phData['phone']) && $this->referrals_model->addReferral($refData) ) {
				print 'true';
			} else {
				print 'false';
			}
		}
	}
	
	private function checkCustomerName($cId, $name) {
		if( ($customerData = $this->customers_model->getById($cId))==false )
			return false;
		if($customerData->name == $name) {
			return true;
		} else {
			return false;
		}
	}
	
	private function checkCustomerPhone($cId, $phone) {
		$customerPhones = $this->customers_model->getPhones($cId);
		//rd($customerPhones);rd($phone);die;
		foreach($customerPhones AS $cp) {
			//rd($cp);
			if($cp['phone'] == numberFixAU($phone)) {
				return true;
				//die('number isset');
			}
		}
		return false;
	}
	
	public function savedetails() {
		$cId = $this->input->post('cId');
		$data['name'] = nameCapFix($this->input->post('name'));
		$data['state'] = $this->input->post('state');
		$data['sex'] = $this->input->post('sex');
		$data['customerQuality'] = $this->input->post('quality');
		$data['address'] = $this->input->post('address');
		$data['notes'] = $this->input->post('notes');
		if($this->customers_model->updateDetails($cId, $data)) {
			print'true';
		} else {
			print'false';
		}
	}
	
	public function getcustomerdetailsblock() {
		$cId = $this->input->post('cId');
		$data['customer'] = $this->customers_model->getById($cId);
		$data['states'] = $this->states_model->getAll();
		$data['qualities'] = $this->qualities_model->getAll();
		$data['c_referrals'] = $this->referrals_model->getCustomersByReferral($cId);
		$data['uId'] = $this->dx_auth->get_user_id();
		$content['html'] = $this->load->view('/customer/details_block', $data, true);
		print(json_encode($content));
	}
	
	public function getcustomerphones() {
		$cId = $this->input->post('cId');
		$data['c_phones'] = $this->customers_model->getPhones($cId);
		$data['cId'] = $cId;
		$res = array('html'	=>	$this->load->view('/customer/details_customer_phones_block', $data, true));
		print(json_encode($res));
	}
	
	public function getcustomerbynumber() {
		$num = $this->input->post('num');
		$phoneRes = $this->customers_model->getCustomerByNumber($num);
		if($phoneRes !== false){
			$uRes = $this->customers_model->getById($phoneRes['customers_id']);
			print(json_encode(array('customers_phones'=>$phoneRes, 'customers'=>$uRes)));
		}
		//rd($res);
	}
	
	public function getcustomersbynumber() {
		$num = numberFixAU($this->input->post('num'));
		$phonesRes = $this->customers_model->getCustomersByNumber($num);
		$res = array();
		for($i=0; $i<count($phonesRes);$i++) {
			$res[$i]['phone'] = $phonesRes[$i]['phone'];
			$uRes = $this->customers_model->getById($phonesRes[$i]['customers_id']);
			$res[$i]['cDetails'] = $uRes;
		}
		if(isset($res[0]['phone'])) {
			print(json_encode(array('results'=>$res)));
		} else {
			print false;
		}
	}
	
}