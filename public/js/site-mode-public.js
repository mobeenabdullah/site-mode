(function( $ ) {
	'use strict';

	// listen for postMessage from iframe
	window.addEventListener("message", function (event) {
	    if (!event.data.hideCountdown) {
	        document.querySelector(".countdown-wrapper").style.display = "none";
	    } else {
	        document.querySelector(".countdown-wrapper").style.display = "flex";
		}

		if (!event.data.hideSocialIcons) {
			document.querySelector(".social-Icon").style.display = "none";
		} else {
			document.querySelector(".social-Icon").style.display = "flex";
		}

		if (!event.data.hideSubscribeBox) {
			document.querySelector(".subscribe-box").style.display = "none";
		} else {
			document.querySelector(".subscribe-box").style.display = "block";
		}

	});

})( jQuery );
