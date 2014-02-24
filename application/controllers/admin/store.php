<?php
class Store extends CI_Controller {
	function __construct() {
		parent::__construct();
		if (!$this->session->userdata('kiotiahraloggedin')) {
			redirect('admin/login');
		}
		$this->load->model('System_model');
		$this->load->model('Customer_model');
		$this->load->model('Supplier_model');
		$this->load->model('User_model');
		$this->load->model('Quote_model');
		$this->load->model('Location_model');
		$this->load->model('Subscribe_model');	
	}
	
	/* 1. 0. Dashboard */
	function index() {
		redirect('admin/store/quote');
		/*
		$this->load->view('admin/common/header');
		$this->load->view('admin/system/dashboard');
		$this->load->view('admin/common/rightbar');
		$this->load->view('admin/common/footer');
		*/
	}
	function mostpopular() {
		$out = '
		<h3>Most popular keywords</h3>
        <div class="row-title">
			<div class="order-id2">Order</div>
        	<div class="customer-name">Keyword</div>
            <div class="cat-func">Times</div>
        </div>';
		$n=1;
		$keywords = $this->System_model->most_keywords();
		foreach($keywords as $keyword) {
			$word = $this->System_model->get_keyword($keyword['id']);
			$out .= '
			<div class="row-item">
				<div class="order-id2">'.$n.'</div>
				<div class="customer-name">'.$word['keyword'].'</div>
				<div class="cat-func">'.$keyword['total'].'</div>
			</div>';
			$n++;
		}
		print $out;
	}
	
	function bestcustomer() {
		$out = '
		<h3>Best customers</h3>
        <div class="row-title">
			<div class="order-id2">Order</div>
        	<div class="customer-name">Customer</div>
            <div class="cat-func2">Spend</div>
        </div>';
		$customers = $this->System_model->best_customers();
		$n=1;
		foreach($customers as $bcustomers) {
			$customer = $this->Customer_model->identify($bcustomers['customer_id']);
			$out .= '
			<div class="row-item">
				<div class="order-id2">'.$n.'</div>
				<div class="customer-name">'.$customer['firstname'].' '.$customer['lastname'].'</div>
				<div class="cat-func2">$'.$bcustomers['total'].'</div>
			</div>';
			$n++;
		}
		print $out;
	}
	
	
	/* 1.5. Manage Customers */
	function customer($action="",$value="") 
	{
		
		if ($action == "search") {
			$this->session->set_userdata('name',$_POST['name']);
			$this->session->set_userdata('type',$_POST['type']);
			redirect('admin/store/customer');
		}
		$this->load->view('admin/common/header');
		if ($action == "edit") {
			//$user = $this->User_model->id($value);
			$data['customer'] = $this->Customer_model->identify($value);
			//$data['user'] = $user;
			$data['countries'] = $this->System_model->get_countries();
			$this->load->view('admin/customer/edit',$data);
		} else {
			/*
			$type = 4;
					
			if ($this->session->userdata('type')) 
			{ 
				$type = $this->session->userdata('type'); 				
			}
			
			$name='';
			if ($this->session->userdata('name')){
				$name=$this->session->userdata('name');	
			}
			$data['users']=array();
			if($type == 5)
			{
				$this->load->model('Subscribe_model');
			  $data['subscribers'] = $this->Subscribe_model->all();
			}
			else
			{
				$data['subscribers'] ='';
				if(isset($name)&&!empty($name))
			  {
				$data['users'] = $this->User_model->recognize_v2($name,$type);				
			  }
			  else
			  {
				$data['users'] = $this->User_model->get($type);	
			  }
			}
			*/
			$data['quotes']=$this->Quote_model->all();
			$this->load->view('admin/customer/list',$data);
						
		}
		$this->load->view('admin/common/rightbar');
		$this->load->view('admin/common/footer');
	}
	function updatecustomer() {
		if (!isset($_POST['id'])) { redirect('admin/store/customer'); }
		$id = $_POST['id'];
		$user = $this->User_model->id($id);
		$data = array(
			'firstname' => $_POST['firstname'],
			'lastname' => $_POST['lastname'],
			'address' => $_POST['address'],
			'city' => $_POST['city'],
			'state' => $_POST['state'],
			'country' => $_POST['country'],
			'postcode' => $_POST['postcode'],
			'phone' => $_POST['phone'],
			'email' => $_POST['email'],
			'modified' => date('Y-m-d H:i:s')
		);
		if ($_POST['password'] != "") {
			$this->User_model->update($id,array('password' => md5($_POST['password'])));
		}
		if ($this->Customer_model->update($user['customer_id'],$data)) {
			$this->session->set_flashdata('update',true);
		}
		redirect('admin/store/customer/edit/'.$id);
	}
	
	function updatetrader() {
		if (!isset($_POST['id'])) { redirect('admin/store/customer'); }
		$id = $_POST['id'];
		$user = $this->User_model->id($id);
		
		$email = $this->input->post('email',true);
		$username = $email;
		$storename = $this->input->post('storename',true);
		$tradename = $this->input->post('tradename',true);
		$firstname = $this->input->post('firstname',true);
		$lastname = $this->input->post('lastname',true);
		
		
		$phone= $_POST['phone'];
		$mobile = $_POST['mobile'];
		$address = $_POST['address'];
		$address2 = $_POST['address2'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		
		$postcode = $_POST['postcode'];
		
		$data = array(
			'email' => $email,
			'firstname' => $firstname,
			'lastname' => $lastname,
			'storename' => $storename,
			'tradename' => $tradename,
			'phone' => $phone,
			'address' => $address,
			'address2' => $address2,
			'city' => $city,
			'state' => $state,
			'postcode' => $postcode,
			'phone' => $phone,
			'mobile' => $mobile,
			'modified' => date('Y-m-d H:i:s')
		);
		
		if ($_POST['password'] != "") {
			$this->User_model->update($id,array('password' => md5($_POST['password'])));
		}
		if ($this->Customer_model->update($user['customer_id'],$data)) {
			$this->session->set_flashdata('update',true);
		}
		redirect('admin/store/customer/edit/'.$id);
	}
	
	function approvetrader() {
		$id = $_POST['id'];
		$this->User_model->update($id,array('activated' => 1));
		
		if ($_POST['send'] == '1') {
			$user = $this->User_model->id($id);
			$customer = $this->Customer_model->identify($user['customer_id']);
			$subject = 'Trade Application Approval @ 7 Eleven Online Merchandise Store';
			$message = sprintf("
<p>Thank you %s</p>
<p>Your application to become a Trade Customer of 7 Eleven Online Merchandise Store has been successful. You are now able to login to the 7 Eleven Online Merchandise Store using the following details:</p>
<p>
Username: %s<br />
Password: this will be the password you selected when you signed up via the registration form.<br/>
(If you have forgotten your password please click 'forgot password' in the trade section of our website)
</p>

<p>Should you have any queries please don't hesitate to contact us.</p>


<p>Warm Regards,</p>


7 Eleven Online Merchandise Store

			",$customer['firstname'],$user['username']);
			/*
			//load email content
			$data['content'] = $message;
			$message = $this->load->view('email_template',$data, TRUE);
			*/
			$this->load->library('email');
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			$this->email->from('noreply@onlinemerchandise.com.au','7 Eleven Online Merchandise Store');		
			$this->email->to($customer['email']);
		
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->send();
		}
	}
		
	function pendingtrader() {
		$id = $_POST['id'];
		$this->User_model->update($id,array('activated' => 0));
	}
	function deletecustomer($id='') 
	{
		$user = $this->User_model->id($id);
		$customer = $this->Customer_model->identify($user['customer_id']);
		$subject = 'Trade Application Decline @ 7 Eleven Online Merchandise Store';
		$message = sprintf("
<p>Thank you %s</p>
<p>Unfortunately, at this moment we are unable to activate you as a Trade Customer.</p>
<p>
Sorry for any inconvenience this might cause you.  If you would like to discuss the matter please feel free to contact us
</p>

<p>Warm Regards,</p>


7 Eleven Online Merchandise Store

		",$customer['firstname']);
		
		//load email content
		//$data['content'] = $message;
		//$message = $this->load->view('email_template',$data, TRUE);
		
		$this->load->library('email');
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('noreply@onlinemerchandise.com.au','7 Eleven Online Merchandise Store');		
		$this->email->to($customer['email']);
		
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();
			
		$user = $this->User_model->id($id);
		$this->User_model->delete($id);
		$this->Customer_model->delete($user['customer_id']);
		$this->Order_model->delete($user['customer_id']);
		
		redirect('admin/store/customer');
	}
	function deletesubscribe($id) {
		$this->load->model('Subscribe_model');
		$this->Subscribe_model->delete($id);
		redirect('admin/store/customer');
	}

	function exportcustomer() {
		$csvdir = getcwd();
		//$csvdir = $csvdir.'/csv/';
		$csvname = 'customer_'.date('d-m-Y');
		$csvname = $csvname.'.csv';
		header('Content-type: application/csv; charset=utf-8;');
        header("Content-Disposition: attachment; filename=$csvname");
		$fp = fopen("php://output", 'w');
		
		$type = 4;
		if ($this->session->userdata('type')) 
		{ 
		$type = $this->session->userdata('type'); 
		}
		$users = $this->User_model->get($type);
		
		if($type==4)
		{
			$headings = array('Username','First Name','Family Name','Email','Store Name','Trading Name','Address 1','Address 2','Suburb','State','Postcode','Phone Number','Mobile','Joined','Last Updated');
		fputcsv($fp,$headings);
			foreach ($users as $user) 
			{
				$customer = $this->Customer_model->identify($user['customer_id']);
				fputcsv($fp,array($user['username'],$customer['firstname'],$customer['familyname'],$customer['email'],$customer['storename'],$customer['tradename'],$customer['address'],$customer['address2'],$customer['suburb'],$customer['state'],$customer['postcode'],$customer['phone'],$customer['mobile'],$customer['joined'],$customer['modified']));
			}
		}
		else
		{
			$this->load->model('Subscribe_model');
			$subscribers = $this->Subscribe_model->all();
			$headings = array('First Name','Family Name','Mobile','Email','Date time');
			fputcsv($fp,$headings);
			foreach ($subscribers as $s) 
			{
				
				fputcsv($fp,array($s['firstname'],$s['familyname'],$s['mobile'],$s['email'],$s['date']));
			}
		}
		
        fclose($fp);
		//redirect(base_url().'csv/'.$csvname);
	}
	
	/* Manage Suppliers */
	
	function supplier($action="",$value="") 
	{
		
		if ($action == "search") {
			$this->session->set_userdata('name',$_POST['name']);
			$this->session->set_userdata('type',$_POST['type']);
			redirect('admin/store/supplier');
		}
		$this->load->view('admin/common/header');
		if ($action == "edit") {
			//$user = $this->User_model->id($value);
			$data['supplier'] = $this->Supplier_model->identify($value);
			$data['s_service']=$this->Supplier_model->getservice($value);
			$data['s_state']=$this->Supplier_model->getstate($value);
			$data['history']=$this->Quote_model->listhistorysupplier($value);
			//$data['user'] = $user;
			$data['countries'] = $this->System_model->get_countries();
			$this->load->view('admin/supplier/edit',$data);
		} else {
			
			$name='';
			$type='';
			if($this->session->userdata('name'))
			{$name=$this->session->userdata('name');}
			
			if($this->session->userdata('type'))
			{
				$type=$this->session->userdata('type');
				if($type=='1'){$type=1;}
				if($type=='2'){$type=0;}
				if($type=='-'){$type='';}
			}
			
			$data['suppliers'] = $this->Supplier_model->get($name,$type);						
			$this->load->view('admin/supplier/list',$data);
			
		}
		$this->load->view('admin/common/rightbar');
		$this->load->view('admin/common/footer');
	}
	
	function updatesupplier() {
		if (!isset($_POST['id'])) { redirect('admin/store/supplier'); }
		$id = $this->input->post('id',true);
		
		
		$email = $this->input->post('email',true);
		$business_name = $this->input->post('business_name',true);
		$website = $this->input->post('website',true);
		$firstname = $this->input->post('firstname',true);
		
		$description =$this->input->post('description',true);
		
		$phone= $this->input->post('phone',true);
		
		$address = $this->input->post('address',true);
		$address2 = $this->input->post('address2',true);
		$suburb = $this->input->post('suburb',true);

		
		$postcode = $this->input->post('postcode',true);
		
		$data = array(
			'email' => $email,
			'firstname' => $firstname,
			'business_name' => $business_name,
			'website' => $website,
			'phone' => $phone,
			'address1' => $address,
			'address2' => $address2,
			'suburb' => $suburb,
			'postcode' => $postcode,
			'phone' => $phone,
			'modified' => date('Y-m-d H:i:s')
		);
		if ($this->Supplier_model->update($id,$data)) {
			$this->session->set_flashdata('update',true);
		}
		$this->Supplier_model->deleteservice($id);
		$this->Supplier_model->deletestate($id);
		$state1=$this->input->post('state1',true);
		$state2=$this->input->post('state2',true);
		$state3=$this->input->post('state3',true);
		$state4=$this->input->post('state4',true);
		$state5=$this->input->post('state5',true);
		$state6=$this->input->post('state6',true);
		$state7=$this->input->post('state7',true);
		$state8=$this->input->post('state8',true);
		
		$service1=$this->input->post('service1',true);
		$service2=$this->input->post('service2',true);
		$service3=$this->input->post('service3',true);
		$service4=$this->input->post('service4',true);
		
		if($state1==1)
		{
			$data=array('supplier_id' => $id, 'state_id' =>1);
			$this->Supplier_model->addstate($data);
		}
		if($state2==1)
		{
			$data=array('supplier_id' => $id, 'state_id' => 2);
			$this->Supplier_model->addstate($data);
		}
		if($state3==1)
		{
			$data=array('supplier_id' => $id, 'state_id' => 3);
			$this->Supplier_model->addstate($data);
		}		
		if($state4==1)
		{
			$data=array('supplier_id' => $id, 'state_id' => 4);
			$this->Supplier_model->addstate($data);
		}		
		if($state5==1)
		{
			$data=array('supplier_id' => $id, 'state_id' => 5);
			$this->Supplier_model->addstate($data);
		}		
		if($state6==1)
		{
			$data=array('supplier_id' => $id, 'state_id' => 6);
			$this->Supplier_model->addstate($data);
		}				
		if($state7==1)
		{
			$data=array('supplier_id' => $id, 'state_id' => 7);
			$this->Supplier_model->addstate($data);
		}		
		if($state8==1)
		{
			$data=array('supplier_id' => $id, 'state_id' => 8);
			$this->Supplier_model->addstate($data);
		}				
		
		
		if($service1==1)
		{
			$data=array('supplier_id' => $id, 'service_id' => 1);
			$this->Supplier_model->addservice($data);
		}		
		if($service2==1)
		{
			$data=array('supplier_id' => $id, 'service_id' => 2);
			$this->Supplier_model->addservice($data);
		}		
		if($service3==1)
		{
			$data=array('supplier_id' => $id, 'service_id' => 3);
			$this->Supplier_model->addservice($data);
		}		
		if($service4==1)
		{
			$data=array('supplier_id' => $id, 'service_id' => 4);
			$this->Supplier_model->addservice($data);
		}		
		
		redirect('admin/store/supplier/edit/'.$id);
	}
	
	function approvesupplier() {
		$id = $_POST['id'];
		$this->Supplier_model->update($id,array('actived' => 1));
		
		if ($_POST['send'] == 1) {
			$supplier = $this->Supplier_model->identify($id);
			$subject = 'Supplier Application Approval @ Removalist Quote';
			 $message="<p>Congratulations your member account with <a href='http://www.removalquote.com.au' style='text-decoration:underline; color:red;'>www.removalistQuote.com.au</a> has been approved. You are well on the way to winning high quality removals jobs work in your area. We will send quotes to you via email to the address".$supplier['email']." please make sure you add this email address to your safe sender list to ensure you don't miss out on any jobs.</p>Please feel free to contact us anytime if you have any questions.<br><br>";
        
//        $message_denied="<p>Im sorry to say that after review your company hasn't met the standards approval check and we are unable to register you with <a href='http://www.removalquote.com.au' style='text-decoration:underline; color:red;'>www.removalistQuote.com.au</a>. If you would like to find out more about how you can pass our standards approval check please contact us.</p><br><br>";
                  
                  
        
        $footer1 ='<p>Kind regards</p><br>';
        $image='<img src="'.base_url().'img/EmailRemovalQuotelogo.jpg"><br>';
        $footer2='<p ><span style="font-weight:bold; font-size:14px;">Removal Quotes </span>  <br>
                    <a href="http://www.removalquote.com.au" style="text-decoration:underline; color:red;">www.removalquote.com.au</a></p>
                        <p>
                        Call     1300 111 222     <br>
                        email    <a style="text-decoration:underline; color:red;" href="mailto:info@removalquote.com.au">info@removalquote.com.au</a></p>';

        $this->load->library('email');
        
        $config['mailtype'] = 'html';
        $this->email->initialize($config);


        $this->email->from('membercare@removalistquote.com.au', 'Removal Quote');
  $this->email->subject($subject);
        $this->email->message($message.$footer1.$image.$footer2);
	
			$this->email->to($supplier['email']);
            $this->email->bcc('raquel@propagate.com.au'); 
		
	
			$this->email->send();
		}
	}
		
	function pendingsupplier() {
		$id = $_POST['id'];
		$this->Supplier_model->update($id,array('actived' => 0));
	}
	function deletesupplier($id='') 
	{
		
		$supplier = $this->Supplier_model->identify($id);
		$subject = 'Supplier Application Decline @ Removalist Quote';

        $message="<p>Im sorry to say that after review your company hasn't met the standards approval check and we are unable to register you with <a href='http://www.removalquote.com.au' style='text-decoration:underline; color:red;'>www.removalistQuote.com.au</a>. If you would like to find out more about how you can pass our standards approval check please contact us.</p><br><br>";
                  
                  
        
        $footer1 ='<p>Kind regards</p><br>';
        $image='<img src="'.base_url().'img/EmailRemovalQuotelogo.jpg"><br>';
        $footer2='<p ><span style="font-weight:bold; font-size:14px;">Removal Quotes </span>  <br>
                    <a href="http://www.removalquote.com.au" style="text-decoration:underline; color:red;">www.removalquote.com.au</a></p>
                        <p>
                        Call     1300 111 222     <br>
                        email    <a style="text-decoration:underline; color:red;" href="mailto:info@removalquote.com.au">info@removalquote.com.au</a></p>';

        $this->load->library('email');
        
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
	
		$this->email->bcc('raquel@propagate.com.au');
        $this->email->from('membercare@removalistquote.com.au', 'Removal Quote');
  		$this->email->subject($subject);
        $this->email->message($message.$footer1.$image.$footer2);
		$this->email->to($supplier['email']);
		$this->email->send();
			
		
		$this->Supplier_model->delete($supplier['id']);
		//$this->Order_model->delete($user['customer_id']);
		
		redirect('admin/store/supplier');
	}
	

	function exportsupplier() {
		$csvdir = getcwd();
		//$csvdir = $csvdir.'/csv/';
		$csvname = 'customer_'.date('d-m-Y');
		$csvname = $csvname.'.csv';
		header('Content-type: application/csv; charset=utf-8;');
        header("Content-Disposition: attachment; filename=$csvname");
		$fp = fopen("php://output", 'w');
		
		
		$suppliers = $this->Supplier_model->all();
		
		
			$headings = array('First Name','Family Name','Email','Store Name','Trading Name','Address 1','Address 2','Suburb','State','Postcode','Phone Number','Mobile','Joined','Last Updated');
		fputcsv($fp,$headings);
			foreach ($suppliers as $supplier) 
			{
				//$customer = $this->Customer_model->identify($user['customer_id']);
				fputcsv($fp,array($supplier['firstname'],$supplier['familyname'],$supplier['email'],$supplier['storename'],$supplier['tradename'],$supplier['address'],$supplier['address2'],$supplier['suburb'],$supplier['state'],$supplier['postcode'],$supplier['phone'],$supplier['mobile'],$supplier['joined'],$supplier['modified']));
			}
		
		
        fclose($fp);
		//redirect(base_url().'csv/'.$csvname);
	}
	/* Manage Quote */
	
	function quote($action="",$value="") 
	{
		
		if ($action == "search") {
			$this->session->set_userdata('name',$_POST['name']);
			$this->session->set_userdata('type',$_POST['type']);
			$this->session->set_userdata('date_from',$_POST['date_from']);
			$this->session->set_userdata('date_to',$_POST['date_to']);
		
			redirect('admin/store/quote');
		}
		$this->load->view('admin/common/header');
		if ($action == "edit") {			
			
			$quote= $this->Quote_model->identify($value);
			
			$data['quote'] = $quote;			
			$data['history']=$this->Quote_model->listhistory($value);
			$data['customer'] = $this->Customer_model->identify($quote['customer_id']);
			$data['states'] = $this->Location_model->allstates();
			$data['states2'] = $this->Location_model->allstates();
			
			$this->load->view('admin/quote/edit',$data);
		} else {
			
			$name='';
			$type=0;
			$date_from='';
			$date_to='';
			if($this->session->userdata('name'))
			{$name=$this->session->userdata('name');}
			
			if($this->session->userdata('type'))
			{$type=$this->session->userdata('type');}
			
			if($this->session->userdata('date_from'))
			{$date_from=$this->session->userdata('date_from');}
			
			if($this->session->userdata('date_to'))
			{$date_to=$this->session->userdata('date_to');}
			
			$data['type']=$type;
			$data['quotes']=$this->Quote_model->searchquote($name,$type,$date_from,$date_to);
			$this->load->view('admin/quote/list',$data);
						
		}
		$this->load->view('admin/common/rightbar');
		$this->load->view('admin/common/footer');
	}
	
	function updatequote() {
		if (!isset($_POST['quote_id'])) { redirect('admin/store/quote'); }
		$quote_id = $this->input->post('quote_id',true);
		$cust_id = $this->input->post('cust_id',true);
		
		//customer detail
		$email = $this->input->post('email',true);				
		$firstname = $this->input->post('firstname',true);
		$lastname = $this->input->post('lastname',true);		
		$phone= $this->input->post('phone',true);
		
		//quote detail
		$type_removal= $this->input->post('type_removal',true);
		$state_from=$this->session->userdata('state_from');
		$city_from=$this->session->userdata('city_from');
		$suburb_from=$this->session->userdata('suburb_from');
		
		$state_to=$this->session->userdata('state_to');
		$city_to=$this->session->userdata('city_to');
		$suburb_to=$this->session->userdata('suburb_to');
		
		
		
		$to_contact=$this->input->post('to_contact',true);
		
		if($type_removal==1 || $type_removal==2){
			$bedroom=$this->input->post('bedroom',true);
			$packing=$this->input->post('packing',true);
		}
		else
		{
			$bedroom='';
			$packing='';
		}
		if($type_removal==1)
		{
			$connecting=$this->input->post('connecting',true);
			$cleaning=$this->input->post('cleaning',true);
		}
		else
		{
			$connecting=0;
			$cleaning=0;
		}
		$date_done=$this->input->post('date_done',true);
		$additional=$this->input->post('additional',true);
		
		//update customer
		$data_cust = array(
			'email' => $email,
			'firstname' => $firstname,
			'lastname' => $lastname,
			'phone' => $phone,
			'modified' => date('Y-m-d H:i:s')
		);
		
		$data_quote = array(
			'customer_id' =>$cust_id,
			'email' => $email,
			'state_from' => $state_from,
			'city_from'=> $city_from,
			'suburb_from' => $suburb_from,
			'state_to' => $state_to,
			'city_to' => $city_to,
			'suburb_to' => $suburb_to,
			'type_removal' => $type_removal,
			'to_contact' => $to_contact,
			'bedroom' => $bedroom,
			'packing' => $packing,
			'cleaning'=> $cleaning,
			'connecting' => $connecting,
			'date_done' => $date_done,
			'additional' => $additional,
			'modified' => date('Y-m-d H:i:s')
		);
		if ($this->Customer_model->update($cust_id,$data_cust)) {
			$this->session->set_flashdata('update',true);
		}
		if ($this->Quote_model->update($quote_id,$data_quote)) {
			$this->session->set_flashdata('update',true);
		}
		redirect('admin/store/quote/edit/'.$quote_id);
	}
	
	
	function deletequote($id='') 
	{
			
		
		$this->Quote_model->delete($id);
		
		
		redirect('admin/store/quote');
	}
	

	function exportquote() {
		$csvdir = getcwd();
		//$csvdir = $csvdir.'/csv/';
		$csvname = 'Quotes_'.date('d-m-Y');
		$csvname = $csvname.'.csv';
		header('Content-type: application/csv; charset=utf-8;');
        header("Content-Disposition: attachment; filename=$csvname");
		$fp = fopen("php://output", 'w');
		
		
		//$quotes = $this->Quote_model->all();
		$name='';
			$type=0;
			$date_from='';
			$date_to='';
			if($this->session->userdata('name'))
			{$name=$this->session->userdata('name');}
			
			if($this->session->userdata('type'))
			{$type=$this->session->userdata('type');}
			
			if($this->session->userdata('date_from'))
			{$date_from=$this->session->userdata('date_from');}
			
			if($this->session->userdata('date_to'))
			{$date_to=$this->session->userdata('date_to');}
			
			
			$quotes=$this->Quote_model->searchquote($name,$type,$date_from,$date_to);
		
			$headings = array('Quote Type','Date','Customer ID','Email','Firstname','Lastname','Phone','State From','City From','Suburb From','State To','City To','Suburb To','Best time to contact','Bedrooms','Moving Date','Need Help for packing','Need a quote for cleaning','status');
		fputcsv($fp,$headings);
			foreach ($quotes as $qt) 
			{
				
				$service=$qt['type_removal'];
				$date=$qt['date'];
				$state_from = $qt['state_from'];
				$state_to = $qt['state_to'];
				$city_from = $qt['city_from'];
				$city_to = $qt['city_to'];
				$suburb_from = $qt['suburb_from'];
				$suburb_to = $qt['suburb_to'];
				
				$customer=$this->Customer_model->identify($qt['customer_id']);
				$firstname=$customer['firstname'];
				$lastname=$customer['lastname'];
				$phone=$customer['phone'];
				$email=$customer['email'];
				$to_contact = $qt['to_contact'];
				$date_done = $qt['date_done'];
				$bedroom = $qt['bedroom'];
				$packing=$qt['packing'];
				$cleaning=$qt['cleaning'];
				$additional=$qt['additional'];
				if($service==1){$service_text="Moving Home";}
				if($service==2){$service_text="Moving Into Storage";}
				if($service==3){$service_text="Moving 1-5 Items";}
				if($service==4){$service_text="Moving Office";}
				
				$state_from_text=$this->Location_model->identifystate($state_from);
				$state_to_text=$this->Location_model->identifystate($state_to);
				
				$suburb_from_text=$this->Location_model->identifysuburb($suburb_from);
				$suburb_to_text=$this->Location_model->identifysuburb($suburb_to);
				
				if($cleaning==0){$cleaning_text='No';}else{$cleaning_text='Yes';}
				if($qt['status']==0){$status='New';}else{$status="Processed";}

				fputcsv($fp,array($service_text,$date,$qt['customer_id'],$email,$firstname,$lastname,$phone,$state_from_text,$city_from,$suburb_from_text,$state_to_text,$city_to,$suburb_to_text,$to_contact,$bedroom,$date_done,$packing,$cleaning_text,$status));
			}
		
		
        fclose($fp);
		//redirect(base_url().'csv/'.$csvname);
	}
	function getsuburb()
	{
		$state=$this->input->post('state',true);
		$suburb_id=$this->input->post('suburb',true);
		$cond=$this->input->post('cond',true);
		$suburbs=$this->Location_model->getsuburb($state);
		$option='<option value="-">There is no suburb yet in this state</option>';		
		if($cond==1)
		{
			$out='<select name="suburb_from" id="suburb_from">';
			
		}
		if($cond==2)
		{
			$out='<select name="suburb_to" id="suburb_to">';
			
		}
		if($suburbs)
		{
			$option='';
	
			foreach($suburbs as $suburb)
			{
				if($suburb['id']==$suburb_id)
				{
					$select="selected=selected";
					$option=$option.'<option value='.$suburb['id'].' selected=selected >'.$suburb['name'].'</option>';
				}
				else
				{ $select='';
				$option=$option.'<option value='.$suburb['id'].' >'.$suburb['name'].'</option>';
				}
				
			}
				
		}									
		$out=$out.$option.'</select>';
		print $out;
	}
	function sendquotepage($id='',$value='')
	{
		
		if($value=='')
		{
			$data['id']=$id;
			$quote= $this->Quote_model->identify($id);			
			$data['quote'] = $quote;			
			$state=$quote['state_from'];
			$service=$quote['type_removal'];
			$name='';
			$data['suppliers'] = $this->Supplier_model->activesupplier($state,$service,$name);
			$data['states'] = $this->Location_model->allstates();
		}
		else
		{
			
			$data['id']=$id;
			$quote= $this->Quote_model->identify($id);			
			$data['quote'] = $quote;			
			$state=$quote['state_from'];
			$service=$quote['type_removal'];
			$state=$this->input->post('state');	
			$name=$this->input->post('firstname');	
			$data['suppliers'] = $this->Supplier_model->activesupplier($state,$service,$name);
			$data['states'] = $this->Location_model->allstates();
		}
		
		$this->load->view('admin/quote/send',$data);		

	}
	function sendquote()
	{
		
		$firstname_supp=$this->input->post('firstname_supplier',true);
		$state_supp=$this->input->post('state_supplier',true);
		$quote_id=$this->input->post('quote_sup',true);
		$quote= $this->Quote_model->identify($quote_id);			
		
		$service=$quote['type_removal'];
		$state_from = $quote['state_from'];
		$state_to = $quote['state_to'];
		$city_from = $quote['city_from'];
		$city_to = $quote['city_to'];
		$suburb_from = $quote['suburb_from'];
		$suburb_to = $quote['suburb_to'];
		
		$customer=$this->Customer_model->identify($quote['customer_id']);
		$firstname=$customer['firstname'];
		$lastname=$customer['lastname'];
		$phone=$customer['phone'];
		$email=$customer['email'];
		$to_contact = $quote['to_contact'];
		$date_done = $quote['date_done'];
		$bedroom = $quote['bedroom'];
		$packing=$quote['packing'];
		$cleaning=$quote['cleaning'];
		$additional=$quote['additional'];
		if($service==1){$service_text="Moving Home";}
		if($service==2){$service_text="Moving Into Storage";}
		if($service==3){$service_text="Moving 1-5 Items";}
		if($service==4){$service_text="Moving Office";}
		
		$state_from_text=$this->Location_model->identifystate($state_from);
		$state_to_text=$this->Location_model->identifystate($state_to);
		
		$suburb_from_text=$this->Location_model->identifysuburb($suburb_from);
		$suburb_to_text=$this->Location_model->identifysuburb($suburb_to);
		
		if($cleaning==0){$cleaning_text='No';}else{$cleaning_text='Yes';}
		
		$message = "There are you summary from your quote<br>";
		$message2="==================================================================================<br>Type Removal: ".$service_text."<br><br>State From :".$state_from_text;
		$message2=$message2."<br>City From :".$city_from."<br> Suburb From : ".$suburb_from_text."<br> State To : ".$state_to_text."<br>City To :".$city_to."<br>Suburb To :".$suburb_to_text;
		$message2=$message2."<br>==========================================================================================<br>Customer Detail<br>";
		$message2=$message2."Name :".$firstname." ".$lastname."<br>";
		$message2=$message2."Phone :".$phone."<br>";
		$message2=$message2."Email :".$email."<br>";
		$message2=$message2."<br><br>";
		$message2=$message2."Best time to contact  :".$to_contact."<br>";
		$message2=$message2."Moving Date  :".$date_done."<br>";
		if($service==1){
		$message2=$message2."Bedrooms  :".$bedroom."<br>";
		$message2=$message2."Need help packing into boxes  :".$packing."<br>";
		$message2=$message2."Need a quote for cleaning  :".$cleaning_text."<br>";
		}
		if($service==2){
		$message2=$message2."Bedrooms  :".$bedroom."<br>";
		$message2=$message2."Need help packing into boxes  :".$packing."<br>";
		}
		$message2=$message2."Additional Information  :".$additional."<br>";
		$message2=$message2."==================================================================================================";
		$message =$message.$message2;
		//print_r($message);
//		print_r($firstname)
	//	if($firstname=='' && $state=='')
		//{
			
			$state=$state_supp;
			$service=$quote['type_removal'];
			$name=$firstname_supp;
			$suppliers = $this->Supplier_model->activesupplier($state,$service,$name);
			foreach($suppliers as $supplier)
			{
				$id=$supplier['id'];

				if($_POST['sup'.$id]==1)
				{
					
					$subject ="Removal Quote Request";
					
					$this->load->library('email');
					$config['mailtype'] = 'html';
					$this->email->initialize($config);
					$this->email->from('noreply@removalistquote.com.au','Removalist Quote');			
//					print_r($supplier['email']);
					$this->email->to($supplier['email']);	
					$this->email->bcc('removalistquote@propagate.com.au');		
					$this->email->subject($subject);
					$this->email->message($message);
					$this->email->send();	
					$data=array(
						'quote_id' => $quote_id,
						'supplier_id' => $supplier['id'],
						'date' => date('Y-m-d  H:i:s'),
						'status' => 0
					);
					$send=true;
					$this->Quote_model->addhistory($data);				
					
				}
				
			}
			if($send)
			{
				
				$num=$this->Quote_model->searchhistory($quote['id']);
				if($num>=3)
				{
					$dataquote=array(
					'status' => 1
					);
					$this->Quote_model->update($quote_id,$dataquote);
				}
				$this->session->set_flashdata('update','Quote has been sent');
			}
			else
			{
				$this->session->set_flashdata('update','Quote has not been  sent');
			}
	//	}	
		/*
		$data['id']=$quote_id;
		$quote= $this->Quote_model->identify($quote_id);			
		$data['quote'] = $quote;			
		$data['suppliers'] = $this->Supplier_model->all();
		$data['states'] = $this->Location_model->allstates();*/
		//$this->load->view('admin/quote/send',$data);
		redirect('admin/store/sendquotepage/'.$quote['id']);
		
	}
	function sendquoteautomate($quote_id='')
	{
	  // get the 3 active least work allocated suppliers based on count_monthly and date joined
	  $send_suppliers = $this->Supplier_model->get_automatic();
	  $this->load->library('email');
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
	  		
		$dates=date('Y-m-d');
		
			$quote= $this->Quote_model->identify($quote_id);			
		
			$service=$quote['type_removal'];
			$state_from = $quote['state_from'];
			$state_to = $quote['state_to'];
			$city_from = $quote['city_from'];
			$city_to = $quote['city_to'];
			$suburb_from = $quote['suburb_from'];
			$suburb_to = $quote['suburb_to'];
			
			$customer=$this->Customer_model->identify($quote['customer_id']);
			$firstname=$customer['firstname'];
			$lastname=$customer['lastname'];
			$phone=$customer['phone'];
			$email=$customer['email'];
			$to_contact = $quote['to_contact'];
			$date_done = $quote['date_done'];
			$bedroom = $quote['bedroom'];
			$packing=$quote['packing'];
			$cleaning=$quote['cleaning'];
			$additional=$quote['additional'];
			if($service==1){$service_text="Moving Home";}
			if($service==2){$service_text="Moving Into Storage";}
			if($service==3){$service_text="Moving 1-5 Items";}
			if($service==4){$service_text="Moving Office";}
			
			$state_from_text=$this->Location_model->identifystate($state_from);
			$state_to_text=$this->Location_model->identifystate($state_to);
			
			$suburb_from_text=$this->Location_model->identifysuburb($suburb_from);
			$suburb_to_text=$this->Location_model->identifysuburb($suburb_to);
			
			if($cleaning==0){$cleaning_text='No';}else{$cleaning_text='Yes';}
	
			$message3='';
			$message3 .='<p>Congratulations we have a quote for you to prepare. A user has provided us with the following information for you to follow up on.<br> 
					Quote ID :'.$quote_id.'</p>';
			$message3 .='<p><b> Customer Details </b><br>';
			$message3 .='First Name : '.$firstname.'<br>';
			$message3 .='Last Name : '.$lastname.'<br>';
			$message3 .='Email Address : '.$email.'<br>';
			$message3 .='Phone : '.$phone.'<br></p><br>';
			
			$message3 .='<p><b> Quote Details </b><br>';
			$message3 .='Type Removal : '.$service_text.'<br>';
			$message3 .='State From : '.$state_from_text.'<br>';
			$message3 .='City From : '.$city_from.'<br>';
			$message3 .='Suburb From : '.$suburb_from_text.'<br>';
			$message3 .='Moving Date : '.$date_done.'<br>';
			$message3 .='Best Time to Contact : '.$to_contact.'<br>';
			$message3 .='How many bedrooms : '.$bedroom.'<br>';
			$message3 .='Need help packing into boxes : '.$packing.'<br>';
			$message3 .='I also need a quote for cleaning my house/unit etc : '.$cleaning_text.'<br>' ;
			$message3 .='Additional Information : '.$additional.'<br></p>';
			
			$footer1='Kind regards and good luck on winning the work<br><br>';
			$image='<img src="'.base_url().'img/EmailRemovalQuotelogo.jpg"><br>';
        $footer2='<p ><span style="font-weight:bold; font-size:14px;">Removal Quotes </span>  <br>
                    <a href="http://www.removalquote.com.au" style="text-decoration:underline; color:red;">www.removalquote.com.au</a></p>
                        <p>
                        Call     1300 111 222     <br>
                        email    <a style="text-decoration:underline; color:red;" href="mailto:info@removalquote.com.au">info@removalquote.com.au</a></p>';
	  foreach($send_suppliers as $supplier)
	  {
		$subject ="Winning A Quote";
		$message =$message3.$footer1.$image.$footer2;
		$this->email->from('noreply@removalistquote.com.au','Removalist Quote');
		$this->email->subject($subject);
	    $this->email->message($message);
		$this->email->bcc('removalistquote@propagate.com.au');	
		$this->email->to($supplier['email']);
		 $this->email->send();	
		 //echo '<pre>'.print_r($s,true).'</pre>';
		 $data=array(
						'quote_id' => $quote_id,
						'supplier_id' => $supplier['id'],
						'date' => date('Y-m-d  H:i:s'),
					);
		// add history quote	
		$this->Quote_model->addhistory($data);
		
		
		$data2 = array(
		              'count_monthly' => $supplier['count_monthly'] + 1,
					   'total_count' => $supplier['total_count'] + 1
					   );
		// update the quote number of suppliers which is count_monthly and total_count
		// note: count_monthly is reset to 0 every month
		$this->Supplier_model->update($supplier['id'],$data2);
	  }
	  // update quote status to 1
	  $this->Quote_model->update($quote_id,array('status' => 1));
     /*
		$add=false;
		$send=false;
		$last_quote=$this->Quote_model->lasthistory();
		$last_supplier_id=$last_quote['id'];
		$max_supplier = $this->Supplier_model->lastrecord();
		if($max_supplier['id']==$last_supplier_id['id'])
		{
			$get_supp = $this->Supplier_model->get_supplier(0,3);
			
		}
		else
		{
			$get_supp=$this->Supplier_model->get_supplier_next($last_supplier_id);
			if(count($get_supp)==1)
			{
				$get_supp2 = $this->Supplier_model->get_supplier(0,2);
				$add=true;
			}
			if(count($get_supp)==2)
			{
				$get_supp2 = $this->Supplier_model->get_supplier(0,1);
				$add=true;
			}
			if(count($get_supp)==0)
			{
				$get_supp2 = $this->Supplier_model->get_supplier(0,3);
				$add=true;
			}

		}
		
		$subject ="Removal Quote Request";
		$message ="test";
		$this->load->library('email');
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('noreply@removalistquote','Removalist Quote');			
		$dates=date('Y-m-d');
		foreach($get_supp as $supp)
		{		
			
//					print_r($quote.$supp['id']);
			//if($this->Quote_model->check_supp($quote,$supp['id'],$dates))
			//{
				$this->email->to($supp['email']);	
				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->send();	
				$send=true;
				$data=array(
						'quote_id' => $quote,
						'supplier_id' => $supp['id'],
						'date' => date('Y-m-d  H:i:s'),
						'status' => 0
					);
					$send=true;
					$this->Quote_model->addhistory($data);		
		//	}
		}
		if($add==true)
		{
			foreach($get_supp2 as $supp)
			{		
				
	//					print_r($quote.$supp['id']);
				//if($this->Quote_model->check_supp($quote,$supp['id'],$dates))
			//	{
					$this->email->to($supp['email']);	
					$this->email->subject($subject);
					$this->email->message($message);
					$this->email->send();	
					$send=true;
					$data=array(
						'quote_id' => $quote,
						'supplier_id' => $supp['id'],
						'date' => date('Y-m-d  H:i:s'),
						'status' => 0
					);
					$send=true;
					$this->Quote_model->addhistory($data);		
				//}
			}
		}
		
		if($send==true)
		{
			$dataquote=array(
				'status' => 1
			);
			$this->Quote_model->update($quote,$dataquote);
			
			$this->session->set_flashdata('update','Quote has been sent');
		}
		
		else
		{
			$this->session->set_flashdata('update','Quote has not been  sent');
		}
		
		$data['id']=$quote;
		$quotes= $this->Quote_model->identify($quote);			
		$data['quote'] = $quotes;			
		$data['suppliers'] = $this->Supplier_model->all();
		$data['states'] = $this->Location_model->allstates();
		$this->load->view('admin/quote/send',$data);
	  */
	  		redirect('admin/store/sendquotepage/'.$quote['id']);
	}
	function newsletter($action='',$value='')
	{
		if ($action == "search") {
			$this->session->set_userdata('email',$_POST['email']);
			redirect('admin/store/newsletter');
		}
		
/*
	if ($action == "edit") {			
			
			$quote= $this->Quote_model->identify($value);
			
			$data['quote'] = $quote;			
			$data['history']=$this->Quote_model->listhistory($value);
			$data['customer'] = $this->Customer_model->identify($quote['customer_id']);
			$data['states'] = $this->Location_model->allstates();
			$data['states2'] = $this->Location_model->allstates();
			
			$this->load->view('admin/quote/edit',$data);
		}*/ 
		else {
			$this->load->view('admin/common/header');
			$email='';

			if($this->session->userdata('email'))
			{$email=$this->session->userdata('email');}

			$data['subscribers']=$this->Subscribe_model->get($email);
			$this->load->view('admin/newsletter/list',$data);
						
		}
		$this->load->view('admin/common/rightbar');
		$this->load->view('admin/common/footer');
	}

	function _my_supplier_email_test()
	{
		$state = 7;
		$service = 1;
		$name = 'Sima Vakin';
		$suppliers = $this->Supplier_model->activesupplier($state,$service,$name);
		if($suppliers){
			foreach($suppliers as $supp){
				$this->load->library('email');
				$this->email->to($supp['email']);
				//$this->email->bcc('kaushtuv@propagate.com.au');
				$this->email->from('noreply@removalistquote.com.au','Ignore this email. Propagate Test Email');
				$message = 'This is a test message from Propagate Dev Team. Ignore this email';
				
				
				$this->email->subject('System Maintenance Test Email');
				$this->email->message($message);
				if($this->email->send()){
					echo 'sent';	
				} 
				
			}
		}else{
			echo 'no supp';	
		}
		/* $this->load->library('email');
		$this->email->to('propagate_test@shellyremovals.com.au');
		//$this->email->bcc('kaushtuv@propagate.com.au');
		$this->email->from('noreply@removalistquote.com.au','Propagate Test Email');
		$message = 'This is a test message from Propagate Dev Team. If you receive this email please send a confirmation email back at kaushtuv@propagate.com.au';
		
		
		$this->email->subject('System Maintenance Test Email');
		$this->email->message($message);
		if($this->email->send()){
			echo 'sent';	
		} */
	}
	
}
?>