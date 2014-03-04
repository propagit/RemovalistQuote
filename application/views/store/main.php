<div class="col-md-12 page-bg desktop-hidden"> 
	<?php
		$this->load->view('store/mob_step1_and_step2',$mob_data);
	?>
</div>
 <?php if(1){ ?>
<div class="col-md-12 page-bg home-boxes-wrap desktop-visible">
	<h1>STEP 1</h1>
	<h2>What removal service are you after?</h2>
    <p class="f14">Get competitive removalist quotes sent directly to your email inbox in 3 simple steps</p>
    <div class="col-md-3 home-boxes">
    	<img alt="moving-home.png" title="Moving home" src="<?=base_url()?>img/home1.png">
    </div>
    <div class="col-md-3 home-boxes">
    	<img alt="moving-to-storage.png" title="Moving to storage" src="<?=base_url()?>img/home2.png">
    </div>
    <div class="col-md-3 home-boxes">
    	<img alt="moving-1-to-5.png" title="Moving 1 to 5 items" src="<?=base_url()?>img/home3.png">
    </div>
    <div class="col-md-3 home-boxes">
    	<img alt="moving-office.png" title="Moving office" src="<?=base_url()?>img/home4.png" >
    </div>

</div>  
<div class="col-md-12 page-bg">
	<h1>Removalist Quote</h1>
    <p>
    <br />
    <b>Removalist Quote</b> provides <b>free removal quotes</b> for a full range of residential or commercial removals. Get competing removal quotes based on your needs and budget from several of our dedicated and independent partners. All of our partners are <b>professional removalist based in Melbourne</b> with year of experience in removalist services to ensure a smooth and easy relocation for you.<br /><br />
    
What sets <b>Removalsit Quote</b> apart from all other companies is that we provide 3 free removal quotes for all of our removal services. Once a customer request a quote online, their request are analyzed and sent to the company that best suits them based on attributes such as relocating location, removalist services required etc.<br /><br />

<b>Removalist Quote</b> is simple and 100% free to use for all without any hidden costs.

    </p>
</div>  
<?php } ?>
<script>
function getsuburbfrom() {
	var state = $("#state_from").val();
	var cond='1';
	$.ajax({
		url: '<?=base_url()?>store/getsuburb',
		type: 'POST',
		data: {state:state,cond:cond},
		dataType: "html",
		success: function(html) {
			$('#divsuburbfrom').html(html);
		}
	})
	
}

function getsuburbto() {
	var state = $("#state_to").val();
	var cond='2';
	$.ajax({
		url: '<?=base_url()?>store/getsuburb',
		type: 'POST',
		data: {state:state,cond:cond},
		dataType: "html",
		success: function(html) {
			$('#divsuburbto').html(html);
		}
	})	
}
</script>




<?php if(0) { ?>
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
    <div class="main-bg main-page-bg">	  

        <div class="content-top">
        	<div style="float:left">
            	<h1>STEP 1</h1>
            </div>
            <div class="dark_gray main-p" style="float:left; padding:0; color:#939393; margin-top:-3px; margin-left:25px;">
            	<h2>What removal service are you after?</h2>
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
                        	Are you looking at moving a small number of items?<br/>
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

    </div>
</div>

<div class="content-wrap">
	<div class="content-wrap-top"></div>
    <div class="content-wrap-mid">
    	<div class="content-top">
        	<h1>Removalist Quote</h1>
        	<p>
            <br />
            <b>Removalist Quote</b> provides <b>free removal quotes</b> for a full range of residential or commercial removals. Get competing removal quotes based on your needs and budget from several of our dedicated and independent partners. All of our partners are <b>professional removalist based in Melbourne</b> with year of experience in removalist services to ensure a smooth and easy relocation for you.<br /><br />
            
What sets <b>Removalsit Quote</b> apart from all other companies is that we provide 3 free removal quotes for all of our removal services. Once a customer request a quote online, their request are analyzed and sent to the company that best suits them based on attributes such as relocating location, removalist services required etc.<br /><br />

<b>Removalist Quote</b> is simple and 100% free to use for all without any hidden costs.

            </p>
        </div>
    
    </div>
    <div class="content-wrap-bottom"></div>
</div>
<?php } ?>