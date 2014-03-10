<div class="col-md-12 page-bg"> 
	<?=$page->content;?>
    <?php
        if($this->uri->segment(3) == ""){ 
            $this->load->view('content/content_sub_content',$sub_categories);
        }
    ?>
</div>