/*
window.addEventListener(
	'DOMContentLoaded',
	(event) => {
    const contactForm      = document.querySelector( '.sm__contact-form' );
    const contactFormName  = document.querySelector( '#sm-contact-name' );
    const contactFormEmail = document.querySelector( '#sm-contact-email' );
	const contactFormMessage = document.querySelector( '#sm-contact-message' );
    const contactFormNonce = document.querySelector( '#sm-contact-nonce' );
    const smContactFormURL = smContactForm.ajax_url;
		if (contactForm) {
			contactForm.addEventListener(
				'submit',
				(event) => {
					console.log('contact form submit')
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
						contactFormName.insertAdjacentHTML( 'afterend', ` <span class="contact_field_error"> Please enter your name.</span> ` );
						contactFormName.focus();
						contactFormName.classList.add( 'sm_error_field' );
						return false;
					}
					if ((contactFormEmail.value == null || contactFormEmail.value === "")) {
						contactFormEmail.insertAdjacentHTML( 'afterend', ` <span class="contact_field_error"> Please enter your email.</span> ` );
						contactFormEmail.focus();
						contactFormEmail.classList.add( 'sm_error_field' );
						validateEmail( contactFormEmail.value );
						return false;
					}
					if ( ! validateEmail( contactFormEmail.value )) {
						contactFormEmail.insertAdjacentHTML( 'afterend', ` <span class="contact_field_error"> Please enter valid email.</span> ` );
						contactFormEmail.focus();
						contactFormEmail.classList.add( 'sm_error_field' );
						return false;
					}
					if ((contactFormMessage.value == null || contactFormMessage.value === "")) {
						contactFormMessage.insertAdjacentHTML( 'afterend', ` <span class="contact_field_error"> Please enter message.</span> ` );
						contactFormMessage.focus();
						contactFormMessage.classList.add( 'sm_error_field' );
						return false;
					}
					if (contactFormName.value !== '' && contactFormEmail.value !== '' && contactFormNonce.value !== '') {
						const data = new FormData();
						data.append( 'action', 'send_email' );
						data.append( 'name', contactFormName.value );
						data.append( 'email', contactFormEmail.value );
						data.append( 'message', contactFormMessage.value );
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
									console.log('success');
									contactForm.innerHTML = '<div class="sm_submit_success">Thank you for contacting us!</div>';
								} else {
									console.log('error');
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
*/


window.addEventListener('DOMContentLoaded', (event) => {
	const contactForm = document.querySelector('.sm__contact-form');
	const contactFormName = document.querySelector('#sm-contact-name');
	const contactFormEmail = document.querySelector('#sm-contact-email');
	const contactFormSubject = document.querySelector('#sm-contact-subject');
	const contactFormMessage = document.querySelector('#sm-contact-message');
	const contactFormNonce = document.querySelector('#sm-contact-nonce');
	const smContactFormURL = smContactForm.ajax_url;

	const validateEmail = (email) => {
		return email.match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
	};

	if (contactForm) {
		contactForm.addEventListener('submit', (event) => {
			event.preventDefault();
			console.log('Contact form submit');

			// Clear previous errors
			document.querySelectorAll('.contact_field_error').forEach(el => el.remove());

			let isValid = true;

			// Name validation
			if (!contactFormName.value.trim()) {
				contactFormName.insertAdjacentHTML('afterend', '<span class="contact_field_error">Please enter your name.</span>');
				isValid = false;
			}

			// Email validation
			if (!contactFormEmail.value.trim()) {
				contactFormEmail.insertAdjacentHTML('afterend', '<span class="contact_field_error">Please enter your email.</span>');
				isValid = false;
			} else if (!validateEmail(contactFormEmail.value)) {
				contactFormEmail.insertAdjacentHTML('afterend', '<span class="contact_field_error">Please enter a valid email.</span>');
				isValid = false;
			}

			// Message validation
			if (!contactFormSubject.value.trim()) {
				contactFormSubject.insertAdjacentHTML('afterend', '<span class="contact_field_error">Please enter a subject.</span>');
				isValid = false;
			}

			// Message validation
			if (!contactFormMessage.value.trim()) {
				contactFormMessage.insertAdjacentHTML('afterend', '<span class="contact_field_error">Please enter a message.</span>');
				isValid = false;
			}

			if (!isValid) return;

			// Form data for submission
			const data = new FormData();
			data.append('action', 'send_email_cb');
			data.append('name', contactFormName.value);
			data.append('email', contactFormEmail.value);
			data.append('subject', contactFormSubject.value);
			data.append('message', contactFormMessage.value);
			data.append('nonce', contactFormNonce.value);

			fetch(smContactFormURL, {
				method: 'POST',
				body: data,
			})
				.then(response => response.json())
				.then(data => {
					if (data.status === 'Success') {
						contactForm.innerHTML = '<div class="sm_submit_success">Thank you for contacting us!</div>';
					} else {
						contactForm.insertAdjacentHTML('beforebegin', `<div class="contact_error">${data.message}</div>`);
						setTimeout(() => {
							document.querySelector('.contact_error')?.remove();
						}, 2000);
					}
				})
				.catch(error => {
					console.error('Fetch error:', error);
					contactForm.insertAdjacentHTML('beforebegin', `<div class="contact_error">An error occurred while sending the message.</div>`);
					setTimeout(() => {
						document.querySelector('.contact_error')?.remove();
					}, 50000);
				});
		});
	}
});
