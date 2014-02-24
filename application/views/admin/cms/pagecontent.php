<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="<?=base_url()?>css/backend.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=base_url()?>js/jquery.js"></script>
<script> var $j = jQuery.noConflict(); </script>
<title><?=$page['title']?> - Update page content</title>
<style>
body { background:#E8EDF2; margin:20px; }
table, tr, td { font-family:Arial, Helvetica, sans-serif; font-size:12px; }
.title { font-family:Tahoma; padding:0 10px 0 0; }
.msg-ok { color:#008000; margin:5px 0 0 10px; float:left; }
</style>
</head>
<body>
<div id="logo_hidden" style="display:none;">
<div class="inner_logo">
    <div class="inner_logo_cell"> <a href="http://google.com" target="_blank"><img alt="" src="/ladyjane/uploads/cute_upload/logo_21.jpg" border="0" /></a> </div>
</div>
</div>
<!--<link href="<?=base_url()?>css/template.css" rel="stylesheet" type="text/css">-->
<form method="post" action="<?=base_url()?>admin/cms/updatecontent">
<input type="hidden" name="id" value="<?=$page['id']?>" />
<div style="padding-left:48px; padding-top:20px; padding-bottom:40px;">
    <dl class="two"><dt>Meta header</dt><dd><input class="textfield rounded" type="text" value="<?=$page['meta_header']?>" name="meta_header"></dd></dl>
    <dl class="two"><dt>Description</dt><dd><input class="textfield rounded" type="text" value="<?=$page['description']?>" name="description"></dd></dl>
    <dl class="two"><dt>Keywords</dt><dd><input class="textfield rounded" type="text" value="<?=$page['keywords']?>" name="keywords"></dd></dl>
    <dl class="two"><dt>Preview Text</dt><dd><input class="textfield rounded" type="text" value="<?=$page['preview']?>" name="preview"></dd></dl>
</div>
<div style="padding-left:158px; padding-top:0px;">
<span id="template" style="padding-left:48px;">
<?php
	$this->Cute_model->init();	
	$this->Cute_model->ID ="content_text";
	$this->Cute_model->UseHTMLEntities = true;
	$this->Cute_model->EditorWysiwygModeCss = "";
	$this->Cute_model->setConfigure("Simple");	
	$this->Cute_model->setWidth("600px");
	$this->Cute_model->setHeight("550px");
	$this->Cute_model->Text = $page['content'];			
	$this->Cute_model->Draw();
	$this->Cute_model = null;
?>
</span>
</div>
<div style="padding-left:48px; padding-top:15px;">
    <dl class="two"><dt>&nbsp;</dt><dd><input type="submit" class="button rounded" value="Update" />
    </dd></dl>
</div>
</form>
<?php if ($this->session->flashdata('updated')) { ?>
<div class="msg-ok">Updated successfully!</div>
<?php } ?>
</body>
</html>
