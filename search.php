<input id="buscador_serie" placeholder="Buscar sèries ..."/>

<script>
	var options = {
		url: "res/series.json",

		getValue: "Title",

		list: {
			match: {
				enabled: true
			},
			maxNumberOfElements: 10
		},

		adjustWidth : false,

		template: {
			type: "custom",
			method: function(value, item) {
				return "<a class=\"search-item\" href=\"/serie/"+encodeURIComponent(item['Title'])+"\">" +
					   		"<img class=\"search-image\" src=\"res/" + item['Title'] + "/thumb_mini.png\"/>" + 
					   			"<span class=\"search-text\">" + value + "</span>" +
					   	"</a>";
			}
		}
	};

	$("#buscador_serie").easyAutocomplete(options);
</script>

<script>
	var matching_series = [];

	$(document).ready(function()
	{
		jQuery('#buscador_serie').on('input', function()
		{
			search_serie_click();
		});
		
		document.getElementById('buscador_serie').onkeypress = function(e)
		{
			if (!e) e = window.event;
		    var keyCode = e.keyCode || e.which;
		    if (keyCode == '13')
		    {
				var element = document.getElementsByClassName("easy-autocomplete-container");
				$(element[0]).children().css({"display": "none"});

				// Hide mobile keyboard
				document.activeElement.blur();

				$('#series_content').html("");
				for (var i in matching_series)
				{
					 $('#series_content').append('<div class=\"work\" id=\"'+matching_series[i]+'\"><a href=\"/serie/'+encodeURIComponent(matching_series[i])+'\"><img src=\"res/'+matching_series[i]+'/thumb.png\" class=\"media\" alt=\"\"/><div class=\"caption\"><div class=\"work_title\"><h1>'+matching_series[i]+'</h1></div></div></a></div>');
				}
			}
		}
		
		function search_serie_click()
		{
	      	var searched_string = document.getElementById('buscador_serie').value.toLowerCase();
	      
	      	matching_series = [];

			//data is the JSON string
			for(var i in series_json)
			{
	 			var title = series_json[i]['Title'];
	 			if (latinize(title.toLowerCase()).includes(latinize(searched_string))) matching_series.push(title);  				
			}
			series_json_rand = matching_series;
	  	}
	});
</script>