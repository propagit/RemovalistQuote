<script>
function addoption(n) {
	var opt = $j('#optval').val().trim();
	if (opt != '') {
		$j('#optval').val('');
		$j('#options').append('<dl class="five" id="opt-' + n + '"><dt>' + opt + '</dt><dd><a href="javascript:removeoption(' + n + ')"><img src="<?=base_url()?>img/backend/icon-delete-small.png" /></a></dd><input type="hidden" name="options[]" value="' + opt + '" /></dl>');
		$j('#optbutton').html('<input type="button" class="button rounded" value="&raquo;" onclick="addoption(' + (n+1) + ')" />');
	} else {
		alert('Please enter a valid option');
	}
}
function removeoption(n) {
	$j('#opt-' + n).remove();
}
</script>
    	<div class="left">
        	<h1>System Settings</h1>
            <div class="bar">

            	<div class="text">Product Attributes &raquo; Edit Attribute</div>
            	<div class="cr"></div>
            </div>
            <?php $options = $attribute['options']; ?>
            <div class="box">
            	<input type="button" class="button rounded" value="Back to Attributes List" onclick="history.go(-1)" />
            </div>
            <hr />
            <div class="box bgw">
            	<form method="post" action="<?=base_url()?>admin/system/updateattribute">
                <input type="hidden" name="attribute_id" value="<?=$attribute['id']?>" />
                <div id="optcontent" class="optwrap">
                	<div class="title" id="attribute_name">Attribute: <b><?=$attribute['name']?></b> (Add option by the input field below)</div>
                    <div class="input">
                    	<dl class="four"><dd><input type="text" class="textfield rounded" id="optval" /></dd><dd id="optbutton"><input type="button" class="button rounded" value="&raquo;" onClick="addoption(<?=(count($options)+1)?>)" /></dd></dl>
                        <dl></dl>
                    </div>
                    <div class="label" id="options">
                    	<?php $options = $attribute['options']; $i=0;
						foreach($options as $opt) { $i++; ?>
                        <dl class="five" id="opt-<?=$i?>"><dt><?=$opt?></dt><dd><a href="javascript:removeoption(<?=$i?>)"><img src="<?=base_url()?>img/backend/icon-delete-small.png" /></a></dd><input type="hidden" name="options[]" value="<?=$opt?>" /></dl>
                        <?php } ?>
                    </div>
                    <div class="button-complete"><input type="button" class="button rounded" value="Cancel" onClick="history.go(-1)" /> &nbsp;<input type="submit" class="button rounded" value="Update" /></div>
                    <dl></dl>
                </div>
                </form>
            </div>
        </div>
        
