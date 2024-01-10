window.addEventListener(
	'DOMContentLoaded',
	(event) => {
    const subscribeForm      = document.querySelector( '.sm__subscribe-form' );
    const subscribeFormName  = document.querySelector( '#sm-subscribe-name' );
    const subscribeFormEmail = document.querySelector( '#sm-subscribe-email' );
    const subscribeFormNonce = document.querySelector( '#sm-subscribe-nonce' );
    const smSubscribeFormURL = smSubscribeForm.ajax_url;
		if (subscribeForm) {
			subscribeForm.addEventListener(
				'submit',
				(event) => {
                event.preventDefault();
                const validateEmail      = (email) => {
                return email.match( /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/ );
					};
                const subscribeFormError = document.querySelector( '.sub_field_error' );
                const formError          = document.querySelector( '.subscribe_error' );
					if (formError) {
						formError.remove();
					}
					if (subscribeFormError) {
						subscribeFormError.remove();
						subscribeFormName.classList.remove( 'sm_error_field' );
					}
					if ((subscribeFormName.value == null || subscribeFormName.value === "")) {
						subscribeFormName.insertAdjacentHTML( 'afterend', ` <span class="sub_field_error"> Please enter your name.</span> ` );
						subscribeFormName.focus();
						subscribeFormName.classList.add( 'sm_error_field' );
						return false;
					}
					if ((subscribeFormEmail.value == null || subscribeFormEmail.value === "")) {
						subscribeFormEmail.insertAdjacentHTML( 'afterend', ` <span class="sub_field_error">Please enter your email.</span> ` );
						subscribeFormEmail.focus();
						subscribeFormEmail.classList.add( 'sm_error_field' );
						validateEmail( subscribeFormEmail.value );
						return false;
					}
					if ( ! validateEmail( subscribeFormEmail.value )) {
						subscribeFormEmail.insertAdjacentHTML( 'afterend', ` <span class="sub_field_error"> Please enter valid email.</span> ` );
						subscribeFormEmail.focus();
						subscribeFormEmail.classList.add( 'sm_error_field' );
						return false;
					}
					if (subscribeFormName.value !== '' && subscribeFormEmail.value !== '' && subscribeFormNonce.value !== '') {
						const data = new FormData();
						data.append( 'action', 'insert_subscribes' );
						data.append( 'name', subscribeFormName.value );
						data.append( 'email', subscribeFormEmail.value );
						data.append( 'nonce', subscribeFormNonce.value );
						fetch(
							smSubscribeFormURL,
							{
								method: 'POST',
								body: data,
								}
						)
						.then( response => response.json() )
						.then(
							data => {
								if (data.success) {
									subscribeForm.innerHTML = '<div class="sm_submit_success">Thank you for subscribing!</div>';
								} else {
                            subscribeForm.insertAdjacentHTML( 'afterbegin', ` <div class="subscribe_error"> ${data.data} </div> ` );
                            setTimeout(
									function() {
										subscribeForm.querySelector( '.subscribe_error' ).classList.add( 'remove_error' );
										subscribeForm.querySelector( '.subscribe_error' ).remove();
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
