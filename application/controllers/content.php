<?php

# Controller: Content

class Content extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Content_model');
		error_reporting(E_ALL);
	}
	
	function removalist($sub_cat_permalink = "",$sub_sub_cat_permalink = "") 
	{
		//echo $sub_cat_permalink."-".$sub_sub_cat_permalink;
		//exit();
				
		$page = $this->Content_model->get_page_content('removalist',$sub_cat_permalink,$sub_sub_cat_permalink);
		$header['meta_data'] = array(
					'meta_keywords' => $page->keywords,
					'meta_desc' => $page->description,
					'meta_title' => $page->meta_header,
				);
		$data['page'] = $page;
		$data['sub_categories']['categories'] = $this->Content_model->get_category_sub_category($sub_cat_permalink);
		$this->load->view('common/header',$header);
		$this->load->view('content/content',$data);
		$this->load->view('common/menu_bottom');
		$this->load->view('common/footer');
	}
	
	
}
?>