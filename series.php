<!DOCTYPE html>
<html lang="ca">
<head>
	<?php
		include_once('head.php');
	?>
	<script type="text/javascript" src="/js/jquery.scrollUp.js"></script>
	<script>
		$(function () {
		    $.scrollUp();
		});
	</script>

	<script>
		var series_json, series_json_filter, j;

		function load_series(num)
		{
			if (series_json_filter.length == 0)
			{
				var html_to_append = "<h2 style=\"margin-top: 30px;\">No s'ha trobat cap sèrie</h2>";
				$("#eac-conatainer-series-list").append(html_to_append);
			}
			else
			{
				var max = num+j;
				if (max > series_json_filter.length) max = series_json_filter.length;

				for (var i = j; i < max; ++i)
				{
					var row_color = (i % 2 == 0) ? 240 : 250;
					var html_to_append = "<ul style=\"list-style-type: none;\">";
					html_to_append += "<li>";
					html_to_append += "<div class=\"eac-item\">";
					html_to_append += "<a class=\"series-item\" href=\"/serie/"+encodeURIComponent(series_json_filter[i].Title)+"\" style=\"display:block; background:rgb("+row_color+", "+row_color+", "+row_color+") none repeat scroll 0 0;\"><table><tr>";
					html_to_append += "<td style=\"padding-top:6px; padding-left:6px;\"><img class=\"search-image\" style=\"display:block;\" data-src=\"/res/"+series_json_filter[i].Title+"/thumb_mini.png\"></td>";
					html_to_append += "<td><span class=\"search-text\">"+series_json_filter[i].Title+"</span></td>";
					html_to_append += "</tr></table></a></div></li></ul>";
					html_to_append += "<ul style=\"height:1px; background-color:#DCDCDC;\"></ul>";
					$("#eac-conatainer-series-list").append(html_to_append);

					$('.search-image').lazy({
						effect: "fadeIn",
					    effectTime: 500,
					    threshold: 0,
						afterLoad: function(element) {
					        element.closest('tr').find("span").stop().fadeTo(100,1);
					    }
			        });
				}
				j = i;
			}
		}

		$(document).ready(function() {
			$(window).scroll(function() {
			   if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
			       load_series(5);
			   }
			});

			$.getJSON('/res/series.json', function(data) {
				series_json = data;

				series_json.sort(function (a, b) {
				    return a.Title.toLowerCase().localeCompare(b.Title.toLowerCase());
				});

				series_json_filter = series_json.slice(0);

				j = 0;

				$("#eac-conatainer-series-list").html("");
				load_series(20);
				$("#eac-conatainer-series-list").hide();
				$("#eac-conatainer-series-list").fadeIn(200);

			});

			$(".series-navigationBar ul li a").click(function() {
			 	var selected_value = $(this).html();

			 	$(".series-navigationBar ul li a").removeClass("active");
			 	$(this).addClass("active");

			 	if (selected_value != "#")
			 	{
			 		series_json_filter = jQuery.grep(series_json, function(c) {
					  return (latinize(c.Title.toUpperCase()[0]) == selected_value);
					});
			 	}
			 	else series_json_filter = series_json.slice(0);

			 	j = 0;

				$("#eac-conatainer-series-list").html("");
				load_series(15);
				$("#eac-conatainer-series-list").hide();
				$("#eac-conatainer-series-list").fadeIn(300);

				/* - Scroll to ".series-navigationBar" element -
		  		$('html, body').animate({
		        	scrollTop: $(".series-navigationBar").offset().top
		        }, 500);
		        */	
					
				return false;
			});
		});
	</script>
</head>
<body>
	<?php
		$menu_section = 'series';
		include_once('menu.php');
	?>
	<section class="main clearfix" id="map">

	  	<section class="top"></section>
		  	<section class="wrapper">
		    <div class="content theme-content">
				<h1>Sèries A-Z</h1>

				<div class="series-navigationBar">
					<ul>
					  <li><a class="active" href="#home">#</a></li>
					  <li><a href="#">A</a></li>
					  <li><a href="#">B</a></li>
					  <li><a href="#">C</a></li>
					  <li><a href="#">D</a></li>
					  <li><a href="#">E</a></li>
					  <li><a href="#">F</a></li>
					  <li><a href="#">G</a></li>
					  <li><a href="#">H</a></li>
					  <li><a href="#">I</a></li>
					  <li><a href="#">J</a></li>
					  <li><a href="#">K</a></li>
					  <li><a href="#">L</a></li>
					  <li><a href="#">M</a></li>
					  <li><a href="#">N</a></li>
					  <li><a href="#">O</a></li>
					  <li><a href="#">P</a></li>
					  <li><a href="#">Q</a></li>
					  <li><a href="#">R</a></li>
					  <li><a href="#">S</a></li>
					  <li><a href="#">T</a></li>
					  <li><a href="#">U</a></li>
					  <li><a href="#">V</a></li>
					  <li><a href="#">W</a></li>
					  <li><a href="#">X</a></li>
					  <li><a href="#">Y</a></li>
					  <li><a href="#">Z</a></li>
					</ul>
				</div>
				<div class="easy-autocomplete-container" id="eac-conatainer-series-list">
			</div>
			</section>
		</section>
	</section>
</body>
</html>