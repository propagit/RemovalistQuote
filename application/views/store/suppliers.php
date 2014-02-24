<script type="text/javascript" src="<?=base_url()?>js/popup.js"></script>
<link href="<?=base_url()?>css/popup.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=base_url()?>js/jquery-cycle-lite.js"></script>
<script type="text/javascript">
var $j = jQuery.noConflict();

$j(document).ready(function(){
				
	//CLOSING POPUP	
	//Click out event!
	$j("#background-popup").click(function(){
		disablePopup();
	});
	//Press Escape event!
	$j(document).keypress(function(e){
		if(e.keyCode==27 && popupStatus==1){
			disablePopup();
		}
	});

    $j('#splash').cycle({
	     fx:    'fade', 
        speed:  1000,
		timeout: 6500
	 });
}); 
function addtocart(id) 
{
	$j.ajax({
		url: '<?=base_url()?>store/addtocart/',
		type: 'POST',
		data: "product_id=" + id,
		dataType: "html",
		success: function(html) {
			updatecart();
			updatenumberitems();
			$j('#content-pop').html(html);
			centerPopup();
	loadPopup();
		}
	})
}
function subscribe() {
	var valid = true;
	var email = $j('#email2').val();
	if(email == "") 
	{ 
	   $j('#email2').css('background','#fff3a0'); valid = false; 
	}
	else 
	{ 
	   if(!echeck(email))
		{
			$j('#email2').css('background','#fff3a0'); 
	        valid = false;
		}
		else
		{
			$j('#email2').css('background','#fff');
		}
	   
	}
	if (valid) 
	{
		$j.ajax({
		url: '<?=base_url()?>ajax_subscribe/',
		type: 'POST',
		data: {email2:email},
		dataType: "html",
		success: function(html) {
			alert(html);
			$j('#email2').val('');
		}
	})
	}
}

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
                   // alert("Please Enter A Valid E-mail")
                    return false
                }

                if (str.indexOf(at) == -1 || str.indexOf(at) == 0 || str.indexOf(at) == lstr) {
                   // alert("Please Enter A Valid E-mail")
                    return false
                }

                if (str.indexOf(dot) == -1 || str.indexOf(dot) == 0 || str.indexOf(dot) == lstr) {
                    //alert("Please Enter A Valid E-mail")
                    return false
                }

                if (str.indexOf(at, (lat + 1)) != -1) {
                   // alert("Please Enter A Valid E-mail")
                    return false
                }

                if (str.substring(lat - 1, lat) == dot || str.substring(lat + 1, lat + 2) == dot) {
                   // alert("Please Enter A Valid E-mail")
                    return false
                }

                if (str.indexOf(dot, (lat + 2)) == -1) {
                    //alert("Please Enter A Valid E-mail")
                    return false
                }

                if (str.indexOf(" ") != -1) {
                   // alert("Please Enter A Valid E-mail")
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
		
		if($j('#business').val() == "") { $j('#business').css('background','#fff3a0'); valid = false;}
		else { $j('#business').css('background','none');}
		
		if($j('#address').val() == "") { $j('#address').css('background','#fff3a0'); valid = false;}
		else { $j('#address').css('background','none');}
        
        if($j('#state').val() == "") { $j('#state').css('background','#fff3a0'); valid = false;}
        else { $j('#state').css('background','none');}
        if($j('#suburub').val() == "") { $j('#suburub').css('background','#fff3a0'); valid = false;}
        else { $j('#suburub').css('background','none');}
        if($j('#postcode').val() == "") { $j('#postcode').css('background','#fff3a0'); valid = false;}
        else { $j('#postcode').css('background','none');}
		
		if($j('#phone').val() == "") { $j('#phone').css('background','#fff3a0'); valid = false; }
		else { $j('#phone').css('background','none');}
		
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
			document.form_suppliers.submit();	
		}	

	}

</script>
<div id="popup-box">
	
    <div id="popup-shopping">
    	<div class="close"><a href="javascript:disablePopup()"><img src="<?=base_url()?>img/CloseButton-Up.png" alt="Close" /></a></div>
        <div style="clear:both"></div>
        <div style="clear:both;padding-top:78px">
           <div id="content-pop" style="width:400px;margin:0 auto"></div>
        </div>
        <br/>
    </div>
</div>
<div id="background-popup"></div>

<div style="clear:both"></div>

<div id="home_top_container">
	<div class="supplier_form_bg main-bg">	  
        
        <div class="content-top">
            <h1>REMOVALIST SERVICE SUPPLIERS</h1>
            <p class="gray" style="font-size:22px;margin-top:10px; width:868px; text-align:justify;"><br />
               	Join the Removalist Quote Removal networks and start winning work today!<br /><br />
Removalist Service Suppliers are subject to Removalist Quotes quality and standards checks. To find out more about signing up as a supplier please <a href="<?=base_url()?>suppliermore" target="_blank">click here</a>.<br /><br />
Please enter your business details below and one of our staff members will contact you shortly.<br /><br />
            </p>
            <div style="margin-top:10px;"> 
            
            <table class="form_table">
            <form action="<?=base_url();?>store/suppliers_add" method="post" id="form_suppliers" name="form_suppliers">
            	<tr height="45">
                	<td>
                    	<span class="gray font_form">Contact Name <span class="mandatory">*</span></span>
                  </td>
                    <td>
                    <div class="div_form_input">
                    	<input type="text" class="form_input_txt" name="name" id="name" maxlength="200"/>
                    	</div>
                   </td>
                </tr>
                <tr height="45">
                	<td>
                    	<span class="gray font_form" >Business Name <span class="mandatory">*</span></span>
                  </td>
                     <td>
                    <div class="div_form_input">
                    	<input type="text" class="form_input_txt" name="business" id="business" maxlength="200"/>
                    	</div>
                   </td>
                </tr>
                <tr height="45">
                	<td>
                    	<span class="gray font_form" >Address <span class="mandatory">*</span></span>
                  </td>
                    <td>
                    <div class="div_form_input">
                    	<input type="text" class="form_input_txt" name="address" id="address" maxlength="200"/>
                    	</div>
                   </td>
                </tr>
                <tr height="45">
                    <td>
                        <span class="gray font_form" >Suburb <span class="mandatory">*</span></span>
                  </td>
                    <td>
                    <div class="div_form_input">
                        <input type="text" class="form_input_txt" name="suburb" id="suburb" maxlength="200"/>
                        </div>
                   </td>
                </tr>
                 <tr height="45">
                    <td>
                        <span class="gray font_form" >State <span class="mandatory">*</span></span>
                  </td>
                    <td>
                    <div class="div_form_input">
                        <input type="text" class="form_input_txt" name="state" id="state" maxlength="200"/>
                        </div>
                   </td>
                </tr>
                <tr height="45">
                    <td>
                        <span class="gray font_form" >Postcode <span class="mandatory">*</span></span>
                  </td>
                    <td>
                    <div class="div_form_input">
                        <input type="text" class="form_input_txt" name="postcode" id="postcode" maxlength="200"/>
                        </div>
                   </td>
                </tr>
                <tr height="45">
                	<td>
                    	<span class="gray font_form" >Phone <span class="mandatory">*</span></span>
                  </td>
                    <td>
                    <div class="div_form_input">
                    	<input type="text" class="form_input_txt" name="phone" id="phone" maxlength="200" onkeypress="return handleKeycode (this, event,'n');"/>
                    	</div>
                   </td>
                </tr>
                <tr height="45">
                	<td>
                    	<span class="gray font_form" >Email <span class="mandatory">*</span></span>
                  </td>
                    <td>
                    <div class="div_form_input">
                    	<input type="text" class="form_input_txt" name="email" id="email" maxlength="200"/>
                    	</div>
                   </td>
                </tr>
                <tr height="45">
                	<td>
                    	<span class="gray font_form" >Website</span>
                  </td>
                     <td>
                    <div class="div_form_input">
                    	<input type="text" class="form_input_txt" name="website" id="website" maxlength="200"/>
                    	</div>
                   </td>
                </tr>
                	<td>
                    	<span class="gray font_form" >About My Business</span>
              </td>
                    <td>
                    	<div class="div_form_text_area">
                    	<textarea class="form_text_area" name="description"></textarea>
                    	</div>
                    </td>
                </tr>
                </tr>
                	<td colspan="2">&nbsp;</td>
                </tr> 
                </form>
                <tr height="45">
                	<td>&nbsp;
                    	
                    </td>
                    <td align="right">
                    	<div style="float:right; margin-right:70px;">
                        <a class="add_supplier_anchor" onclick="validate_form();"><img src="<?=base_url()?>img/signUp.png" /></a>
                        </div>
                    </td>
                </tr>
                
            </table>
           
            </div>
        </div>       
    </div>
</div>

