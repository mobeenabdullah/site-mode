(function( $ ) {
	'use strict';

	// listen for postMessage from iframe
	window.addEventListener("message", function (event) {

		if(document.querySelector("body")) {
			document.querySelector("body").classList.remove('preset1', "preset2", "preset3", "preset4", "preset5", "preset6");
			if(event.data.colorScheme) {
				document.querySelector("body").classList.add(event.data.colorScheme);
			}
		}

		if(document.querySelector(".countdown-wrapper")) {
			if (event.data.hideCountdown) {
				document.querySelector(".countdown-wrapper").style.display = "none";
			} else {
				document.querySelector(".countdown-wrapper").style.display = "flex";
			}
		}

		if(document.querySelector(".social-Icon")) {
			if (event.data.hideSocialIcons) {
				document.querySelector(".social-Icon").style.display = "none";
			} else {
				document.querySelector(".social-Icon").style.display = "flex";
			}
		}

		if(document.querySelector(".subscribe-box")) {
			if (event.data.hideSubscribeBox) {
				document.querySelector(".subscribe-box").style.display = "none";
			} else {
				document.querySelector(".subscribe-box").style.display = "block";
			}
		}

	});

})( jQuery );
