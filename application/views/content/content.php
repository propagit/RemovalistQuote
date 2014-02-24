<div class="content-wrap remove-top-margin">
	<div class="content-wrap-top"></div>
    <div class="content-wrap-mid">
    	<div class="content-top cms-contents">
        	<?=$page->content;?>
            <?php
				if($this->uri->segment(3) == ""){ 
					$this->load->view('content/content_sub_content',$sub_categories);
				}
			?>
        </div>
    	
    </div>
    <div class="content-wrap-bottom"></div>
</div>