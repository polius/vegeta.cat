<!DOCTYPE html>
<html lang="ca">
<head>
	<?php
		include_once('head.php');
	?>
	<link rel="stylesheet" href="/plyr/plyr.css">

	<script>
		var series_json, serie_random, media_origin;
		var is_random = 1;

		$(document).ready(function() 
		{
			$.getJSON('/res/series.json', function(data) {
				series_json = data;

				$("#player").on('ended', function(event) {
				  loadSerie();
				});

				loadSerie();
			});		
		});

		function loadSerie()
		{
			var random_index = Math.floor(Math.random()*series_json.length);

			$.getJSON("/res/origin.json", function(origin) {
				media_origin = origin['cloudfront'];
				$.getJSON("/res/"+series_json[random_index]['Title']+"/content.json", function(data_serie) {
					serie_random = data_serie;

					var openings = serie_random['Openings'].length;
					var endings = serie_random['Endings'].length;

					var random = Math.floor(Math.random() * (openings+endings));
					var url = (random < openings) ? media_origin + serie_random['Openings'][random]['Url'] : media_origin + serie_random['Endings'][(random-openings)]['Url'];
					var player = document.getElementById("player");

					player.src = url;
					player.play();
				});
			});
		}
		
	</script>

</head>
<body style="overflow:hidden;">
	<?php
		$menu_section = 'random';
		include_once('menu.php');
	?>
	<section class="main clearfix" id="map">
	  	<!--
	  	<div class="video-container">
			<div id="youtube-player" style="width:100%;height:100vh;"></div>
		</div>
		-->
		<video id="player" autoplay controls crossorigin style="width:100%;height:100vh;">
            <source src="" type="video/mp4">
        </video>
	</section>

	<script type="text/javascript" src="/plyr/plyr.js"></script>
	<script type="text/javascript" src="/plyr/demo.js"></script>

</body>
</html>