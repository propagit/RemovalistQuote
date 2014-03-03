<div class="col-md-12 page-bg"> 
	<h1>STEP 3 <?=($removal_service != '' ? ' - '.$removal_service : '');?></h1>
    <p>
    	Please provide us with some basic information
		on your removel requirments and we will find
		you three competiative removalist quotes.
    </p>
    
    <form role="form" class="custom-form" id="formquotes" action="<?=base_url()?>store/savequotes" method="post">
    	<div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="firstname" data="required">
  		</div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="lastname" data="required">
  		</div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" data="required">
  		</div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="text" class="form-control" id="email" name="email" data="required">
  		</div>
        <div class="form-group">
            <label for="to_contact">Best time to contact</label>
            <select class="form-control" id="to_contact" name="to_contact">
            	<option value='ASAP'>ASAP</option>
                <option value='Morning'>Morning</option>
                <option value='Afternoon'>Afternoon</option>
                <option value='Evening'>Evening</option>
                <option value='Anytime'>Anytime</option>
        	</select>
  		</div>
    	<div class="form-group">
            <label for="date_done">Moving date</label>
            <input type="text" class="form-control" id="date_done" name="date_done" data="required">
  		</div>
        <? if($this->session->userdata('service')==1 || $this->session->userdata('service')==2  || $this->session->userdata('service')==3 ){ ?>
        <div class="form-group">
            <label for="bedroom">How many bedrooms do you have?</label>
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
        <?php } ?>
        <div class="form-group">
            <label for="packing">Do you need a packing / unpacking service?</label>
            <select class="form-control" id="packing" name="packing">
            	<option value='Full packing service'>Full packing service</option>
                <option value='Fragile items only (Avoid breakages)'>Fragile items only (Avoid breakages)</option>
                <option value='No thanks'>No thanks</option> 
        	</select>
  		</div>
        <div class="form-group">
            <label for="to_contact">Do you need a cleaning / carpet cleaning service?</label>
            <select class="form-control" id="need_cleaning" name="need_cleaning">
            	<option value='Yes'>Yes</option>                            
                <option value='No Thanks'>No Thanks</option>  
        	</select>
  		</div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" data="required">
  		</div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" data="required">
  		</div>
    
    </form>
</div>