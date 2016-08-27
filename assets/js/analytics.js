jQuery(document).ready(function() {
	jQuery("a[href*='mailto']").click(function() {
		if ( typeof _gaq !== "undefined" ) {
			_gaq.push(['_trackEvent', 'kontakt', 'maillink', jQuery(this).attr("href").replace("mailto:", "")]);
		} else if ( typeof ga !== "undefined" ) {
			ga('send', 'event','kontakt', 'maillink', jQuery(this).attr("href").replace("mailto:", ""));
		}
	});
});