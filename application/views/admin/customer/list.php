<script>
function deletecustomer(id) {
	if (confirm('You are about to delete this customer from the system? This will also delete all orders made by this customer? Are you sure you want to do this?')) {
		/*window.location = '<?=base_url()?>admin/store/deletecustomer/' + id;*/
	}
}
function export_csv() {
	if (confirm('This will export the customers list to a csv file. Do you want to continue?')) {
		//var type=document.customerform.type.value;
		window.location = '<?=base_url()?>admin/store/exportcustomer';
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

            	<div class="text">Manage Quotes</div>
            	<div class="cr"></div>
            </div>
            <div class="box">
            	<h3>Search Quotes</h3>
            	<form name="customerform" method="post" action="<?=base_url()?>admin/store/customer/search">
                <dl class="three"><dt>Customer name</dt><dd><input type="text" class="textfield rounded" name="name" /></dd></dl>
                <dl class="three"><dt>Quotes type</dt><dd>
                	<select name="type">
                		<option value="0">New</option>
                        <option value="1">Process</option>
                	</select>
                </dd><dd><input type="submit" class="button rounded" value="Search" /></dd>
                </dl>
                <dl></dl>
                </form>
            </div>
            <hr />
            <div class="box bgw">
            	<h3>Quotes List &nbsp; <input type="button" class="button rounded" value="Export to CSV" onclick="export_csv()" /></h3>
                <p class="desc">Use the search function to search through all customers in the system.</p><br />
                <div class="row-title">
                     <div class="cust-fname">Quote Type</div>
                	<div class="cust-fname" style="border-left: 1px dotted #63A2D4; width:60px;">State</div>
                    <div class="cust-fname" style="border-left: 1px dotted #63A2D4;width:140px;">Customer</div>
                    
                    <div class="cat-func">Delete</div>
                    <div class="cat-func">View</div>
                    <div class="cat-func">Sent</div>
                   
                </div>
                <div class="sub-cat">
                	<? foreach ($quotes as $qt) {
                    
						$customer=$this->Customer_model->identify($qt['customer_id']); 
						if($qt['status']==0){$style='style=background-color:#f6dfe1';} else{$style='style=background-color:#e2f9e1';}
						$quote = $this->Quote_model->identify($qt['type_removal']);
						$location=$this->Location_model->identify($qt['state_from']);
					?>	
                    <div class="row-item" <?=$style;?>>
                    <div class="cust-fname" ><?=$quote['name']?></div>
                	<div class="cust-fname" style="border-left: 1px dotted #63A2D4;width:60px;"><?=$location['code']?></div>
                    <div class="cust-fname" style="border-left: 1px dotted #63A2D4;width:140px;"><?=$customer['email'];?></div>
                    
                    <div class="cat-func"><a href="javascript:deletesupplier(<?=$qt['id']?>)"><img src="<?=base_url()?>img/backend/icon-delete.png" /></a></div>
                    <div class="cat-func"><a href="<?=base_url()?>admin/store/customer/edit/<?=$qt['id']?>"><img src="<?=base_url()?>img/backend/icon-view.png" /></a></div>
                                        <div class="cat-func"><? if($qt['status']==0){?><img src="<?=base_url()?>img/sendbutton.png"> <? }else{echo ' ';}?></div>


                    </div>
                    
                     <? }?>
                </div>
            </div>
        </div>
        
