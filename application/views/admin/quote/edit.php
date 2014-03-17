<link type="text/css" href="<?=base_url()?>css/themes/base/ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="<?=base_url()?>js/ui/ui.core.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/ui/ui.datepicker.js"></script>
<script>
jQuery(document).ready(function(){
				
	jQuery("#done-date").datepicker({ dateFormat: 'yy-mm-dd' });			
	getsuburbfrom();
	getsuburbto();
	<? if($quote['cleaning']==1){?>
	jQuery("#cb_cleaning").attr("checked", "checked");
	<? } ?>
	
	<? if($quote['connecting']==1){?>
	jQuery("#cb_connecting").attr("checked", "checked");
	<? } ?>

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
function check_service()
{
	var service=jQuery("#type_removal").val();
	if(service==1)
	{ jQuery("#service2").show();
		jQuery("#service1").show();
	}
	if(service==2)
	{ jQuery("#service2").show();
		jQuery("#service1").hide();
	}
	if(service==3)
	{ jQuery("#service2").hide();
		jQuery("#service1").hide();
	}
	if(service==4)
	{ jQuery("#service2").hide();
		jQuery("#service1").hide();
	}
}
function getsuburbfrom() {
	var state = jQuery("#state_from").val();
	var suburb=<?=$quote['suburb_from']?>;
	var cond='1';
	//jQuery('#divsuburbfrom').html('Loading..');
	jQuery.ajax({
	url: '<?=base_url()?>admin/store/getsuburb',
	type: 'POST',
	data: {state:state,cond:cond,suburb:suburb},
	dataType: "html",
	success: function(html) {
		
		jQuery('#divsuburbfrom').html(html);
	}
	})
	
}
function getsuburbto() {
	
	var state = jQuery("#state_to").val();
	var cond='2';
	var suburb=<?=$quote['suburb_to']?>;
//	jQuery('#divsuburbto').html('Loading..');
	jQuery.ajax({
	url: '<?=base_url()?>admin/store/getsuburb',
	type: 'POST',
	data: {state:state,cond:cond,suburb:suburb},
	dataType: "html",
	success: function(html) {
		
		jQuery('#divsuburbto').html(html);
	}
	})
	
}

function backtolist() {
	window.location = '<?=base_url()?>admin/store/quote';
}

function deletequote() {
	if (confirm('Do you want delete this quote?')) {
		window.location = '<?=base_url()?>admin/store/deletequote/<?=$quote['id']?>';
	}
}
</script>
<style>
dl.three dt {
    width: 150px;
}
textarea{
	width:200px;
	heigght:100px;
}
</style>
    	<div class="left">
        	<h1>Store Management</h1>
            <div class="bar">

            	<div class="text">Manage Quote &raquo; Quote Details</div>
            	<div class="cr"></div>
            </div>
            <div class="box">
            	<input type="button" class="button rounded" value="Back to Quote Lists" onClick="backtolist()" />
            	<?php if($this->session->flashdata('update')) { ?>
                <span class="green"> &nbsp; Quote has been updated successfully!</span>
                <?php } ?>
                    

            </div>
            <hr />
            
            <form method="post" action="<?=base_url()?>admin/store/updatequote" autocomplete="off">
            <input type="hidden" name="cust_id" value="<?=$customer['id']?>" />
            <input type="hidden" name="quote_id" value="<?=$quote['id']?>" />
            <div class="box bgw">
            	<h3>Customer Details</h3>
                <dl class="three"><dt>First name</dt><dd><input type="text" class="textfield rounded" value="<?=$customer['firstname']?>" name="firstname" /></dd></dl>
                <dl class="three"><dt>Last name</dt><dd><input type="text" class="textfield rounded" value="<?=$customer['lastname']?>" name="lastname" /></dd></dl>
                <dl class="three"><dt>Email Address</dt><dd><input type="text" class="textfield rounded" value="<?=$customer['email']?>" name="email" /></dd></dl>
                <dl class="three"><dt>Phone</dt><dd><input type="text" class="textfield rounded" value="<?=$customer['phone']?>" name="storename" /></dd></dl>            
                <dl></dl>
            </div>
            <hr />
            <div class="box">
                <h3>Quote Details</h3>
               
                <dl class="three"><dt>Type Removal</dt><dd>
                <select name="type_removal" id="type_removal" onchange="check_service()">
                	<option value="1" <? if($quote['type_removal']==1) {echo "selected=selected";}?> >Moving Home</option>
                    <option value="2" <? if($quote['type_removal']==2) {echo "selected=selected";}?> >Moving Into Storage</option>
                    <option value="3" <? if($quote['type_removal']==3) {echo "selected=selected";}?> >Moving 1-5 Items</option>
                    <option value="4" <? if($quote['type_removal']==4) {echo "selected=selected";}?> >Moving Office</option>
                </select></dd></dl>
                <dl>&nbsp;</dl>
                <dl class="three"><dt>State From</dt><dd>
                <select id="state_from" name="state_from" onchange="getsuburbfrom()">
                	<? foreach($states as $state){ ?>
                    <option value="<?=$state['id']?>" <? if($state['id']==$quote['state_from']){ echo 'selected=selected';}?>><?=$state['name']?></option>
                    <? } ?>
                </select>
                </dd></dl>
				<dl class="three"><dt>City From</dt><dd><input type="text" class="textfield rounded" value="<?=$quote['city_from']?>" name="city_from" /></dd></dl>
                <dl class="three"><dt>Suburb From</dt><dd>
                <div id="divsuburbfrom">
                <select name="suburb_from" id="suburb_from">
                	<option value="-">Select Suburb</option>                    
                </select>
                </div>
                </dd></dl>
                <dl>&nbsp;</dl>
                <dl class="three"><dt>State To</dt><dd>
                <select id="state_to" name="state_to" onchange="getsuburbto()">
                	<? foreach($states2 as $state){ ?>
                    <option value="<?=$state['id']?>" <? if($state['id']==7){ echo 'selected=selected';}?>><?=$state['name']?></option>
                    <? } ?>
                </select></dd></dl>
				<dl class="three"><dt>City To</dt><dd><input type="text" class="textfield rounded" value="<?=$quote['city_to']?>" name="city_to" /></dd></dl>
                <dl class="three"><dt>Suburb To</dt><dd> 
                <div id="divsuburbto">
                <select name="suburb_to" id="suburb_to">
                	<option value="-">Select Suburb</option>                    
                </select>
                </div>
                </dd></dl>
                <dl>&nbsp;</dl>
                <dl class="three"><dt>Moving Date  </dt>
                <dd>
                <input id="done-date" name="date_done" type="text" value="<?=$quote['date_done']?>"></dd></dl>
                
                <dl class="three"><dt>Best time to contact</dt><dd> 
                <select name="to_contact" id="to_contact">
                    <option value='ASAP' <? if($quote['to_contact']=='ASAP'){echo 'Selected=selected';} ?>>ASAP</option>
                    <option value='Morning' <? if($quote['to_contact']=='Morning'){echo 'Selected=selected';} ?>>Morning</option>
                    <option value='Afternoon' <? if($quote['to_contact']=='Afternoon'){echo 'Selected=selected';} ?>>Afternoon</option>
                    <option value='Evening' <? if($quote['to_contact']=='Evening'){echo 'Selected=selected';} ?>>Evening</option>
                    <option value='Anytime' <? if($quote['to_contact']=='Anytime'){echo 'Selected=selected';} ?>>Anytime</option>
                </select>
                </dd></dl>
                <? if($quote['type_removal']==1 || $quote['type_removal']==2 ){?>
                <div id="service2">
                <dl class="three"><dt>How many bedrooms</dt><dd> 
                		<select name="bedroom" id="bedroom">
 							<option value='1' <? if($quote['bedroom']=='1'){echo 'Selected=selected';} ?>>1</option>
                            <option value='2' <? if($quote['bedroom']=='2'){echo 'Selected=selected';} ?>>2</option>
                            <option value='3' <? if($quote['bedroom']=='3'){echo 'Selected=selected';} ?>>3</option>
                            <option value='4' <? if($quote['bedroom']=='4'){echo 'Selected=selected';} ?>>4</option>
                            <option value='5' <? if($quote['bedroom']=='5'){echo 'Selected=selected';} ?>>5</option>
                            <option value='6' <? if($quote['bedroom']=='6'){echo 'Selected=selected';} ?>>6</option>
                            <option value='7' <? if($quote['bedroom']=='7'){echo 'Selected=selected';} ?>>7</option>
                            <option value='8' <? if($quote['bedroom']=='8'){echo 'Selected=selected';} ?>>8</option>
                            <option value='9' <? if($quote['bedroom']=='9'){echo 'Selected=selected';} ?>>9</option>
                            <option value='10+'<? if($quote['bedroom']=='10+'){echo 'Selected=selected';} ?>>10+</option>
                        </select></dd></dl>
				
                <dl class="three"><dt>Need help packing into boxes?</dt><dd> 
                <select name="packing" id="packing">
 					<option value='Full packing service' <? if($quote['packing']=='Full packing service'){echo 'Selected=selected';} ?>>Full packing service</option>
                    <option value='Fragile items only (Avoid breakages)' <? if($quote['packing']=='Fragile items only (Avoid breakages)'){echo 'Selected=selected';} ?>>Fragile items only (Avoid breakages)</option>
                   <option value='No Thanks' <? if($quote['packing']=='No thanks'){echo 'Selected=selected';} ?>>No Thanks</option>                            
                </select></dd></dl>
				</div>
	          
				<? }?>
                <? if ($quote['type_removal']==1){?>
                <div id="service1">
                	<!--
                    <dl class="three"><dd> <p><input type="checkbox" id="cb_connecting" name="cb_connecting" onclick="check_connecting()">  Need help connecting your Gas, Electricity, Water, Phone, Internet? (FREE complimentary service)</p>  <input type="hidden" name="connecting" id="connecting" value=<?=$quote['connecting']?>></dd></dl>
                    -->
                    <dl class="three"><dd> <p><input type="checkbox" id="cb_cleaning" name="cb_cleaning" onclick="check_cleaning()">  I also need a quote for cleaning my house/unit etc?</p>
                        <input type="hidden" name="cleaning" id="cleaning" value=<?=$quote['cleaning']?>/></dd></dl>	
                </div>
                <? } ?>
                
				<dl class="three"><dt>Additional Information  </dt><dd> <textarea id="additional" name="additional"><?=$quote['additional']?></textarea></dd></dl>
                
                <dl></dl>
            </div>
            <hr />
            <div class="box bgw">
            	<div class="row-title">
                     <div class="cust-fname">Supplier Name</div>
                    <div class="cust-fname" style="border-left: 1px dotted #63A2D4;width:140px;">Supplier Email</div>
                    
                    <div class="cat-func"  style="width:100px;">Date</div>
                   
                </div>
                <div class="sub-cat">
                	<? foreach ($history as $ht) {
                    
						$supplier=$this->Supplier_model->identify($ht['supplier_id']); 
						
					?>	
                    <div class="row-item">
                    <div class="cust-fname" ><? if(isset($supplier['business_name'])) { echo $supplier['business_name'];} else { echo 'Unknown';}?></div>
                    <div class="cust-fname" style="border-left: 1px dotted #63A2D4;width:110px;"><? if(isset($supplier['email'])) { echo $supplier['email'];} else {echo 'Unknown'; }?></div>
                    
                    <div class="cat-func" style="width:100px;"><?=$ht['date']?></div>

					
                    </div>
                    <? } ?>
            	</div>
            </div>
            <hr />
            
            <div class="box">
            	
                <dl class="three"><dt>&nbsp;</dt>
                	<dd><input type="submit" class="button rounded" value="Update" /></dd>
                
                	<dd><input type="button" class="button rounded" value="Delete" onClick="deletequote()" /></dd>
                	                    
                </dl>
                <dl></dl>
            </div>
            </form>
            
        </div>
        
