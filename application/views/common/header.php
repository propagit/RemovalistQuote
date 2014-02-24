<!DOCTYPE html>
<html lang="en">
<head>
<?php
	$meta_keywords = 'removalist quote,free removalist quotes,online removalist quotes';
	$meta_desc = 'Removalist Quotes Australia can provide 3 competitive removal quotes to your inbox from professional removals companies';
	$meta_title = 'Get Free Removals Quotes to your inbox - Removalist Quotes';
	
	if($meta_data){
			$meta_desc = $meta_data['meta_desc'];
			$meta_keywords = $meta_data['meta_keywords'];
			$meta_title = $meta_data['meta_title'];
	}

?>
	<meta charset="utf-8">
    <meta name="keywords" content="<?=$meta_keywords;?>" />
	<meta name="description" content="<?=$meta_desc;?>" />
	<title><?=$meta_title;?></title>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<link href="<?=base_url();?>frontend-assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="<?=base_url();?>frontend-assets/bootstrap/js/bootstrap.js"></script>
    <!--fontawesome-->
	<link rel="stylesheet" href="<?=base_url();?>frontend-assets/font-awesome/css/font-awesome.min.css">
	<!--sys css-->
    <link rel="stylesheet" href="<?=base_url();?>frontend-assets/css/styles.css">
    <!--jQuery and UI-->
    <link rel="stylesheet" href="<?=base_url();?>frontend-assets/ui/css/jquery-ui-1.10.4.custom.min.css">
    <script type="text/javascript" src="<?=base_url()?>frontend-assets/ui/js/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="<?=base_url()?>frontend-assets/ui/js/jquery-ui-1.10.4.custom.min.js"></script>
    
    <!--styles-->
<?php $cur_page = $this->uri->segment(1);?>
</head>
<body>
<header>
    <div class="container">
    	<div class="col-md-3">
        	<div id="logo">
           		 <a href="<?=base_url()?>" title="Removalist Quote">
                 	<img src="<?=base_url()?>frontend-assets/img/logo.png" alt="logo.png" title="Removalist Quote Logo" />
                 </a>
        	</div>
        </div>
        <div class="col-md-9">
        
        </div>
    </div>
</header>

<div class="container">