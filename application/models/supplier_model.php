<?php
class Supplier_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function add($data) {
		$this->db->insert('suppliers',$data);
		return $this->db->insert_id();
	}
	
	function identify($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('suppliers');
		return $query->first_row('array');
	}
	function recognize($email) {
		$this->db->where('email',$email);
		$query = $this->db->get('suppliers');
		return $query->first_row('array');
	}
	function validate($username,$password) {
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$query = $this->db->get('suppliers');
		return $query->first_row('array');
	}
	function update($id,$data) {
		$this->db->where('id',$id);
		return $this->db->update('suppliers',$data);
	}
	function all() {
		$this->db->order_by('firstname','asc');
		$query = $this->db->get('suppliers');
		return $query->result_array();
	}
	
	function delete($id) {
		$this->db->where('id',$id);
		$this->db->delete('suppliers');
	}
	
	function get($name,$type) {
		if($name<>''){
			$this->db->like('firstname', $name); 
		}
		if($type<>''){
			$this->db->where('actived',$type);
		}
		$query = $this->db->get('suppliers');
		return $query->result_array();
	}
	function lastrecord()
	{
		$this->db->select_max('id');
		$query = $this->db->get('suppliers');
		return $query->first_row('array');
	}
	function get_supplier($start,$tot)
	{
		$this->db->limit($tot);
		$query = $this->db->get('suppliers');
		//print_r($query->result_array());
	return $query->result_array();

	}
	function get_supplier_next($id)
	{
		$this->db->where('id > ',$id);
		$this->db->limit(3);
		$query = $this->db->get('suppliers');
		return $query->result_array();
	}
	function deleteservice($id)
	{
	
		$this->db->where('supplier_id',$id);
		$this->db->delete('supplierservice');
	}
	function deletestate($id)
	{
	
		$this->db->where('supplier_id',$id);
		$this->db->delete('supplierstate');
	}
	function addstate($data)
	{
		$this->db->insert('supplierstate',$data);
		return $this->db->insert_id();
	}
	function addservice($data)
	{
		$this->db->insert('supplierservice',$data);
		return $this->db->insert_id();
	}
	function getstate($id)
	{
		$this->db->where('supplier_id',$id);
		$query=$this->db->get('supplierstate');
		return $query->result_array();
	}
	function getservice($id)
	{
		$this->db->where('supplier_id',$id);
		$query=$this->db->get('supplierservice');
		return $query->result_array();
	}
	function check_service($id,$service_id)
	{
		$this->db->where('supplier_id',$id);
		$this->db->where('service_id',$service_id);
		$query=$this->db->get('supplierservice');
		$data= $query->result_array();
		if(count($data)>0)
		{
			return 1;
		}
		else {return 0;}
		
	}
	function check_state($id,$state_id)
	{
		$this->db->where('supplier_id',$id);
		$this->db->where('state_id',$state_id);
		$query=$this->db->get('supplierstate');
		$data= $query->result_array();
		if(count($data)>0)
		{
			return 1;
		}
		else {return 0;}
		
	}
	function activesupplier($state,$service,$name)
	{
		if($name=='')
		{
		$sql="SELECT s.* FROM suppliers s, supplierservice sv, supplierstate ss
WHERE s.actived =1
AND sv.service_id =".$service." AND ss.state_id =".$state." AND ss.supplier_id=s.id AND sv.supplier_id=s.id";
		} else
		{
			$sql="SELECT s.* FROM suppliers s, supplierservice sv, supplierstate ss
WHERE s.actived =1
AND sv.service_id =".$service." AND ss.state_id =".$state." AND ss.supplier_id=s.id AND sv.supplier_id=s.id AND s.firstname LIKE '%".$name."%'";
		}
		//$this->db->where('actived',1);
		
		//echo $sql;
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	function get_automatic()
	{
		// use rand to get 0 or 1 so the query will random select newer or older supplier
		$rand = rand(0,1);
		$added = '';
		if($rand == 0)
		{
			$added = 'desc';
		}
		else
		{
			$added = 'asc';
		}
		$this->db->where('actived',1);
		$this->db->order_by("count_monthly", "asc");
		$this->db->order_by("added", $added);
		$this->db->limit(3);
		$query=$this->db->get('suppliers');
		return $query->result_array();
	}
	
}
?>