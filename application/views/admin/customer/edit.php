<script>
function backtolist() {
	window.location = '<?=base_url()?>admin/store/customer';
}
function approved() {
	if (confirm('You want to approve this user as trading account?')) {
		var notify = $j('#notify:checked').val();
		var send = 0;
		if (notify) { send = 1; }
		$j.ajax({ 
			url: '<?=base_url()?>admin/store/approvetrader',
			type: 'POST',
			data: ({id:'<?=$user['id']?>',send:send}),
			dataType: "html",
			success: function(html) {
				window.location = '<?=base_url()?>admin/store/customer';
			}
		})	
	}
}
function pending() {
	if (confirm('You want to put this user to be pending?')) {
		$j.ajax({ 
			url: '<?=base_url()?>admin/store/pendingtrader',
			type: 'POST',
			data: ({id:'<?=$user['id']?>'}),
			dataType: "html",
			success: function(html) {
				window.location = '<?=base_url()?>admin/store/customer';
			}
		})	
	}
}
function deleteuser() {
	if (confirm('This action will delete this customers account, including all past orders related to this customer. Please note this action cannot be undone. If you don\'t wish to delete all past orders relating to this customer yet still want to deactivate the account click the pending button instead.')) {
		window.location = '<?=base_url()?>admin/store/deletecustomer/<?=$user['id']?>';
	}
}
</script>
    	<div class="left">
        	<h1>Store Management</h1>
            <div class="bar">

            	<div class="text">Manage Customers &raquo; Customer Details</div>
            	<div class="cr"></div>
            </div>
            <div class="box">
            	<input type="button" class="button rounded" value="Back to Customers List" onClick="backtolist()" />
            	<?php if($this->session->flashdata('update')) { ?>
                <span class="green"> &nbsp; Customers has been updated successfully!</span>
                <?php } ?>
                    

            </div>
            <hr />
            
            <form method="post" action="<?=base_url()?>admin/store/updatetrader" autocomplete="off">
            <input type="hidden" name="id" value="<?=$user['id']?>" />
            <div class="box bgw">
            	<h3>Personal Details</h3>
                <dl class="three"><dt>First name</dt><dd><input type="text" class="textfield rounded" value="<?=$customer['firstname']?>" name="firstname" /></dd></dl>
                <dl class="three"><dt>Family name</dt><dd><input type="text" class="textfield rounded" value="<?=$customer['lastname']?>" name="lastname" /></dd></dl>
                <dl class="three"><dt>Email Address</dt><dd><input type="text" class="textfield rounded" value="<?=$customer['email']?>" name="email" /></dd></dl>
                <dl class="three"><dt>Store Name</dt><dd><input type="text" class="textfield rounded" value="<?=$customer['storename']?>" name="storename" /></dd></dl>
                <dl class="three"><dt>Trading Name</dt><dd><input type="text" class="textfield rounded" value="<?=$customer['tradename']?>" name="tradename" /></dd></dl>
                <dl></dl>
            </div>
            <hr />
            <div class="box">
                <h3>Contact Details</h3>
               
                
                <dl class="three"><dt>Address 1</dt><dd><input type="text" class="textfield rounded" value="<?=$customer['address']?>" name="address" /></dd></dl>
				<dl class="three"><dt>Address 2</dt><dd><input type="text" class="textfield rounded" value="<?=$customer['address2']?>" name="address2" /></dd></dl>
                <dl class="three"><dt>Suburb</dt><dd><input type="text" class="textfield rounded" value="<?=$customer['city']?>" name="city" /></dd></dl>
                <dl class="three"><dt>State</dt><dd><input type="text" class="textfield rounded" value="<?=$customer['state']?>" name="state" /></dd></dl>
                
                <dl class="three"><dt>Postcode</dt><dd><input type="text" class="textfield rounded" value="<?=$customer['postcode']?>" name="postcode" /></dd></dl>
                <dl class="three"><dt>Phone</dt><dd><input type="text" class="textfield rounded" value="<?=$customer['phone']?>" name="phone" /></dd></dl>
                <dl class="three"><dt>Mobile</dt><dd><input type="text" class="textfield rounded" value="<?=$customer['mobile']?>" name="mobile" /></dd></dl>
                <dl></dl>
            </div>
            <hr />
            <div class="box bgw">
            	<h3>Account Login</h3>
                <dl class="three"><dt>Username</dt><dd><b><?=$user['username']?></b></dd></dl>
                <dl class="three"><dt>Password</dt><dd><input type="password" class="textfield rounded" name="password" /></dd></dl>
                <dl class="three"><dt>Status</dt><dd>
                	<?php if($user['activated']) { ?>
                	<span class="green">Approved</span>
                	<?php } else { ?><span>Pending</span>
                	<?php } ?>
                </dd></dl>
                <dl></dl>
            </div>
            <hr />
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
        
