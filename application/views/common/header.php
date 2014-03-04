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
    <!--jQuery and UI-->
    <link rel="stylesheet" href="<?=base_url();?>frontend-assets/ui/css/jquery-ui-1.10.4.custom.min.css">
    <script type="text/javascript" src="<?=base_url()?>frontend-assets/ui/js/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="<?=base_url()?>frontend-assets/ui/js/jquery-ui-1.10.4.custom.min.js"></script>
	<!-- Bootstrap -->
	<link href="<?=base_url();?>frontend-assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="<?=base_url();?>frontend-assets/bootstrap/js/bootstrap.js"></script>
    <!--fontawesome-->
	<link rel="stylesheet" href="<?=base_url();?>frontend-assets/font-awesome/css/font-awesome.min.css">
    
    <!--helper scripts -->
    <script src="<?=base_url();?>frontend-assets/js/helpers.js"></script>
    <!--sys css-->
    <link rel="stylesheet" href="<?=base_url();?>frontend-assets/css/styles.css">
    
    <!--styles-->
    <?php $cur_page = $this->uri->segment(1);?>
</head>
<body>
<div id="body-bg"></div>
<header>
    <div class="container head-wrap desktop-visible">
    	<div class="col-md-4 logo-wrap remove-gutters">
           <a href="<?=base_url()?>" title="Removalist Quote">
              <img src="<?=base_url()?>frontend-assets/img/logo.png" alt="logo.png" title="Removalist Quote Logo" />
           </a>
        </div>
        <div class="col-md-8 nav-wrap remove-gutters">
        	<h1 class="slogan">
            GET 3 COMPETITIVE QUOTES 
            SENT TO YOUR INBOX NOW!
            </h1>
            <ul class="nav">
               <li><a <?=($cur_page == '' ? 'class="active"' : '');?> href="<?=base_url()?>">GET A QUOTE <?=($cur_page == '' ? '<i class="fa fa-caret-up active-nav-caret"></i>' : '');?></a></li>
               <li><a <?=($cur_page == 'suppliers' ? 'class="active"' : '');?> href="<?=base_url()?>suppliers">SUPPLIERS <?=($cur_page == 'suppliers' ? '<i class="fa fa-caret-up active-nav-caret"></i>' : '');?></a></li>
               <li><a <?=($cur_page == 'aboutus' ? 'class="active"' : '');?> href="<?=base_url()?>aboutus">ABOUT US <?=($cur_page == 'aboutus' ? '<i class="fa fa-caret-up active-nav-caret"></i>' : '');?></a></li>
               <li><a <?=($cur_page == 'contactus' ? 'class="active"' : '');?> href="<?=base_url()?>contactus">CONTACT US <?=($cur_page == 'contactus' ? '<i class="fa fa-caret-up active-nav-caret"></i>' : '');?></a></li>
            </ul>
        </div>
    </div><!--end desktop header-->
    
    <!--begin mob header-->
     <div class="container head-wrap desktop-hidden">
        <div class="col-md-12 remove-gutters">
        	  <div class="logo-wrap">
                  <a href="<?=base_url()?>" title="Removalist Quote">
                       <img class="logo inline" src="<?=base_url()?>frontend-assets/img/logo.png" alt="logo.png" title="Removalist Quote Logo" />
                  </a>
              </div>
        </div>
    </div>
    <div class="container mob-nav-wrap desktop-hidden remove-gutters">
    	 <div class="col-md-12 remove-gutters">
         	<span class="mob-menu-head">MENU <i class="fa fa-angle-right"></i></span>
        	<button class="btn btn-navbar mob-menu-btn" data-target=".nav-collapse" data-toggle="collapse" type="button">
               <i class="fa fa-align-justify"></i>
            </button>
            <div class="nav-collapse collapse push" style="height: auto;">
                <ul class="nav mob-navbar">
                     <li><a <?=($cur_page == '' ? 'class="active"' : '');?> href="<?=base_url()?>">GET A QUOTE</a></li>
                     <li><a <?=($cur_page == 'suppliers' ? 'class="active"' : '');?> href="<?=base_url()?>suppliers">SUPPLIERS</a></li>
                     <li><a <?=($cur_page == 'aboutus' ? 'class="active"' : '');?> href="<?=base_url()?>aboutus">ABOUT US</a></li>
                     <li><a <?=($cur_page == 'contactus' ? 'class="active"' : '');?> href="<?=base_url()?>contactus">CONTACT US</a></li>
                </ul>
            </div><!--end mob nav-->
        </div>
    </div>
    <div class="container desktop-hidden">
    <div class="col-md-12 remove-gutters">
            <h1 class="slogan">
              GET 3 COMPETITIVE QUOTES 
              SENT TO YOUR INBOX NOW!	
            </h1>
        </div>
    </div>
    <!--end mobile header-->    
        

</header>

<div class="container">