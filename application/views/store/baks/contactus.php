<script type="text/javascript">
var $j = jQuery.noConflict();
$j(function() {
	  <?php if($this->session->flashdata('send_msg'))
			{?>
				alert('<?=$this->session->flashdata('send_msg')?>');
				<?
			}
			?>
});

function handleKeycode (field, event,type)
			{
				var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
				if(type=="nd")//numeric with dot 0-9,.
				{
						if((keyCode >=48 && keyCode<=57)||keyCode==46||keyCode==8||keyCode==9)
						{
							return true;
						} 
						else
						return false;
				
				}
				
				if(type=="n")//numeric without dot
				{
						if((keyCode >=48 && keyCode<=57) || keyCode==8 || keyCode==9)
						{
							return true;
						} 
						else
						return false;
				
				}
			}
			
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
			
	function validate_form()
	{
		var valid = true;
		var email_specify = true;
		
		if($j('#name').val() == "") { $j('#name').css('background','#fff3a0'); valid = false; 
		}
		else { $j('#name').css('background','none');}
		
		
		
		if($j('#telephone').val() == "") { $j('#telephone').css('background','#fff3a0'); valid = false; }
		else { $j('#telephone').css('background','none');}
		
		if($j('#message').val() == "") { $j('#message').css('background','#fff3a0'); valid = false; }
		else { $j('#message').css('background','none');}
		
		if($j('#email').val() == "") { 
			$j('#email').css('background','#fff3a0'); 
			valid = false; 
			email_specify = false;
		} else { 
			if(echeck($j('#email').val())==false) {
				$j('#email').css('background','#fff3a0'); 
				valid = false;
				email_specify = false;
			}else { $j('#email').css('background','none');}
		}
		
		if(valid)
		{
			document.form_contact.submit();	
		}	
		else
		{
			alert('Please check the highlighted fields to make sure you have entered the correct data.');
		}

	}
</script>
<div id="home_top_container">
	<div class="main-bg contact-us-bg">	  

        <div class="content-top">
			<h1>CONTACT US</h1>
            <p class="dark_gray font_form" style="margin-top:15px;">            
            We are interested in what you have to say about our website and services.<br>
            We aim to provide you with the highest level of service and professional and<br>
            affordable removalist quotes in the market.<br><br>
            
            Please feel free to contact us any time <br>
            RemovalistQuote.com.au
            </p>

            <p class="dark_gray font_form" style="margin-top:15px;">
                <span class="gray"><b>Head Office</b></span><br>
                <table>
                <tr>
                <td style="width:400px;">
                <span class="dark_gray font_form">P.O.Box 1172 <!-- Clayton South --></span>
                </td>
                <td style="width:70px;">
                	<span class="gray font_form">Tel:	</span>
                </td>
                <td>
                <span class="dark_gray font_form"><!-- (03) 9882 4461 --> 1-300-531475</span>
                </td>
                </tr>
                <tr>
                <td>
                
                <span class="dark_gray font_form"><!-- 30 Bays Road --></span>
                </td>
                <td><span class="gray font_form"><!-- Fax: -->	</span></td>
                <td><span class="dark_gray font_form"><!-- (03) 9882 4462 --> </span></td>
                </tr>
                </table>
				 <!-- <span class="dark_gray font_form">Clayton Melbourne</span><br>
                 <span class="dark_gray font_form">Vic 3182</span> -->
            </p>
			 <br>
            <p class="dark_gray" style="font-size:22px;margin-top:15px;">
            <span class="gray"><b>Contact Us Via Email</b>  </span>
            </p>
          
			 <table class="form_table">
            <form action="<?=base_url();?>store/sendcontact" method="post" id="form_contact" name="form_contact">
            	<tr height="45">
                	<td>
                    	<span class="gray font_form">Your Name </span>
                  </td>
                    <td>
                    <div class="div_form_input">
                    	<input type="text" class="form_input_txt" name="name" id="name" maxlength="200"/>
                    	</div>
                   </td>
                </tr>
                <tr height="45">
                	<td>
                    	<span class="gray font_form" >Email Address </span>
                  </td>
                     <td>
                    <div class="div_form_input">
                    	<input type="text" class="form_input_txt" name="email" id="email" maxlength="200"/>
                    	</div>
                   </td>
                </tr>
                <tr height="45">
                	<td>
                    	<span class="gray font_form" >Telephone </span>
                  </td>
                    <td>
                    <div class="div_form_input">
                    	<input type="text" class="form_input_txt" name="telephone" id="telephone" maxlength="200" onkeypress="return handleKeycode (this, event,'n');"/>
                    	</div>
                   </td>
                </tr>
               
                <tr>
                	<td>
                    	<span class="gray font_form" >Your Message</span>
              </td>
                    <td>
                    	<div class="div_form_text_area">
                    	<textarea class="form_text_area" name="message" id="message"></textarea>
                    	</div>
                    </td>
                </tr>
                <tr>
                	<td colspan="2">&nbsp;</td>
                </tr> 
                </form>
                <tr height="45">
                	<td>&nbsp;
                    	
                    </td>
                    <td align="right">
                    	<div style="float:right; margin-right:70px;">
                        <a class="add_supplier_anchor" onclick="validate_form();"><img src="<?=base_url()?>img/contactus-button.png" /></a>
                        </div>
                    </td>
                </tr>
                
            </table>
        </div>
        
    </div>
</div>

