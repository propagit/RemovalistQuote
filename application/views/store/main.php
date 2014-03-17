<div class="col-md-12 page-bg desktop-hidden"> 
	<?php
		$this->load->view('store/mob_step1_and_step2',$mob_data);
	?>
</div>
 <?php if(1){ ?>
<div class="col-md-12 page-bg home-boxes-wrap desktop-visible">
	<h1>STEP 1</h1>
	<h2>What removal service are you after?</h2>
    <p class="f14">Get competitive removalist quotes sent directly to your email inbox in 3 simple steps</p>
    <div class="col-md-3 home-boxes" onclick="next_step(1);">
    	<img alt="moving-home.png" title="Moving home" src="<?=base_url()?>frontend-assets/img/home1.png">
        <div class="home-box-slide">
        	<span>Moving Home</span>
            <p>Moving across town or interstate we can find you quality removalist companies at competitive prices</p>
        </div>
    </div>
    <div class="col-md-3 home-boxes" onclick="next_step(2);">
    	<img alt="moving-to-storage.png" title="Moving to storage" src="<?=base_url()?>frontend-assets/img/home2.png">
        <div class="home-box-slide">
        	 <span>Moving To Storage</span>
             <p>Looking to move your goods into long term or short term storage, we can find you cost effective solutions in your local area</p>
        </div>
    </div>
    <div class="col-md-3 home-boxes" onclick="next_step(3);">
    	<img alt="moving-1-to-5.png" title="Moving 1 to 5 items" src="<?=base_url()?>frontend-assets/img/home3.png">
        <div class="home-box-slide">
        	<span>Moving 1 to 5 items</span>
            <p>Are you looking at moving a small number of items?<br/>
            We can source and find movers that specialise in smaller moves that offer great service and competitive prices</p>
        </div>
    </div>
    <div class="col-md-3 home-boxes" onclick="next_step(4);">
    	<img alt="moving-office.png" title="Moving office" src="<?=base_url()?>frontend-assets/img/home4.png" >
        <div class="home-box-slide">
        	<span>Moving Office</span>
            <p>Needing to relocate your office locally or interstate we can find you quality providers at the best possible rates</p>
        </div>
    </div>

</div>  
<div class="col-md-12 page-bg">
	<h1>Removalist Quote</h1>
    <p>
    <b>Removalist Quote</b> provides <b>free removal quotes</b> for a full range of residential or commercial removals. Get competing removal quotes based on your needs and budget from several of our dedicated and independent partners. All of our partners are <b>professional removalist based in Melbourne</b> with year of experience in removalist services to ensure a smooth and easy relocation for you.<br /><br />
    
What sets <b>Removalsit Quote</b> apart from all other companies is that we provide 3 free removal quotes for all of our removal services. Once a customer request a quote online, their request are analyzed and sent to the company that best suits them based on attributes such as relocating location, removalist services required etc.<br /><br />

<b>Removalist Quote</b> is simple and 100% free to use for all without any hidden costs.

    </p>
</div>  
<?php } ?>
<script>

$(function(){

	 $('.home-boxes').on({ 
		mouseenter:function(){
			var current_wrap = $(this);
			var info_wrap = current_wrap.children('.home-box-slide');
			info_wrap.animate({
						'margin-top':-current_wrap.height(),
						'min-height':current_wrap.height()
				  	}, 300, function() {
				  });
		 },
		 mouseleave:function(){
			var current_wrap = $(this);
			var info_wrap = current_wrap.children('.home-box-slide');
			info_wrap.animate({
						'margin-top':'-45px',
						'min-height':''
				  	}, 300, function() {
				 });
		 }
 
	 }); 
});//ready

function next_step(service){
	window.location = '<?=base_url()?>store/saveservice/'+service;
}
</script>
