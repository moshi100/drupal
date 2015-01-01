//ToolBar
$(document).ready(function(){

	var commentaryBox = $('.commentaryBox');
	
	//Fixed the commentary box to the top from 120px
	$(window).scroll(function(){
        if($(document).scrollTop() > 80){
			commentaryBox.css({"position" : "fixed","top" : "0"});
		}else{
			commentaryBox.css({"position" : "static"});
		}
    });

});
