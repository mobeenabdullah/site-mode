import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import {PanelBody,PanelRow, DateTimePicker, ToggleControl, SelectControl, TextControl } from '@wordpress/components';
import {useState, useEffect} from "@wordpress/element";
import Countdown from 'react-countdown';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
	const { dueDate, showLabel, showDays, showHours, showMinutes, showSeconds, showSeperator, preset, labels} = attributes;
	const [ isInvalidDate, setIsInvalidDate ] = useState( false );
	const [date, setDate] = useState();

	useEffect(() => {
		if(dueDate) {
			setDate(new Date(dueDate));
		} else {
			setDate('');
		}
	}, [dueDate]);

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

	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Settings', 'site-mode')} initialOpen={ false }>
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
							options={ [
								{ label: 'Preset 1', value: 'preset-1' },
								{ label: 'Preset 2', value: 'preset-2' },
								{ label: 'Preset 3', value: 'preset-3' },
							]}
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

			</InspectorControls>
			<div {...useBlockProps()}>
				{date && (
					<Countdown
						date={new Date(date)}
						daysInHours={!showDays}
						intervalDelay={1000}
						renderer={props => {
							const {days, hours, minutes, seconds, completed} = props.formatted;
							if(completed) return '';

							return (
								<div className="countdown">
									{showDays && <span className="countdown-days">{days} {showLabel && __(labels.days, 'site-mode')}</span>}
									{showSeperator && showDays && <span className="countdown-seperator">:</span>}
									{showHours && <span className="countdown-hours">{hours} {showLabel && __(labels.hours, 'site-mode')}</span>}
									{showSeperator && showHours && <span className="countdown-seperator">:</span>}
									{showMinutes && <span className="countdown-minutes">{minutes} {showLabel && __(labels.minutes, 'site-mode')}</span>}
									{showSeperator && showMinutes && showSeconds && <span className="countdown-seperator">:</span>}
									{showSeconds && <span className="countdown-seconds">{seconds} {showLabel && __(labels.seconds, 'site-mode')}</span>}
								</div>
							)
						}}
					/>
				)}

			</div>
		</>
	);
}
