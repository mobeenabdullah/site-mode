window.addEventListener(
	'DOMContentLoaded',
	(event) => {
    const contactForm      = document.querySelector( '.sm__contact-form' );
    const contactFormName  = document.querySelector( '#sm-contact-name' );
    const contactFormEmail = document.querySelector( '#sm-contact-email' );
    const contactFormNonce = document.querySelector( '#sm-contact-nonce' );
    const smContactFormURL = smContactForm.ajax_url;
		if (contactForm) {
			contactForm.addEventListener(
				'submit',
				(event) => {
                event.preventDefault();
                const validateEmail      = (email) => {
                return email.match( /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/ );
					};
                const contactFormError = document.querySelector( '.contact_field_error' );
                const formError          = document.querySelector( '.contact_error' );
					if (formError) {
						formError.remove();
					}
					if (contactFormError) {
						contactFormError.remove();
						contactFormName.classList.remove( 'sm_error_field' );
					}
					if ((contactFormName.value == null || contactFormName.value === "")) {
						contactFormName.insertAdjacentHTML( 'afterend', ` < span class = "contact_field_error" > Please enter your name.< / span > ` );
						contactFormName.focus();
						contactFormName.classList.add( 'sm_error_field' );
						return false;
					}
					if ((contactFormEmail.value == null || contactFormEmail.value === "")) {
						contactFormEmail.insertAdjacentHTML( 'afterend', ` < span class = "contact_field_error" > Please enter your email.< / span > ` );
						contactFormEmail.focus();
						contactFormEmail.classList.add( 'sm_error_field' );
						validateEmail( contactFormEmail.value );
						return false;
					}
					if ( ! validateEmail( contactFormEmail.value )) {
						contactFormEmail.insertAdjacentHTML( 'afterend', ` < span class = "contact_field_error" > Please enter valid email.< / span > ` );
						contactFormEmail.focus();
						contactFormEmail.classList.add( 'sm_error_field' );
						return false;
					}
					if (contactFormName.value !== '' && contactFormEmail.value !== '' && contactFormNonce.value !== '') {
						const data = new FormData();
						data.append( 'action', 'insert_contacts' );
						data.append( 'name', contactFormName.value );
						data.append( 'email', contactFormEmail.value );
						data.append( 'nonce', contactFormNonce.value );
						fetch(
							smContactFormURL,
							{
								method: 'POST',
								body: data,
								}
						)
						.then( response => response.json() )
						.then(
							data => {
								if (data.success) {
									contactForm.innerHTML = '<div class="sm_submit_success">Thank you for subscribing!</div>';
								} else {
									contactForm.insertAdjacentHTML( 'afterbegin', ` <div class="contact_error"> ${data.data} </div> ` );
                            setTimeout(
									function() {
										contactForm.querySelector( '.contact_error' ).classList.add( 'remove_error' );
										contactForm.querySelector( '.contact_error' ).remove();
										},
									2000
									);
								}
								}
						);
					}
				}
			);
		}
	}
);
