<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Calendar | Core Modules | Dynamics</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500|Roboto:300,400,500,700" rel="stylesheet">
		<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-red.min.css">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.6.1/fullcalendar.min.css" rel="stylesheet">
	</head>
	<body>
		<style>
			.mdl-card__supporting-text {
				margin: 0;
			}
			.inline-title, .calendar h2 {
				display: block;
				line-height: 32px;
				margin-bottom: 8px;
				font-size: 24px;
				font-weight: 300;
				font-family: "Roboto", sans-serif;
				color: rgba(0,0,0,0.87);
				margin-top: 0;
			}
		</style>
		<div class="mdl-card__supporting-text">
			<div class="calendar"></div>
		</div>
		<div class="mdl-card__actions mdl-card--border rel-logo">
			<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
				Log Out
			</a>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.6.1/fullcalendar.min.js"></script>
		<script>
		$(function(){
			$.getJSON('https://holidayapi.com/v1/holidays?key=8360f161-1b34-4c2e-ae6e-85add453de1f&country=US&year=2017', function(data) {
				var holidays = [];
				for(var day in data.holidays) {
					for(var i = 0; i < data.holidays[day].length; i++) {
					var holiday = data.holidays[day][i];
						holidays.push({
							title: holiday.name,
							start: holiday.date,
							allDay: true,
							color: (holiday.public ? '#0D47A1' : '#1B5E20')
						})
					}
				}

				$(".calendar").fullCalendar({
					defaultDate: moment('2017-01-01'),
					validRange: {
						start: '2017-01-01',
						end: '2017-12-31'
					},
					events: holidays
				});
			});
		});
		</script>
	</body>
</html>