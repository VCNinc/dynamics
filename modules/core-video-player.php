<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Video Player | Core Modules | Dynamics</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500|Roboto:300,400,500,700" rel="stylesheet">
		<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-red.min.css">
	</head>
	<body>
		<style>
			.upload-area {
				height: 100vh;
				width: 100vw;
				position: relative;
			}
			.file-icon {
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				text-align: center;
				padding: 20px 40px;
				width: 120px;
				border: 3px dashed #3F51B5;
				border-radius: 8px;
				transition: all 0.1s linear;
				will-change: transform;
			}
			.file-icon img {
				height: 96px;
			}
			.file-icon p {
				text-transform: uppercase;
				padding-top: 6px;
				font-size: 14px;
				text-align: center;
				font-family: 'Roboto', sans-serif;
				font-weight: 800;
				color: #3F51B5;
				margin-bottom: 0;
				padding-bottom: 0;
			}
			.module-label.core {
				width: 50px;
				text-align: center;
				padding: 3px;
				font-size: 10px;
				font-family: 'Roboto', sans-serif;
				font-weight: 500;
				text-transform: uppercase;
				position: fixed;
				right: 8px;
				top: 8px;
				background: #3F51B5;
				color: #FFF;
				border-radius: 4px;
			}
			.module-label {
				pointer-events: none;
			}
			.file-icon * {
				pointer-events: none;
			}
			.file-icon.in {
				border: 3px solid #3F51B5;
				transform: translate(-50%, -50%) scale(1.1);
			}
			#file {
				width: 0.1px;
				height: 0.1px;
				opacity: 0;
				overflow: hidden;
				position: absolute;
				z-index: -1;
			}

			#video {
				position: fixed;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				width: 100%;
				height: 100%;
				display: none;
			}
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<div class="upload-area">
			<div class="file-icon">
				<img src="video-file.svg">
				<p>Drop Video Here</p>
			</div>
		</div>
		<video controls autoplay id="video"></video>
		<div class="module-label core">Core</div>
		<script>
		$(function(){
			$(".file-icon").on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
				e.preventDefault();
				e.stopPropagation();
			}).on("dragenter", function(e){
				$(this).addClass("in");
			}).on("dragleave drop", function(e){
				$(this).removeClass("in");
			}).on("drop", function(e){
				var file = e.originalEvent.dataTransfer.files[0];
				var type = file.type;
				var video = document.getElementById('video');

				var compatibility = video.canPlayType(type);
				if(!(compatibility === '' || compatibility === 'no')) {
					var url = URL.createObjectURL(file);
					video.src = url;
					$(video).fadeIn();
				} 

				console.log(file);
			});
		});
		</script>
	</body>
</html>