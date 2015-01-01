//
$(document).ready(function(){
						   
	var verseText = ".verse";
	var commentary = ".commentary";
	var highLight = "highlight";
	var commentaryBox = $('.commentaryBoxScroll');
	
	$(verseText+", "+commentary).hover(function() {
		var commentarys = $('*[data-verse='+$(this).data("verse")+']');
		$(commentarys).addClass(highLight);
  	}, function() {
		var commentarys = $('*[data-verse='+$(this).data("verse")+']');
		$(commentarys).removeClass(highLight);
  	});
	
	$(verseText).click(function (){
    	var scrollToVerse = ".verse-"+$(this).data("verse");

		commentaryBox.animate({
			scrollTop: $(scrollToVerse).offset().top - $(commentaryBox).offset().top + $(commentaryBox).scrollTop()
		});
	});

	$(commentary).click(function (){
		$(this).toggleClass('expanded');
	});
	
});