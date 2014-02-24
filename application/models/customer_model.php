<?php
class Customer_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	function add($data) {
		$this->db->insert('customers',$data);
		return $this->db->insert_id();
	}
	function identify($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('customers');
		return $query->first_row('array');
	}
	function recognize($email) {
		$this->db->where('email',$email);
		$query = $this->db->get('customers');
		return $query->first_row('array');
	}
	function validate($username,$password) {
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$query = $this->db->get('customers');
		return $query->first_row('array');
	}
	function update($id,$data) {
		$this->db->where('id',$id);
		return $this->db->update('customers',$data);
	}
	function all() {
		$this->db->order_by('firstname','asc');
		$query = $this->db->get('customers');
		return $query->result_array();
	}
	function total_orders($customer_id,$status) {
		$this->db->where('customer_id',$customer_id);
		if ($status != "") {
			$this->db->where('status',$status);
		}
		$query = $this->db->get('orders');
		return $query->num_rows();
	}
	function delete($id) {
		$this->db->where('id',$id);
		$this->db->delete('customers');
	}
}
?>