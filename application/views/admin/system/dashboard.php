<script type="text/javascript" src="<?=base_url()?>js/popup.js"></script>
<link href="<?=base_url()?>css/popup.css" rel="stylesheet" type="text/css" />
<script>
$j(document).ready(function(){
	$j("#background-popup").click(function(){ disablePopup(); });
	$j(document).keypress(function(e){ if(e.keyCode==27 && popupStatus==1){ disablePopup(); } });
});

function bestcustomer() {
	$j.ajax({
		url: '<?=base_url()?>admin/store/bestcustomer/',
		success: function(html) {
			$j('#popup-content').html(html);
			centerPopup();
			loadPopup();
		}
	})	
}
</script>
    	<div class="left">
        	<h1>Store Management</h1>
            <div class="bar">

            	<div class="text">Dashboard</div>
            	<div class="cr"></div>
            </div>
            <div class="box">
            	<div class="box-1 rounded">
                	<h3>Recent Sales</h3>
                    <div class="row-title">
                    	<div class="customer-name">Customer name</div>
                        <div class="cat-func">View</div>
                        <div class="total">Total</div>
                    </div>
                </div>
                <div class="box-2 rounded">
                	<h3>Sales Stats</h3>
                             
                </div>
                <div class="box-1 rounded">
                	<h3>Quick Facts</h3>
                   
                </div>
                <div class="box-2 rounded">
                	<h3>Quick Facts</h3>
                   
                </div>
                <dl></dl>
            	<p>This is the dashboard of store management system (<b>SimplyShopping V2.01</b>).</p>
                <p>Please <a href="mailto:team@propagate.com.au">contact us</a> for support and to here about other web products we have</p>
            </div>
        </div>
        

<div id="popup-box">
	<div id="popup-content">
    	
    </div>
</div>
<div id="background-popup"></div>