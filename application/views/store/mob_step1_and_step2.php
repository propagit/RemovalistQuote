<?php
	//echo '<pre>'.print_r($states,true).'</pre>';
?>
<h1 class="inline">STEP 1</h1>
<form role="form" class="custom-form" id="mob-step1-form" action="<?=base_url()?>store/savelocation" method="post">
    <div class="form-group">
        <label for="removal_service">Select Removal Service</label>
        <select class="form-control" id="removal_service" name="removal_service">
            <option value="1">Moving House</option>
            <option value="2">Moving To Storage</option>
            <option value="3">Moving 1 to 5 Items</option>
            <option value="4">Moving Office</option>
        </select>
   </div>
   <div class="form-group">
        <label for="state_from">Your Current State</label>
         <select class="form-control" id="state_from" name="state_from" onchange="getsuburbfrom();" data="required">
         	<option value="">Select Your Current State</option>
            <? foreach($states as $state){ ?>
            <option value="<?=$state['id']?>"><?=$state['name']?></option>
            <? } ?>
         </select>
   </div>
   <?php if(0) {?>
   <div class="form-group hide">
        <label for="current_city">Your Current City</label>
    	<input type="text" class="form-control" id="city_from" name="city_from">
   </div>
   <?php } ?>
   <div class="form-group">
         <label for="suburb_from">Your Current Suburb</label>
         <div id="divsuburbfrom">
             <select class="form-control" name="suburb_from" id="suburb_from"  data="required">
                <option value="">Select Suburb</option>                    
             </select>
         </div>
   </div>
   <div class="form-group">
        <label for="state_from">Your Destination State</label>
        <select class="form-control" id="state_to" name="state_to" onchange="getsuburbto();"  data="required">
        	<option value="">Select Your Destination State</option>
            <? foreach($states as $state){ ?>
            <option value="<?=$state['id']?>"><?=$state['name']?></option>
            <? } ?>
        </select>
   </div>
   <?php if(0) {?>
   <div class="form-group hide">
        <label for="current_city">Your Destination City</label>
    	<input type="text" class="form-control" id="city_to" >
   </div>
   <?php } ?>
   <div class="form-group">
         <label for="suburb_from">Your Destination Suburb</label>
         <div id="divsuburbto">
             <select class="form-control" name="suburb_to" id="suburb_to"  data="required">
                <option value="">Select Suburb</option>                    
             </select>
         </div>
   </div>
   <div class="form-group text-right">
		<img class="btn-next-step" src="<?=base_url()?>frontend-assets/img/next-step.png" />
   </div>
</form>
<script>
$('.btn-next-step').on('click',function(){
	if(help.validate_form('mob-step1-form')){
		$('#mob-step1-form').submit();
	}else{
		alert('Please check the highlighted fields to make sure you have entered the correct data.');	
	}
	
});
</script>