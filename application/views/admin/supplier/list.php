<script>
function deletesupplier(id) {
	if (confirm('You are about to delete this supplier from the system? This will also delete all orders made by this supplier? Are you sure you want to do this?')) {
		window.location = '<?=base_url()?>admin/store/deletesupplier/' + id;
	}
}
function export_csv() {
	if (confirm('This will export the customers list to a csv file. Do you want to continue?')) {
		//var type=document.customerform.type.value;
		window.location = '<?=base_url()?>admin/store/exportsupplier';
	}
}
function deletesubscribe(id) {
	if (confirm('You are about to delete this subscribe from the system? Are you sure you want to do this?')) {
		window.location = '<?=base_url()?>admin/store/deletesubscribe/' + id;
	}
}
</script>
    	<div class="left">
        	<h1>Store Management</h1>
            <div class="bar">

            	<div class="text">Manage Supplier</div>
            	<div class="cr"></div>
            </div>
            <div class="box">
            	<h3>Search Supplier</h3>
            	<form name="supplierform" method="post" action="<?=base_url()?>admin/store/supplier/search">
                <dl class="three"><dt>Supplier name</dt><dd><input type="text" class="textfield rounded" name="name" /></dd></dl>
                <dl class="three"><dt>Supplier type</dt><dd>
                	<select name="type">
                		<option value="-">All</option>
                        <option value="1">Active</option>
                        <option value="2">Inactive</option>
                	</select>
                </dd><dd><input type="submit" class="button rounded" value="Search" /></dd>
                </dl>
                <dl></dl>
                </form>
            </div>
            <hr />
            <div class="box bgw">
            	<h3>Supplier List &nbsp; <input type="button" class="button rounded" value="Export to CSV" onclick="export_csv()" /></h3>
                <p class="desc">Use the search function to search through all supplier in the system.</p><br />
                <div class="row-title">
                 
                	<div class="cust-fname">Supplier Name</div>
                	<!--<div class="cust-uname">Username</div>-->
                    <div class="cust-email">Email</div>
                    
                    <div class="cat-func">Delete</div>
                    <div class="cat-func">Edit</div>
                    
                    <div class="cat-func">Status</div>
                   
                    
                 
                </div>
                <div id="subcat">
                 <?
                     foreach($suppliers as $supplier) { 
                	 ?>
                    <div class="row-item">
                    	<div class="cust-fname">
						<?php
							if($this->session->userdata('type')==4){						
						 		echo substr($supplier['storename'],0,18);
							}else{
								echo substr($supplier['business_name'],0,18);								
							}	
						 ?>
						</div>
                    	<!--<div class="cust-uname"><?//= to_short($user['username'],12)?></div>-->
                        <div class="cust-email"><a href="mailto:<?=$supplier['email']?>"><!--<img src="<?=base_url()?>img/backend/emailIcon.png" title="Email" />--><?=$supplier['email']?></a></div>
                     
                        <div class="cat-func"><a href="javascript:deletesupplier(<?=$supplier['id']?>)"><img src="<?=base_url()?>img/backend/icon-delete.png" /></a></div>
                     
                        <div class="cat-func"><a href="<?=base_url()?>admin/store/supplier/edit/<?=$supplier['id']?>"><img src="<?=base_url()?>img/backend/icon-view.png" /></a></div>
                     <?
                        	if($supplier['actived']) { ?>
                        <div class="cat-func"><img src="<?=base_url()?>img/backend/icon-actived.png" title="Approved" /></div>
                        <?php } else { ?>
                        <div class="cat-func"><img src="<?=base_url()?>img/backend/icon-inactived.png" title="Pending" /></div>
                        <?php } ?>
                       
                    </div>
					<?
                    } ?>
                </div>
            </div>
        </div>
       
        
