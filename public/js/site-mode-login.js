jQuery(function($) {

    // listen for postMessage from iframe
    window.addEventListener("message", function (event) {

        if(document.querySelector("#login") && event.data.hasOwnProperty('loginStyles')) {
            const loginStyles = event.data.loginStyles;

            if(loginStyles) {
                applyStyles(loginStyles);
            }
        }
    });

    // Apply login page styles
    function applyStyles(loginStyles) {

        const parsedStyles = JSON.parse(loginStyles);

        for (const selector in parsedStyles) {
            const elements = document.querySelectorAll(selector);
            elements.forEach(element => {
                const styles = parsedStyles[selector];
                for (const property in styles) {
                    element.style[property] = styles[property];
                }
            });
        }
    }

});