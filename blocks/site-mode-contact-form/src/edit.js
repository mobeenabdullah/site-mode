import { __ } from '@wordpress/i18n';
import {RichText, useBlockProps, PanelColorSettings, InspectorControls} from '@wordpress/block-editor';
import {
	PanelBody,
	PanelRow,
	RangeControl,
	__experimentalBoxControl as BoxControl,
	__experimentalUnitControl as UnitControl
} from '@wordpress/components';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {

	const {
		nameLabel,
		emailLabel,
		namePlaceholder,
		emailPlaceholder,
		submitLabel,
		labelColor,
		inputBgColor,
		inputTextColor,
		inputBorderColor,
		inputBorderWidth,
		inputBorderRadius,
		inputPadding,
		btnTextColor,
		btnBgColor,
		btnBorderColor,
		btnBorderWidth,
		btnBorderRadius,
		btnPadding
	} = attributes;

	const smLabelColor = {
		color: labelColor ?  labelColor : 'transparent',
	}

	const smInputField = {
		backgroundColor: inputBgColor ? inputBgColor : 'transparent',
		color: inputTextColor ? inputTextColor : 'transparent',
		borderColor: inputBorderColor ? inputBorderColor : 'transparent',
		borderWidth: inputBorderWidth ? inputBorderWidth : 0,
		borderRadius: inputBorderRadius ? inputBorderRadius : 0,
		paddingTop: inputPadding.top ? inputPadding.top : '8px',
		paddingRight: inputPadding.right ? inputPadding.right : '16px',
		paddingBottom: inputPadding.bottom ? inputPadding.bottom : '8px',
		paddingLeft: inputPadding.left ? inputPadding.left : '16px',
	}

	const units = [
		{ value: 'px', label: 'px', default: 0 },
		{ value: '%', label: '%', default: 10 },
		{ value: 'em', label: 'em', default: 0 },
	];

	const buttonColors = {
		backgroundColor: btnBgColor ? btnBgColor : 'transparent',
		color: btnTextColor ? btnTextColor : 'transparent',
		borderColor: btnBorderColor ? btnBorderColor : 'transparent',
		borderWidth: inputBorderWidth ? inputBorderWidth : 0,
		borderRadius: inputBorderRadius ? inputBorderRadius : 0,
		paddingTop: inputPadding.top ? inputPadding.top : '8px',
		paddingRight: inputPadding.right ? inputPadding.right : '16px',
		paddingBottom: inputPadding.bottom ? inputPadding.bottom : '8px',
		paddingLeft: inputPadding.left ? inputPadding.left : '16px',
	}


	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Fields color settings', 'site-mode')} initialOpen={ false }>
					<PanelColorSettings
						title="Fields Color Settings"
						initialOpen={false}
						icon="admin-appearance"
						colorSettings={[
							{
								value: labelColor,
								onChange: (value) => setAttributes( { labelColor: value }),
								label: __('Label Color')
							},
							{
								value: inputBgColor,
								onChange: (value) => setAttributes( { inputBgColor: value }),
								label: __('Input Background Color')
							},
							{
								value: inputTextColor,
								onChange: (value) => setAttributes( { inputTextColor: value }),
								label: __('Input Text Color')
							},
							{
								value: inputBorderColor,
								onChange: (value) => setAttributes( { inputBorderColor: value }),
								label: __('Input Border Color')
							},
							{
								value: btnBgColor,
								onChange: (value) => setAttributes( { btnBgColor: value }),
								label: __('Button Background Color')
							},
							{
								value: btnTextColor,
								onChange: (value) => setAttributes( { btnTextColor: value }),
								label: __('Button Text Color')
							},
							{
								value: btnBorderColor,
								onChange: (value) => setAttributes( { btnBorderColor: value }),
								label: __('Button Border Color')
							}

						]}
					/>
				</PanelBody>
				<PanelBody title={__('Fields Settings', 'site-mode')} initialOpen={ false }>
						<RangeControl
							label="Border width"
							value={ inputBorderWidth }
							onChange={ ( value ) => setAttributes({ inputBorderWidth: value }) }
							min={ 2 }
							max={ 10 }
						/>
						<UnitControl
							label="Border radius"
							onChange={ (value) => setAttributes({inputBorderRadius: value}) }
							value={ inputBorderRadius }
							units={ units }
						/>
						<BoxControl
							label="Padding"
							values={ inputPadding }
							onChange={ (nextValues) => setAttributes({inputPadding: nextValues}) }
						/>
				</PanelBody>

			</InspectorControls>
			<div {...useBlockProps()}>
				<form>
					<p className="login-username">
						<RichText
							tagName="label"
							placeholder={__('Full Name', 'site-mode')}
							keepPlaceholderOnFocus="true"
							onChange={(value) => setAttributes({ nameLabel: value })}
							value={nameLabel}
							style={smLabelColor}
						/>
						<input
							type="text"
							className="input"
							placeholder={__('John Doe', 'site-mode')}
							onChange={(event) => setAttributes({ namePlaceholder: event.target.value })}
							value={namePlaceholder}
							size="20"
							style={smInputField}
						/>
					</p>
					<p className="login-password">
						<RichText
							tagName="label"
							placeholder={__('Your Email', 'site-mode')}
							keepPlaceholderOnFocus="true"
							onChange={(value) => setAttributes({ emailLabel: value })}
							value={emailLabel}
							style={smLabelColor}
						/>
						<input
							type="text"
							className="input"
							placeholder={__('example@xyz.com', 'site-mode')}
							onChange={(event) => setAttributes({ emailPlaceholder: event.target.value })}
							value={emailPlaceholder}
							size="20"
							style={smInputField}
						/>
					</p>
					<p className="login-submit">
						<input
							type="submit"
							className="button button-primary"
							value={submitLabel}
							onChange={(event) => setAttributes({ submitLabel: event.target.value })}
							placeholder={__('Submit', 'site-mode')}
							size="20"
							style={buttonColors}
						/>
					</p>
				</form>
			</div>
		</>

	);
}
