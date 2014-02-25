<?php $cur_page = $this->uri->segment(1);?>

<ul class="nav desktop-visible">
   <li><a <?=($cur_page == '' ? 'class="current"' : '');?> href="<?=base_url()?>">GET A QUOTE</a></li>
   <li><a <?=($cur_page == 'suppliers' ? 'class="current"' : '');?> href="<?=base_url()?>suppliers">SUPPLIERS</a></li>
   <li><a <?=($cur_page == 'aboutus' ? 'class="current"' : '');?> href="<?=base_url()?>aboutus">ABOUT US</a></li>
   <li><a <?=($cur_page == 'contactus' ? 'class="current"' : '');?> href="<?=base_url()?>contactus">CONTACT US</a></li>
</ul>
