$(document).ready(function() {

	var originalMenuColor;

	// Resize previous/next buttons on window resize.
	$(window).resize(function() {
		$('.title .prev-next').height($('.title h1').outerHeight(true) - 2);
	});
	$(window).resize();
	
	// Mosaic.
	$('.mosaic-block').mosaic({
		animation: 'slide'
	});
	$('.mosaic-block').corner();

	// Animate the main menu colours.
	originalMenuColor = $.Color($('div.desktop-menu-container div.menu ul li a').css('color')).toHexString();
	$('div.desktop-menu-container div.menu ul li a').hover(
		function() {$(this).animate({color:'#000'}, 600);},
		function() {$(this).animate({color:originalMenuColor}, 400);}
	);
	
	// Responsive menu.
	$('.menu').meanmenu();
	
	// Google Analytics.
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-29298536-1']);
	_gaq.push(['_trackPageview']);
	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
	
});
