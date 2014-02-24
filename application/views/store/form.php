<script type="text/javascript" src="<?=base_url()?>js/popup.js"></script>
<link href="<?=base_url()?>css/popup.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=base_url()?>js/jquery-cycle-lite.js"></script>

<link type="text/css" href="<?=base_url()?>css/themes/base/ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="<?=base_url()?>js/ui/ui.core.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/ui/ui.datepicker.js"></script>

<script type="text/javascript">
jQuery(document).ready(function(){
	$j("#done-date").datepicker({ dateFormat: 'yy-mm-dd' });			
	<?
		if($this->session->flashdata('save'))
		{?>
			alert(<?=$this->session->flashdata('save')?>);
		
	<?	}
	?>
}); 
function check_connecting()
{
	if(jQuery('#cb_connecting').attr('checked'))
	{
		jQuery('#connecting').val(1);
	
		
	}
	else
	{
		jQuery('#connecting').val(0);
	
	}
}
function check_cleaning()
{
	if(jQuery('#cb_cleaning').attr('checked'))
	{
		jQuery('#cleaning').val(1);
	
		
	}
	else
	{
		jQuery('#cleaning').val(0);
	
	}
}
function check_terms()
{
	if(jQuery('#cb_terms').attr('checked'))
	{
		jQuery('#terms').val(1);
	
		
	}
	else
	{
		jQuery('#terms').val(0);
	
	}
}

function clear_text()
{
	jQuery('#additional').val('');
}
function check_quotes() {
	var valid = true;
	
	
	var email = jQuery('#email').val();
	if(email == "") 
	{ 
	   jQuery('#email').css('background','#fff3a0'); valid = false; 
	}
	else 
	{ 
	   if(!echeck(email))
		{
			jQuery('#email').css('background','#fff3a0'); 
	        valid = false;
		}
		else
		{
			jQuery('#email').css('background','#fff');
		}
	   
	}
	
	if(jQuery("#firstname").val()==''){jQuery("#firstname").css('background','#fff3a0'); valid = false; }
	else { jQuery("#firstname").css('background','#fff'); }
	if(jQuery("#lastname").val()==''){jQuery("#lastname").css('background','#fff3a0'); valid = false; }
	else { jQuery("#lastname").css('background','#fff'); }
	if(jQuery("#phone").val()==''){jQuery("#phone").css('background','#fff3a0'); valid = false; }
	else { jQuery("#phone").css('background','#fff'); }
	
	if(jQuery("#cb_terms").is(':checked')) { } else
	{ alert('Please read term and condition'); valid=false; return false; }
	
	if(valid)
	{
		document.formquotes.submit();
	}else
	{
		alert('Please check the highlighted fields to make sure you have entered the correct data.');
		return false;
	}
}
function echeck(str) {

                var at = "@"
                var dot = "."
                var lat = str.indexOf(at)
                var lstr = str.length
                var ldot = str.indexOf(dot)
                if (str.indexOf(at) == -1) {
                    alert("Please Enter A Valid E-mail")
                    return false
                }

                if (str.indexOf(at) == -1 || str.indexOf(at) == 0 || str.indexOf(at) == lstr) {
                    alert("Please Enter A Valid E-mail")
                    return false
                }

                if (str.indexOf(dot) == -1 || str.indexOf(dot) == 0 || str.indexOf(dot) == lstr) {
                    alert("Please Enter A Valid E-mail")
                    return false
                }

                if (str.indexOf(at, (lat + 1)) != -1) {
                    alert("Please Enter A Valid E-mail")
                    return false
                }

                if (str.substring(lat - 1, lat) == dot || str.substring(lat + 1, lat + 2) == dot) {
                    alert("Please Enter A Valid E-mail")
                    return false
                }

                if (str.indexOf(dot, (lat + 2)) == -1) {
                    alert("Please Enter A Valid E-mail")
                    return false
                }

                if (str.indexOf(" ") != -1) {
                    alert("Please Enter A Valid E-mail")
                    return false
                }


                return true;
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
	<div class="main-bg" style="height:987px; background:url(<?=base_url()?>img/form_bg.png)">	  
        
        <div class="content-top">
            <h1>STEP 3 <?=($removal_service != '' ? ' - '.$removal_service : '');?></h1>
            <p class="gray font_form" style="margin-top:5px;">
               	Please provide us with some basic information <br>
				on your removel requirments and we will find <bR>
				you three competiative removalist quotes.
            </p>
            <div style="margin-top:40px;"> 
            <form name="formquotes" id="formquotes" action="<?=base_url()?>store/savequotes" method="post">
            <table>            	                
                <tr height="45">
                	<td style="width:475px;">
                    	<span class="gray font_form" >First Name</span>
                    </td>
                    <td>
                    	<div style="background:url(<?=base_url()?>img/input_bg.png); width:392px; height:37px;">
                    	<input name="firstname" id="firstname" type="text" style="margin-top:5px !important; background:none; width:385px !important">
                    	</div>
                    </td>
                </tr>
                <tr height="45">
                	<td style="width:475px;">
                    	<span class="gray font_form" >Last Name</span>
                    </td>
                    <td>
                    	<div style="background:url(<?=base_url()?>img/input_bg.png); width:392px; height:37px;">
                    	<input name="lastname" id="lastname" type="text" style="margin-top:5px !important; background:none; width:385px !important">
                    	</div>
                    </td>
                </tr>
               <tr height="45">
                	<td style="width:475px;">
                    	<span class="gray font_form" >Phone</span>
                    </td>
                    <td>
                    	<div style="background:url(<?=base_url()?>img/input_bg.png); width:392px; height:37px;">
                    	<input id="phone" name="phone" type="text" style="margin-top:5px !important; background:none; width:385px !important">
                    	</div>
                    </td>
                </tr>
               <tr height="45">
                	<td style="width:475px;">
                    	<span class="gray font_form" >Email Address</span>
                    </td>
                    <td>
                    	<div style="background:url(<?=base_url()?>img/input_bg.png); width:392px; height:37px;">
                    	<input id="email" name="email" type="text" style="margin-top:5px !important; background:none; width:385px !important">
                    	</div>
                    </td>
                </tr>
                <tr height="45">
                	<td style="width:475px;">
                    	<span class="gray font_form" >Best time to contact</span>
                    </td>
                    <td>
                    	<select name="to_contact" id="to_contact">
                        	<option value='ASAP'>ASAP</option>
                            <option value='Morning'>Morning</option>
                            <option value='Afternoon'>Afternoon</option>
                            <option value='Evening'>Evening</option>
                            <option value='Anytime'>Anytime</option>
                        </select>
                    </td>
                </tr>
                <tr height="45">
                	<td style="width:475px;">
                    	<span class="gray font_form" >Moving date</span>
                    </td>
                    <td>
                    	<div style="background:url(<?=base_url()?>img/input_bg.png); width:392px; height:37px;">
                    	<input id="done-date" name="date_done" type="text" style="margin-top:5px !important; background:none; width:385px !important">
                    	</div>
                    </td>
                </tr>
                <? if($this->session->userdata('service')==1 || $this->session->userdata('service')==2  || $this->session->userdata('service')==3 ){ ?>
                <tr height="45">
                	<td style="width:475px;">
                    	<span class="gray font_form" >How many bedrooms do you have?</span>
                    </td>
                    <td>
                    	<select name="bedroom" id="bedroom">
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
                    </td>
                </tr>
                <? } ?>
                
                
                
                
                
                <tr height="45">
                	<td style="width:475px;">
                    	<span class="gray font_form" >Do you need a packing / unpacking service?</span>
                    </td>
                    <td>
                    	<select name="packing" id="packing">
 							<option value='Full packing service'>Full packing service</option>
                            <option value='Fragile items only (Avoid breakages)'>Fragile items only (Avoid breakages)</option>
                            <option value='No thanks'>No thanks</option>                            
                        </select>
                    </td>
                </tr>
                
                <tr height="45">
                	<td style="width:475px;">
                    	<span class="gray font_form" >Do you need a cleaning / carpet cleaning service?</span>
                    </td>
                    <td>
                    	<select name="need_cleaning" id="need_cleaning">
 							<option value='Yes'>Yes</option>                            
                            <option value='No Thanks'>No Thanks</option>                            
                        </select>
                    </td>
                </tr>
                
                <tr height="45">
                	<td style="width:475px;">
                    	<span class="gray font_form" >Additional Information</span>
                    </td>
                    <td>
                    	<? 
							$textarea='Important Info (i.e Level, Stairs, Lift, Parking, Packing, etc';
							
							if($this->session->userdata('service') =='1') { $textarea='Important Info (i.e Level, Stairs, Lift, Parking, Packing, etc';}
							if($this->session->userdata('service') =='2') { $textarea='Important Info (i.e Level, Stairs, Lift, Parking, Packing, etc';}
							if($this->session->userdata('service') =='3') { $textarea='Please provide list of items';}
							if($this->session->userdata('service') =='4') { $textarea='Important Info (i.e Level, Stairs, Lift, Parking, Packing, etc';}							
						
						?>
                        <div style="background:url(<?=base_url()?>img/txtarea_bg.png); width:392px; height:121px;">
                    	<textarea id="additional" name="additional" onclick="clear_text()" style="border:none; margin-top:5px !important;  margin-left:5px !important;background:none; width:385px !important; height:115px"><?=$textarea?></textarea>
                    	</div>
                    </td>
                </tr>
               
                <tr height="45">
                	<td style="width:475px;">
                    	<span class="gray font_form" >Tick to agree with our Terms & Conditions</span>
                        <?php if(0){ ?>
                        <br>
                        <a href="<?=base_url();?>terms_and_conditions" target="_blank">Read Terms & Conditions</a>
                        <?php }?>
                    </td>
                    <td>
                    	<input type="checkbox" id="cb_terms" name="cb_terms" onclick='check_terms()'>
                        <input type="hidden" name="terms" id="terms" value=0/>
                    </td>
                </tr>
                <tr height="45">
                	<td style="width:475px;">&nbsp;
                    	
                    </td>
                    <td align="right">
                    	<a onclick="check_quotes()"><img src="<?=base_url()?>img/get_me_3_quotes.png"></a>
                    </td>
                </tr>
                
            </table>
            </form>
            </div>
        </div>       
    </div>
</div>

