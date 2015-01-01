//Nav Bar
$(document).ready(function(){
	
	var tanach = $('.tanach');
	var book = $('#book');
	var tanachBack = $('#tanach-back');
	var tanachLi = $('.tanach > li');
	var tanachLevel2 = $('.tanach > li > ul > li');
	
	$(tanachLi).click(function (){
		var classAttr = ($(this).attr("class")).replace(" ",".");
		var ulChild = '.' + classAttr + ' > ul';
		
		$(tanach).animate({"padding-top" : "10px"})
		$(ulChild).fadeIn();
		$(".tanach ul").not(ulChild).fadeOut();;
	});
	
	$(tanachLevel2).click(function (){
		$(tanach).slideUp(10);
		$.ajax({
			type: "GET",
           	url: "ajax.php",
          	data: 'book=' + $(this).attr("id"),
         	success: function(msg){
      			$(book).html(msg);
   			}
       	});
		$(book).fadeIn();
		$(tanachBack).fadeIn();
	});
	
	$(tanachBack).click(function (){
		$(book).fadeOut(0);
		$(tanachBack).fadeOut(0);
		$(tanach).fadeIn();
	});
	
});














