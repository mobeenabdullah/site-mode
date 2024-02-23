jQuery(function($) {


    $(document).ready(function() {

        // listen for postMessage from iframe
        window.addEventListener("message", function (event) {

            if (document.querySelector("#login") && event.data.hasOwnProperty('loginStyles')) {
                const loginStyles = event.data.loginStyles;

                if (loginStyles) {
                    applyStyles(loginStyles);
                }
            } else if (document.querySelector("#login") && event.data.hasOwnProperty('contentHandler')) {
                const contentHandler = event.data.contentHandler;

                if (contentHandler) {
                    changeLoginFormContent(contentHandler);
                }

            }
        });

        // change the login form content based on the site mode
        function changeLoginFormContent(contentHandler) {

            const parsedContent = JSON.parse(contentHandler);
            for (const selector in parsedContent) {
                const elements = document.querySelectorAll(selector);
                elements.forEach(element => {
                    const content = parsedContent[selector];
                    const target = content.target;
                    const value = content.value;

                    if (target === "text") {
                        element.innerHTML = value;
                    } else {
                        element.setAttribute(target, value);
                    }

                });
            }

        }


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
});