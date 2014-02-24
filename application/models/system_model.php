<?php
class System_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	/* Attribute Module */
	function add_attribute($data) {
		$this->db->insert('attributes',$data);
	}
	function delete_attribute($id) {
		$this->db->where('id',$id);
		$this->db->delete('attributes');
	}
	function get_attributes() {
		$attributes = array();
		$this->db->order_by('id','asc');
		$query = $this->db->get('attributes');
		return $query->result_array();
		//$result = $query->result_array();
		/*
		foreach($result as $row)
	    {
			
			//$value = explode("~",$row['value']);
			//$options = array();
			//for($i=0;$i<count($value)-1;$i++) {
				//$options[] = $value[$i];
			//}
			
			$options = array();
			if($row['value'] != '')
			{
				$options = json_decode($row['value'], true);
			}
			$attributes[] = array(
				'id' => $row['id'],
				'name' => $row['name'],
				'options' => $options
			);			
		}
		return $attributes;
		*/
	}
	
	function get_attribute($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('attributes');
		$result = $query->first_row('array');
		//$value = explode("~",$result['value']);
		
		$options = array();
		$options = json_decode($result['value'],true);
		/*
		for($i=0;$i<count($value)-1;$i++) {
			$options[] = $value[$i];
		}
		*/
		return array(
			'id' => $result['id'],
			'name' => $result['name'],
			'options' => $options
		);
	}
	function update_attribute($id,$data) {
		$this->db->where('id',$id);
		$this->db->update('attributes',$data);
	}
	
	/* Shipping Module */
	function get_countries() {
		$this->db->order_by('name','asc');
		$query = $this->db->get('countries');
		return $query->result_array();
	}
	function get_country($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('countries');
		$result = $query->first_row('array'); 
		return $result['name'];
	}
	
	
	
	/* Keyword */
	function add_keyword($data) {
		$this->db->insert('keywords',$data);
	}
	function get_keyword($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('keywords');
		return $query->first_row('array');
	}
	function most_keyword() {
		$sql = "SELECT id, COUNT(*) as `total` FROM `keywords` GROUP BY `keyword` ORDER BY `total` DESC";
		$query = $this->db->query($sql);
		$result = $query->first_row('array');
		if ($result) {
			$this->db->where('id',$result['id']);
			$query = $this->db->get('keywords');
			$row = $query->first_row('array');
			return to_short($row['keyword'],33).' ('.$result['total'].' times)';
		}
		return 'N/A';
	}
	function most_keywords() {
		$sql = "SELECT id, COUNT(*) as `total` FROM `keywords` GROUP BY `keyword` ORDER BY `total` DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	/* Stats */
	function best_customer() {
		$sql = "SELECT `customer_id`, sum(`total`) as `total` 
				FROM `orders` 
				WHERE `status` = 'success'
				GROUP BY `customer_id` 
				ORDER BY `total` DESC";
		$query = $this->db->query($sql);
		$result = $query->first_row('array');
		if ($result) {
			$this->db->where('id',$result['customer_id']);
			$query = $this->db->get('customers');
			$row = $query->first_row('array');
			if ($row) {
				return to_short($row['firstname'].' '.$row['lastname'],33).' ($'.$result['total'].')';
			}
		}
		return 'N/A';
	}
	function best_customers() {
		$sql = "SELECT `customer_id`, sum(`total`) as `total` 
				FROM `orders` 
				WHERE `status` = 'success'
				GROUP BY `customer_id` 
				ORDER BY `total` DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	
	/* Email Module */
	function get_email($field,$value) {
		$this->db->where($field,$value);
		$query = $this->db->get('emails');
		return  $query->first_row('array');
	}
	function update_email($id,$data) {
		$this->db->where('id',$id);
		return $this->db->update('emails',$data);
	}
	function add_email($data) {
		$this->db->insert('emails',$data);
		return $this->db->insert_id();
	}
	function delete_emails($field,$value) {
		$this->db->where($field,$value);
		$this->db->delete('emails');
	}
	
}
?>