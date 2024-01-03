import { registerBlockType } from '@wordpress/blocks';
import './style.scss';
import Edit from './edit';
import save from './save';

registerBlockType(
	'site-mode/countdown',
	{
		edit: Edit,
		save,
	}
);
