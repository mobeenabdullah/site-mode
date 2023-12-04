window.addEventListener('DOMContentLoaded', (event) => {

	const contactForm = document.querySelector('.sm-contact-form');
	const contactFormName = document.querySelector('#sm-contact-name');
	const contactFormEmail = document.querySelector('#sm-contact-email');

	if(contactForm) {
		contactForm.addEventListener('submit', (event) => {
			event.preventDefault();
			if(contactFormName.value !== '' && contactFormEmail.value !== '') {
				console.log(contactFormName.value);
			}
		});
	}


});
