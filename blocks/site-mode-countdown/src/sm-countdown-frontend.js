var daysWrapper = document.querySelector('.sm-countdown-days');
var hoursWrapper = document.querySelector('.sm-countdown-hours');
var minutesWrapper = document.querySelector('.sm-countdown-minutes');
var secondsWrapper = document.querySelector('.sm-countdown-seconds');
function countdownHandler(countInterval) {
	const now = new Date();
	const nowUTC = new Date(now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate(), now.getUTCHours(), now.getUTCMinutes(), now.getUTCSeconds());
	const endUTC = new Date(end.getUTCFullYear(), end.getUTCMonth(), end.getUTCDate(), end.getUTCHours(), end.getUTCMinutes(), end.getUTCSeconds());
	const timeleft = endUTC - nowUTC;
	let days = Math.floor(timeleft / (1000 * 60 * 60 * 24));
	let hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	let minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
	let seconds = Math.floor((timeleft % (1000 * 60)) / 1000);

	if(!daysWrapper) {
		hours = hours + (days * 24);
		days = 0;
	}
	if(!hoursWrapper) {
		minutes = minutes + (hours * 60);
		hours = 0;
	}
	if(!minutesWrapper) {
		seconds = seconds + (minutes * 60);
		minutes = 0;
	}
	if(!secondsWrapper) {
		seconds = 0;
	}

	if(seconds > 0 || days > 0 || hours > 0 || minutes > 0 ){
		document.querySelector('.countdown_main-wrapper').style.display = 'block';
		setCount(days, hours, minutes, seconds);

	} else {
		clearInterval(countInterval);
		document.querySelector('.countdown_main-wrapper').innerHTML = '';
	}
}

function setCount(days, hours, minutes, seconds) {
	const daysArr = days.toString().split('');
	const hoursArr = hours.toString().split('');
	const minutesArr = minutes.toString().split('');
	const secondsArr = seconds.toString().split('');
	if(daysWrapper !== null) {
		daysWrapper.innerHTML = setCountContent(daysArr);
	}
	if(hoursWrapper !== null) {
		hoursWrapper.innerHTML = setCountContent(hoursArr);
	}
	if(minutesWrapper !== null) {
		minutesWrapper.innerHTML = setCountContent(minutesArr);
	}
	if(secondsWrapper !== null) {
		secondsWrapper.innerHTML = setCountContent(secondsArr);
	}
}

function setCountContent(intervalArr) {
	let content = '';
	if(intervalArr.length === 1) {
		content += `<span>0</span>`;
	}
	intervalArr.forEach((item) => {
		content += `<span>${item}</span>`;
	});
	return content;
}

var end = '';
window.addEventListener('DOMContentLoaded', (event) => {
	const dueDateSelector = document.querySelector('.due-date')

	if(dueDateSelector && dueDateSelector.value !== ''){
		const dueDate = dueDateSelector.value;
		end = new Date(dueDate);
		var countInterval = setInterval(countdownHandler, 1000);
		countdownHandler(countInterval);
	}
});
