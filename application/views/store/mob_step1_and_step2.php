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
         <select class="form-control" id="state_from" name="state_from" data="required">
         	<option value="">Select Your Current State</option>
            <? foreach($states as $state){ ?>
            <option value="<?=$state['id']?>"><?=$state['name']?></option>
            <? } ?>
         </select>
   </div>
   <div class="form-group">
        <label for="suburb_from">Your Current Suburb</label>
    	<input type="text" class="form-control" id="search_suburb_from" onkeyup="search_suburb('from');">
        <input type="hidden" id="suburb_from" name="suburb_from" value="0" />
   </div>
   <div id="divsuburbfrom" class="form-group ajax-suburb-list-from"></div>
   <div class="form-group">
        <label for="state_from">Your Destination State</label>
        <select class="form-control" id="state_to" name="state_to" data="required">
        	<option value="">Select Your Destination State</option>
            <? foreach($states as $state){ ?>
            <option value="<?=$state['id']?>"><?=$state['name']?></option>
            <? } ?>
        </select>
   </div>
   <div class="form-group">
         <label for="suburb_to">Your Destination Suburb</label>
         <input type="text" class="form-control" id="search_suburb_to" onkeyup="search_suburb('to');">
         <input type="hidden" id="suburb_to" name="suburb_to" value="0" />
         <div id="divsuburbto"  class="form-group ajax-suburb-list-to"></div>
   </div>
   <div class="form-group text-right">
		<img class="btn-next-step" src="<?=base_url()?>frontend-assets/img/next-step.png" />
   </div>
</form>
<script>
$(function(){
	//current suburb list
	$(document).on('click','.suburb-from li',function(){
		$('#search_suburb_from').val($(this).text());
		$('#suburb_from').val($(this).attr('data-suburb-id'));
		$('#divsuburbfrom').hide();
	});
	
	$(document).on('click','.suburb-to li',function(){
		$('#search_suburb_to').val($(this).text());
		$('#suburb_to').val($(this).attr('data-suburb-id'));
		$('#divsuburbto').hide();
	});
});//ready

function search_suburb(type){
	var state = '';
	var keyword = '';
	var cond = 1;
	if(type == 'from'){
		$('#suburb_from').val(0);
		state = $('#state_from').val();
		keyword = $('#search_suburb_from').val();
		$('#divsuburbfrom').show();
	}else{
		$('#suburb_to').val(0);
		state = $('#state_to').val();
		keyword = $('#search_suburb_to').val();
		cond = 2;
		$('#divsuburbto').show();
	}
	if(state){
		$.ajax({
			url: '<?=base_url()?>store/search_suburb',
			type: 'POST',
			data: {state:state,cond:cond,keyword:keyword},
			dataType: "html",
			success: function(html) {
				if(cond == 1){
					$('#divsuburbfrom').html(html);
				}else{
					$('#divsuburbto').html(html);
				}
			}
		});
	}
}

$('.btn-next-step').on('click',function(){
	if(help.validate_form('mob-step1-form')){
		var msg = '';
		var valid = true;
		if($('#suburb_from').val() == 0){
			$('#search_suburb_from').addClass('error');
			msg += 'Invalid Current Suburb\n';
			valid = false;
		}
		if($('#suburb_to').val() == 0){
			$('#search_suburb_to').addClass('error');
			msg += 'Invalid Destination Suburb\n';
			valid = false;
		}
		if(valid){
			$('#mob-step1-form').submit();
		}else{
			alert(msg);	
		}
	}else{
		alert('Please check the highlighted fields to make sure you have entered the correct data.');	
	}
	
});
</script>