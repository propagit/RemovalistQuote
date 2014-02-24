<script>
}
function export_csv() {
	if (confirm('This will export the customers list to a csv file. Do you want to continue?')) {
		//var type=document.customerform.type.value;
		window.location = '<?=base_url()?>admin/store/exportnewsletter';
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

            	<div class="text">Manage Newsletters</div>
            	<div class="cr"></div>
            </div>
            <div class="box">
            	<h3>Search Subscriber</h3>
            	<form name="customerform" method="post" action="<?=base_url()?>admin/store/newsletter/search">
                <dl class="three"><dt>Subcriber Email</dt><dd><input type="text" class="textfield rounded" name="email" /></dd></dl>
              	
                <dd ><input style="margin-left:20px;" type="submit" class="button rounded" value="Search" /></dd>
                <dl></dl>
                </form>
            </div>
            <hr />
            <div class="box bgw">
            	<h3>Subcribers List &nbsp; <input type="button" class="button rounded" value="Export to CSV" onclick="export_csv()" /></h3>
                <p class="desc">Use the search function to search through all subscriber in the system.</p><br />
                <div class="row-title">
                    <div class="cust-fname">Date</div>
                	<div class="cust-fname" style="border-left: 1px dotted #63A2D4; width:60px;">Email</div>                    
                    <div class="cat-func">Delete</div>                  
                </div>
                <div class="sub-cat">
                	<? foreach ($subscribers as $sb) {?>	
                    <div class="row-item">
                    <div class="cust-fname" ><?=$sb['date']?></div>
                	<div class="cust-fname" style="border-left: 1px dotted #63A2D4;width:60px;"><?=$sb['email']?></div>                 
                    <div class="cat-func"><a href="javascript:deletesubscribe(<?=$sb['id']?>)"><img src="<?=base_url()?>img/backend/icon-delete.png" /></a></div>
                    </div>                    
                     <? }?>
                </div>
            </div>
        </div>
        
