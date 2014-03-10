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
             <select class="form-control" id="state_from" name="state_from" onchange="getsuburbfrom();" data="required">
                <option value="">Select Your Current State</option>
                <? foreach($states as $state){ ?>
                <option value="<?=$state['id']?>"><?=$state['name']?></option>
                <? } ?>
             </select>
             </div>
       </div>
       <div class="form-group custom-group hide">
            <label class="col-sm-5 custom-label remove-gutters" for="current_city">Your Current City</label>
			<div class="col-sm-7 remove-gutters">
            <input type="text" class="form-control" id="city_from" name="city_from">
            </div>
       </div>
       <div class="form-group custom-group">
             <label class="col-sm-5 custom-label remove-gutters" for="suburb_from">Your Current Suburb</label>
			<div class="col-sm-7 remove-gutters">
             <div id="divsuburbfrom">
                 <select class="form-control" name="suburb_from" id="suburb_from"  data="required">
                    <option value="">Select Suburb</option>                    
                 </select>
             </div>
             </div>
       </div>
       <div class="form-group custom-group">
            <label class="col-sm-5 custom-label remove-gutters" for="state_from">Your Destination State</label>
			<div class="col-sm-7 remove-gutters">
            <select class="form-control" id="state_to" name="state_to" onchange="getsuburbto();"  data="required">
                <option value="">Select Your Destination State</option>
                <? foreach($states as $state){ ?>
                <option value="<?=$state['id']?>"><?=$state['name']?></option>
                <? } ?>
            </select>
            </div>
       </div>
       <div class="form-group custom-group hide">
            <label class="col-sm-5 custom-label remove-gutters" for="current_city">Your Destination City</label>
			<div class="col-sm-7 remove-gutters">
            <input type="text" class="form-control" id="city_to" >
            </div>
       </div>
       <div class="form-group custom-group">
             <label class="col-sm-5 custom-label remove-gutters" for="suburb_from">Your Destination Suburb</label>
			 <div class="col-sm-7 remove-gutters">
             <div id="divsuburbto">
                 <select class="form-control" name="suburb_to" id="suburb_to"  data="required">
                    <option value="">Select Suburb</option>                    
                 </select>
             </div>
             </div>
       </div>
       <div class="form-group custom-group text-right">
            <img class="btn-next-step" src="<?=base_url()?>frontend-assets/img/next-step.png" />
       </div>
    </form>
</div>
<script>
$('.btn-next-step').on('click',function(){
	if(help.validate_form('mob-step1-form')){
		$('#formlocation').submit();
	}else{
		alert('Please check the highlighted fields to make sure you have entered the correct data.');	
	}
	
});
</script>
