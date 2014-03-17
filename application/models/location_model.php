<?php
class Location_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
		
	function allstates()
	{
		$query = $this->db->get('states');
		return $query->result_array();
	}
	function getsuburb($state) {
		$this->db->where('state',$state);
		$query = $this->db->get('suburbs');
		return $query->result_array();
	}			
	function identify($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('states');
		//return $query->first_row('array');
		return $query->first_row('array');
		//return $data;
	}
	function identifysuburb($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('suburbs');
		$data= $query->first_row('array');
		return $data['name'];
	}
	function identifystate($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('states');
		$data= $query->first_row('array');
		return $data['name'];
	}
	function search_suburb($state,$keyword = "")
	{
		$sql = "select * from suburbs where state = ".$state." and name like '".$keyword."%' order by name asc limit 0,6";
		return $this->db->query($sql)->result_array();
	}
	
}
?>