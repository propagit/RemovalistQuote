<?php
class Cms extends CI_Controller {
	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('kiotiahraloggedin')) {
			redirect('admin/login');
		}
		$this->load->model('Content_model');
		$this->load->model('System_model');
	}
	
	function index() {

	}
	
	function page($action="",$page_id="") {
		if ($action == "") {
			$this->load->view('admin/common/header');
			$this->load->view('admin/cms/page');
			$this->load->view('admin/common/rightbar');
			$this->load->view('admin/common/footer');
		} else if ($action == "content") {
			$this->load->model('Cute_model');
			$data['page'] = $this->Content_model->id($page_id);			
			$this->load->view('admin/cms/pagecontent',$data);
		}	
	}
	
	function getcats() {
		$categories = $this->Content_model->root_categories();
		$category_id = $this->session->userdata('category_id');
		$out = '
			<select id="category_id" name="category_id" onChange="getpages()">';
		foreach($categories as $category) {
			$out .= '<option value="'.$category['id'].'"';
			if ($category_id == $category['id']) { $out .= ' selected="selected"'; }
			$out .= '>'.$category['name'].'</option>';
			$children = $this->Content_model->sub_categories($category['id']);
			if($children) {
				foreach($children as $child) {
					$out .= '<option value="'.$child['id'].'"';
					if ($category_id == $child['id']) { $out .= ' selected="selected"'; }
					$out .= '>|-- '.$child['name'].'</option>';
					$children2 = $this->Content_model->sub_categories($child['id']);
					if ($children2) {
						foreach($children2 as $child2) {
							$out .= '<option value="'.$child2['id'].'"';
							if ($category_id == $child2['id']) { $out .= ' selected="selected"'; }
							$out .= '>|-- |-- '.$child2['name'].'</option>';
            			}
					}
				}
			} 
		}
		$out .= '</select>';
		print $out;
	}
	
	function getpages() {
		$category_id = $_POST['category_id'];
		if ($category_id == -1) {
			
		} 
		else {
			$pages = $this->Content_model->search($category_id);
			$out = '';
			
			if(count($pages) == 0) {
				$out = '<dl><dd style="float:right"><a href="javascript:addpage()">Create page</a></dd></dl>';
			}
			$out .= '
				<h3>Page List</h3><dl></dl>
				<div class="row-title">
					<div class="menu-name">Page title</div>
					<div class="menu-func">Delete</div>
					<div class="menu-func">Content</div>				
				</div>';
			foreach($pages as $page) {
				$out .= '
				<div class="row-item" id="page-'.$page['id'].'">
					<div class="menu-name" id="pagename-'.$page['id'].'"><a href="javascript:editpage('.$page['id'].',\''.$page['title'].'\')">'.$page['title'].'</a></div>
					<div class="menu-func"><a href="javascript:deletepage('.$page['id'].')"><img src="'.base_url().'img/backend/icon-delete.png" /></a></div>
					<div class="menu-func"><a href="javascript:content('.$page['id'].')"><img src="'.base_url().'img/backend/icon-view.png" /></a></div>
				</div>';
			}
		}
		print $out;
	}
	
	# Page
	function addpage() {
		$category_id = $_POST['category_id'];
		$category = $this->Content_model->get_category($category_id);
		$this->session->set_userdata('category_id',$category_id);
		$out = '
		<form name="addPageForm" method="post" action="'.base_url().'admin/cms/addingpage">
		<input type="hidden" name="category_id" value="'.$category_id.'" />
		<div class="row-item">
			<div class="page-name"><input type="text" class="textfield rounded" name="title" id="title" /></div>
			<div class="page-button">
				<input type="button" class="button rounded" value="Add" onClick="addingpage()" />
				<input type="button" class="button rounded" value="Cancel" onClick="cancel()" />
			</div>
		</div>
		</form>';
		print $out;
	}
	function addingpage() {
		$title = $_POST['title'];
		$data = array(
			'category_id' => $_POST['category_id'],
			'title' => $title,
			'created' => date('Y-m-d H:i:s'),
			'modified' => date('Y-m-d H:i:s')
		);
		$this->session->set_userdata('category_id',$_POST['category_id']);
		$page_id = $this->Content_model->add($data);
		redirect('admin/cms/page');
	}
	function updatepage() {
		if ($this->Content_model->update($_POST['id'],array('title' => $_POST['title']))) {
			print "OK";
		}
	}
	function deletepage() {
		$this->Content_model->delete($_POST['page_id']);
	}
	
	function updatecontent() {
		$id = $_POST['id'];
		$data = array(
			'meta_header' => $_POST['meta_header'],
			'description' => $_POST['description'],
			'keywords' => $_POST['keywords'],								
			'content' => $_POST['content_text'],
			'preview' => $_POST['preview'],		
			'modified' => date('Y-m-d H:i:s')
		);
		$this->Content_model->update($id,$data);
		$this->session->set_flashdata('updated',true);
		redirect('admin/cms/page/content/'.$id);
	}

	
	function addcat() {
		$data = array(
			'parent_id' => $_POST['category_id'],
			'name' => $_POST['name'],
			'permalink' => $_POST['permalink']
		);
		$category_id = $this->Content_model->add_category($data);
		
		//unset session for only admin view
		$this->session->unset_userdata('sub_menus');
		
		redirect('admin/cms/page');
	}
	
	# Delete category
	function deletecategory() {
		$category_id = $_POST['category_id'];
		$cat = $this->Content_model->get_category($category_id);
		
		if(isset($cat) && $cat['parent_id'] > 0) {
			$this->Content_model->clear($category_id);
			$this->Content_model->delete_category($category_id);					
		}
	}		
	
	function getcat_name() {
		$category_id = $_POST['category_id'];
		$cat = $this->Content_model->get_category($category_id);		
		
		$data['parent_cat'] = true;
		if(isset($cat) && $cat['parent_id'] > 0) {
			$data = array(
				'parent_cat' => false,
				'category_name' => $cat['name'],
				'permalink' => $cat['permalink']
			); 	
		}		
		echo json_encode($data);
	}
	
	function editcat() {
		$category_id = $_POST['edit_id'];
		$cat = $this->Content_model->get_category($category_id);		
		
		if(isset($cat) && count($cat) > 0 && $cat['parent_id'] > 0) {
			$data = array(
				'parent_id' => $cat['parent_id'],
				'name' => $_POST['edit_name'],
				'permalink' => $_POST['edit_permalink']
			);
	
			$this->Content_model->update_category($category_id,$data);
		}
		redirect('admin/cms/page');
	}	
}
?>