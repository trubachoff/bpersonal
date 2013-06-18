$(document).ready(function() {

	$('ul.sub-menu' )
		.hide()
		.click(function(event) {
			event.stopPropagation();
		});
  
	$('#menu-uslugi li:has("ul")').toggle(function() {
		$(this).find('ul').slideDown();
	}, function() {
		$(this).find('ul').slideUp();
	});

});
