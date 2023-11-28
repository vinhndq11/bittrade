// set active class
$(document).ready(function(){
	var curURL = window.location.pathname;
	$('ul.sidebar-menu a').each(function(){
		if(curURL.toLowerCase() === this.pathname.toLowerCase())
		{
		    $(this).parent().addClass('active');
            $(this).parent().parent().addClass('menu-open');
		    $(this).parent().parent().parent().addClass('active');
		    return false;
		}
	});	
});