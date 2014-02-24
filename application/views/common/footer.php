</div><!--container-->


<?php if(0) { ?>
<script type="text/javascript">
var $j = jQuery.noConflict();
$j(function() {
	  <?php if($this->session->flashdata('sign_msg'))
			{?>
				alert('<?=$this->session->flashdata('sign_msg')?>');
				<?
			}
			?>
});

		function echeck(str) {

                var at = "@"
                var dot = "."
                var lat = str.indexOf(at)
                var lstr = str.length
                var ldot = str.indexOf(dot)
                if (str.indexOf(at) == -1) {
                   alert("Please Enter A Valid E-mail")
                    return false
                }

                if (str.indexOf(at) == -1 || str.indexOf(at) == 0 || str.indexOf(at) == lstr) {
                    alert("Please Enter A Valid E-mail")
                    return false
                }

                if (str.indexOf(dot) == -1 || str.indexOf(dot) == 0 || str.indexOf(dot) == lstr) {
                   alert("Please Enter A Valid E-mail")
                    return false
                }

                if (str.indexOf(at, (lat + 1)) != -1) {
                   alert("Please Enter A Valid E-mail")
                    return false
                }

                if (str.substring(lat - 1, lat) == dot || str.substring(lat + 1, lat + 2) == dot) {
                   alert("Please Enter A Valid E-mail")
                    return false
                }

                if (str.indexOf(dot, (lat + 2)) == -1) {
                    alert("Please Enter A Valid E-mail")
                    return false
                }

                if (str.indexOf(" ") != -1) {
                   alert("Please Enter A Valid E-mail")
                    return false
                }


                return true;
            }
			
	function check_signup()
	{
		var valid = true;
		var email_specify = true;
		
		
		if($j('#signup_email').val() == "") { 
			$j('#signup_email').css('background','#fff3a0'); 
			valid = false; 
			email_specify = false;
		} else { 
			if(echeck($j('#signup_email').val())==false) {
				$j('#signup_email').css('background','#fff3a0'); 
				valid = false;
				email_specify = false;
			}else { $j('#signup_email').css('background','none');}
		}
		
		if(valid)
		{
			document.signupform.submit();	
		}	
		

	}
	</script>
    
    </div>
    <!-- MAIN // END -->

    <!-- FOOTER // START -->
    <div id="footer">
      <div class="footer_content">
         
            
            <div style="clear:both"></div>
            <div class="hr-line"></div>
            <div id="footer_bottom" style="margin-top:20px;">
            	<div style="float:left; height:300px;">
                	<div class="gray_footer" style="margin-left:40px;line-height:20px;"> Removalist Quotes &copy; </div>  
                   
                    <div style="float:left;margin-left:40px; font-weight:bold; font-size:12px;line-height:20px;" class="dark_gray_footer">
                    	Quick Links
                    </div>
                    <div style="clear:both"></div>
                    <div style="float:left; margin-left:40px;line-height:20px;">
                   
                    <ul style="list-style-type: none;">
                    	<li class="li-line"><a href="<?=base_url()?>removalist_services">Removalist Services</a></li>
                        <li class="li-line"> <a href="<?=base_url()?>moving_home">Moving Home</a></li>
                        <li class="li-line"> <a href="<?=base_url()?>moving_office">Moving Office</a></li>
                        <li class="li-line"> <a href="<?=base_url()?>moving_to_storage">Moving To Storage</a></li>
						<li class="li-line"> <a href="<?=base_url()?>removalist">Removalist</a></li>
                    </ul>
                    </div>
                    <div style="float:left; margin-left:30px;line-height:20px;">
                     <ul style="list-style-type: none;">
						<li class="li-line"> <a href="<?=base_url()?>removalist/melbourne">Melbourne Removalist</a></li>
                        <li class="li-line"> <a href="<?=base_url()?>why_choose_removalist_quote">Why Choose Our Removalist Quote</a></li>
                    	<li class="li-line"><a href="<?=base_url()?>privacy_policy">Privacy Policy</a></li>
                        <li class="li-line"><a href="<?=base_url()?>terms_and_conditions">Terms and Conditions</a></li>
						<li class="li-line"><a href="<?=base_url()?>faq">Frequently Asked Questions</a></li>
                    </ul>
                    </div>
                </div>
                
                <div style="float:right;">
                <div style="clear:both;"></div>
                	<div id="our_product" style="width:270px; float:right;  margin-right:35px; margin-top:20px;">
                    	<div class="dark_gray_footer" style=" font-weight:bold; font-size:12px;line-height:20px;">Sign Up To Get Great Deals & Discounts!</div>
                        <div style="clear:both;"></div>
                        <div id="sub_ourproduct" style="float:none;">

                        <div style="float:left;  margin-top:2px; ">
                       	<form name="signupform" id="signupform" method="post" action="<?=base_url()?>store/signup">
                        	<div style="background:url(<?=base_url()?>img/join.png); width:244px; height:57px;">
                            <input type="text" name="signup_email" id="signup_email" style="margin-top:5px !important; background:none; width:155px !important; float:left;">
                            <a onclick="check_signup()"><img src="<?=base_url()?>img/blank.gif" width="75px" height="55px" style="float:left;"/></a>
                            </div>
                        </form>
                        </div>
                       
                        </div>
                    </div>
                    
                </div>
            </div>
            
<!-- END of FOOTER -->      
	</div>
<!-- END OF PGWRAP--> 
<script type="text/javascript">
setTimeout(function(){var a=document.createElement("script");
var b=document.getElementsByTagName("script")[0];
a.src=document.location.protocol+"//dnn506yrbagrg.cloudfront.net/pages/scripts/0020/0179.js?"+Math.floor(new Date().getTime()/3600000);
a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
</script>
            
<?php } ?>      
</body>
</html>