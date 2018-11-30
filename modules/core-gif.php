<?php
$tag = isset($_GET['tag']) ? $_GET['tag'] : "meme";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>GIF | Core Modules | Dynamics</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500|Roboto:300,400,500,700" rel="stylesheet">
		<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-red.min.css">
	</head>
	<body>
		<style>
			.mdl-card__supporting-text {
				margin: 0;
			}
			.card-logo {
				position: absolute;
				right: 24px;
				top: 50%;
				transform: translateY(-50%);
			}
			.rel-logo {
				position: relative;
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
		<div class="mdl-card__title" style="padding: 0;">
			<img src="gfycat.png" width="100%" id="gif">
		</div>
		<div class="mdl-card__actions mdl-card--border rel-logo">
			<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="another">
				Another Gif
			</a>
			<img src="gif.png" height="20" class="card-logo">
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script>
		const giphy = {
			baseURL: "https://api.giphy.com/v1/gifs/",
			key: "dc6zaTOxFJmzC",
			tag: "<?=$tag?>",
			type: "random",
			rating: "pg-13"
		};

		let giphyURL = encodeURI(
			giphy.baseURL +
			giphy.type +
			"?api_key=" +
			giphy.key +
			"&tag=" +
			giphy.tag +
			"&rating=" +
			giphy.rating
		);

		var newGif = () => $.getJSON(giphyURL, json => renderGif(json.data));
		var renderGif = _giphy => {
			$("#gif").attr("src", _giphy.image_original_url);
		};

		$(function(){
			newGif();
		});

		$("#another").click(function(){
			newGif();
		});
		</script>
	</body>
</html>