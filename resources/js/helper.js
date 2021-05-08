window._formatNumber = function (val) {
	val = val || '0'
	return val.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
}

window._stringifyNumber = function (val) {
	return parseInt(val) < 10 ? '0' + val : '' + val
}

window._addDays = function (date, days) {
	const copy = new Date(Number(date))
	copy.setDate(date.getDate() + days)
	return copy
}

// supported format: second, minute, hour, day, date, month, monthName, year, iso. example: 'day, date month year'
window._formatDate = function (val = new Date(), format = 'year-month-date') {
	const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', `Friday`, 'Saturday']
	const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']

	if (!(val instanceof Date && !isNaN(val.valueOf()))) val = new Date(val)

	let res = format
	if (format.includes('second')) res = res.replace('second', this._stringifyNumber(val.getSeconds()))
	if (format.includes('minute')) res = res.replace('minute', this._stringifyNumber(val.getMinutes()))
	if (format.includes('hour')) res = res.replace('hour', this._stringifyNumber(val.getHours()))
	if (format.includes('day')) res = res.replace('day', days[val.getDay()])
	if (format.includes('date')) res = res.replace('date', this._stringifyNumber(val.getDate()))
	if (format.includes('monthName')) res = res.replace('monthName', months[val.getMonth()])
	else if (format.includes('month')) res = res.replace('month', this._stringifyNumber(parseInt(val.getMonth()) + 1))
	if (format.includes('year')) res = res.replace('year', val.getFullYear())
	if (format.includes('iso')) res = this._formatDate(val, 'year-month-dateThour:minute:second.000Z')

	return res
}