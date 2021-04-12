jQuery("html").addClass('bonfire-html-onload');

jQuery(document.body).on("touchmove", function(e) {
    e.preventDefault();
});

var scrollPosition = [
self.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft,
self.pageYOffset || document.documentElement.scrollTop  || document.body.scrollTop
];
var html = jQuery('html');
html.data('scroll-position', scrollPosition);
html.data('previous-overflow', html.css('overflow'));
html.css('overflow', 'hidden');
window.scrollTo(scrollPosition[0], scrollPosition[1]);

function removeLocationHash(){
	var noHashURL = window.location.href.replace(/#.*$/, '');
	try {
		window.history.replaceState('', document.title, noHashURL)
	} catch (err) {

	}
}

$(document).ready(function() {

	var anc = window.location.hash.replace("#","");
	removeLocationHash();

	setTimeout(function () {
		jQuery(".bonfire-pageloader-icon").addClass('bonfire-pageloader-icon-hide');
	}, 250);


	setTimeout(function(){

		jQuery(document.body).unbind('touchmove');

		/* enable browser scroll on desktop */
		var html = jQuery('html');
		var scrollPosition = html.data('scroll-position');
		html.css('overflow', '');
		if (anc) {
			var offset = 0;
			if ($(window).innerWidth() >= 751) {
				offset = $('.main-header .top').height();
			} else  {
				offset = $('.main-header .main-menu').height()
			}
			window.scrollTo(0, $('#'+anc).offset().top - offset);
		} else {
			window.scrollTo(scrollPosition[0], scrollPosition[1]);
		}
		$(window).scroll();
		$('.port-client-result .attribute-item .attribute-value').each(function () {
			var value = Number($(this).html());
			if (value > 0) {
				$(this).html('0');
				$(this).countTo({
					from: 0,
					to: value,
					speed: 1500,
					refreshInterval: 50
				});
			}
		});
		/* fade out loader */
		jQuery("#bonfire-pageloader").addClass('bonfire-pageloader-fade');

		/* slide down html */
		jQuery("html").removeClass('bonfire-html-onload');

	},500);

	/* after 1000ms delay, hide (not fade out) loader*/
	setTimeout(function(){
	/* hide loader after fading out*/
		jQuery("#bonfire-pageloader").addClass('bonfire-pageloader-hide');
	},1000);

});
