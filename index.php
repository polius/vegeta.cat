<!DOCTYPE html>
<html lang="ca">
<head>
	<?php
		include_once('head.php');
	?>
	<script type="text/javascript" src="js/jquery.scrollUp.js"></script>
	<script>
	$(function () {
	    $.scrollUp();
	});
	</script>

    <script>
	var series_json, series_json_rand;
	$(document).ready(function() {
		$.getJSON('/res/series.json', function(data) {
			//data is the JSON string
			series_json = data.slice(0)
			series_json_rand = series_json.slice(0);
			

			function append_series(num)
			{
				var title;

				if (series_json_rand.length < num) num = series_json_rand.length;

				for(var e = 0; e < num; ++e)
				{
					var i = Math.floor(Math.random() * series_json_rand.length);

					title = series_json_rand[i]['Title'];

					$('#series_content').append('<div class=\"work\" id=\"'+title+'\"><a href=\"/serie/'+encodeURIComponent(title)+'\"><img data-src=\"/res/'+title+'/thumb.png\" class=\"media lazy\" alt=\"\"/><div class=\"caption\"><div class=\"work_title\"><h1>'+title+'</h1></div></div></a></div>');
					series_json_rand.splice(i,1);
					
					$("div[id='"+title+"']").find("div").css("opacity","0");

					$('.main .work .media').lazy({
						effect: "fadeIn",
					    effectTime: 500,
					    threshold: 0,
						afterLoad: function(element) {
					        element.closest('div').find("div").fadeTo(100,1);
					    }
			        });
				}		
			}

			append_series(15);

			$(window).scroll(function() {
			   if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
			       append_series(10);
			   }
			});

		});
	});
	</script>
</head>
<body>
	<?php
		$menu_section = 'index';
		$menu_search_icon = TRUE;
		include_once('menu.php');
		include_once('search.php');
	?>
	<section class="main clearfix" id="series_content">
	</section>
</body>
</html>
