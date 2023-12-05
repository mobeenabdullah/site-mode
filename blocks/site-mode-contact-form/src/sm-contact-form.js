window.addEventListener('DOMContentLoaded', (event) => {

	const contactForm = document.querySelector('.sm-contact-form');
	const contactFormName = document.querySelector('#sm-contact-name');
	const contactFormEmail = document.querySelector('#sm-contact-email');
	const contactFormNonce = document.querySelector('#sm-contact-nonce');
	const smContactFormURL = smContactForm.ajax_url;

	if(contactForm) {
		contactForm.addEventListener('submit', (event) => {
			event.preventDefault();
			if(contactFormName.value !== '' && contactFormEmail.value !== '' && contactFormNonce.value !== '') {
				console.log(contactFormName.value);
				console.log(contactFormEmail.value);
				console.log(contactFormNonce.value);
				const data = new FormData();
				data.append('action', 'sm_contact_form');
				data.append('name', contactFormName.value);
				data.append('email', contactFormEmail.value);
				data.append('nonce', contactFormNonce.value);
				fetch(smContactFormURL, {
					method: 'POST',
					body: data,
				})
				.then(response => response.json())
				.then(data => {
					console.log(data);
					if(data.success) {
						contactForm.innerHTML = '<p>Thank you for contacting us.</p>';
					} else {
						contactForm.innerHTML = '<p>Sorry, there was a problem.</p>';
					}
				});
			}
		});
	}


});
