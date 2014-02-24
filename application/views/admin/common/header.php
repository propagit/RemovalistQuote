<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Removalist Quote // Administration Panel</title>
<link href="<?=base_url()?>css/backend.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=base_url()?>js/jquery.js"></script>
<script> var $j = jQuery.noConflict(); </script>
</head>
<body>

<!-- HEADER -->
<div id="header">
    <div class="logo"></div>
    <div class="bar">

        <div class="cr"></div>
        <div class="text"><a href="<?=base_url()?>admin">Removalist Quote Admin Panel</a> // 
        	<?php if($this->session->userdata('kiotiahraloggedin')) { ?>
            <a href="<?=base_url()?>admin/logout">Logout</a>
            <?php } else { ?>Login<?php } ?>
        </div>
    </div>
</div>
<!-- HEADER // END -->

<div id="pgwrap">	
    <div id="bodier">