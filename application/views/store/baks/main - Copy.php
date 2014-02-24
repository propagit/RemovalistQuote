<script type="text/javascript" src="<?=base_url()?>js/popup.js"></script>
<link href="<?=base_url()?>css/popup.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=base_url()?>js/jquery-cycle-lite.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
				
	//CLOSING POPUP	
	//Click out event!
	jQuery("#background-popup").click(function(){
		disablePopup();
	});
	//Press Escape event!
	jQuery(document).keypress(function(e){
		if(e.keyCode==27 && popupStatus==1){
			disablePopup();
		}
	});
	getsuburbfrom();
	getsuburbto();

}); 
function getsuburbfrom() {
	var state = jQuery("#state_from").val();
	var cond='1';
	//jQuery('#divsuburbfrom').html('Loading..');
	jQuery.ajax({
	url: '<?=base_url()?>store/getsuburb',
	type: 'POST',
	data: {state:state,cond:cond},
	dataType: "html",
	success: function(html) {
		
		jQuery('#divsuburbfrom').html(html);
	}
	})
	
}
function getsuburbto() {
	
	var state = jQuery("#state_to").val();
	var cond='2';
//	jQuery('#divsuburbto').html('Loading..');
	jQuery.ajax({
	url: '<?=base_url()?>store/getsuburb',
	type: 'POST',
	data: {state:state,cond:cond},
	dataType: "html",
	success: function(html) {
		
		jQuery('#divsuburbto').html(html);
	}
	})
	
}
function checklocation()
{
	var valid=true;
	/*
	if(jQuery("#city_from").val()==''){jQuery("#city_from").css('background','#fff3a0'); valid = false; }
	else { jQuery("#city_from").css('background','#fff'); }
	if(jQuery("#city_to").val()==''){jQuery("#city_to").css('background','#fff3a0'); valid = false; }
	else { jQuery("#city_to").css('background','#fff'); }
	*/
	if(jQuery("#suburb_from").val()=='-'){jQuery("#suburb_from").css('background','#fff3a0'); valid = false; }
	else { jQuery("#suburb_from").css('background','#fff'); }
	if(jQuery("#suburb_to").val()=='-'){jQuery("#suburb_to").css('background','#fff3a0'); valid = false; }
	else { jQuery("#suburb_to").css('background','#fff'); }
	
	if(valid)
	{
		document.formlocation.submit();
	}else
	{
		alert('Please check the highlighted fields to make sure you have entered the correct data.');
		return false;
	}
}
function saveservice()
{
	document.formservice.submit();
}
</script>
<div id="popup-box">
	
    <div id="popup-shopping">
    	<div class="close"><a href="javascript:disablePopup()"><img src="<?=base_url()?>img/CloseButton-Up.png" alt="Close" /></a></div>
        <div style="clear:both"></div>
        <div style="clear:both;padding-top:78px">
           <div id="content-pop" style="width:400px;margin:0 auto"></div>
        </div>
        <br/>
    </div>
</div>
<div id="background-popup"></div>

<div style="clear:both"></div>

<div id="home_top_container">
	<? if($step==1){?>
    <div class="main-bg main-page-bg">	  
    <? } else {?>
    <div class="main-bg about-us-bg">	  
    <? }?>
        <? if($step==1){?>
        <div class="content-top">
            <img src="<?=base_url()?>img/step_1.png">
            <p class="dark_gray font_form" style="margin-top:5px;">
                Getting 3 competitive quotes couldn't<br />
                be easier. In just 3 simple steps you <br />
                will have 3 quotes from Australia's <br />
                leading companies spechalising in <br />
                removal services.
            </p>
        </div>
        <div style="float:right">
        	<p class="dark_gray main-p" >
            	What service are you after?
                <div class="pdr" style="margin-top:15px; text-align:right;">
                <form name="formservice" id="formservice" method="post" action="<?=base_url()?>store/saveservice">
                <select name="service" id="service">
                	<option value=1>Moving Home</option>
                    <option value=2>Moving Into Storage</option>
                    <option value=3>Moving 1-5 Items</option>
                    <option value=4>Moving Office</option>
                </select>
                </form>
                </div>
                <div class="pdr" style="margin-top:30px;">
                <a onclick="saveservice()"><img src="<?=base_url()?>img/next-step.png" style="float:right;"/></a>
                </div>
            </p>
        </div>
        <? } 
		else if($step==2){ ?>
        <div class="content-top">
            <img src="<?=base_url()?>img/step_2.png">
            <p class="dark_gray font_form" style="margin-top:5px;">
                Please provide us with the postcode <br />
				of your pick up address so we can find<br />
				the most suitable match for your location<br />
            </p>
        </div>
        <form name="formlocation" id="formlocation" action="<?=base_url()?>store/savelocation" method="post">
        <div style="clear:both"></div>
        <div style="float:none; padding-left:45px;">
        	<div style="float:left; margin-top:15px;">
            	<span class="gray font_form">State*</span>
                <div style="margin-top:15px; text-align:right;">
                <select id="state_from" name="state_from" onchange="getsuburbfrom()">
                	<? foreach($states as $state){ ?>
                    <option value="<?=$state['id']?>" <? if($state['id']==7){ echo 'selected=selected';}?>><?=$state['name']?></option>
                    <? } ?>
                </select>
                </div>
                <div style="margin-top:15px;">
                <span class="gray font_form">City / Town</span>
                </div>
                <div style="background:url(<?=base_url()?>img/input_text.png); width:244px; height:43px;">
                    <input type="text" id="city_from" name="city_from" style="margin-top:5px !important; background:none; width:240px !important">
                    </div>
                <div style="margin-top:15px;">                    
                <span class="gray font_form">Suburb*</span>
                </div>
                <div style="margin-top:15px; text-align:right;" name="divsuburbfrom" id="divsuburbfrom">
                <select name="suburb_from" id="suburb_from">
                	<option value="-">Select Suburb</option>                    
                </select>
                </div>
            </div>
        	<div style="float:left; margin-top:15px; margin-left:20px;width:55px;">
            	<span class="gray font_form">To</span>
            </div>
            <div style="float:left; margin-top:15px;">
            	<span class="gray font_form">State*</span>
                <div style="margin-top:15px; text-align:right;">
                <select id="state_to" name="state_to" onchange="getsuburbto()">
                	<? foreach($states2 as $state){ ?>
                    <option value="<?=$state['id']?>" <? if($state['id']==7){ echo 'selected=selected';}?>><?=$state['name']?></option>
                    <? } ?>
                </select>
                </div>
                <div style="margin-top:15px;">
                <span class="gray font_form">City / Town</span>
                </div>
                <div style="background:url(<?=base_url()?>img/input_text.png); width:244px; height:43px;">
                    <input type="text" id="city_to" name="city_to" style="margin-top:5px !important; background:none; width:240px !important">
                    </div>
                <div style="margin-top:15px;">                    
                <span class="gray font_form">Suburb*</span>
                </div>
                <div style="margin-top:15px; text-align:right;" name="divsuburbto" id="divsuburbto">
                <select name="suburb_to" id="suburb_to">
                	<option value="-">Select Suburb</option>                    
                </select>
                </div>
            </div>
        </div>
        <div style="clear:both"></div>
        <div style="float:right; margin-right:53px; margin-top:15px;">
        <a onclick="checklocation()" ><img src="<?=base_url()?>img/next-step.png" style="float:right;"/></a>
        </div>
        </form>
        <!--
        <div style="float:right">
        	<p class="dark_gray main-p" >
            	What is your post code?
                <div class="pdr" style="margin-top:15px; text-align:right;float:right;">
                	<div style="background:url(<?=base_url()?>img/input_text.png); width:244px; height:43px;">
                    <input type="text" style="margin-top:5px !important; background:none; width:240px !important">
                    </div>
                </div>
                <div class="pdr" style="margin-top:70px;">
                <a href="<?=base_url()?>store/step3"><img src="<?=base_url()?>img/next-step.png" style="float:right;"/></a>
                </div>
            </p>
        </div>
        -->
        
        <? }?>
    </div>
</div>

