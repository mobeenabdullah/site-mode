import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText } from '@wordpress/block-editor';
import './editor.scss';

export default function Edit() {
	return (
		<div {...useBlockProps()}>

			<form>
				login form
			</form>


			{__('Boilerplate – hello from the editor!', 'boilerplate')}
		</div>
	);
}
