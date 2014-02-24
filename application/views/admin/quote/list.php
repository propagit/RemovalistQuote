<link type="text/css" href="<?=base_url()?>css/themes/base/ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="<?=base_url()?>js/ui/ui.core.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/ui/ui.datepicker.js"></script>
<script>
jQuery(document).ready(function(){
	jQuery("#from-date").datepicker({ dateFormat: 'yy-mm-dd' });
	jQuery("#to-date").datepicker({ dateFormat: 'yy-mm-dd' });
});
function deletequote(id) {
	if (confirm('Do you want delete this quote?')) {
		window.location = '<?=base_url()?>admin/store/deletequote/'+id;
	}
}
function export_csv() {
	if (confirm('This will export the quotes list to a csv file. Do you want to continue?')) {
		//var type=document.customerform.type.value;
		window.location = '<?=base_url()?>admin/store/exportquote';
	}
}
function send(quote_id) {
	day = new Date();
	id = day.getTime();
	URL = '<?=base_url()?>admin/store/sendquotepage/' + quote_id;
	eval("page" + id + " = window.open(URL, '" + quote_id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=550,height=750,left = 180,top = 50');");
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
            	<form name="customerform" method="post" action="<?=base_url()?>admin/store/quote/search">
                <dl class="three"><dt>Customer email</dt><dd><input type="text" class="textfield rounded" name="name" /></dd></dl>
                <dl class="three"><dt>Quotes type</dt><dd>
                	<select name="type">
                		<option value="0">New</option>
                        <option value="1">Processed</option>
                	</select>
                </dd>
                </dl>
                <dl class="three"><dt>Date From</dt><dd><input type="text" class="textfield rounded" name="date_from" id="from-date" /></dd></dl>
                <dl class="three"><dt>Date To</dt><dd><input type="text" class="textfield rounded" name="date_to" id="to-date"/></dd>
             
                <dd><input type="submit" class="button rounded" value="Search" /></dd>
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
                    <div class="cust-fname" style="border-left: 1px dotted #63A2D4;width:140px;">Date</div>
                    
                    <div class="cat-func">Delete</div>
                    <div class="cat-func">View</div>
                    <div class="cat-func"><? if($type==0){?> Sent <? }?></div>
                   
                </div>
                <div class="sub-cat">
                	<? foreach ($quotes as $qt) {
                    
						$customer=$this->Customer_model->identify($qt['customer_id']); 
						if($qt['status']==0){$style='style=background-color:#f6dfe1';} else{$style='style=background-color:#e2f9e1';}
						$quote = $this->Quote_model->identifytype($qt['type_removal']);
						$location=$this->Location_model->identify($qt['state_from']);
					?>	
                    <div class="row-item" <?=$style;?>>
                    <div class="cust-fname" ><? if(isset($quote['name'])) { echo $quote['name'];}?></div>
                	<div class="cust-fname" style="border-left: 1px dotted #63A2D4;width:60px;"><? if(isset($location['name'])) { echo $location['name'];} else { echo 'Unknown';}?></div>
                    <div class="cust-fname" style="border-left: 1px dotted #63A2D4;width:140px;"><? echo $qt['date'];//=$customer['email'];  ?></div>
                    
                    <div class="cat-func"><a href="javascript:deletequote(<?=$qt['id']?>)"><img src="<?=base_url()?>img/backend/icon-delete.png" /></a></div>
                    <div class="cat-func"><a href="<?=base_url()?>admin/store/quote/edit/<?=$qt['id']?>"><img src="<?=base_url()?>img/backend/icon-view.png" /></a></div>
                    <div class="cat-func"><? if($qt['status']==0){?><img src="<?=base_url()?>img/sendbutton.png" onclick="send(<?=$qt['id']?>)"> <? }else{echo ' ';}?></div>


                    </div>
                    
                     <? }?>
                </div>
            </div>
        </div>
        
