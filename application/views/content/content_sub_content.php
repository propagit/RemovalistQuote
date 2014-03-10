
	<?php if($categories){ 
			//print_r($categories);
			foreach($categories as $cat){
				$page = $this->Content_model->get_page_from_category_id($cat->id);
				if($page){
	?>
    	<div class="col-md-6 remove-left-gutter">
        	<a class="sub-page-title" href="<?=$this->Content_model->build_url_from_category_id($page->category_id);?>"><?=$page->title;?></a>
            <p><?=substr($page->preview,0,100).'...';?></p>
            <a class="sub-page-anchor" href="<?=$this->Content_model->build_url_from_category_id($page->category_id);?>">View All</a></p>
        </div>	
    <?php 		
					}
				}
			}
	 ?>
