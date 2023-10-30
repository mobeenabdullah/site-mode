import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, ToggleControl, SelectControl, CheckboxControl } from '@wordpress/components';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {

	const {
		labelUsername,
		defaultUsername,
		labelPassword,
		showRememberMe,
		labelSubmit,
		rememberMeLabel,
		defaultRememberMe,
		loggedInBehaviour,
	} = attributes;

	console.log(attributes);


	return (
		<div {...useBlockProps()}>

			<InspectorControls>
				<PanelBody title={__('Login Form Settings', 'site-mode')}>
					<ToggleControl
						label={__('Show Remember Me', 'site-mode')}
						onChange={() => setAttributes({ showRememberMe: !showRememberMe })}
						checked={showRememberMe}
					/>
					<SelectControl
						label={__('Logged in behaviour', 'site-mode')}
						value={loggedInBehaviour}
						onChange={(value) => setAttributes({ loggedInBehaviour: value })}
						options={[
							{ value: 'hide', label: __('Display nothing', 'site-mode') },
							{ value: 'user', label: __('Show "Logged in as USER. Log Out"', 'site-mode') },
							{ value: 'logout', label: __('Just the log out link', 'site-mode') },
							{ value: 'login', label: __('Show log in form', 'site-mode') },
						]}
					/>
				</PanelBody>
			</InspectorControls>

			<form>
				<p className="login-username">
					<RichText
						tagName="label"
						placeholder={__('Username or Email Address', 'site-mode')}
						keepPlaceholderOnFocus="true"
						onChange={(value) => setAttributes({ labelUsername: value })}
						value={labelUsername}
					/>
					<input
						type="text"
						className="input"
						placeholder={__('Default username', 'site-mode')}
						onChange={(event) => setAttributes({ defaultUsername: event.target.value })}
						value={defaultUsername}
						size="20"
					/>
				</p>
				<p className="login-password">
					<RichText
						tagName="label"
						placeholder={__('Password', 'site-mode')}
						keepPlaceholderOnFocus="true"
						onChange={(value) => setAttributes({ labelPassword: value })}
						value={labelPassword}
					/>
					<input type="password" className="input" size="20" value='********' readOnly />
				</p>
				{showRememberMe ?
					<>
						<p className="login-remember">
							<input
								type="checkbox"
								onChange={() => setAttributes({ defaultRememberMe: !defaultRememberMe })}
								checked={defaultRememberMe}
							/>
							<RichText
								tagName="label"
								placeholder={__('Remember Me', 'site-mode')}
								keepPlaceholderOnFocus="true"
								onChange={(value) => setAttributes({ rememberMeLabel: value })}
								value={rememberMeLabel}
							/>
						</p>
					</>
					: (<br />)
				}
				<p className="login-submit">
					<RichText
						tagName="label"
						className="wp-block-button__link"
						placeholder={__('Log In', 'site-mode')}
						keepPlaceholderOnFocus="true"
						onChange={(value) => setAttributes({ labelSubmit: value })}
						value={labelSubmit}
					/>
				</p>
			</form>

		</div>
	);
}
