<?php
class System extends CI_Controller {
	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('kiotiahraloggedin')) {
			redirect('admin/login');
		}
		$this->load->model('System_model');
	}
	
	function index() {
		redirect('admin');
	}
	
	/* 2. 1. Product Attribute module */
	function attribute($action="",$attribute_id="") {
		$this->load->view('admin/common/header');
		if ($action == "edit") {
			$data['attribute'] = $this->System_model->get_attribute($attribute_id);
			$this->load->view('admin/system/attribute/edit',$data);
		} else {
			$data['attributes'] = $this->System_model->get_attributes();
			$this->load->view('admin/system/attribute/main',$data);
		}
		$this->load->view('admin/common/rightbar');
		$this->load->view('admin/common/footer');
	}
	function addattribute() {
		$name = $_POST['name'];
		$value = array();
		if (isset($_POST['options'])) {
			$options = $_POST['options'];
			foreach($options as $opt) 
			{
				//$value .= $opt.'~';
				$value[] = $opt; // store in an array
			}
		}
		$js_encode_value = json_encode($value,JSON_FORCE_OBJECT); // use json encode as object updated by Hieu
		$data = array(
			'name' => $name,
			'value' => $js_encode_value
		);
		$this->System_model->add_attribute($data);
		redirect('admin/system/attribute');
	}
	
	function getattributes() {
		$id = $_POST['id'];
		$attribute = $this->System_model->get_attribute($id);
		$options = $attribute['options'];
		$n = count($options);
		$out = '<div class="optwrap" id="attr-'.$id.'"><div class="title">Attribute: <b>'.$attribute['name'].'</b> (You can still customsie this attribute by adding/removing options below) <a href="javascript:removeattr('.$id.')">Remove</a></div>
				<input type="hidden" name="attributes[]" value="'.$id.'" id="attribute-'.$id.'" />
                    <div class="input">
                    	<dl class="four"><dd><input type="text" class="textfield rounded" id="optval-'.$id.'" /></dd><dd id="optbutton-'.$id.'"><input type="button" class="button rounded" value="&raquo;" onclick="addoption('.$id.','.($n + 1).')" /></dd></dl>
                        <dl></dl>
                    </div>
                    <div class="label" id="options-'.$id.'">';
			for($i=0;$i<$n;$i++) {
				$out .='<dl class="five" id="opt-'.$id.'-'.($i+1).'"><dt>'.$options[$i].'</dt><dd><a href="javascript:removeoption('.$id.','.($i+1).')"><img src="'.base_url().'img/backend/icon-delete-small.png" /></a></dd><input type="hidden" name="options-'.$id.'[]" value="'.$options[$i].'" /></dl>';
			}
		$out .='</div>
        <dl></dl>
		</div>';
		print $out;
	} 
	
	// Ajax function
	function deleteattribute($id="") {
		$this->System_model->delete_attribute($id);
		redirect('admin/system/attribute');
	}
	function updateattribute() {
		$attribute_id = $_POST['attribute_id'];
		$value = array();
		if (isset($_POST['options'])) {
			$options = $_POST['options'];
			foreach($options as $opt) {
				//$value .= $opt.'~';
				$value[] = $opt; // store in an array
			}
		}
		$js_encode_value = json_encode($value,JSON_FORCE_OBJECT); // use json encode as object updated by Hieu
		$this->System_model->update_attribute($attribute_id,array('value' => $js_encode_value));
		redirect('admin/system/attribute');
	}
	function updateattributename() {
		$id = $_POST['id'];
		$this->System_model->update_attribute($id,array('name' => $_POST['name']));
	}
	
	/* 2. 2. Shipping Methods */
	function shipping($action="",$shipping_id="") {
		$this->load->view('admin/common/header');
		if ($action == "add") {
			$data['countries'] = $this->System_model->get_countries();
			$this->load->view('admin/system/shipping/add',$data);
		} else if ($action == "edit") {
			$data['shipping'] = $this->System_model->get_shipping($shipping_id);
			$data['countries'] = $this->System_model->get_countries();
			$conditions = $this->System_model->get_shipping_conditions($shipping_id);
			if (count($conditions) == 0) {
				$conditions[0] = array('price' => '','condition' => '');
			}
			$data['conditions'] = $conditions;
			$this->load->view('admin/system/shipping/edit',$data);
		} else {
			$data['shippings'] = $this->System_model->get_shippings();
			$this->load->view('admin/system/shipping/list',$data);
		}
		$this->load->view('admin/common/rightbar');
		$this->load->view('admin/common/footer');
	}
	function addshippingmethod() {
		if ($_POST['name'] == "") { redirect('admin/system/shipping'); }
		$data = array(
			'name' => $_POST['name'],
			'description' => $_POST['description'],
			'default' => 0,
			'price_type' => $_POST['price_type'],
			'price_value' => $_POST['price_value'],
			'created' => date('Y-m-d H:i:s')
		);
		$shipping_id = $this->System_model->add_shipping($data);
		if (isset($_POST['default'])) { $this->System_model->default_shipping($shipping_id); }
		
		if (isset($_POST['countries'])) {
			$countries = $_POST['countries'];
			foreach($countries as $ct) {
				$data = array(
					'shipping_id' => $shipping_id,
					'country_id' => $ct
				);
				$this->System_model->add_shipping_country($data);
			}
		}
		$prices = $_POST['prices'];
		$conditions = $_POST['conditions'];
		for($i=0;$i<count($prices);$i++) {
			$price = str_replace('$','',$prices[$i]);
			$condition = str_replace('$','',$conditions[$i]);
			if ($price != "" && $condition != "") {
				$data = array(
					'shipping_id' => $shipping_id,
					'price' => floatval($price),
					'condition' => floatval($condition)
				);
				$this->System_model->add_shipping_condition($data);
			}
		}
		redirect('admin/system/shipping');
	}
	function updateshippingmethod() {
		$shipping_id = $_POST['shipping_id'];
		$data = array(
			'name' => $_POST['name'],
			'description' => $_POST['description'],
			'price_type' => $_POST['price_type'],
			'price_value' => $_POST['price_value']
		);
		$this->System_model->update_shipping($shipping_id,$data);
		if (isset($_POST['default'])) { $this->System_model->default_shipping($shipping_id); }
		$this->System_model->remove_shipping_countries($shipping_id);
		if (isset($_POST['countries'])) {
			$countries = $_POST['countries'];
			foreach($countries as $ct) {
				$data = array(
					'shipping_id' => $shipping_id,
					'country_id' => $ct
				);
				$this->System_model->add_shipping_country($data);
			}
		}
		$this->System_model->remove_shipping_conditions($shipping_id);
		$prices = $_POST['prices'];
		$conditions = $_POST['conditions'];
		for($i=0;$i<count($prices);$i++) {
			$price = str_replace('$','',$prices[$i]);
			$condition = str_replace('$','',$conditions[$i]);
			if ($price != "" && $condition != "") {
				$data = array(
					'shipping_id' => $shipping_id,
					'price' => floatval($price),
					'condition' => floatval($condition)
				);
				$this->System_model->add_shipping_condition($data);
			}
		}		
		$this->session->set_flashdata('updated',true);
		redirect('admin/system/shipping/edit/'.$shipping_id);
	}
	function activeshipping($id="") {
		$this->System_model->active_shipping($id);
		redirect('admin/system/shipping');
	}
	function deleteshipping($id="") {
		$this->System_model->remove_shipping_countries($id);
		$this->System_model->remove_shipping_conditions($id);
		$this->System_model->delete_shipping($id);
		redirect('admin/system/shipping');
	}
	
	/* 2. 3. Coupon Methods */
	function coupon($action="",$coupon_id="") {
		$this->load->view('admin/common/header');
		if ($action == "add") {
			$this->load->view('admin/system/coupon/add');
		} else if ($action == "edit") {
			$data['coupon'] = $this->System_model->get_coupon($coupon_id);
			$this->load->view('admin/system/coupon/edit',$data);
		} else {
			$data['coupons'] = $this->System_model->get_coupons();
			$this->load->view('admin/system/coupon/list',$data);
		}
		$this->load->view('admin/common/rightbar');
		$this->load->view('admin/common/footer');
	}
	function addcoupon() {
		if(!isset($_POST['name'])) { redirect('admin/system/coupon/add'); }
		$name = $_POST['name'];
		$code = $_POST['code'];
		if ($this->System_model->check_coupon_code($code)) {
			$this->session->set_flashdata('duplicate',true);
			redirect('admin/system/coupon/add');
		}
		$permanent = 0;
		if (isset($_POST['permanent'])) { $permanent = 1; }
		$from_date = $_POST['from_date'];
		$to_date = $_POST['to_date'];
		$type = $_POST['type'];
		$value = $_POST['value'];
		$condition = $_POST['condition'];
		$sale_exclude = 0;
		if (isset($_POST['sale_exclude'])) { $sale_exclude = 1; }
		$data = array(
			'name' => $name,
			'code' => $code,
			'permanent' => $permanent,
			'from_date' => $from_date,
			'to_date' => $to_date,
			'type' => $type,
			'value' => $value,
			'condition' => $condition,
			'sale_exclude' => $sale_exclude,
			'created' => date('Y-m-d H:i:s'),
			'modified' => date('Y-m-d H:i:s')
		);
		$coupon_id = $this->System_model->add_coupon($data);
		redirect('admin/system/coupon');
	}
	function updatecoupon() {
		if(!isset($_POST['id'])) { redirect('admin/system/coupon'); }
		$id = $_POST['id'];
		$name = $_POST['name'];
		$code = $_POST['code'];
		if ($this->System_model->check_coupon_code_update($id,$code)) {
			$this->session->set_flashdata('duplicate',true);
			redirect('admin/system/coupon/edit/'.$id);
		}
		$permanent = 0;
		if (isset($_POST['permanent'])) { $permanent = 1; }
		$from_date = $_POST['from_date'];
		$to_date = $_POST['to_date'];
		$type = $_POST['type'];
		$value = $_POST['value'];
		$condition = $_POST['condition'];
		$sale_exclude = 0;
		if (isset($_POST['sale_exclude'])) { $sale_exclude = 1; }
		$data = array(
			'name' => $name,
			'code' => $code,
			'permanent' => $permanent,
			'from_date' => $from_date,
			'to_date' => $to_date,
			'type' => $type,
			'value' => $value,
			'condition' => $condition,
			'sale_exclude' => $sale_exclude,
			'modified' => date('Y-m-d H:i:s')
		);
		if($this->System_model->update_coupon($id,$data)) {
			$this->session->set_flashdata('updated',true);
		}
		redirect('admin/system/coupon/edit/'.$id);
	}
	function activecoupon($id="") {
		$this->System_model->active_coupon($id);
		redirect('admin/system/coupon');
	}
	function deletecoupon($id) {
		$this->System_model->delete_coupon($id);
		redirect('admin/system/coupon');
	}
	
	/* 2. 4. Manage Taxes */
	function tax($action="",$tax_id="") {
		$this->load->view('admin/common/header');
		if ($action == "add") {
			$data['countries'] = $this->System_model->get_shipping_countries();
			$this->load->view('admin/system/tax/add',$data);
		} else if($action == "edit") {
			$data['countries'] = $this->System_model->get_shipping_countries();
			$data['tax'] = $this->System_model->get_tax($tax_id);			
			$this->load->view('admin/system/tax/edit',$data);
		} else {
			$data['taxes'] = $this->System_model->get_taxes();
			$this->load->view('admin/system/tax/list',$data);
		}
		$this->load->view('admin/common/rightbar');
		$this->load->view('admin/common/footer');
	}
	function addtax() {
		if(!isset($_POST['countries'])) {
			$this->session->set_flashdata('error',true);
			redirect('admin/system/tax/add');
		}
		$countries = $_POST['countries'];
		$name = $_POST['name'];
		$description = $_POST['description'];
		$type = $_POST['type'];
		$value = $_POST['value'];
		$included = 0;
		if (isset($_POST['included'])) { $included = 1; }
		$tradetax=0;
		if(isset($_POST['tradetax'])){$tradetax=1;}
		$data = array(
			'name' => $name,
			'description' => $description,
			'type' => $type,
			'value' => $value,
			'included' => $included,
			'created' => date('Y-m-d H:i:s'),
			'modified' => date('Y-m-d H:i:s'),
			'tradetax' => $tradetax
		);
		$tax_id = $this->System_model->add_tax($data);
		foreach($countries as $country_id) {
			$this->System_model->add_tax_country(array('country_id' => $country_id,'tax_id' => $tax_id));
		}
		
		redirect('admin/system/tax');
	}
	function updatetax() {
		$tax_id = $_POST['tax_id'];
		if(!isset($_POST['countries'])) {
			$this->session->set_flashdata('error',true);
			redirect('admin/system/tax/edit/'.$tax_id);
		}
		$countries = $_POST['countries'];
		$name = $_POST['name'];
		$description = $_POST['description'];
		$type = $_POST['type'];
		$value = $_POST['value'];
		$included = 0;
		if (isset($_POST['included'])) { $included = 1; }
		$data = array(
			'name' => $name,
			'description' => $description,
			'type' => $type,
			'value' => $value,
			'included' => $included,
			'modified' => date('Y-m-d H:i:s')
		);
		$this->System_model->update_tax($tax_id,$data);
		$this->System_model->remove_tax_countries($tax_id);
		foreach($countries as $country_id) {
			$this->System_model->add_tax_country(array('country_id' => $country_id,'tax_id' => $tax_id));
		}
		$this->session->set_flashdata('updated',true);
		redirect('admin/system/tax/edit/'.$tax_id);
	}
	function deletetax($id="") {
		$this->System_model->remove_tax_countries($id);
		$this->System_model->delete_tax($id);
		redirect('admin/system/tax');
	}
	function activetax($id="") {
		$this->System_model->active_tax($id);
		redirect('admin/system/tax');
	}
	
	
	/* 2. 5. Email Forwardings */
	function email() {
		//$data['signup'] = $this->System_model->get_email('name','signup');
		$data['order'] = $this->System_model->get_email('name','order');
		$data['contact'] = $this->System_model->get_email('name','contact');
		$data['trade'] = $this->System_model->get_email('name','trade');
		$data['stock'] = $this->System_model->get_email('name','stock');
		$this->load->view('admin/common/header');
		$this->load->view('admin/system/email/main',$data);
		$this->load->view('admin/common/rightbar');
		$this->load->view('admin/common/footer');
	}
	function updateemails() {
		// not using stock
		// if(!isset($_POST['order']) || !isset($_POST['contact']) || !isset($_POST['stock'])|| !isset($_POST['trade'])) {
		if(!isset($_POST['order']) || !isset($_POST['contact']) ||  !isset($_POST['trade'])) {
			$this->session->set_flashdata('updated','<br /><span class="error">ERROR: Invalid references</span>');
			redirect('admin/system/email');
		}
		//$this->System_model->delete_emails('name','signup');
		//$this->System_model->delete_emails('name','trade');
		//$this->System_model->delete_emails('name','order');
		//$this->System_model->delete_emails('name','contact');
		//$this->System_model->delete_emails('name','stock');
		//$email_ss = explode(',',$_POST['signup']);
		$email_tt = explode(',',$_POST['trade']);
		$email_oo = explode(',',$_POST['order']);
		$email_cc = explode(',',$_POST['contact']);
		//$email_st = explode(',',$_POST['stock']);
		$msg0 = '';
		$msg1 = '';
		$msg2 = '';
		$msg3 = '';
		$msg4 = '';
		$this->load->helper('email');
		/*
		foreach($email_ss as $email_s) {
			$this->System_model->add_email(array('name' => 'signup','address' => $email_s));
			if (valid_email($email_s)) {
				$email_signup = $this->System_model->get_email('name','signup');
				if ($email_s != $email_signup['address']) {
					$this->System_model->update_email(3,array('address' => $email_s,'modified' => date('Y-m-d H:i:s')));
					$msg0 = '<span class="green">New Customer email has been updated successfully.</span>';
				} else { $msg0 = '<span>New Cusomter email is still the same</span>'; }
			} else { $msg0 = '<span class="error">New Customer email is invalid and was not updated.</span>'; }
			
		}
		*/
		$temp1= array();
		foreach($email_tt as $email_t) {
			//$this->System_model->add_email(array('name' => 'trade','address' => $email_t));
			/*if (valid_email($email_t)) {
				$email_trade = $this->System_model->get_email('name','trade');
				if ($email_t != $email_trade['address']) {
					$this->System_model->update_email(4,array('address' => $email_t,'modified' => date('Y-m-d H:i:s')));
					$msg3 = '<span class="green">New Trader email has been updated successfully.</span>';
				} else { $msg3 = '<span>New Trader email is still the same</span>'; }
			} else { $msg3 = '<span class="error">New Trader email is invalid and was not updated.</span>'; }*/
			$temp1[] = $email_t;
		}
		
		$this->System_model->update_email(1,array('name' => 'trade','address' => json_encode($temp1,JSON_FORCE_OBJECT)));
		$temp2= array();
		foreach($email_oo as $email_o) {
			
			/*if (valid_email($email_o)) {
				$email_order = $this->System_model->get_email('name','order');
				if ($email_o != $email_order['address']) {
					$this->System_model->update_email(1,array('address' => $email_o,'modified' => date('Y-m-d H:i:s')));	
					$msg1 = '<span class="green">Shop Order email has been updated successfully.</span>';
				} else { $msg1 = '<span>Shop Order email is still the same</span>'; }
			} else { $msg1 = '<span class="error">Shop Order email is invalid and was not updated.</span>'; }*/
			$temp2[] = $email_o;
		}
		$this->System_model->update_email(2,array('name' => 'order','address' => json_encode($temp2,JSON_FORCE_OBJECT)));
		$temp3= array();
		foreach($email_cc as $email_c) {
			
			/*if (valid_email($email_c)) {
				$email_contact = $this->System_model->get_email('name','contact');
				if ($email_c != $email_contact['address']) {
					$this->System_model->update_email(2,array('address' => $email_c,'modified' => date('Y-m-d H:i:s')));	
					$msg2 = '<span class="green">Website Contact email has been updated successfully.</span>';
				} else { $msg2 = '<span>Website Contact email is still the same</span>'; }
			} else { $msg2 = '<span class="error">Website Contact email is invalid and was not updated</span>'; }*/
			$temp3[] = $email_c;
		}
		$this->System_model->update_email(3,array('name' => 'contact','address' => json_encode($temp3,JSON_FORCE_OBJECT)));
		
		//$temp4= array();
		//foreach($email_st as $email_s) {
			
			/*if (valid_email($email_c)) {
				$email_contact = $this->System_model->get_email('name','contact');
				if ($email_c != $email_contact['address']) {
					$this->System_model->update_email(2,array('address' => $email_c,'modified' => date('Y-m-d H:i:s')));	
					$msg2 = '<span class="green">Website Contact email has been updated successfully.</span>';
				} else { $msg2 = '<span>Website Contact email is still the same</span>'; }
			} else { $msg2 = '<span class="error">Website Contact email is invalid and was not updated</span>'; }*/
			//$temp4[] = $email_s;
		//}
		//$this->System_model->update_email(4,array('name' => 'stock','address' => json_encode($temp4,JSON_FORCE_OBJECT)));
		#$this->session->set_flashdata('updated','<br />'.$msg0.'<br />'.$msg3.'<br />'.$msg1.'<br />'.$msg2);
		redirect('admin/system/email');
		
	}	
	
}
?>