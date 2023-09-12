import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import {useState, useEffect} from "@wordpress/element";
import { layouts } from '../constants';
import './editor.scss';
import {
	PanelBody,
	PanelRow,
	DateTimePicker,
	ToggleControl,
	SelectControl,
	TextControl,
	ColorPalette,
	MenuGroup, MenuItem,
	__experimentalUnitControl as UnitControl
} from '@wordpress/components';


export default function Edit({ attributes, setAttributes }) {
	const {
		dueDate,
		showLabel,
		showDays,
		showHours,
		showMinutes,
		showSeconds,
		showSeperator,
		preset,
		labels,
		colors,
		height,
		width
	} = attributes;
	const [ isInvalidDate, setIsInvalidDate ] = useState( false );
	const [days, setDays] = useState();
	const [hours, setHours] = useState();
	const [minutes, setMinutes] = useState();
	const [seconds, setSeconds] = useState();
	const [intervalCount, setIntervalCount] = useState();


	useEffect(() => {
		if(dueDate) {
			clearInterval(intervalCount);
			const interval = setInterval(countdownHandler, 1000);
			setIntervalCount(interval);
		} else {
			clearInterval(intervalCount);
			setIntervalCount(null);
		}
	}, [dueDate]);

	function countdownHandler() {
		const now = new Date();
		const nowUTC = new Date(now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate(), now.getUTCHours(), now.getUTCMinutes(), now.getUTCSeconds());
		const end = new Date(dueDate);
		const endUTC = new Date(end.getUTCFullYear(), end.getUTCMonth(), end.getUTCDate(), end.getUTCHours(), end.getUTCMinutes(), end.getUTCSeconds());
		const timeleft = endUTC - nowUTC;
		let smDays = Math.floor(timeleft / (1000 * 60 * 60 * 24));
		let smHours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		let smMinutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
		let smSeconds = Math.floor((timeleft % (1000 * 60)) / 1000);

		if(!showDays) {
			smHours = smHours + (smDays * 24);
			smDays = 0;
		}
		if(!showHours) {
			smMinutes = smMinutes + (smHours * 60);
			smHours = 0;
		}
		if(!showMinutes) {
			smSeconds = smSeconds + (smMinutes * 60);
			smMinutes = 0;
		}
		if(!showSeconds) {
			smSeconds = 0;
		}

		if(smSeconds > 0 || smDays > 0 || smHours > 0 || smMinutes > 0 ){
			setDays(smDays);
			setHours(smHours);
			setMinutes(smMinutes);
			setSeconds(smSeconds);
		} else {
			setDays(0);
			setHours(0);
			setMinutes(0);
			setSeconds(0);
			clearInterval(intervalCount);
			setIntervalCount(null);
		}
	}


	const onChangeDate = ( newDate ) => {
		const now = new Date();
		const nowUTC = new Date(now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate(), now.getUTCHours(), now.getUTCMinutes(), now.getUTCSeconds());

		if( new Date(newDate) < nowUTC) {
			setIsInvalidDate(true)
			setAttributes( { dueDate: '' } )
		} else {
			setIsInvalidDate(false)
			setAttributes( { dueDate: newDate } )
		}
	}

	const resetColors = () => {
		setAttributes({colors: {
			bgColor: '#000000',
			labelColor: '#ffffff',
			borderColor: '#ffffff',
			seperatorColor: '#ffffff',
			timerColor: '#ffffff',
		}})
	}

	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Settings', 'site-mode')} initialOpen={ true }>
					<PanelRow>
						{isInvalidDate && (
							<p className="error-message">
								{__('Please select a date in the future.', 'site-mode')}
							</p>
						)}

						<DateTimePicker
							currentDate={ dueDate }
							onChange={ onChangeDate }
							is12Hour={ true }
						/>
					</PanelRow>
				</PanelBody>
				<PanelBody title={__('Layout', 'site-mode')} initialOpen={ false }>
					<PanelRow>
						<SelectControl
							label="Presets"
							value={ preset }
							onChange={ ( value ) => setAttributes( { preset: value } ) }
							options={ layouts }
						/>
					</PanelRow>
					<PanelRow>
						<ToggleControl
							label="Show Label"
							checked={ showLabel }
							onChange={ () => setAttributes( { showLabel: ! showLabel } ) }
						/>
					</PanelRow>
					<PanelRow>
						<ToggleControl
							label="Show Days"
							checked={ showDays }
							onChange={ () => setAttributes( { showDays: ! showDays } ) }
						/>
					</PanelRow>
					<PanelRow>
						<ToggleControl
							label="Show Hours"
							checked={ showHours }
							onChange={() => setAttributes( { showHours: ! showHours })}
						/>
					</PanelRow>

					<PanelRow>
						<ToggleControl
							label="Show Minutes"
							checked={ showMinutes }
							onChange={() => setAttributes( { showMinutes: ! showMinutes })}
						/>
					</PanelRow>
					<PanelRow>
						<ToggleControl
							label="Show Seconds"
							checked={ showSeconds }
							onChange={() => setAttributes( { showSeconds: ! showSeconds })}
						/>
					</PanelRow>
					<PanelRow>
						<ToggleControl
							label="Show Seperator"
							checked={ showSeperator }
							onChange={() => setAttributes( { showSeperator: ! showSeperator })}
						/>
					</PanelRow>
					{ showDays && (
						<PanelRow>
							<TextControl
								label="Days Label"
								value={ labels.days }
								onChange={ ( value ) => setAttributes( { labels: { ...labels, days: value } } ) }
							/>
						</PanelRow>
					)}
					{ showHours && (
						<PanelRow>
							<TextControl
								label="Hours Label"
								value={ labels.hours }
								onChange={ ( value ) => setAttributes( { labels: { ...labels, hours: value } } ) }
							/>
						</PanelRow>
					)}
					{ showMinutes && (
						<PanelRow>
							<TextControl
								label="Minutes Label"
								value={ labels.minutes }
								onChange={ ( value ) => setAttributes( { labels: { ...labels, minutes: value } } ) }
							/>
						</PanelRow>
					)}
					{ showSeconds && (
						<PanelRow>
							<TextControl
								label="Seconds Label"
								value={ labels.seconds }
								onChange={ ( value ) => setAttributes( { labels: { ...labels, seconds: value } } ) }
							/>
						</PanelRow>
					)}
				</PanelBody>
				<PanelBody title={__('Styles', 'site-mode')} initialOpen={ false }>
					<PanelRow>
						<ColorPalette
							label="Background Color"
							value={ colors.bgColor }
							onChange={ ( value ) => setAttributes({colors: {...colors, bgColor: value}} ) }
						/>
					</PanelRow>
					<PanelRow>
						<ColorPalette
							label="Label Color"
							value={ colors.labelColor }
							onChange={ ( value ) => setAttributes({colors: {...colors, labelColor: value}} ) }
						/>
					</PanelRow>
					<PanelRow>
						<ColorPalette
							label="Border Color"

							value={ colors.borderColor }
							onChange={ ( value ) => setAttributes({colors: {...colors, borderColor: value}} ) }
						/>
					</PanelRow>
					<PanelRow>
						<ColorPalette
							label="Seperator Color"
							value={ colors.seperatorColor }
							onChange={ ( value ) => setAttributes({colors: {...colors, seperatorColor: value}} ) }
						/>
					</PanelRow>
					<PanelRow>
						<ColorPalette
							label="Time Color"
							value={ colors.timerColor }
							onChange={ ( value ) => setAttributes({colors: {...colors, timerColor: value}} ) }
						/>
					</PanelRow>
					<PanelRow>
						<UnitControl
							label="Height"
							value={ height }
							onChange={ ( value ) => setAttributes( { height: value } ) }
						/>
					</PanelRow>
					<PanelRow>
						<UnitControl
							label="Width"
							value={ width }
							onChange={ ( value ) => setAttributes( { width: value } ) }
						/>
					</PanelRow>

				</PanelBody>
			</InspectorControls>
			<div {...useBlockProps()}>

				{dueDate && (
					<div className="countdown_main-wrapper">
						<div className={`countdown-wrapper ${preset}`}>
								{showDays && (
									<div className="sm-countdown-box sm-countdown-days-wrapper">
										<div className="sm-countdown-days-label countdown_label">{showLabel && __(labels.days, 'site-mode')}</div>
										<div className="sm-countdown-days countdown_number">
											<span>{days}</span>
										</div>
									</div>
								)}
								{showSeperator && showDays && <span className="countdown-seperator">:</span>}
								{showHours && (
									<div className="sm-countdown-box sm-countdown-days-wrapper">
										<div className="sm-countdown-days-label countdown_label">{showLabel && __(labels.hours, 'site-mode')}</div>
										<div className="sm-countdown-days countdown_number">
											<span>{hours}</span>
										</div>
									</div>
								)}
								{showSeperator && showHours && <span className="countdown-seperator">:</span>}
								{showMinutes && (
									<div className="sm-countdown-box sm-countdown-hours-wrapper">
										<div className="sm-countdown-hours-label countdown_label">{showLabel && __(labels.minutes, 'site-mode')}</div>
										<div className="sm-countdown-hours countdown_number">
											<span>{minutes}</span>
										</div>
									</div>
								)}
								{showSeperator && showMinutes && showSeconds && <span className="countdown-seperator">:</span>}
								{showSeconds && (
									<div className="sm-countdown-box sm-countdown-minutes-wrapper">
										<div className="sm-countdown-minutes-label countdown_label">{showLabel && __(labels.seconds, 'site-mode')}</div>
										<div className="sm-countdown-minutes countdown_number">
											<span>{seconds}</span>
										</div>
									</div>
								)}
						</div>
					</div>
				)}
			</div>
		</>
	);
}
