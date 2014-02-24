<?php
class Quote_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
		
	function add($data)
	{
		$this->db->insert('quotes',$data);
		return $this->db->insert_id();
	}
	function all() {
		$this->db->order_by('id','asc');
		$query = $this->db->get('quotes');
		return $query->result_array();
	}
	function identify($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('quotes');
		return $query->first_row('array');
	}
	function identifytype($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('typeremoval');
		return $query->first_row('array');
	}
	function update($id,$data) {
		$this->db->where('id',$id);
		return $this->db->update('quotes',$data);
	}
	function delete($id) {
		$this->db->where('id',$id);
		$this->db->delete('quotes');
	}
	function addhistory($data)
	{
		$this->db->insert('historyquote',$data);
		return $this->db->insert_id();
	}
	function lasthistory()
	{
		$this->db->select_max('id');
		$query = $this->db->get('historyquote');
		return $query->first_row('array');
	}
	function check_supp($quote,$supp,$date)
	{
		$this->db->where('quote_id',$quote);
		$this->db->where('supplier_id',$supp);
		$this->db->where('date',$date);
		$query = $this->db->get('historyquote');
		$check= $query->result_array();
//		print_r(count($check));
		if(count($check)>0)
		{
			return true;
		}
		else
		{ return false;}
	}
	function quotenew()
	{
		$this->db->where('status',0);
		$query = $this->db->get('quotes');
		return $query->result_array();	
	}
	function searchquote($name,$type,$date_from,$date_to)
	{
		
		if($name)
		{
			$this->db->like('email', $name);

		}
	
		if($date_from<>'' && $date_to<>'')
		{
			$where="date BETWEEN '".$date_from."' AND '".$date_to."'";
			
			$this->db->where($where);			
		}
		
	
		$this->db->where('status',$type);					
		$query = $this->db->get('quotes');
		return $query->result_array();	
	}
	function searchhistory($id)
	{
		$this->db->where('quote_id',$id);
		$query = $this->db->get('historyquote');
		$data = $query->result_array();	
		return count($data);
	}
	function listhistory($id)
	{
		$this->db->where('quote_id',$id);
		$query=$this->db->get('historyquote');
		return $query->result_array();
	}
	function listhistorysupplier($id)
	{
		$this->db->where('supplier_id',$id);
		$query=$this->db->get('historyquote');
		return $query->result_array();
	}
}
?>