function countdownHandler(countInterval) {
	const now = new Date();
	const nowUTC = new Date(now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate(), now.getUTCHours(), now.getUTCMinutes(), now.getUTCSeconds());
	const endUTC = new Date(end.getUTCFullYear(), end.getUTCMonth(), end.getUTCDate(), end.getUTCHours(), end.getUTCMinutes(), end.getUTCSeconds());
	const timeleft = endUTC - nowUTC;
	const days = Math.floor(timeleft / (1000 * 60 * 60 * 24));
	const hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	const minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
	const seconds = Math.floor((timeleft % (1000 * 60)) / 1000);

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
	const daysWrapper = document.querySelector('.sm-countdown-days');
	const hoursWrapper = document.querySelector('.sm-countdown-hours');
	const minutesWrapper = document.querySelector('.sm-countdown-minutes');
	const secondsWrapper = document.querySelector('.sm-countdown-seconds');
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
	const dueDate = document.querySelector('.due-date').value;
	if(dueDate !== ''){
		end = new Date(dueDate);
		var countInterval = setInterval(countdownHandler, 1000);
		countdownHandler(countInterval);
	}
});
