<?php $cur_page = $this->uri->segment(1);?>

<ul class="nav desktop-visible">
   <li><a <?=($cur_page == '' ? 'class="active"' : '');?> href="<?=base_url()?>">GET A QUOTE <?=($cur_page == '' ? '<i class="fa fa-caret-up active-nav-caret"></i>' : '');?></a></li>
   <li><a <?=($cur_page == 'suppliers' ? 'class="active"' : '');?> href="<?=base_url()?>suppliers">SUPPLIERS <?=($cur_page == 'suppliers' ? '<i class="fa fa-caret-up active-nav-caret"></i>' : '');?></a></li>
   <li><a <?=($cur_page == 'aboutus' ? 'class="active"' : '');?> href="<?=base_url()?>aboutus">ABOUT US <?=($cur_page == 'aboutus' ? '<i class="fa fa-caret-up active-nav-caret"></i>' : '');?></a></li>
   <li><a <?=($cur_page == 'contactus' ? 'class="active"' : '');?> href="<?=base_url()?>contactus">CONTACT US <?=($cur_page == 'contactus' ? '<i class="fa fa-caret-up active-nav-caret"></i>' : '');?></a></li>
</ul>
