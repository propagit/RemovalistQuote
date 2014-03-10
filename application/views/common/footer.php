<hr />

</div><!--container-->
<div class="container white-bg">
<footer>
	<div id="footer">
          <div class="col-md-6 quicklinks-wrap">
             <span class="copy">Removalist Quotes &copy; </span>
             <span class="quicklinks-head">Quick Links</span>
             <ul class="quicklinks">
                <li><a href="<?=base_url()?>removalist_services">Removalist Services</a></li>
                <li> <a href="<?=base_url()?>moving_home">Moving Home</a></li>
                <li> <a href="<?=base_url()?>moving_office">Moving Office</a></li>
                <li> <a href="<?=base_url()?>moving_to_storage">Moving To Storage</a></li>
                <li> <a href="<?=base_url()?>removalist">Removalist</a></li>
            </ul>
            <ul class="quicklinks">
                <li> <a href="<?=base_url()?>removalist/melbourne">Melbourne Removalist</a></li>
                <li> <a href="<?=base_url()?>why_choose_removalist_quote">Why Choose Our Removalist Quote</a></li>
                <li><a href="<?=base_url()?>privacy_policy">Privacy Policy</a></li>
                <li><a href="<?=base_url()?>terms_and_conditions">Terms and Conditions</a></li>
                <li><a href="<?=base_url()?>faq">Frequently Asked Questions</a></li>
            </ul>
          </div>
          <div class="col-md-4 newsletter-signup-wrap">
          	 <span class="newsletter-head">Sign Up To Get Great Deals & Discounts!</span>
             <form name="signupform" id="signupform" method="post" action="<?=base_url()?>store/signup">
                <div class="newsletter-signup">
                    <input type="text" name="signup_email" id="signup_email">
                    <a class="newsletter-signup-btn" onclick="check_signup();"></a>
                </div>
            </form>
          </div>
     </div>
</footer>
</div>

<script type="text/javascript">
$(function() {
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

	if($('#signup_email').val() == "") { 
		$('#signup_email').css('background','#fff3a0'); 
		valid = false; 
		email_specify = false;
	} else { 
		if(echeck($('#signup_email').val())==false) {
			$('#signup_email').css('background','#fff3a0'); 
			valid = false;
			email_specify = false;
		}else { $('#signup_email').css('background','none');}
	}
	
	if(valid){
		document.signupform.submit();	
	}	
	

}
</script>   
</body>
</html>