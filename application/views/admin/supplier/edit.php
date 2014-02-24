<script>
jQuery(document).ready(function(){
				
	if(jQuery('#service1').val()==1)
	{jQuery('#cb_service1').attr('checked',true);}
	if(jQuery('#service2').val()==1)
	{jQuery('#cb_service2').attr('checked',true);}
	if(jQuery('#service3').val()==1)
	{jQuery('#cb_service3').attr('checked',true);}
	if(jQuery('#service4').val()==1)
	{jQuery('#cb_service4').attr('checked',true);}
	
	if(jQuery('#state1').val()==1)
	{jQuery('#cb_state1').attr('checked',true);}
	if(jQuery('#state2').val()==1)
	{jQuery('#cb_state2').attr('checked',true);}
	if(jQuery('#state3').val()==1)
	{jQuery('#cb_state3').attr('checked',true);}
	if(jQuery('#state4').val()==1)
	{jQuery('#cb_state4').attr('checked',true);}
	if(jQuery('#state5').val()==1)
	{jQuery('#cb_state5').attr('checked',true);}
	if(jQuery('#state6').val()==1)
	{jQuery('#cb_state6').attr('checked',true);}
	if(jQuery('#state7').val()==1)
	{jQuery('#cb_state7').attr('checked',true);}
	if(jQuery('#state8').val()==1)
	{jQuery('#cb_state8').attr('checked',true);}


}); 

function check_cbs(id)
{
	if(jQuery('#cb_service'+id).attr('checked'))
	{
		jQuery('#service'+id).val(1);
	
		
	}
	else
	{
		jQuery('#service'+id).val(0);
	
	}
	//alert(jQuery('#service'+id).val());
}
function check_cbst(id)
{
		if(jQuery('#cb_state'+id).attr('checked'))
	{
		jQuery('#state'+id).val(1);
	
		
	}
	else
	{
		jQuery('#state'+id).val(0);
	
	}
	//alert(jQuery('#state'+id).val());
}
function backtolist() {
	window.location = '<?=base_url()?>admin/store/supplier';
}
function approved() {
	if (confirm('You want to approve this user as trading account?')) {
		var notify = $j('#notify:checked').val();
		var send = 0;
		if (notify) { send = 1; }
        //alert(send);
		$j.ajax({ 
			url: '<?=base_url()?>admin/store/approvesupplier',
			type: 'POST',
			data: ({id:'<?=$supplier['id']?>',send:send}),
			dataType: "html",
			success: function(html) {
				window.location = '<?=base_url()?>admin/store/supplier';
			}
		})	
	}
}
function pending() {
	if (confirm('You want to put this user to be pending?')) {
		$j.ajax({ 
			url: '<?=base_url()?>admin/store/pendingsupplier',
			type: 'POST',
			data: ({id:'<?=$supplier['id']?>'}),
			dataType: "html",
			success: function(html) {
				window.location = '<?=base_url()?>admin/store/supplier';
			}
		})	
	}
}
function deleteuser() {
	if (confirm('This action will delete this supplier account, including all past orders related to this supplier. Please note this action cannot be undone. If you don\'t wish to delete all past orders relating to this supplier yet still want to deactivate the account click the pending button instead.')) {
		window.location = '<?=base_url()?>admin/store/deletesupplier/<?=$supplier['id']?>';
	}
}
</script>
    	<div class="left">
        	<h1>Store Management</h1>
            <div class="bar">

            	<div class="text">Manage Supplier &raquo; Supplier Details</div>
            	<div class="cr"></div>
            </div>
            <div class="box">
            	<input type="button" class="button rounded" value="Back to Supplier List" onClick="backtolist()" />
            	<?php if($this->session->flashdata('update')) { ?>
                <span class="green"> &nbsp; Supplier has been updated successfully!</span>
                <?php } ?>
                    

            </div>
            <hr />
            
            <form method="post" action="<?=base_url()?>admin/store/updatesupplier" autocomplete="off">
            <input type="hidden" name="id" value="<?=$supplier['id']?>" />
            <div class="box bgw">
            	<h3>Personal Details</h3>
                <dl class="three"><dt>Name</dt><dd><input type="text" class="textfield rounded" value="<?=$supplier['firstname']?>" name="firstname" /></dd></dl>
                <dl class="three"><dt>Email Address</dt><dd><input type="text" class="textfield rounded" value="<?=$supplier['email']?>" name="email" /></dd></dl>
                <dl class="three"><dt>Business Name</dt><dd><input type="text" class="textfield rounded" value="<?=$supplier['business_name']?>" name="business_name" /></dd></dl>
                <dl class="three"><dt>Website</dt><dd><input type="text" class="textfield rounded" value="<?=$supplier['website']?>" name="website" /></dd></dl>
                <dl class="three"><dt>Description</dt><dd><textarea class="textfield rounded" name="description" style="width:300px; height:75px;" ><?=$supplier['description']?></textarea></dd></dl>
                <dl></dl>
            </div>
            <hr />
            <div class="box">
                <h3>Contact Details</h3>
               
                
                <dl class="three"><dt>Address </dt><dd><input type="text" class="textfield rounded" value="<?=$supplier['address1']?>" name="address" /></dd></dl>
				
                <dl class="three"><dt>Suburb</dt><dd><input type="text" class="textfield rounded" value="<?=$supplier['suburb']?>" name="suburb" /></dd></dl>
                <dl class="three"><dt>State</dt><dd><input type="text" class="textfield rounded" value="<?=$supplier['state']?>" name="suburb" /></dd></dl>
              
                </dd></dl>
                
                <dl class="three"><dt>Postcode</dt><dd><input type="text" class="textfield rounded" value="<?=$supplier['postcode']?>" name="postcode" /></dd></dl>
                <dl class="three"><dt>Phone</dt><dd><input type="text" class="textfield rounded" value="<?=$supplier['phone']?>" name="phone" /></dd></dl>
               
               <dl class="three"><dt>Status</dt><dd>
                	<?php if($supplier['actived']) { ?>
                	<span class="green">Approved</span>
                	<?php } else { ?><span>Pending</span>
                	<?php } ?>
                </dd></dl>
                <dl></dl>
            </div>
            <hr />
            <div class="box bgw">
            	<h3>Removal Details</h3>                            
                <dl class="three"><dt>Type of Service</dt>
                <dd>
                	<div style="float:left; width:150px;">
                    <input type="checkbox" name="cb_service1" id="cb_service1" onclick="check_cbs(1)" /> Moving Home 
                    <? $value=$this->Supplier_model->check_service($supplier['id'],1);?>
                    <input type="hidden" name="service1" id="service1" value=<?=$value?> >
                    </div>
                    <div style="float:left; width:150px;">
                    <input type="checkbox" name="cb_service2" id="cb_service2" onclick="check_cbs(2)"/> Moving Into Storage
                    <? $value=$this->Supplier_model->check_service($supplier['id'],2);?>
                    <input type="hidden" name="service2" id="service2" value=<?=$value?>>
                    </div>
                    <br />
                    <div style="float:left; width:150px;">
                    <input type="checkbox" name="cb_service3" id="cb_service3" onclick="check_cbs(3)"/> Moving 1-5 Items 
                    <? $value=$this->Supplier_model->check_service($supplier['id'],3);?>
                    <input type="hidden" name="service3" id="service3" value=<?=$value?> />
                    </div>
                    <div style="float:left; width:150px;">
                    <input type="checkbox" name="cb_service4" id="cb_service4" onclick="check_cbs(4)"/> Moving Office
                    <? $value=$this->Supplier_model->check_service($supplier['id'],4);?>
                    <input type="hidden" name="service4" id="service4" value=<?=$value?> />
                    </div>
                </dd>
                </dl>
                <dl>&nbsp;</dl>
				<dl class="three"><dt>State</dt>
                <dd>
                	<div style="float:left; width:150px;">
                    <input type="checkbox" name="cb_state1" id="cb_state1" onclick="check_cbst(1)"/> ACT 
                    <? $value1=$this->Supplier_model->check_state($supplier['id'],1);?>
                    <input type="hidden" name="state1" id="state1" value=<?=$value1?> />
                    </div>
                    <div style="float:left; width:150px;">
                    <input type="checkbox" name="cb_state2" id="cb_state2" onclick="check_cbst(2)"/> NSW
                    <? $value2=$this->Supplier_model->check_state($supplier['id'],2);?>
                    <input type="hidden" name="state2" id="state2" value=<?=$value2?> />
                    </div>
                    <div style="float:left; width:150px;">
                    <input type="checkbox" name="cb_state3" id="cb_state3" onclick="check_cbst(3)"/> NT 
                    <? $value3=$this->Supplier_model->check_state($supplier['id'],3);?>
                    <input type="hidden" name="state3" id="state3" value=<?=$value3?> />
                    </div>
                    <br />
                    <div style="float:left; width:150px;">
                    <input type="checkbox" name="cb_state4" id="cb_state4" onclick="check_cbst(4)" /> QLD 
                    <? $value4=$this->Supplier_model->check_state($supplier['id'],4);?>
                    <input type="hidden" name="state4" id="state4" value=<?=$value4?> />
                    </div>
                    <div style="float:left; width:150px;">
                    <input type="checkbox" name="cb_state5" id="cb_state5" onclick="check_cbst(5)" /> SA
                    <? $value5=$this->Supplier_model->check_state($supplier['id'],5);?>
                    <input type="hidden" name="state5" id="state5" value=<?=$value5?> />
                    </div>
                    <div style="float:left; width:150px;">
                    <input type="checkbox" name="cb_state6" id="cb_state6" onclick="check_cbst(6)" /> TAS
                    <? $value6=$this->Supplier_model->check_state($supplier['id'],6);?>
                    <input type="hidden" name="state6" id="state6" value=<?=$value6?> />
                    </div>
                    <br />
                    <div style="float:left; width:150px;">
                    <input type="checkbox" name="cb_state7" id="cb_state7" onclick="check_cbst(7)"/> VIC 
                    <? $value7=$this->Supplier_model->check_state($supplier['id'],7);?>
                    <input type="hidden" name="state7" id="state7" value=<?=$value7?> />
                    </div>
                    <div style="float:left; width:150px;">
                    <input type="checkbox" name="cb_state8" id="cb_state8" onclick="check_cbst(8)"/> WA
                    <? $value8=$this->Supplier_model->check_state($supplier['id'],8);?>
                    <input type="hidden" name="state8" id="state8" value=<?=$value8?> />
                    </div>
                </dd></dl>                              
                <dl></dl>
            </div>
			<hr/>
            <div class="box">
            	<div class="row-title">
                     <div class="cust-fname">Quote Type</div>
                    <div class="cust-fname" style="border-left: 1px dotted #63A2D4;width:140px;">Customer Email</div>
                    
                    <div class="cat-func"  style="width:100px;">Date</div>
                   
                </div>
                <div class="sub-cat">
                	<? foreach ($history as $ht) {
                    
						$quotes=$this->Quote_model->identify($ht['quote_id']);
						$customer=$this->Customer_model->identify($quotes['customer_id']); 
						$service=$quotes['type_removal'];
						if($service==1){$service_text="Moving Home";}
						if($service==2){$service_text="Moving Into Storage";}
						if($service==3){$service_text="Moving 1-5 Items";}
						if($service==4){$service_text="Moving Office";}
					?>	
                    <div class="row-item">
                    <div class="cust-fname" ><a href="<?=base_url()?>admin/store/quote/edit/<?=$ht['quote_id']?>"><?=$service_text?></a></div>
                    <div class="cust-fname" style="border-left: 1px dotted #63A2D4;width:110px;"><a href="mailto:<?=$customer['email']?>"><?=$customer['email']?></a></div>
                    
                    <div class="cat-func" style="width:100px;"><?=$ht['date']?></div>

					
                    </div>
                    <? } ?>
            	</div>
            </div>            
            <hr/>
            <div class="box bgw">
            	<dl class="three"><dt>&nbsp;</dt>
            		<dd><label><input type="checkbox" id="notify" /> &nbsp; Send approval notification email to this user</label></dd>
            	</dl><dl></dl><br />
                <dl class="three"><dt>&nbsp;</dt>
                	<dd><input type="submit" class="button rounded" value="Update" /></dd>
                	<dd><input type="button" class="button rounded" value="Approve" onClick="approved()" /></dd>
                	<dd><input type="button" class="button rounded" value="Pending" onClick="pending()" /></dd>
                	<dd><input type="button" class="button rounded" value="Delete" onClick="deleteuser()" /></dd>
                	                    
                </dl>
                <dl></dl>
            </div>
            </form>
            
        </div>
        
