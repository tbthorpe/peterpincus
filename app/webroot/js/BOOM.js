function fillTheBar(){
	fulltext = "<ul>";
	$.getJSON('/categories/topLevels', function(data) {
	  $.each(data, function(key, val) {
		fulltext = fulltext + "<li><a href='/categories/sub/"+val.Category.id+"'>" + val.Category.title + "</a></li>";
	  });
		$("#workCatsNav").html(fulltext+"</ul>");
		
	});
}

$(document).ready(function(){
	$('#workNav').click(function(){
		fillTheBar();
		$("#aboutPageNav").fadeOut('fast',function(){
			$("#workCatsNav").fadeIn();
		});
	});
	
	$('#aboutNav').click(function(){
		$("#workCatsNav").fadeOut('fast',function(){
			$("#aboutPageNav").fadeIn();
		});
		
	})
	
});