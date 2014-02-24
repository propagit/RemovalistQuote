<div class="sub-contents-wrap">
	<?php if($categories){ 
			//print_r($categories);
			foreach($categories as $cat){
				$page = $this->Content_model->get_page_from_category_id($cat->id);
				if($page){
	?>
    	<div class="sub-content">
        	<a href="<?=$this->Content_model->build_url_from_category_id($page->category_id);?>"><strong><?=$page->title;?></strong></a></p>
            <p><?=substr($page->preview,0,100).'...';?></p>
            <a href="<?=$this->Content_model->build_url_from_category_id($page->category_id);?>">View All</a></p>
        </div>	
    <?php 		
					}
				}
			}
	 ?>
</div>