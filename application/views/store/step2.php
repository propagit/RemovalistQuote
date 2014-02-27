 <div class="content-top">
            <h1>STEP 2 <?=($removal_service != '' ? ' - '.$removal_service : '');?></h1>
            <p class="dark_gray font_form" style="margin-top:5px;">
                Please provide us with the postcode <br />
				of your pick up address so we can find<br />
				the most suitable removal company for your location<br />
            </p>
        </div>
        <form name="formlocation" id="formlocation" action="<?=base_url()?>store/savelocation" method="post">
        <div style="clear:both"></div>
        <div style="float:none; padding-left:45px;">
        	<div style="float:left; margin-top:15px;">
            	<span class="gray font_form">State*</span>
                <div style="margin-top:15px; text-align:right;">
                <select id="state_from" name="state_from" onchange="getsuburbfrom()">
                	<? foreach($states as $state){ ?>
                    <option value="<?=$state['id']?>" <? if($state['id']==7){ echo 'selected=selected';}?>><?=$state['name']?></option>
                    <? } ?>
                </select>
                </div>
                <div style="margin-top:15px;">
                <span class="gray font_form">City / Town</span>
                </div>
                <div style="background:url(<?=base_url()?>img/input_text.png); width:244px; height:43px;">
                    <input type="text" id="city_from" name="city_from" style="margin-top:5px !important; background:none; width:240px !important">
                    </div>
                <div style="margin-top:15px;">                    
                <span class="gray font_form">Suburb*</span>
                </div>
                <div style="margin-top:15px; text-align:right;" name="divsuburbfrom" id="divsuburbfrom">
                <select name="suburb_from" id="suburb_from">
                	<option value="-">Select Suburb</option>                    
                </select>
                </div>
            </div>
        	<div style="float:left; margin-top:15px; margin-left:20px;width:55px;">
            	<span class="gray font_form">To</span>
            </div>
            <div style="float:left; margin-top:15px;">
            	<span class="gray font_form">State*</span>
                <div style="margin-top:15px; text-align:right;">
                <select id="state_to" name="state_to" onchange="getsuburbto()">
                	<? foreach($states2 as $state){ ?>
                    <option value="<?=$state['id']?>" <? if($state['id']==7){ echo 'selected=selected';}?>><?=$state['name']?></option>
                    <? } ?>
                </select>
                </div>
                <div style="margin-top:15px;">
                <span class="gray font_form">City / Town</span>
                </div>
                <div style="background:url(<?=base_url()?>img/input_text.png); width:244px; height:43px;">
                    <input type="text" id="city_to" name="city_to" style="margin-top:5px !important; background:none; width:240px !important">
                    </div>
                <div style="margin-top:15px;">                    
                <span class="gray font_form">Suburb*</span>
                </div>
                <div style="margin-top:15px; text-align:right;" name="divsuburbto" id="divsuburbto">
                <select name="suburb_to" id="suburb_to">
                	<option value="-">Select Suburb</option>                    
                </select>
                </div>
            </div>
        </div>
        <div style="clear:both"></div>
        <div style="float:right; margin-right:53px; margin-top:15px;">
        <a onclick="checklocation()" ><img src="<?=base_url()?>img/next-step.png" style="float:right;"/></a>
        </div>
        </form>