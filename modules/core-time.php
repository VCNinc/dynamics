<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Time | Core Modules | Dynamics</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500|Roboto:300,400,500,700" rel="stylesheet">
		<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-red.min.css">
	</head>
	<body>
		<style>
			.timezone {
				text-align: center;
			}
			.timezone h1.current-time {
				display: block;
				font-weight: 300;
				font-family: "Roboto", sans-serif;
				color: rgba(0,0,0,0.87);
				margin: 0;
			}
			.timezone p.current-time-zone {
				display: block;
				line-height: 32px;
				font-weight: 300;
				font-family: "Roboto", sans-serif;
				margin: 0;
				font-size: 22px;
			}
			.mdl-card__supporting-text {
				margin: auto;
			}
		</style>
		<div class="mdl-card__supporting-text">
			<div class="timezone">
				<h1 class="current-time"></h1>
				<p class="current-time-zone"></p>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.13/moment-timezone-with-data.min.js"></script>
		<script>
		$(function(){
			var timezone = moment.tz.guess();
			var timezone_string = timezone + " (UTC" + ((moment().tz(timezone).utcOffset()/60) > 0 ? '+' : '') + (moment().tz(timezone).utcOffset()/60) + ")";
			$(".current-time-zone").text(timezone_string);

			setInterval(function(){
				var time = moment.tz(timezone).format('h:mm:ss A');
				$(".current-time").text(time);
			}, 500);

			$("#result-" + results).html(answer);
			var time = moment.tz(timezone).format('hh:mm:ss A');
			$("#result-" + results + " .current-time").text(time);
			componentHandler.upgradeAllRegistered();
		});
		</script>
	</body>
</html>