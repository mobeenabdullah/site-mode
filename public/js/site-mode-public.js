(function( $ ) {
	'use strict';

	// listen for postMessage from iframe
	window.addEventListener("message", function (event) {

		if(document.querySelector("body")) {
			document.querySelector("body").classList.remove('preset1', "preset2", "preset3", "preset4", "preset5", "preset6", "default");
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

		if(document.querySelector(".wp-block-social-links")) {
			if (event.data.hideSocialIcons) {
				document.querySelector(".wp-block-social-links").style.display = "none";
			} else {
				document.querySelector(".wp-block-social-links").style.display = "flex";
			}
		}

	});

})( jQuery );
