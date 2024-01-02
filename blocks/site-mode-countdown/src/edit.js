import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls, PanelColorSettings } from '@wordpress/block-editor';
import {useState, useEffect} from "@wordpress/element";
import './editor.scss';
import {
	PanelBody,
	PanelRow,
	DateTimePicker,
	ToggleControl,
	SelectControl,
	RadioControl,
} from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
	const {
		dueDate,
		showSeperator,
		preset,
		bgColor,
		numberColor,
		labelColor,
		borderColor,
		separatorColor,
		timeUnits,
		background,
		border,
	} = attributes;
	const [ isInvalidDate, setIsInvalidDate ] = useState( false );
	const [days, setDays]                     = useState();
	const [hours, setHours]                   = useState();
	const [minutes, setMinutes]               = useState();
	const [seconds, setSeconds]               = useState();
	const [intervalCount, setIntervalCount]   = useState();

	useEffect(
		() => {
        if (dueDate) {
            clearInterval( intervalCount );
            const interval = setInterval( countdownHandler, 1000 );
            setIntervalCount( interval );
        } else {
				clearInterval( intervalCount );
				setIntervalCount( null );
        }
		},
		[dueDate, timeUnits]
	);

	function countdownHandler() {
		const now      = new Date();
		const nowUTC   = new Date( now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate(), now.getUTCHours(), now.getUTCMinutes(), now.getUTCSeconds() );
		const end      = new Date( dueDate );
		const endUTC   = new Date( end.getUTCFullYear(), end.getUTCMonth(), end.getUTCDate(), end.getUTCHours(), end.getUTCMinutes(), end.getUTCSeconds() );
		const timeleft = endUTC - nowUTC;
		let smDays     = Math.floor( timeleft / (1000 * 60 * 60 * 24) );
		let smHours    = Math.floor( (timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60) );
		let smMinutes  = Math.floor( (timeleft % (1000 * 60 * 60)) / (1000 * 60) );
		let smSeconds  = Math.floor( (timeleft % (1000 * 60)) / 1000 );

		if ( ! timeUnits.includes( 'days' )) {
			smHours = smHours + (smDays * 24);
			smDays  = 0;
		}
		if ( ! timeUnits.includes( 'hours' )) {
			smMinutes = smMinutes + (smHours * 60);
			smHours   = 0;
		}
		if ( ! timeUnits.includes( 'minutes' )) {
			smSeconds = smSeconds + (smMinutes * 60);
			smMinutes = 0;
		}
		if ( ! timeUnits.includes( 'seconds' )) {
			smSeconds = 0;
		}

		if (smSeconds > 0 || smDays > 0 || smHours > 0 || smMinutes > 0 ) {
			setDays( smDays );
			setHours( smHours );
			setMinutes( smMinutes );
			setSeconds( smSeconds );
		} else {
			setDays( 0 );
			setHours( 0 );
			setMinutes( 0 );
			setSeconds( 0 );
			clearInterval( intervalCount );
			setIntervalCount( null );
		}
	}

	const onChangeDate = ( newDate ) => {
		const now      = new Date();
		const nowUTC   = new Date( now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate(), now.getUTCHours(), now.getUTCMinutes(), now.getUTCSeconds() );

		if (new Date( newDate ) < nowUTC) {
			setIsInvalidDate( true )
			setAttributes( {dueDate: ''} )
		} else {
			setIsInvalidDate( false )
			setAttributes( {dueDate: newDate} )
		}
	}

	const smCounterBox = {
		backgroundColor: background ? bgColor : 'transparent',
		borderColor: border ? borderColor : 'transparent',
	}

	const smCountdownDaysLabel = {
		color: labelColor,
	}

	const countdownNumber = {
		color: numberColor,
	}

	const countdownSeperator = {
		color: separatorColor
	}

	return (
		<>
			<InspectorControls >
				<PanelBody title         = {__( 'Time & Date', 'site-mode' )} initialOpen = { false }>
					<PanelRow>
						{isInvalidDate && (
							<p className = "error-message">
								{__( 'Please select a date in the future.', 'site-mode' )}
							</p>
						)}

						<DateTimePicker
							currentDate = { dueDate }
							onChange    = { onChangeDate }
							is12Hour    = { true }
						/>
					</PanelRow>
				</PanelBody>
				<PanelBody title       = {__( 'Layout', 'site-mode' )} initialOpen = { false }>
					<PanelRow>
						<RadioControl
							label       = "Shape"
							options     = { [
								{ label: 'Radius', value: 'default-countdown' },
								{ label: 'Circle', value: 'countdown-circle' },
								{ label: 'Square', value: 'countdown-without-box'}
								] }
							onChange    = { ( value ) => setAttributes( {preset: value} ) }
						/>
					</PanelRow>
					<PanelRow>
						<SelectControl
							multiple    = {true}
							label       = { __( 'Time Units' ) }
							value       = {  timeUnits }
							onChange    = { ( value ) => setAttributes( {timeUnits : value} )}
							options     = { [
								{ value: '', label: 'Select Time Units', disabled: true },
								{ value: 'days', label: 'Days' },
								{ value: 'hours', label: 'Hours' },
								{ value: 'minutes', label: 'Minutes' },
								{ value: 'seconds', label: 'Seconds'},
								] }
							__nextHasNoMarginBottom
						/>
					</PanelRow>
					<PanelRow>
						<ToggleControl
							label       = "Background"
							checked     = { background }
							onChange    = {() => setAttributes( { background: ! background } )}
						/>
					</PanelRow>
					<PanelRow>
						<ToggleControl
							label       = "Border"
							checked     = { border }
							onChange    = {() => setAttributes( { border: ! border } )}
						/>
					</PanelRow>
					<PanelRow>
						<ToggleControl
							label       = "Seperator"
							checked     = { showSeperator }
							onChange    = {() => setAttributes( { showSeperator: ! showSeperator } )}
						/>
					</PanelRow>

				</PanelBody>
				<PanelBody title = {__( 'Colors & Background', 'site-mode' )} initialOpen = { false }>

					<PanelColorSettings
						title         = "Color Settings"
						initialOpen   = {true}
						icon          = "admin-appearance"
						colorSettings = {[
							{
								value: bgColor,
								onChange: (value) => setAttributes( { bgColor: value } ),
								label: __( 'Background Color' )
							},
							{
								value: labelColor,
								onChange: (value) => setAttributes( { labelColor: value } ),
								label: __( 'Label Color' )
							},
							{
								value: borderColor,
								onChange: (value) => setAttributes( { borderColor: value } ),
								label: __( 'Border Color' )
							},
							{
								value: numberColor,
								onChange: (value) => setAttributes( { numberColor: value } ),
								label: __( 'Number Color' )
							},
							{
								value: separatorColor,
								onChange: (value) => setAttributes( { separatorColor: value } ),
								label: __( 'Separator Color' )
							}
							]}
					/>
				</PanelBody>
			</InspectorControls>

			<div {...useBlockProps()}>

				{dueDate ? (
					<>
						<div className="countdown_main-wrapper">
							<div className={`countdown-wrapper ${preset}`}>
									{timeUnits.includes( 'days' ) && (
										<div className="sm-countdown-box sm-countdown-days-wrapper" style = {smCounterBox}>
											<div className="sm-countdown-days-label countdown_label" style = {smCountdownDaysLabel} > { __( 'Days', 'site-mode' )} </div>
											<div className="sm-countdown-days countdown_number">
												<span style={countdownNumber}>{days} </span>
											</div>
										</div>
									)}
									{showSeperator && timeUnits.includes( 'days' ) && < span className = "countdown-seperator" style = {countdownSeperator} > : < / span > }
									{timeUnits.includes( 'hours' ) && (
										<div className      = "sm-countdown-box sm-countdown-days-wrapper" style = {smCounterBox}>
											<div className  = "sm-countdown-days-label countdown_label" style = {smCountdownDaysLabel} > {__( 'Hours', 'site-mode' )} </div>
											<div className  = "sm-countdown-days countdown_number">
												<span style = {countdownNumber} > {hours} </span>
											</div>
										</div>
									)}
									{showSeperator && timeUnits.includes( 'hours' ) && < span className = "countdown-seperator" style = {countdownSeperator} > : < / span > }
									{timeUnits.includes( 'minutes' ) && (
										<div className ="sm-countdown-box sm-countdown-hours-wrapper" style={smCounterBox}>
											<div className="sm-countdown-hours-label countdown_label" style = {smCountdownDaysLabel}> {__( 'Minutes', 'site-mode' )} </div>
											<div className="sm-countdown-hours countdown_number">
												<span style={countdownNumber}>{minutes}</span>
											</div>
										</div>
									)}
									{showSeperator && timeUnits.includes( 'minutes' ) && timeUnits.includes( 'seconds' ) && < span className = "countdown-seperator" style = {countdownSeperator} > : < / span > }
									{timeUnits.includes( 'seconds' ) && (
										<div className="sm-countdown-box sm-countdown-minutes-wrapper" style={smCounterBox}>
											<div className="sm-countdown-minutes-label countdown_label" style={smCountdownDaysLabel}> {__( 'Seconds', 'site-mode' )} </div>
											<div className="sm-countdown-minutes countdown_number">
												<span style={countdownNumber}>{seconds}</span>
											</div>
										</div>
									)}
							</div>
						</div>
					</>
				)
				: <p> Timer not set ! </p>
				}
			</div>
		</>
	);
}
