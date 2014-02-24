<?php
class User_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function add($data){
		$this->db->insert('users',$data);
		return $this->db->insert_id();
	}
	function get($type) {
		$this->db->where('level',$type);
		$query = $this->db->get('users');
		return $query->result_array();
	}
	
	function validate($data) {
		$this->db->where('username',$data['username']);
		$this->db->where('password',md5($data['password']));
		$this->db->where('level >','0');
		$query = $this->db->get('users');
		if ($query->num_rows() > 0){ 
			return $query->first_row('array');
		}
		return false;
	}
	
	function id($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('users');
		return $query->first_row('array');
	}
	function delete($id) {
		$this->db->where('id',$id);
		$this->db->delete('users');
	}
	function update($id,$data) {
		$this->db->where('id',$id);
		$this->db->update('users',$data);
	}
	function recognize($username) {
		$this->db->where('username',$username);
		$query = $this->db->get('users');
		return $query->first_row('array');
	}
	function recognize_v2($name, $type) {
		$sql="select users.customer_id, users.id, users.activated, users.banned, users.username, users.level from users, customers where customers.firstname like '%$name%' and users.level =$type and users.customer_id=customers.id"	;	
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	function customer($customer_id) {
		$this->db->where('customer_id',$customer_id);
		$query = $this->db->get('users');
		return $query->first_row('array');
	}
}
?>