import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import Countdown from "react-countdown";
import {useState, useEffect} from "@wordpress/element";

export default function save({attributes}) {
	const { dueDate, showLabel, showDays, showHours, showMinutes, showSeconds, showSeperator, labels} = attributes;

	let expireDate;

	useEffect(() => {
		if(dueDate) {
			expireDate = new Date(dueDate);
		} else {
			expireDate = '';
		}
	}, [dueDate]);

	return (
		<div { ...useBlockProps.save() }>
			{expireDate && (
				<Countdown
					date={expireDate}
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
	);
}
