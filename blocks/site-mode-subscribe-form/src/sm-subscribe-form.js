window.addEventListener('DOMContentLoaded', (event) => {
	const subscribeForm = document.querySelector('.sm__subscribe-form');
	const subscribeFormName = document.querySelector('#sm-subscribe-name');
	const subscribeFormEmail = document.querySelector('#sm-subscribe-email');
	const subscribeFormNonce = document.querySelector('#sm-subscribe-nonce');
	const smSubscribeFormURL = smSubscribeForm.ajax_url;
	if(subscribeForm) {
		subscribeForm.addEventListener('submit', (event) => {
			event.preventDefault();
			if(subscribeFormName.value !== '' && subscribeFormEmail.value !== '' && subscribeFormNonce.value !== '') {
				const data = new FormData();
				data.append('action', 'insert_subscribes');
				data.append('name', subscribeFormName.value);
				data.append('email', subscribeFormEmail.value);
				data.append('nonce', subscribeFormNonce.value);
				fetch(smSubscribeFormURL, {
					method: 'POST',
					body: data,
				})
				.then(response => response.json())
				.then(data => {
					if(data.success) {
						subscribeForm.innerHTML = '<p>Thank you for contacting us.</p>';
					} else {
						subscribeForm.insertAdjacentHTML('afterbegin', data.data);
					}
				});
			}
		});
	}


});
