<div class="col-md-12 page-bg"> 
	<h1>CONTACT US</h1>
    <p>            
    We at Removalist Quote are interested in what you have to say about our website and removal services.<br /><br />
    We aim to provide you with the highest level of removalist service, professional and<br />
    affordable removalist quotes in Melbourne.<br /><br />
    
    Please feel free to contact us any time <br />
    RemovalistQuote.com.au
    </p>
    <p class="text-dark-grey bolder">Head Office</p>
    <div class="col-md-5 remove-gutters"><p>P.O.Box 1172</p></div>
    <div class="col-md-7 remove-gutters"><p>Tel: 1-300-531475</p></div>
    <p class="text-dark-grey bolder">Contact Us Via Email</p>
    
    <form role="form" class="custom-form" id="form_contact" action="<?=base_url()?>store/sendcontact" method="post">
    	<div class="form-group custom-group">
            <label class="col-sm-5 custom-label remove-gutters  remove-gutters" for="first_name">Your Name</label>
            <div class="col-sm-7 remove-gutters  remove-gutters">
            <input type="text" class="form-control" id="name" name="name" data="required">
            </div>
  		</div>
        <div class="form-group custom-group">
            <label class="col-sm-5 custom-label remove-gutters  remove-gutters" for="last_name">Email Address</label>
			<div class="col-sm-7 remove-gutters  remove-gutters">
            <input type="text" class="form-control" id="email" name="email" data="email" >
            </div>
  		</div>
        <div class="form-group custom-group">
            <label class="col-sm-5 custom-label remove-gutters  remove-gutters" for="telephone">Telephone</label>
			<div class="col-sm-7 remove-gutters  remove-gutters">
           	 <input type="text" class="form-control" id="telephone" name="telephone" data="required">
            </div>
  		</div>
       
        <div class="form-group custom-group">
            <label class="col-sm-5 custom-label remove-gutters  remove-gutters" for="additional">Your Message</label>
			<div class="col-sm-7 remove-gutters  remove-gutters">
            <textarea class="form-control" id="message" name="message"></textarea>
            </div>
  		</div>
    	<div class="form-group custom-group text-right">
			<img class="btn-next-step" src="<?=base_url()?>img/contactus-button.png" />
   		</div>
    </form>
</div>
<script>
$(function(){
	$('.btn-next-step').on('click',function(){
		if(help.validate_form('form_contact')){
			$('#form_contact').submit();
		}else{
			alert('Please check the highlighted fields to make sure you have entered the correct data.');	
		}
	});	
});

</script>


