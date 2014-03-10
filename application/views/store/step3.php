<div class="col-md-12 page-bg"> 
	<h1>Final Step <?=($removal_service != '' ? ' - '.$removal_service : '');?></h1>
    <p>
    	Please provide us with some basic information
		on your removel requirments and we will find
		you three competiative removalist quotes.
    </p>
    
    <form role="form" class="custom-form" id="formquotes" action="<?=base_url()?>store/savequotes" method="post">
    	<div class="form-group custom-group">
            <label class="col-sm-5 custom-label remove-gutters  remove-gutters" for="first_name">First Name</label>
            <div class="col-sm-7 remove-gutters  remove-gutters">
            <input type="text" class="form-control" id="first_name" name="firstname" data="required">
            </div>
  		</div>
        <div class="form-group custom-group">
            <label class="col-sm-5 custom-label remove-gutters  remove-gutters" for="last_name">Last Name</label>
			<div class="col-sm-7 remove-gutters  remove-gutters">
            <input type="text" class="form-control" id="last_name" name="lastname" data="required">
            </div>
  		</div>
        <div class="form-group custom-group">
            <label class="col-sm-5 custom-label remove-gutters  remove-gutters" for="phone">Phone</label>
			<div class="col-sm-7 remove-gutters  remove-gutters">
           	 <input type="text" class="form-control" id="phone" name="phone" data="required">
            </div>
  		</div>
        <div class="form-group custom-group">
            <label class="col-sm-5 custom-label remove-gutters  remove-gutters" for="email">Email Address</label>
			<div class="col-sm-7 remove-gutters  remove-gutters">
            	<input type="text" class="form-control" id="email" name="email" data="email">
            </div>
  		</div>
        <div class="form-group custom-group">
            <label class="col-sm-5 custom-label remove-gutters  remove-gutters" for="to_contact">Best time to contact</label>
			<div class="col-sm-7 remove-gutters  remove-gutters">
            <select class="form-control" id="to_contact" name="to_contact">
            	<option value='ASAP'>ASAP</option>
                <option value='Morning'>Morning</option>
                <option value='Afternoon'>Afternoon</option>
                <option value='Evening'>Evening</option>
                <option value='Anytime'>Anytime</option>
        	</select>
            </div>
  		</div>
    	<div class="form-group custom-group">
            <label class="col-sm-5 custom-label remove-gutters  remove-gutters" for="date_done">Moving date</label>
			<div class="col-sm-7 remove-gutters  remove-gutters">
            <input type="text" class="form-control" id="date_done" name="date_done" data="required">
            </div>
  		</div>
        <? if($this->session->userdata('service')==1 || $this->session->userdata('service')==2  || $this->session->userdata('service')==3 ){ ?>
        <div class="form-group custom-group">
            <label class="col-sm-5 custom-label remove-gutters  remove-gutters" for="bedroom">How many bedrooms do you have?</label>
			<div class="col-sm-7 remove-gutters  remove-gutters">
            <select class="form-control" id="bedroom" name="bedroom">
            	<option value='0'>No bedrooms</option>
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
                <option value='5'>5</option>
                <option value='6'>6</option>
                <option value='7'>7</option>
                <option value='8'>8</option>
                <option value='9'>9</option>
                <option value='10+'>10+</option>
        	</select>
            </div>
  		</div>
        <?php } ?>
        <div class="form-group custom-group">
            <label class="col-sm-5 custom-label remove-gutters  remove-gutters" for="packing">Do you need a packing / unpacking service?</label>
			<div class="col-sm-7 remove-gutters  remove-gutters">
            <select class="form-control" id="packing" name="packing">
            	<option value='Full packing service'>Full packing service</option>
                <option value='Fragile items only (Avoid breakages)'>Fragile items only (Avoid breakages)</option>
                <option value='No thanks'>No thanks</option> 
        	</select>
            </div>
  		</div>
        <div class="form-group custom-group">
            <label class="col-sm-5 custom-label remove-gutters  remove-gutters" for="need_cleaning">Do you need a cleaning / carpet cleaning service?</label>
			<div class="col-sm-7 remove-gutters  remove-gutters">
            <select class="form-control" id="need_cleaning" name="need_cleaning">
            	<option value='Yes'>Yes</option>                            
                <option value='No Thanks'>No Thanks</option>  
        	</select>
            </div>
  		</div>
        <div class="form-group custom-group">
        	<? 
				$textarea='Important Info (i.e Level, Stairs, Lift, Parking, Packing, etc';
				
				if($this->session->userdata('service') =='1') { $textarea='Important Info (i.e Level, Stairs, Lift, Parking, Packing, etc';}
				if($this->session->userdata('service') =='2') { $textarea='Important Info (i.e Level, Stairs, Lift, Parking, Packing, etc';}
				if($this->session->userdata('service') =='3') { $textarea='Please provide list of items';}
				if($this->session->userdata('service') =='4') { $textarea='Important Info (i.e Level, Stairs, Lift, Parking, Packing, etc';}							
			
			?>
            <label class="col-sm-5 custom-label remove-gutters  remove-gutters" for="additional">Additional Information</label>
			<div class="col-sm-7 remove-gutters  remove-gutters">
            <textarea class="form-control" id="additional" name="additional" onclick="clear_text()" onfocus="clear_text();"><?=$textarea;?></textarea>
            </div>
  		</div>
        <div class="form-group custom-group">
            <label class="col-sm-5 custom-label remove-gutters  remove-gutters" for="terms">Tick to agree with our Terms & Conditions &nbsp;&nbsp;</label>
			<div class="col-sm-7 remove-gutters  remove-gutters">
            <input type="checkbox" id="terms" name="terms" data="checked" data-msg="terms-error">
            </div>
            <span id="terms-error" class="text-danger hide">You need to agree to our Terms and Conditons before you can proceed</span>
  		</div>
    	<div class="form-group custom-group text-right">
			<img class="btn-next-step" src="<?=base_url()?>img/get_me_3_quotes.png" />
   		</div>
    </form>
</div>
<script>
$(document).ready(function(){
	$("#date_done").datepicker({ dateFormat: 'yy-mm-dd' });	
	
	$('.btn-next-step').on('click',function(){
		if(help.validate_form('formquotes')){
			$('#formquotes').submit();
		}else{
			alert('Please check the highlighted fields to make sure you have entered the correct data.');	
		}
	});	
}); 

function clear_text(){
	$('#additional').val('');
}
</script>