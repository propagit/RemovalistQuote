<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/popup.css"> 
<script type="text/javascript" src="<?=base_url()?>js/popup.js"></script> 
<script>
$j(function() { 
	getcats();	
});
/* Get category and pages */
function getcats() {
	$j.ajax({
		url: '<?=base_url()?>admin/cms/getcats',
		type: 'POST',
		data: ({}),
		dataType: "html",
		success: function(html) {
			$j('#cats').html(html);
			getpages();
		}
	})	
}
function getpages() {
	var category_id = $j('#category_id').val();
	$j.ajax({
		url: '<?=base_url()?>admin/cms/getpages',
		type: 'POST',
		data: ({category_id:category_id}),
		dataType: "html",
		success: function(html) {
			$j('#page-list').html(html);
		}
	})	
}
/* Create new page */
function addpage() {
	var category_id = $j('#category_id').val();
	$j.ajax({
		url: '<?=base_url()?>admin/cms/addpage',
		type: 'POST',
		data: ({category_id:category_id}),
		dataType: "html",
		success: function(html) {
			$j('#page-add').html(html);
			$j('#title').focus();
		}
	})
}
function cancel() { $j('#page-add').html(''); }
function addingpage() {
	if($j('#title').val() == "") {
		alert('Please enter a title for new page');
	} else {
		document.addPageForm.submit();
	}
}
function editpage(id,title) {
	$j('#pagename-' + id).html('<div><input type="text" class="textfield rounded" value="' + title + '" id="newtitle-' + id + '" size="25" /></div><div><input type="button" class="button rounded" value="Go" onClick="updatepage(' + id + ')" /></div><div><input type="button" class="button rounded" value="X" onClick="cancelpage(' + id + ',\'' + title + '\')" />');
	$j('#newtitle-' + id).focus();
}
function updatepage(id) {
	var title = $j('#newtitle-' + id).val();
	$j.ajax({
		url: '<?=base_url()?>admin/cms/updatepage',
		type: 'POST',
		data: ({id:id,title:title}),
		dataType: "html",
		success: function(html) {
			if (html == "OK") {
				$j('#pagename-' + id).html('<a href="javascript:editpage(' + id + ',\'' + title + '\')">' + title + '</a>');
			} else {
				alert('There was an error. Could not update the page title');
			}
		}
	})
}
function cancelpage(id,title) {
	$j('#pagename-' + id).html('<a href="javascript:editpage(' + id + ',\'' + title + '\')">' + title + '</a>');
}
function deletepage(page_id) {
	if (confirm('Are you sure you want to delete this page? This action cannot be undo!')) {
		$j.ajax({
			url: '<?=base_url()?>admin/cms/deletepage',
			type: 'POST',
			data: ({page_id:page_id}),
			dataType: "html",
			success: function(html) {
				$j('#page-' + page_id).fadeOut();
			}
		})
	}
}
/* Update page */

function content(page_id) {
day = new Date();
id = day.getTime();
URL = '<?=base_url()?>admin/cms/page/content/' + page_id;
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=930,height=750,left = 180,top = 50');");
}
/* Add new category */
function addnew() {
	$j("#popup-content1").css({'display':'none'});	
	$j("#popup-content").css({'display':'block'});		
	getcats2();
	loadPopup();
	centerPopup();
	$j('#name').focus();
}
function getcats2() {
	$j.ajax({
		url: '<?=base_url()?>admin/cms/getcats',
		type: 'POST',
		data: ({}),
		dataType: "html",
		success: function(html) {
			$j('#cats2').html(html);
		}
	})
}
function addcat() {
	if($j('#name').val() == "") {
		alert('Please enter a name for new category');
	} else {
		document.addForm.submit();
	}
}
/* Update category */
function editcat() {
	$j("#popup-content").css({'display':'none'});	
	$j("#popup-content1").css({'display':'block'});
	getcats3();
	loadPopup();
	centerPopup();
	$j('#edit_name').focus();
}
function getcats3() {
	$j('#edit_message').html('');
	var category_id = $j('#category_id').val();
	$j('#edit_id').val(category_id);		
		
	$j.ajax({
		url: '<?=base_url()?>admin/cms/getcat_name',
		type: 'POST',
		data: ({category_id:category_id}),
		dataType: "json",
		success: function(data) {
			if(data['parent_cat']) {
				$j('#edit_message').html('Sorry, You cannot delete parent category!');
			}
			$j('#edit_name').val(data['category_name']);
			$j('#edit_permalink').val(data['permalink']);
			
		}
	})
}
function editingcat() {
	if($j('#edit_name').val() == "") {
		alert('Please enter a name for this category');
	} else {
		document.editForm.submit();
	}
}
/* Delete category */
function deletecat() {
	var category_id = $j('#category_id').val();
	if (category_id == -1) {
		alert('Sorry! You can not delete this category');
	} else if (confirm('This will delete all the pages in this category and the category itself. Are you sure you want to continue?')) {		
		$j.ajax({
			url: '<?=base_url()?>admin/cms/deletecategory',
			type: 'POST',
			data: ({category_id:category_id}),
			dataType: "html",
			success: function(html) {
				location.reload();
			}
		})
	}
}


/* new functions 2014-01-13 */

$j(function(){
	help.make_permalink('#name','#permalink'); 
	help.make_permalink('#edit_name','#edit_permalink'); 
});//ready

var help = {
	//create permalink
	make_permalink:function(main_text_selector,permalink_selector){
		$j(main_text_selector).keyup(function(){
			var main_text = $j(main_text_selector).val();
			if(main_text){
				$j(permalink_selector).val(help.format_to_link(main_text));	
			}else{
				$j(permalink_selector).val('');
			}
		});
	},

	//permalink generator
	format_to_link:function(text){
		text = text.toLowerCase();
		var   spec_chars = {a:/\u00e1/g,e:/u00e9/g,i:/\u00ed/g,o:/\u00f3/g,u:/\u00fa/g,n:/\u00f1/g}
		for (var i in spec_chars) text = text.replace(spec_chars[i],i);
		var hyphens = text.replace(/\s/g,'-');
		var permalink = hyphens.replace(/[^a-zA-Z0-9\-]/g,'');
		permalink = permalink.toLowerCase();
		return permalink;
	}
};
</script>
<div class="left">
<h1>Content Management</h1>
<div class="bar">
    <div class="text">Page Manager</div>
    <div class="cr"></div>
</div>
<div class="box">
    Category &nbsp;<span id="cats">
    
    </span>
    &nbsp; <a href="javascript:deletecat()">Delete</a>
    &nbsp;/&nbsp; <a href="javascript:editcat()">Edit this category</a>
    <div style="float:right; padding-top:5px;">
    &nbsp; <a href="javascript:addnew()">Add new category</a>
    </div>
    <dl></dl>    
</div>
<hr />
<div class="box bgw">
	
    <div id="page-list">
    </div>
    <div id="page-add"></div>
</div>
<hr />
</div>
<div id="popup-box">
	<div id="popup-content" style="display:none;">
    	<h3>Add new category</h3>
        <form name="addForm" method="post" action="<?=base_url()?>admin/cms/addcat">
        <p>Name</p>
        <p><input type="text" class="textfield rounded" id="name" name="name" /></p>
        <p>Permalink</p>
        <p><input type="text" class="textfield rounded" id="permalink" name="permalink" /></p>
        <p>Parent</p>
        <p id="cats2"></p>
        <p><input type="button" class="button rounded" value="Add" onclick="addcat()" /></p>
        </form>
    </div>
	<div id="popup-content1">
    	<h3>Edit category</h3>
        <form name="editForm" method="post" action="<?=base_url()?>admin/cms/editcat">
        <input type="hidden" class="textfield rounded" id="edit_id" name="edit_id" value=""/>
        <p>Name</p>
        <p><input type="text" class="textfield rounded" id="edit_name" name="edit_name" style="width:250px;" /></p><br/>
        <p>Permalink</p>
        <p><input type="text" class="textfield rounded" id="edit_permalink" name="edit_permalink" /></p>
        <p><input type="button" class="button rounded" value="Update" onclick="editingcat()" /></p>
        <div id="edit_message"></div>
        </form>
    </div>    
</div>
<div onclick="javascript:disablePopup()" id="background-popup"></div>