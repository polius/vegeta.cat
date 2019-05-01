<!DOCTYPE html>
<html lang="ca">
<head>
	<?php
    	include_once('head.php');
  	?>  

	<link rel="stylesheet" href="/plyr/plyr.css">

	<script>
	var serie_json;
	var media_origin;

	$(document).ready(function() {
		var get = getParameterByName('s');

		if (get == null)
		{
			var pathname = window.location.pathname;
			get = pathname.replace("/serie/", "");
		}

		var player = document.getElementById("player");

		$.getJSON("/res/origin.json", function(origin) {
			media_origin = origin['cloudfront'];
			$.getJSON("/res/"+ get +"/content.json", function(data) {
				serie_json = data;
				load_serie_openings();
				load_serie_endings();

				$("#serie-title").html(serie_json['Title']);

				var url = (serie_json['Openings'].length > 0) ? media_origin + serie_json['Openings'][0].Url : media_origin + serie_json['Endings'][0].Url;
				player.src = url;
				
				var serie_list_width = $("#serie-list").css("width");
				$("#player").css("width", serie_list_width);

				player.style.height = (player.offsetWidth * 0.5) + "px";
			});
		});

		function getParameterByName(name, url)
		{
		    if (!url) url = window.location.href;
		    name = name.replace(/[\[\]]/g, "\\$&");
		    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
		        results = regex.exec(url);
		    if (!results) return null;
		    if (!results[2]) return '';
		    return decodeURIComponent(results[2].replace(/\+/g, " "));
		}

		function load_serie_openings()
		{
			for (var i = 0; i < serie_json['Openings'].length; ++i)
			{
				var row_color = (i % 2 == 0) ? 240 : 250;
				var html_to_append = "<ul style=\"list-style-type: none;\">";
				html_to_append += "<li style=\"cursor: pointer; cursor: hand;\">";
				html_to_append += "<div class=\"eac-item\">";
				html_to_append += "<a onClick=\"play_video('"+ media_origin + serie_json['Openings'][i].Url+"')\" class=\"series-item\" style=\"border-right: 0.5px solid #4caf50; display:block; background:rgb("+row_color+", "+row_color+", "+row_color+") none repeat scroll 0 0;\"><table style=\"width: 100%;\"><tr>";
				html_to_append += "<td><span class=\"serie-list\">"+serie_json['Openings'][i].Title+"</span></td>";
				html_to_append += "</tr></table></a></div></li></ul>";
				html_to_append += "<ul style=\"height:1px; background-color:#DCDCDC;\"></ul>";

				$("#eac-conatainer-series-list-openings").append(html_to_append);
			}
		}

		function load_serie_endings()
		{
			for (var i = 0; i < serie_json['Endings'].length; ++i)
			{
				var row_color = (i % 2 == 0) ? 240 : 250;
				var html_to_append = "<ul style=\"list-style-type: none;\">";
				html_to_append += "<li style=\"cursor: pointer; cursor: hand;\">";
				html_to_append += "<div class=\"eac-item\">";
				html_to_append += "<a onClick=\"play_video('"+ media_origin + serie_json['Endings'][i].Url+"')\" class=\"series-item\" style=\"border-left: 0.5px solid #4caf50; display:block; background:rgb("+row_color+", "+row_color+", "+row_color+") none repeat scroll 0 0;\"><table style=\"width: 100%;\"><tr>";
				html_to_append += "<td><span class=\"serie-list\">"+serie_json['Endings'][i].Title+"</span></td>";
				html_to_append += "</tr></table></a></div></li></ul>";
				html_to_append += "<ul style=\"height:1px; background-color:#DCDCDC;\"></ul>";
				
				$("#eac-conatainer-series-list-endings").append(html_to_append);
			}
		}

		$(window).resize(function() {
			var serie_list_width = $("#serie-list").css("width");
			$("#player").css("width", serie_list_width);

		    player.style.height = (player.offsetWidth * 0.5) + "px";
		});
	});

	function play_video(url)
	{
		var serie_list_width = $("#serie-list").css("width");
		$("#player").css("width", serie_list_width);

		player.style.height = (player.offsetWidth * 0.5) + "px";
		player.src = url;
		
	}

	</script>

</head>
<body>
	<?php
		$menu_section = 'serie';
		include_once('menu.php');
	?>

	<section class="main clearfix">
		<section class="top">	
			<div class="wrapper content_header clearfix">
				<h1 id="serie-title" class="title">
				</h1>
			</div>		
		</section>

		<section class="wrapper">
			<div class="content">
				<video id="player" autoplay controls crossorigin>
                    <source src="" type="video/mp4">
                </video>

				<div id="serie-list" style="display:flex; margin-top: 20px;">

					<div id="serie-openings" style="width:50%; flex: 1;">
						<div class="work-content-section clearfix">
							<div class="series-navigationBar" style="margin-top: 0px;">
								<ul>
								  <li class="series-list-title">Openings</li>
								</ul>
							</div>
							<div id="eac-conatainer-series-list-openings" class="easy-autocomplete-container"></div>
						</div>
					</div>

					<div id="serie-endings" style="width:50%; flex: 1;">
						<div class="work-content-section clearfix">
							<div class="series-navigationBar" style="margin-top: 0px;">
							<ul>
							  <li class="series-list-title">Endings</li>
							</ul>
						</div>
						<div id="eac-conatainer-series-list-endings" class="easy-autocomplete-container"></div>
					</div>
				</div>
			</div><!-- end content -->
		</section>
	</section><!-- end main -->

	<script type="text/javascript" src="/plyr/plyr.js"></script>
	<script type="text/javascript" src="/plyr/demo.js"></script>

</body>
</html>