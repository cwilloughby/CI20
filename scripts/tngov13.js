
/* -----------------------------------------
--------------------------------------------
	 TN.gov: Initialize Scripts
--------------------------------------------
----------------------------------------- */
	
function addScript(url){
	$('body').append('<scr'+'ipt type="text/javascript" src="'+url+'"></scr'+'ipt>');
}

addScript('/javascripts/plugins/css_browser_selector.js');

addScript('/javascripts/general.js');

if($('body').attr('id') == 'tngov-index'){
	addScript('/javascripts/tngov13-index.js');
}

addScript('/javascripts/feature-search.js');
addScript('/apps/js/jquery/tngov.custom.js');


