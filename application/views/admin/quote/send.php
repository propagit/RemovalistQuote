<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="<?=base_url()?>css/backend.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=base_url()?>js/jquery.js"></script>
<script>
function check_sup(id)
{
//	alert(jQuery("#cb_sup"+id).val() + id);
	if(jQuery("#cb_sup"+id).attr('checked'))
	{
		jQuery('#sup'+id).val(1);
	
		
	}
	else
	{
		jQuery('#sup'+id).val(0);
	
	}

}
function sendquoteautomatically()
{
	var id = jQuery('#quote_sup').val();
	window.location = '<?=base_url()?>admin/store/sendquoteautomate/'+id;
}

function sendquotemanual()
{
	var firstname=jQuery("#firstname").val();
	var state=jQuery("#state").val();
	jQuery('#firstname_supplier').val(firstname);
	jQuery('#state_supplier').val(state);
		document.formquotesupplier.submit();
}
function searchsupplier()
{
	document.searchsupplierform.submit();
}

</script>
<title>Send Quote</title>
<style>
body { background:#e8edf2; margin:0px; }
table, tr, td { font-family:Arial, Helvetica, sans-serif; font-size:12px; }
.title { font-family:Arial; padding:0 10px 0 0; }
.msg-ok { color:#008000; margin:5px 0 0 10px; float:left; }

</style>

</head>

<body>
<?
if($this->session->flashdata('update'))
{
	echo $this->session->flashdata('update');
}
?>
<div class="box" style="padding:20px;">
    <h3>Auto Allocate</h3>
    <p>
    Hitting auto allocate quote will email the quote to the NEXT 3 suppliers from the job location.
    </p>
    <br />
    <input type="button" class="button rounded" value="Auto Allocate Quote" onClick="sendquoteautomatically()" />       
</div>
<hr />
<div class="box bgw" style="padding:20px;">
    <h3>Search Suppliers</h3>
    <form name="searchsupplierform" id="searchsupplierform" action="<?=base_url()?>admin/store/sendquotepage/<?=$quote['id']?>/search" method="post">
    <dl class="three"><dt>Supplier Name</dt><dd><input type="text" class="textfield rounded"  name="firstname" /></dd></dl>
    <dl class="three"><dt>State</dt><dd>
    <select id="state" name="state" >
		<? foreach($states as $state){ ?>
        <option value="<?=$state['id']?>" <? if($state['id']==$quote['state_from']){ echo 'selected=selected';}?>><?=$state['name']?></option>
        <? } ?>
    </select></dd></dl>
    <dl class="three"><dt><input type="button" class="button rounded" value="Search" onClick="searchsupplier()" />       </dt></dl>
    <dl></dl>
    </form>
</div>
<hr />
<form id="formquotesupplier" name="formquotesupplier" method="post" action="<?=base_url()?>admin/store/sendquote" autocomplete="off">
<div class="box" style="padding:20px;">
   <div class="row-title" style="width:490px;">
         <div class="cust-fname" style="width:400px;">Supplier Name</div>
        <div class="cust-fname" style="border-left: 1px dotted #63A2D4;width:45px;">Add</div>
       
    </div>
    
    <div class="sub-cat">
        <? 
		$i=0;
		foreach($suppliers as $supplier) {
			$i=$i+1;
			?>
        <div class="row-item"style="width:490px;">
        <div class="cust-fname" style="width:400px;" ><?=$supplier['business_name']?><input name="id<?=$supplier['id']?>" id="id<?=$supplier['id']?>" type="hidden" value=<?=$supplier['id']?>></div>
        <div class="cust-fname" style="border-left: 1px dotted #63A2D4;width:45px; height:30px;"><input type="checkbox" name="cb_sup<?=$supplier['id']?>" id="cb_sup<?=$supplier['id']?>" onclick="check_sup(<?=$supplier['id']?>)" style="margin-top:10px;margin-left:10px;">
        	<input type="hidden" name="sup<?=$supplier['id']?>" id="sup<?=$supplier['id']?>" value=0/>
        </div>
        </div>
		<? } ?>
        <input type="hidden" value="<?=$i?>" name="tot" id="tot" />
		<input type="hidden" name="firstname_supplier" id="firstname_supplier" />
        <input type="hidden" name="state_supplier" id="state_supplier" />
        <input type="hidden" name="quote_sup" id="quote_sup" value="<?=$quote['id']?>" />
    </div>

    <dl class="three" style="margin-top:5px; margin-bottom:15px; margin-left:345px;"><dt><input type="button" class="button rounded" value="Allocate Quote" onClick="sendquotemanual()" />       </dt></dl>
        
</div>
<hr />
</form>
</body>
</html>
