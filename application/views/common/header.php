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
    <link href='//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,800,700,300,600' rel='stylesheet' type='text/css'>
	<!-- Bootstrap -->
	<link href="<?=base_url();?>frontend-assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="<?=base_url();?>frontend-assets/bootstrap/js/bootstrap.js"></script>
    <!--fontawesome-->
	<link rel="stylesheet" href="<?=base_url();?>frontend-assets/font-awesome/css/font-awesome.min.css">
    <!--jQuery and UI-->
    <link rel="stylesheet" href="<?=base_url();?>frontend-assets/ui/css/jquery-ui-1.10.4.custom.min.css">
    <script type="text/javascript" src="<?=base_url()?>frontend-assets/ui/js/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="<?=base_url()?>frontend-assets/ui/js/jquery-ui-1.10.4.custom.min.js"></script>
    
    <!--sys css-->
    <link rel="stylesheet" href="<?=base_url();?>frontend-assets/css/styles.css">
    
    <!--styles-->
</head>
<body>
<header>
    <div class="container head-wrap">
    	<div class="col-md-4 logo-wrap">
           <a href="<?=base_url()?>" title="Removalist Quote">
              <img src="<?=base_url()?>frontend-assets/img/logo.png" alt="logo.png" title="Removalist Quote Logo" />
           </a>
        </div>
        <div class="col-md-8 nav-wrap">
        	<h1>
            GET 3 COMPETITIVE QUOTES 
            SENT TO YOUR INBOX NOW!
            </h1>
        	<?php $this->load->view('common/nav');?>
        </div>
    </div>
</header>

<div class="container">