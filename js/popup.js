/***************************/
//@Author: Adrian "yEnS" Mato Gondelle
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

//SETTING UP OUR POPUP
//0 means disabled; 1 means enabled;
var popupStatus = 0;

//loading popup with jQuery magic!
function loadPopup(){
	//loads popup only if it is disabled
	if(popupStatus==0){
		$j("#background-popup").css({
			"opacity": "0.7"
		});
		$j("#background-popup").fadeIn("slow");
		$j("#popup-box").fadeIn("slow");
		popupStatus = 1;
	}
	
}

//disabling popup with jQuery magic!
function disablePopup(){
	//disables popup only if it is enabled
	if(popupStatus==1){
		$j("#background-popup").fadeOut("slow");
		$j("#popup-box").fadeOut("slow");
		popupStatus = 0;
	}
}

//centering popup
function centerPopup(){
	//request data for centering
	//var windowWidth = document.documentElement.clientWidth;
	//var windowWidth = f_clientWidth();
	//var windowHeight = f_clientHeight();
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $j("#popup-box").height();
	var popupWidth = $j("#popup-box").width();
	var arrPageSizes = getPageSize();
	var arrPageScroll = getPageScroll();
	//centering
	$j("#popup-box").css({
		"position": "absolute",
		top:	arrPageScroll[1] + (arrPageSizes[3] / 10),
		left:	arrPageScroll[0]
	});
	//only need force for IE6

	$j("#background-popup").css({
		"height": windowHeight
	});
	
}
/*
not needed
function f_clientWidth() {
	return f_filterResults (
		window.innerWidth ? window.innerWidth : 0,
		document.documentElement ? document.documentElement.clientWidth : 0,
		document.body ? document.body.clientWidth : 0
	);
}
function f_clientHeight() {
	return f_filterResults (
		window.innerHeight ? window.innerHeight : 0,
		document.documentElement ? document.documentElement.clientHeight : 0,
		document.body ? document.body.clientHeight : 0
	);
}
function f_scrollLeft() {
	return f_filterResults (
		window.pageXOffset ? window.pageXOffset : 0,
		document.documentElement ? document.documentElement.scrollLeft : 0,
		document.body ? document.body.scrollLeft : 0
	);
}
function f_scrollTop() {
	return f_filterResults (
		window.pageYOffset ? window.pageYOffset : 0,
		document.documentElement ? document.documentElement.scrollTop : 0,
		document.body ? document.body.scrollTop : 0
	);
}
function f_filterResults(n_win, n_docel, n_body) {
	var n_result = n_win ? n_win : 0;
	if (n_docel && (!n_result || (n_result > n_docel)))
		n_result = n_docel;
	return n_body && (!n_result || (n_result > n_body)) ? n_body : n_result;
}
*/
<!-- take these 2 funtions from lightbox js by Hieu -->
function getPageScroll() {
			var xScroll, yScroll;
			if (self.pageYOffset) {
				yScroll = self.pageYOffset;
				xScroll = self.pageXOffset;
			} else if (document.documentElement && document.documentElement.scrollTop) {	 // Explorer 6 Strict
				yScroll = document.documentElement.scrollTop;
				xScroll = document.documentElement.scrollLeft;
			} else if (document.body) {// all other Explorers
				yScroll = document.body.scrollTop;
				xScroll = document.body.scrollLeft;	
			}
			arrayPageScroll = new Array(xScroll,yScroll);
			return arrayPageScroll;
		};
function getPageSize() {
			var xScroll, yScroll;
			if (window.innerHeight && window.scrollMaxY) {	
				xScroll = window.innerWidth + window.scrollMaxX;
				yScroll = window.innerHeight + window.scrollMaxY;
			} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
				xScroll = document.body.scrollWidth;
				yScroll = document.body.scrollHeight;
			} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
				xScroll = document.body.offsetWidth;
				yScroll = document.body.offsetHeight;
			}
			var windowWidth, windowHeight;
			if (self.innerHeight) {	// all except Explorer
				if(document.documentElement.clientWidth){
					windowWidth = document.documentElement.clientWidth; 
				} else {
					windowWidth = self.innerWidth;
				}
				windowHeight = self.innerHeight;
			} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
				windowWidth = document.documentElement.clientWidth;
				windowHeight = document.documentElement.clientHeight;
			} else if (document.body) { // other Explorers
				windowWidth = document.body.clientWidth;
				windowHeight = document.body.clientHeight;
			}	
			// for small pages with total height less then height of the viewport
			if(yScroll < windowHeight){
				pageHeight = windowHeight;
			} else { 
				pageHeight = yScroll;
			}
			// for small pages with total width less then width of the viewport
			if(xScroll < windowWidth){	
				pageWidth = xScroll;		
			} else {
				pageWidth = windowWidth;
			}
			arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight);
			return arrayPageSize;
		};

//CONTROLLING EVENTS IN jQuery
/*
$j(document).ready(function(){
				
	//CLOSING POPUP	
	//Click out event!
	$j("#backgroundPopup").click(function(){
		disablePopup();
	});
	//Press Escape event!
	$j(document).keypress(function(e){
		if(e.keyCode==27 && popupStatus==1){
			disablePopup();
		}
	});

}); */