// JavaScript Document

/**  
	Helper Scripts
*/
var help = {
	
	//email validator
	validate_email:function(emailAddress){
		var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	
		return pattern.test(emailAddress);
	},
	
	
	//form validator
	//validates input, email, textarea, select
	// use <input data="required" />
	//email <input data="email" />
	validate_form:function(form_id){
		var valid = true;
		var validation_rule = '';
		$('#'+form_id+' input,#'+form_id+' textarea,#'+form_id+' select').each(function(){
			validation_rule = $(this).attr('data');
			switch(validation_rule){
				case 'required':
					if(!$(this).val()){
						valid = false;
						$(this).addClass('error');	
					}else{
						$(this).removeClass('error');
					}
				break;
				
				case 'email':
					if(!$(this).val()){
						valid = false;	
						$(this).addClass('error');
					}else{
						if(!help.validate_email($(this).val())){
							valid = false;
							$(this).addClass('error');	
						}else{
							$(this).removeClass('error');
						}
					}
				break;
				
				case 'checked':
					if(!$(this).is(':checked')){
						valid = false;	
						$(this).addClass('error');
					}else{
						$(this).removeClass('error');
					}
				break;	
			}
		});
		
		if(valid){
			return valid;
		}
		
	},

	//check numeric 
	//type: nd = numeric with dot, n = numeric without dot
	//onkeypress="return help.check_numeric(this, event,'n');"
	check_numeric:function(field, event,type){
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		//numeric with dot 0-9,.
		if(type=="nd"){
			if((keyCode >=48 && keyCode<=57)||keyCode==46||keyCode==8||keyCode==9){return true;} 
			else{return false;}
		}
		//numeric without dot		
		if(type=="n"){
			if((keyCode >=48 && keyCode<=57) || keyCode==8 || keyCode==9){return true;} 
			else{return false;}
		}
	},
	
	//scrolls to the top of the page
	go_to_top:function(selector){			
		$(window).scroll(function(){
			$(window).scrollTop() ? $(selector).removeClass('custom-hidden')  : $(selector).addClass('custom-hidden');
		});
		
		$(selector).click(function(){
			$('html, body').animate({ scrollTop:0},300);
		});
	} 
};
