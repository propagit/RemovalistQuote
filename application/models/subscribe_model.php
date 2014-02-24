<?php
class Subscribe_model extends CI_Model{
	function __contruct(){
		parent::__construct();
	}
	function all(){
		
		$query = $this->db->get("subscribers");
		return $query->result_array();
	}
	function get($email)
	{
		if($email)
		{
			$this->db->like("email",$email);
			
		}
		$this->db->order_by("date","asc");
		$query = $this->db->get("subscribers");
		return $query->result_array();
	}
	function add($data){
		$this->db->insert("subscribers",$data);
		return $this->db->insert_id();
	}
	function delete($id){
		$this->db->where("id",$id);
		$this->db->delete("subscribers");
	}
	/*
	function exist($email){
		$this->db->where("email",$email);
		$query =$this->db->get("emailsubscribe");
		$result =$query->first_row("array");
		if(count($result)>0)
			return true;
		return false;
	}
    */
}
?>