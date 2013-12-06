<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
tabs:
	- tab ID - text with user ID, like: member_12, search_1
	- 
*/
class Tabs {

	var $CI;

	function __construct() {
		$this->CI =& get_instance();
	}
	
	function getTabs($uId) {
		$query = $this->CI->db->get_where('user_profile', array('user_id' => $uId), 1, 0);
		$row = $query->row();
		return json_decode($row->tabs);
	}
	
	function addTab($tabName, $uId, $cId) { //customer, search
		$query = $this->CI->db->get_where('user_profile', array('user_id' => $uId), 1, 0);
		$row = $query->row();
		if(empty($row)) {
			return false;
		} else {
			if(empty($row->tabs)) {
				$tabArr = array($tabName=>array($cId));
				$newTabs = json_encode($tabArr);
			} else {
				$dbTabs = json_decode($row->tabs);
				$tabsArr = (array)$dbTabs;
				if(in_array($cId, $tabsArr[$tabName], true)) {
					return false;
				} else {
					array_push($tabsArr[$tabName], $cId);
				}
				$newTabs = json_encode($tabsArr);
			}
		}
		$this->CI->db->update('user_profile', array('tabs'=>$newTabs), array('id'=>$uId));
		return true;
	}
	
	function removeTab($tabName, $uId, $cId) {
		$query = $this->CI->db->get_where('user_profile', array('user_id' => $uId), 1, 0);
		$row = $query->row();
		if(empty($row)) {
			return false;
		} else {
			if(empty($row->tabs)) {
				$newTabs = NULL;
			} else {
				$dbTabs = json_decode($row->tabs);
				$tabsArr = (array)$dbTabs;
				foreach($tabsArr[$tabName] AS $key=>$val) {
					if($val == $cId) {
						unset($tabsArr[$tabName][$key]);
					}
				}
				$tabsArr[$tabName] = array_values($tabsArr[$tabName]);
				$newTabs = json_encode($tabsArr);
			}
			$this->CI->db->update('user_profile', array('tabs'=>$newTabs), array('id'=>$uId));
			return true;
		}
	}
	
}