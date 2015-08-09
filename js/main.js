jQuery(document).ready(function($) {
	
	function toggleMenu() {
		$('body').toggleClass('is-menu-open');

		if ( $('body').hasClass('is-menu-open') ) {
			$('body').bind('touchmove', function(e){ e.preventDefault(); });
		} else {
			 $('body').unbind('touchmove');
		}

		if ( $(window).width() > 520 ) {
			setTimeout(function(){ $('#search-field').focus(); }, 400);
		}		
	}

	$(document).keyup(function(e) {
		if (e.keyCode === 27) { toggleMenu(); }   // esc
	});

	$('.js-menu-toggle').click(function() { toggleMenu(); });

	$('.menu-item').click(function() { $('body').unbind('touchmove'); });
});