<div class="col-md-12 page-bg"> 
    <h1 class="inline">STEP 2 <?=($removal_service != '' ? ' - '.$removal_service : '');?></h1>
    <p>
        Please provide us with the postcode <br />
        of your pick up address so we can find<br />
        the most suitable removal company for your location<br />
    </p>
    <form role="form" class="custom-form" id="formlocation" action="<?=base_url()?>store/savelocation" method="post">
       <div class="form-group custom-group">
            <label class="col-sm-5 custom-label remove-gutters" for="state_from">Your Current State</label>
			<div class="col-sm-7 remove-gutters">
             <select class="form-control" id="state_from" name="state_from" data="required">
                <option value="">Select Your Current State</option>
                <? foreach($states as $state){ ?>
                <option value="<?=$state['id']?>"><?=$state['name']?></option>
                <? } ?>
             </select>
             </div>
       </div>

       <div class="form-group custom-group">
             <label class="col-sm-5 custom-label remove-gutters" for="suburb_from">Your Current Suburb</label>
			<div class="col-sm-7 remove-gutters">
                <input type="text" class="form-control" id="search_suburb_from" onkeyup="search_suburb('from');">
                <input type="hidden" id="suburb_from" name="suburb_from" value="0" />
            </div>
       </div>
       <div class="form-group custom-group frm-group-suburb-from-wrap ajax-from-suburb-list-desktop">
       		<label class="col-sm-5 custom-label remove-gutters" for="suburb_from">&nbsp;</label>
			<div class="col-sm-7 remove-gutters">
                <div id="divsuburbfrom" class="ajax-suburb-list-from"></div>
             </div>
       </div>
       <div class="form-group custom-group">
            <label class="col-sm-5 custom-label remove-gutters" for="state_from">Your Destination State</label>
			<div class="col-sm-7 remove-gutters">
            <select class="form-control" id="state_to" name="state_to"  data="required">
                <option value="">Select Your Destination State</option>
                <? foreach($states as $state){ ?>
                <option value="<?=$state['id']?>"><?=$state['name']?></option>
                <? } ?>
            </select>
            </div>
       </div>
       
       <div class="form-group custom-group">
             <label class="col-sm-5 custom-label remove-gutters" for="suburb_to">Your Destination Suburb</label>
			 <div class="col-sm-7 remove-gutters">
                <input type="text" class="form-control" id="search_suburb_to" onkeyup="search_suburb('to');">
                <input type="hidden" id="suburb_to" name="suburb_to" value="0" />
            </div>
       </div>
       <div class="form-group custom-group ajax-suburb-list-desktop">
       		<label class="col-sm-5 custom-label remove-gutters" for="suburb_to">&nbsp;</label>
			<div class="col-sm-7 remove-gutters">
                <div id="divsuburbto" class="ajax-suburb-list-to"></div>
             </div>
       </div>
       <div class="form-group custom-group text-right">
            <img class="btn-next-step" src="<?=base_url()?>frontend-assets/img/next-step.png" />
       </div>
    </form>
</div>
<script>

$(function(){
	//current suburb list
	$(document).on('click','.suburb-from li',function(){
		$('#search_suburb_from').val($(this).text());
		$('#suburb_from').val($(this).attr('data-suburb-id'));
		$('#divsuburbfrom').hide();
		$('.frm-group-suburb-from-wrap').hide();
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
		state = $('#state_from').val();
		keyword = $('#search_suburb_from').val();
		$('#divsuburbfrom').show();
	}else{
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
					$('.frm-group-suburb-from-wrap').show();
				}else{
					$('#divsuburbto').html(html);
				}
			}
		});
	}
}

$('.btn-next-step').on('click',function(){
	if(help.validate_form('mob-step1-form')){
		$('#formlocation').submit();
	}else{
		alert('Please check the highlighted fields to make sure you have entered the correct data.');	
	}
	
});
</script>
