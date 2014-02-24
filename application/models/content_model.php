<?php
class Content_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	function add($data) {
		$this->db->insert('pages',$data);
		return $this->db->insert_id();
	}
	function id($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('pages');
		return $query->first_row('array');
	}
	function update($id,$data) {
		$this->db->where('id',$id);
		return $this->db->update('pages',$data);
	}
	
	function delete($id) {
		$this->db->where('id',$id);
		$this->db->delete('pages');		
	}
	function clear($category_id) {
		$this->db->where('category_id',$category_id);
		$this->db->delete('pages');
	}
	function get($category_id) {
		$this->db->where('category_id',$category_id);
		$this->db->order_by('id','asc');
		$query = $this->db->get('pages');
		return $query->result_array();
	}
	function search($category_id) {
		$this->db->where('category_id',$category_id);
		$this->db->order_by('title','asc');
		$query = $this->db->get('pages');
		return $query->result_array();
	}
	function lookup_total($keyword) {
		$keyword = $this->db->escape_str($keyword);
		
		$sql = "SELECT * FROM `pages` WHERE `status` < 6
				AND `content` LIKE '%$keyword%'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function lookup($row,$keyword) {
		$keyword = $this->db->escape_str($keyword);
		$sql = "SELECT * FROM `pages` WHERE `status` < 6
				AND `content` LIKE '%$keyword%' LIMIT $row,10";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	
	
	function add_category($data) {
		$this->db->insert('pages_categories',$data);
		return $this->db->insert_id();
	}
	function update_category($id,$data) {
		$this->db->where('id',$id);
		return $this->db->update('pages_categories',$data);
	}	
	function delete_category($id) {
		$this->db->where('id',$id);
		$this->db->delete('pages_categories');
	}
	function get_category($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('pages_categories');
		return $query->first_row('array');
	}
	function root_categories() {
		$this->db->where('parent_id',0);
		$this->db->order_by('name','asc');
		$query = $this->db->get('pages_categories');
		return $query->result_array();
	}
	function sub_categories($parent_id) {
		$this->db->where('parent_id',$parent_id);
		$this->db->order_by('name','asc');
		$query = $this->db->get('pages_categories');
		return $query->result_array();
	}
	
	//cleans url for menu
	public function url_builder($txt)
  	{
		$clean = trim($txt);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
		return $clean;
  	}	
	
	//new functions
	//14 Jan, 2014
	
	function get_page_content($primary_cat,$sub_cat_permalink = "",$sub_sub_cat_permalink = "")
	{
		$redirect = true;
		  if(!$sub_cat_permalink && !$sub_sub_cat_permalink){
			  //load primary content
			  $cat_id = $this->get_category_id_from_permalink($primary_cat); 
		  }else{
			  if(!$sub_sub_cat_permalink){
					//load sub cat content	
					$cat_id = $this->get_category_id_from_permalink($sub_cat_permalink); 		
			  }else{
				  	//load sub sub cat content
					$cat_id = $this->get_category_id_from_permalink($sub_sub_cat_permalink); 
			  }
		  }
		  
		  if($cat_id){
			  $sql = "select * from pages,pages_categories where pages.category_id = pages_categories.id and pages.category_id = ".$cat_id." and pages.status = 'active'"; 
			  $page = $this->db->query($sql)->row();
			  if($page){
					return $page; 
					$redirect = false; 
			  }
		  }
		  if($redirect){
				redirect('404');  
		  }
	}
	
	function get_category_id_from_permalink($permalink)
	{
		if($permalink){
			$category = $this->db->select('id')->from('pages_categories')->where('permalink',$permalink)->get()->row();
			if($category){
				return $category->id;	
			}
		}
		return false;
	}
	
	function get_category_sub_category($permalink)
	{
		$category_id = $this->get_category_id_from_permalink($permalink);
		if($category_id){
			$contents = $this->db->where('parent_id',$category_id)->order_by('name','asc')->get('pages_categories')->result();
			if($contents){
				return $contents;	
			}
		}
		return false;
	}
	
	function get_page_from_category_id($category_id)
	{
		if($category_id){
			$page = $this->db->select('id,category_id,title,content,preview')->from('pages')->where('category_id',$category_id)->where('status','active')->get()->row();
			if($page){
				return $page;	
			}
		}
		return false;
	}
	
	function get_parent_category($id)
	{
		if($id){
			$parent = $this->db->where('id',$id)->get('pages_categories')->row();	
			if($parent){
				return $parent;	
			}
		}
		return false;
	}
	
	function build_url_from_category_id($category_id)
	{
		$category = $this->db->where('id',$category_id)->get('pages_categories')->row();
		$url = base_url().'removalist/';
		$parent_link = "";
		if($category){
			$parent = $this->get_parent_category($category->parent_id);
			if($parent){
				$url .= $parent->permalink.'/'.$category->permalink;
			}
		}
		return $url;
	}

	
	
	
}
?>