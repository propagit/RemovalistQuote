<script type="text/javascript" src="<?=base_url()?>js/popup.js"></script>
<link href="<?=base_url()?>css/popup.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=base_url()?>js/jquery-cycle-lite.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.min.js"></script>

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

function next_step(service)
{
	window.location = '<?=base_url()?>store/saveservice/'+service;
}


</script>
<style>
.home_item:hover 
{
	cursor:pointer;
	
}
.home_item:hover .home_item_bg
{
	cursor:pointer;
	color:#fcb040;
}
</style>
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
        	<div style="float:left">
            	<h1>STEP 1</h1>
            </div>
            <div class="dark_gray main-p" style="float:left; padding:0; color:#939393; margin-top:-3px; margin-left:25px;">
            	<h2>What service are you after?</h2>
            </div>
            <div style="clear:both; height:12px;">&nbsp;</div>
            <div style="color:#636363; font-size:14px">Get competitive removalist quotes sent directly to your email inbox in 3 simple steps</div>
            <div style="clear:both; height:20px;">&nbsp;</div>
            <div>
            	<div id="home_item1" class="home_item" style="float:left; margin-right:5px;" onclick="next_step(1);">
                	<img alt="" src="<?=base_url()?>img/home1.png">
                    <div id="item_over1" class="home_item_bg">
                    	Moving Home
                    	<div style="display:none; color:#fff; text-align:left; font-size:14px; font-weight:400; margin-left:10px; width:190px; line-height:normal" id="item_text1">
                        	Moving across town or interstate we can find you quality removalist companies at competitive prices
                     </div>
                    </div>
                </div>
                <div id="home_item2" class="home_item" style="float:left; margin-right:5px;" onclick="next_step(2);">
                	<img alt="" src="<?=base_url()?>img/home2.png">
                    <div id="item_over2" class="home_item_bg">
                    	Moving To Storage
                    	<div style="display:none; color:#fff; text-align:left; font-size:14px; font-weight:400; margin-left:10px; width:190px; line-height:normal" id="item_text2">
                        	Looking to move your goods into long term or short term storage, we can find you cost effective solutions in your local area
                     </div>
                    </div>
                </div>
                <div id="home_item3" class="home_item" style="float:left; margin-right:5px;" onclick="next_step(3);">
                	<img alt="" src="<?=base_url()?>img/home3.png">
                    <div id="item_over3" class="home_item_bg">
                    	Moving 1 to 5 items
                        <div style="display:none; color:#fff; text-align:left; font-size:14px; font-weight:400; margin-left:10px; width:190px; line-height:normal" id="item_text3">
                        	Are you looking at moving a small number of items?<br/><br/>
                            We can source and find movers that specialise in smaller moves that offer great service and competitive prices
                        </div>
                    </div>
                </div>
                <div id="home_item4" class="home_item" style="float:left;" onclick="next_step(4);">
                	<img alt="" src="<?=base_url()?>img/home4.png" >
                    <div id="item_over4" class="home_item_bg">
                    	Moving Office
                    	<div style="display:none; color:#fff; text-align:left; font-size:14px; font-weight:400; margin-left:10px; width:190px; line-height:normal" id="item_text4">
                        	Needing to relocate your office locally or interstate we can find you quality providers at the best possible rates
                     	</div>
                    </div>
                </div>
            </div>
        </div>
        <script>
			jQuery("#home_item1").mouseenter(function() {
				
				jQuery('#item_over1').animate({
					'marginTop': '-190px',
					'height': '190px'
				  }, 300, function() {
				  });
				  jQuery("#item_text1").slideDown(300);
			}).mouseleave(function(){
				jQuery('#item_over1').animate({
					'marginTop': '-45px',
					'height': '45px'
				  }, 300, function() {
				  });
				  jQuery("#item_text1").slideUp(300);
			  });
			  
			  
			jQuery("#home_item2").mouseover(function() {
				jQuery('#item_over2').animate({
					'marginTop': '-190px',
					'height': '190px'
				  }, 300, function() {
				  });
				  jQuery("#item_text2").slideDown(300);
			}).mouseleave(function(){
				jQuery('#item_over2').animate({
					'marginTop': '-45px',
					'height': '45px'
				  }, 300, function() {
				  });
				  jQuery("#item_text2").slideUp(300);
			});
			jQuery("#home_item3").mouseover(function() {
				jQuery('#item_over3').animate({
					'marginTop': '-190px',
					'height': '190px'
				  }, 300, function() {
				  });
				  jQuery("#item_text3").slideDown(300);
			}).mouseleave(function(){
				jQuery('#item_over3').animate({
					'marginTop': '-45px',
					'height': '45px'
				  }, 300, function() {
					  
				  });
				  jQuery("#item_text3").slideUp(300);
			});
			jQuery("#home_item4").mouseover(function() {
				jQuery('#item_over4').animate({
					'marginTop': '-190px',
					'height': '190px'
				  }, 300, function() {
				  });
				  jQuery("#item_text4").slideDown(300);
			}).mouseleave(function(){
				jQuery('#item_over4').animate({
					'marginTop': '-45px',
					'height': '45px'
				  }, 300, function() {
				  });
				  jQuery("#item_text4").slideUp(300);
			});
		</script>
        
        <? } 
		else if($step==2){ ?>
        <div class="content-top">
            <h1>STEP 2</h1>
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

