<?php

# Controller: Store

class Store extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Supplier_model');
		$this->load->model('Subscribe_model');	
		$this->load->model('Location_model');	
		$this->load->model('Customer_model');	
		$this->load->model('Quote_model');	
		$this->load->model('System_model');	
		$this->load->library('session');
		
		error_reporting(E_ALL);
	}
	
	function index() {
		$header['meta_data'] = array(
					'meta_keywords' => 'removalist quote,free removalist quotes,online removalist quotes',
					'meta_desc' => 'Removalist Quotes Australia can provide 3 competitive removal quotes to your inbox from professional removals companies',
					'meta_title' => 'Removalist Quote: Get Free Removalist Quotes'
				);
				
		$data['step']=1;
		$data['mob_data']['states']=$this->Location_model->allstates();
		$this->load->view('common/header',$header);
		$this->load->view('store/main',$data);
		
		$this->load->view('common/menu_bottom');
		$this->load->view('common/footer');
	}
	function saveservice($service)
	{
		//$service=$this->input->post('service',true);
		$this->session->set_userdata('service',$service);
		redirect('step2');
	}
	
	function saveservice2($service)
	{
		//$service=$this->input->post('service',true);
		$this->session->set_userdata('service',$service);
		redirect('step2');
	}
	
	function _get_service_name($service = '')
	{
		switch($service){
			case 1:
				return 'Moving House';
			break;
			
			case 2:
				return 'Moving To Storage';
			break;	
			
			case 3:
				return 'Moving 1 to 5 items';
			break;	
			
			case 4:
				return 'Moving Office';
			break;	
			
			default:
				return 'Moving House';
			break;	
			
		}
	}
	
	function step2()
	{
		$service_name = $this->_get_service_name($this->session->userdata('service'));
		$header['meta_data'] = array(
					'meta_keywords' => 'removal quote, removalist quotes, removal services',
					'meta_desc' => 'enter the address where you would want the removal services at',
					'meta_title' => $service_name.' Step 2 - Removalist Quotes'
				);
		$data['step']=2;		
		$data['removal_service'] = $service_name;
		$data['states']=$this->Location_model->allstates();
		$data['states2']=$this->Location_model->allstates();
		$this->load->view('common/header',$header);
		$this->load->view('store/step2',$data);
		
		$this->load->view('common/menu_bottom');
		$this->load->view('common/footer');
	}
	
	function getsuburb()
	{
		$state=$this->input->post('state',true);
		$cond=$this->input->post('cond',true);
		$suburbs=$this->Location_model->getsuburb($state);
		$option='<option value="-">There is no suburb yet in this state</option>';		
		if($cond==1)
		{
			$out='<select class="form-control" name="suburb_from" id="suburb_from"  data="required">';
			
		}
		if($cond==2)
		{
			$out='<select class="form-control" name="suburb_to" id="suburb_to"  data="required">';
			
		}
		if($suburbs)
		{
			$option='';
			foreach($suburbs as $suburb)
			{
				$option=$option.'<option value='.$suburb['id'].'>'.$suburb['name'].'</option>';
			}
				
		}									
		$out=$out.$option.'</select>';
		print $out;
	}
	
	function savelocation()
	{
		if($this->input->post('removal_service',true)){
			$service = $this->input->post('removal_service',true);
			$this->session->set_userdata('service',$service);
		}
		
		$state_from = $this->input->post('state_from',true);		
		$city_from = $this->input->post('city_from',true);
		$suburb_from = $this->input->post('suburb_from',true);
		
		$state_to = $this->input->post('state_to',true);
		$city_to = $this->input->post('city_to',true);
		$suburb_to = $this->input->post('suburb_to',true);
		
		$this->session->set_userdata('state_from',$state_from);
		$this->session->set_userdata('state_from',$state_from);
		$this->session->set_userdata('state_to',$state_to);
		
		$this->session->set_userdata('city_from',$city_from);
		$this->session->set_userdata('city_to',$city_to);
		
		$this->session->set_userdata('suburb_from',$suburb_from);
		$this->session->set_userdata('suburb_to',$suburb_to);
		
		redirect('step3');
	}
	
	function step3()
	{
		$service_name = $this->_get_service_name($this->session->userdata('service'));
		$header['meta_data'] = array(
					'meta_keywords' => 'removal requirements, removalist requirements, removal services requirements',
					'meta_desc' => 'enter your removal requirements',
					'meta_title' => $service_name.' Step 3 - Removalist Quotes'
				);
		$data['removal_service'] = $service_name;
		$this->load->view('common/header',$header);
		$this->load->view('store/step3',$data);
		$this->load->view('common/menu_bottom');
		$this->load->view('common/footer');
	}
	
	function savequotes()
	{
		$service = $this->session->userdata('service');
		
		$state_from = $this->session->userdata('state_from');
		$city_from = $this->session->userdata('city_from');
		$suburb_from = $this->session->userdata('suburb_from');
		
		$state_to = $this->session->userdata('state_to');
		$city_to = $this->session->userdata('city_to');
		$suburb_to = $this->session->userdata('suburb_to');
		
		if($city_from == ''){$city_from = 'None';}
		if($city_to == ''){$city_to = 'None';}
		$to_contact = $this->input->post('to_contact',true);
		$packing = $this->input->post('packing',true);
		$cleaning = 0;
		if($service != 4){
			$bedroom = $this->input->post('bedroom',true);			
		}else{
			$bedroom = '';			
		}
		
		if($service == 1){
			$connecting = $this->input->post('connecting',true);
		}else{
			$connecting = 0;
			$cleaning = 0;
		}
		$date_done = $this->input->post('date_done',true);
		
		$firstname = $this->input->post('firstname',true);
		$lastname = $this->input->post('lastname',true);
		$phone = $this->input->post('phone',true);
		$email = $this->input->post('email',true);
		$additional = $this->input->post('additional',true);
		$need_cleaning = $this->input->post('need_cleaning',true);
		
		
		
		if($this->Customer_model->recognize($email)){
			$customer=$this->Customer_model->recognize($email);
			$cust_id=$customer['id'];
		}else{
			$data=array(
				'firstname' => $firstname,
				'lastname' => $lastname,
				'phone' => $phone,
				'email'=> $email,
				'joined' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			);
			$cust_id=$this->Customer_model->add($data);
		}
		$dataservice=array(
			'customer_id' =>$cust_id,
			'email' => $email,
			'state_from' => $state_from,
			'city_from'=> $city_from,
			'suburb_from' => $suburb_from,
			'state_to' => $state_to,
			'city_to' => $city_to,
			'suburb_to' => $suburb_to,
			'type_removal' => $service,
			'to_contact' => $to_contact,
			'bedroom' => $bedroom,
			'packing' => $packing,									
			'cleaning' => $need_cleaning,
			'connecting' => $connecting,
			'date_done' => $date_done,
			'additional' => $additional,
			'date' => date('Y-m-d H:i:s'),
			'modified' => date('Y-m-d H:i:s')
		);
		if($service==1){$service_text="Moving Home";}
		if($service==2){$service_text="Moving Into Storage";}
		if($service==3){$service_text="Moving 1-5 Items";}
		if($service==4){$service_text="Moving Office";}
		
		$state_from_text = $this->Location_model->identifystate($state_from);
		
		$state_to_text = $this->Location_model->identifystate($state_to);
		
		$suburb_from_text = $this->Location_model->identifysuburb($suburb_from);
		$suburb_to_text = $this->Location_model->identifysuburb($suburb_to);
		
		if($cleaning == 0){$cleaning_text = 'No';}else{$cleaning_text = 'Yes';}
		$qid = $this->Quote_model->add($dataservice);
		if($qid)
		{
			$subject ="Removalist Quote";
			$message = "Thank you for submitting your request with Removalist Quotes.<br>Please find a summary of the information we have received from you to create your quote:<br><br>";
			$message2="<b>Customer Details</b><br><br>";
			$message2=$message2."Name :".$firstname." ".$lastname."<br>";
			$message2=$message2."Phone :".$phone."<br>";
			$message2=$message2."Email :".$email."<br><br>";
			$message2=$message2."<b>Job Details</b><br><br>Type Removal: ".$service_text."<br>State From :".$state_from_text;			
			$message2=$message2."<br>City From :".$city_from."<br> Suburb From : ".$suburb_from_text."<br> State To : ".$state_to_text."<br>City To :".$city_to."<br>Suburb To :".$suburb_to_text;
			
			$message2=$message2."<br>";
			$message2=$message2."Best time to contact  :".$to_contact."<br>";
			$message2=$message2."Moving Date  :".$date_done."<br>";			
			if($service!=4){
				$message2=$message2."Bedrooms  :".$bedroom."<br>";			
			}
			$message2=$message2."Do you need packing / unpacking service?  :".$packing."<br>";
			$message2=$message2."Do you need cleaning / carpet cleaning service?   :".$need_cleaning."<br>";
			$message2=$message2."Additional Information  :".$additional."<br>";
			$message =$message.$message2;
			
			$footer="<br><Br><img src='".base_url()."img/logo.png' style='width:13%;'><br>";
			$footer.="<b><span style='color:#86151D;'>Head Office</span></b><br>";
			$footer.="<span style='color:#939393;'>P.O.Box 1172 Clayton South</span><br>";
			$footer.="<span style='color:#939393;'>30 Bays Road</span><br>";
			$footer.="<span style='color:#939393;'>Clayton Melbourne</span><br>";
			$footer.="<span style='color:#939393;'>Vic 3182</span><br>";
			$footer.="<b><span style='color:#86151D;'>Tel:</span></b>	<span style='color:#939393;'>(03) 9882 4461 </span><br>";
			$footer.="<b><span style='color:#86151D;'>Fax:</span></b>	<span style='color:#939393;'>(03) 9882 4462 </span><br>";
			$footer.="<b><span style='color:#86151D;'>Email:</span></b>	<a style='color:#939393;' href='mailto:info@removalistquote.com.au'>info@removalistquote.com.au</a>";
			
			$message=$message.$footer;
			
			$this->load->library('email');
			$config['mailtype'] = 'html';
			 $this->email->initialize($config);
			$this->email->from('noreply@removalistquote.com.au','Removalist Quote');
			$this->email->to($email);
			$this->email->bcc('removalistquote@propagate.com.au');
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->send(); 
			
			
			//send email into backend
			// send email to admin
			$message='<p>New Quote has been request. The Quote ID is '.$qid.' <br><br> The detail can be seen on the admin page. Thank you<br>';
			
			//send sample email
			/* $email_data = array(
						'to' => $email,
						'from' => 'noreply@removalistquote.com.au',
						'from_text' => 'Removalist Quote',
						'subject' => $subject,
						'message' => $message
					);
			$this->_send_email_localhost($email_data); */
		   
	
			$this->load->library('email');
			
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			$emailo = $this->System_model->get_email('name','order');
			$email_o = json_decode($emailo['address'],true);
			if($email_o){
				$this->email->to($email_o[0]);
				if(count($email_o) > 1){
					 for($i=1;$i<count($email_o);$i++){
						$this->email->cc($email_o[$i]);
					 }
				}
			}else{
				$this->email->to('info@shellyremovals.com.au');
			}								
			$this->email->bcc('removalistquote@propagate.com.au');
			$this->email->from('membercare@removalistquote.com.au', 'Removal Quote');
			$this->email->subject('New Request Quote');
			$this->email->message($message);
			$this->email->send();
			$this->email->clear();	 
			
			
			
			$this->session->set_flashdata('save','Your Quotes has been saved');
			$this->session->sess_destroy();
			redirect('confirmation');			
		}else{
			$this->session->set_flashdata('save','Your Quotes has not been saved, please try again');
			redirect('step3');			
		}
		
	}
	
	function confirmation()
	{
		
		$service_name = $this->_get_service_name($this->session->userdata('service'));
		$header['meta_data'] = array(
					'meta_keywords' => 'removal quote, removalist quotes, removal services',
					'meta_desc' => 'removalist quote request successfully received',
					'meta_title' => $service_name.' - Removal Quote Successfully Received - Removalist Quotes'
				);
		$data['removal_service'] = $service_name;
		$this->load->view('common/header',$header);
		$this->load->view('store/confirmation',$data);
		
		$this->load->view('common/menu_bottom');
		$this->load->view('common/footer');
	}
	
	function suppliers()
	{
		$header['meta_data'] = array(
					'meta_keywords' => 'removal services, removal companies, join our removal network',
					'meta_desc' => 'join the removalist quote network and start winning',
					'meta_title' => 'Removal Service Suppliers - Removalist Quote',
				);
		$this->load->view('common/header',$header);
		$this->load->view('store/suppliers');		
		$this->load->view('common/menu_bottom');
		$this->load->view('common/footer');	
	}
	
	function suppliers_add()
	{
		$valid = true;
		$name = $this->input->post('name',true);
		$business = $this->input->post('business',true);
		$address = $this->input->post('address',true);
        $suburb = $this->input->post('suburb',true);     
        $state = $this->input->post('state',true);     
        $postcode = $this->input->post('postcode',true);     
		$phone = $this->input->post('phone',true);
		$email = $this->input->post('email',true);
		$website = $this->input->post('website',true);
		$description = $this->input->post('description',true);
		
		if($name && $business && $address && $phone && $email)
		{
			//validate email
			if (!preg_match("/^[A-Z0-9._%-]+@[A-Z0-9][A-Z0-9.-]{0,61}[A-Z0-9]\.[A-Z]{2,6}$/i",$email))
					{
						$valid = false;		
					}
		}
		else
		{
			$valid = false;	
		}
		
		if($valid)
		{
			//insert into database
			$data = array(
				'firstname' => $name,
				'business_name' => $business,
                'address1' => $address, 
                'suburb' => $suburb, 
                'state' => $state, 
                'postcode' => $postcode, 
				'phone' => $phone,
				'email' => $email,
				'website' => $website,
				'description' => $description,
				'added' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s')
			);
			
			$insert_supplier = $this->Supplier_model->add($data);
			
			//sent email
			
			//send email
        
       // $message_approve="<p>Congratulations your member account with <a href='http://www.removalquote.com.au' style='text-decoration:underline; color:red;'>www.removalistQuote.com.au</a> has been approved. You are well on the way to winning high quality removals jobs work in your area. We will send quotes to you via email to the address [MEMBER EMAIL] please make sure you add this email address to your safe sender list to ensure you don't miss out on any jobs.</p>Please feel free to contact us anytime if you have any questions.<br><br>";
        
//        $message_denied="<p>Im sorry to say that after review your company hasn't met the standards approval check and we are unable to register you with <a href='http://www.removalquote.com.au' style='text-decoration:underline; color:red;'>www.removalistQuote.com.au</a>. If you would like to find out more about how you can pass our standards approval check please contact us.</p><br><br>";
                  
                  
        $message='<p>Thanks for your interest with signing up to <a href="http://www.removalquote.com.au" style="text-decoration:underline; color:red;">www.removalQuote.com.au</a>. Your application has been sent successfully and is currently being reviewed. One of our staff will contact you shortly to walk you through the process of jointing the Removal Quote network.</p>
                  You are well on the way to winning new removal jobs in your area.<br><br>';
        
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
		$this->email->to($email);
		
        $this->email->from('membercare@removalistquote.com.au', 'Removal Quote');
        $this->email->subject('Member Application');
        $this->email->message($message.$footer1.$image.$footer2);
        $this->email->send();
		$this->email->clear();	
		//send email ends	
		
		// send email to admin
		$message='<p>New Member has been signed up,<br><br> The detail can be seen on the admin page. Thank you<br>';
        
       

        $this->load->library('email');
        
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
		$emailo = $this->System_model->get_email('name','trade');
		$email_o = json_decode($emailo['address'],true);
		if($email_o) 
		{
			$this->email->to($email_o[0]);
			if(count($email_o) > 1)
			{
			 for($i=1;$i<count($email_o);$i++) 
			 {
				$this->email->cc($email_o[$i]);
			 }
			}
		} 
		else 
		{
			$this->email->to('raquel@propagate.com.au');
		}		
		//$this->email->to($email);
		
        $this->email->from('membercare@removalistquote.com.au', 'Removal Quote');
        $this->email->subject('New Member Sign Up');
        $this->email->message($message);
        $this->email->send();
		$this->email->clear();	
		
		
		redirect('signupsuccess');		
		}
		else
		{
		  $this->session->set_userdata('supplier_add', $_POST);
		  redirect('suppliers');
		}
		
			
	}
	
	function signupsuccess()
	{
		$data['current_page'] = 2;
		$this->load->view('common/header',$data);
		$this->load->view('store/success');		
		$this->load->view('common/menu_bottom');
		$this->load->view('common/footer');	
	}
	
	function suppliermore()
	{
		$header['meta_data'] = array(
					'meta_keywords' => 'removalist companies, removal companies',
					'meta_desc' => 'Removalist suppliers frequently asked questions. If you are a removalist supplier find out how you can join Removalist Quote.',
					'meta_title' => 'Suppliers FAQ - Removalist Quote',
				);
				
		$this->load->view('common/header',$header);
		$this->load->view('store/suppliermore');		
		$this->load->view('common/menu_bottom');
		$this->load->view('common/footer');	
	}
	
	function aboutus()
	{
		$header['meta_data'] = array(
					'meta_keywords' => 'removal services, removal quotes, melbourne removals, sydney removals, brisbane removals',
					'meta_desc' => 'Removalist Quote offers the better way to find a removalist in Melbourne. Get 3 Removals Quotes for free from the professionals.',
					'meta_title' => 'About Us - Removalist Quote',
				);
				
		$this->load->view('common/header',$header);
		$this->load->view('store/aboutus');		
		$this->load->view('common/menu_bottom');
		$this->load->view('common/footer');	
	}
	
	function privacy_policy()
	{
		$header['meta_data'] = array(
					'meta_keywords' => 'removalist quote privacy policies',
					'meta_desc' => 'Removalist Quote privacy policy. Find out more about our privacy policy. Removalist Quote do not provide personal information to any organisation other than our partners.',
					'meta_title' => 'Privacy Policy - Removalist Quote',
				);
				
		$this->load->view('common/header',$header);
		$this->load->view('store/privacy_policy');		
		$this->load->view('common/menu_bottom');
		$this->load->view('common/footer');	
	}
	
	function terms_and_conditions()
	{
		$header['meta_data'] = array(
					'meta_keywords' => 'removalist quote terms and condtions',
					'meta_desc' => 'Removalist Quote terms and conditions. Find out more about our terms and conditions.',
					'meta_title' => 'Terms and Conditions - Removalist Quote',
				);
				
		$this->load->view('common/header',$header);
		$this->load->view('store/term_and_conditions');		
		$this->load->view('common/menu_bottom');
		$this->load->view('common/footer');	
	}
	
	function contactus()
	{
		$header['meta_data'] = array(
					'meta_keywords' => 'removalist services, removal quotes',
					'meta_desc' => 'Contact us for a free quote for home removals, storage removalist, furniture removals or any other queries',
					'meta_title' => 'Contact Us For Removal Services - Removalist Quote',
				);
				
		$data['current_page'] = 4;
		$this->load->view('common/header',$header);
		$this->load->view('store/contactus');		
		$this->load->view('common/menu_bottom');
		$this->load->view('common/footer');	
	}
	
	function sendcontact()
	{
		$name = $this->input->post('name',true);
		$email = $this->input->post('email',true);
		$phone = $this->input->post('telephone',true);
		$msg = $_POST['message'];
		$message = sprintf("
		
		Removalist Quote Contact Form
		
		First Name: %s
		Email: %s
		Phone: %s
		Message:
		%s
		
		Removalist Quote
				",$name,$email,$phone,$msg);
	
		$this->load->library('email');
		
		$this->email->from('noreply@removalistquote.com.au','Removalist Quote');
		$this->load->model('System_model');
		$emailc = $this->System_model->get_email('name','contact');
		$email_c = json_decode($emailc['address'],true);
		
		
		if ($email_c) 
		{
			$this->email->to($email_c[0]);
			if(count($email_c) > 1)
			{
			 for($i=1;$i<count($email_c);$i++) 
			 {
				$this->email->cc($email_c[$i]);
			 }
			}
		} else {
			$this->email->to('raquel@propagate.com.au');
		}
		
		
		
		$this->email->subject('Removalist Quote Contact Form');
		$this->email->message($message);
		if($this->email->send())
		{
		 $this->session->set_flashdata('send_msg','Thanks for contacting Removalist Quotes. One of our staff will contact you shortly');
		}
		else
		{
			 $this->session->set_flashdata('send_msg','There was error sending your contact message. Please try again!');
		}
		redirect('contactus');
	}
	
	function signup()
	{
		$email=$this->input->post('signup_email',true);
		$data['email'] = $email;
		$data['date']=date('Y-m-d H:i:s');
		if($this->Subscribe_model->add($data)){
		
		 $this->session->set_flashdata('sign_msg','Thanks for joining Removalist Quotes. ');
		}
		else
		{
			$this->session->set_flashdata('sign_msg','There was error processing your email. Please try again!');
		}
		redirect('store');
	}

	/* new seo pages */
	
	function why_choose_removalist_quote()
	{
		$header['meta_data'] = array(
					'meta_keywords' => 'removalist quotes services, free removalist quotes,free removal quotes',
					'meta_desc' => "Removalist Quote offers 3 free removalist quotes from Melbourne's professionals,  more reason to choose our removal services",
					'meta_title' => 'Why Choose Our Removal Services - Removalist Quote',
				);
				
		$this->load->view('common/header',$header);
		$this->load->view('secondary/why_choose_us');		
		$this->load->view('common/menu_bottom');
		$this->load->view('common/footer');	
	}
	
	function removalist_services()
	{
		$header['meta_data'] = array(
					'meta_keywords' => 'removalist services, removal services',
					'meta_desc' => 'Removalist Quote offers free quotes for services including home removals, moving to storage, office removals, furniture removals and carpet cleaning',
					'meta_title' => 'Removal Services - Removalist Quote',
				);
				
		$this->load->view('common/header',$header);
		$this->load->view('secondary/removal_services');		
		$this->load->view('common/menu_bottom');
		$this->load->view('common/footer');	
	}

	function moving_home()
	{
		$header['meta_data'] = array(
					'meta_keywords' => 'home moving services, home movers, home removalist',
					'meta_desc' => 'We offer 3 competing home removalist quotes for moving home in and around Melbourne',
					'meta_title' => 'Moving Home - Removalist Quote',
				);
				
		$this->load->view('common/header',$header);
		$this->load->view('secondary/moving_home');		
		$this->load->view('common/menu_bottom');
		$this->load->view('common/footer');	
	}
	
	function moving_office()
	{
		$header['meta_data'] = array(
					'meta_keywords' => 'office moving services, office movers, office removalist',
					'meta_desc' => 'Get 3 free removal quotes for your office move for a stree free and hassel free move',
					'meta_title' => 'Moving Office - Removalist Quote',
				);
				
		$this->load->view('common/header',$header);
		$this->load->view('secondary/moving_office');		
		$this->load->view('common/menu_bottom');
		$this->load->view('common/footer');	
	}
	
	function moving_to_storage()
	{
		$header['meta_data'] = array(
					'meta_keywords' => 'storage moving services, storage movers, storage removalist',
					'meta_desc' => 'Removalist Quote offers free quotes for your storage removals. Get competing quotes and pick the one that best fits your budget',
					'meta_title' => 'Moving To Storage - Removalist Quote',
				);
				
		$this->load->view('common/header',$header);
		$this->load->view('secondary/moving_to_storage');		
		$this->load->view('common/menu_bottom');
		$this->load->view('common/footer');	
	}

	function faq()
	{
		$header['meta_data'] = array(
					'meta_keywords' => 'removalist quote, removal quotes, removal quote prices',
					'meta_desc' => 'Frequently asked questions regarding removalist quote. Quote prices, quote obligations and steps involved in getting 3 free removal quotes',
					'meta_title' => 'Frequently Asked Questions - Removalist Quote',
				);
				
		$this->load->view('common/header',$header);
		$this->load->view('secondary/faq');		
		$this->load->view('common/menu_bottom');
		$this->load->view('common/footer');	
	}

	function _my_email_test()
	{
		$emailo = $this->System_model->get_email('name','order');
		$email_o = json_decode($emailo['address'],true);
		
		$this->load->library('email');
		if($email_o) 
		{
			$this->email->to($email_o[0]);
		} 
		$this->email->bcc('kaushtuv@propagate.com.au');
		$this->email->from('noreply@removalistquote.com.au','Propagate Test Email');
		$message = 'This is a test message from Propagate Dev Team. If you receive this email please send a confirmation email back at kaushtuv@propagate.com.au';
		
		
		$this->email->subject('System Maintenance Test Email');
		$this->email->message($message);
		if($this->email->send()){
			echo 'sent';	
		}
	}
	
	function _send_email_localhost($data)
	{
		$config = Array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'ssl://smtp.googlemail.com',
		  'smtp_port' => 465,
		  'smtp_user' => 'propagate.au@gmail.com', // change it to yours
		  'smtp_pass' => 'morem0n3y', // change it to yours
		  'mailtype' => 'html',
		  'charset' => 'iso-8859-1',
		  'wordwrap' => TRUE
		);
		
		if($data){
		foreach($data as $key=>$val){
				switch($key){
					case 'to':
						$to = $val;
					break;
					
					case 'from':
						$from = $val;
					break;
					
					case 'cc':
						$cc = $val;
					break;
										
					case 'bcc':
						$bcc = $val;
					break;
					
					case 'from_text':
						$from_text = $val;
					break;
					
					case 'subject':
						$subject = $val;
					break;
					
					case 'message':
						$message = $val;
					break;
					
					case 'attachment':
						$attachment = $val;
					break;	
				}
				
				
			}
		}
		

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('propagate.au@gmail.com',$from_text); // change it to yours
		$this->email->to($to);// change it to yours
		$this->email->subject($subject);
		$this->email->message($message);
		
		if($this->email->send()){
		  	echo 'Email sent.';
		}else{
			show_error($this->email->print_debugger());
		} 
	}
	
}
?>