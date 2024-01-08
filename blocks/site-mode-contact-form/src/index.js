import { registerBlockType } from '@wordpress/blocks';
import './style.scss';
import Edit from './edit';
import save from './save';

registerBlockType(
	'site-mode/contact-form',
	{
		edit: Edit,
		save,
	}
);
