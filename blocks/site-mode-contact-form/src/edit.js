import { __ } from '@wordpress/i18n';
import {RichText, useBlockProps} from '@wordpress/block-editor';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {

	const {
		nameLabel,
		emailLabel,
		namePlaceholder,
		emailPlaceholder,
		submitLabel,
	} = attributes;


	return (
		<div {...useBlockProps()}>
			<form>
				<p className="login-username">
					<RichText
						tagName="label"
						placeholder={__('Full Name', 'site-mode')}
						keepPlaceholderOnFocus="true"
						onChange={(value) => setAttributes({ nameLabel: value })}
						value={nameLabel}
					/>
					<input
						type="text"
						className="input"
						placeholder={__('John Doe', 'site-mode')}
						onChange={(event) => setAttributes({ namePlaceholder: event.target.value })}
						value={namePlaceholder}
						size="20"
					/>
				</p>
				<p className="login-password">
					<RichText
						tagName="label"
						placeholder={__('Your Email', 'site-mode')}
						keepPlaceholderOnFocus="true"
						onChange={(value) => setAttributes({ emailLabel: value })}
						value={emailLabel}
					/>
					<input
						type="text"
						className="input"
						placeholder={__('example@xyz.com', 'site-mode')}
						onChange={(event) => setAttributes({ emailPlaceholder: event.target.value })}
						value={emailPlaceholder}
						size="20"
					/>
				</p>
				<p className="login-submit">
					<input
						type="text"
						className="button button-primary"
						value={submitLabel}
						onChange={(event) => setAttributes({ submitLabel: event.target.value })}
						placeholder={__('Submit', 'site-mode')}
						size="20"
					/>
				</p>
			</form>
		</div>
	);
}
