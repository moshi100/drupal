//ToolBar
$(document).ready(function(){
	
	var book = $('.book');
	var verse = $('.verse');
	var verseText = $('.verse-text');
	var commentaryBox = $('.commentaryBox');
	var commentary = $('.commentary');
	
	//Cache the punctuation text
	var verseTextPunctuation = new Array();
	verseTextPunctuation = getPunctuation(verseText);
	
	$("#increaseFont").click(function (){
		var newSizeFont = parseInt(book.css("font-size")) + 2;
		if(newSizeFont < 36){
			book.css({"font-size": newSizeFont + "px"});
			newSizeFont = parseInt(commentaryBox.css("font-size")) + 2;
			commentaryBox.css({"font-size": newSizeFont + "px"});
			var newMaxHeight = parseInt(commentary.css("max-height")) + 4;
			commentary.css({"max-height": newMaxHeight + "px"});
		}
	});

	$("#decreaseFont").click(function (){
		var newSizeFont = parseInt(book.css("font-size")) - 2;
		if(newSizeFont > 14){
			book.css({"font-size": newSizeFont + "px"});
			newSizeFont = parseInt(commentaryBox.css("font-size")) - 2;
			commentaryBox.css({"font-size": newSizeFont + "px"});
			var newMaxHeight = parseInt(commentary.css("max-height")) - 4;
			commentary.css({"max-height": newMaxHeight + "px"});
		}
	});
	
	$("#whitoutPunctuation").click(function (){
		verseText.each(function(index, element) {
			$(this).text(removePunctuation($(this).text()));
        });
	});

	$("#withPunctuation").click(function (){
		verseText.each(function(index, element) {
			$(this).text(verseTextPunctuation[index]);
        });
	});
	
	$("#displayInline").click(function (){
		verse.css({"display" : "inline"});
	});
	
	$("#displayBlock").click(function (){
		verse.css({"display" : "block"});
	});

});

function removePunctuation(str){
	var punctuation = ["֑", "֒֒֒֒֒;", "֓", "֔", "֕", "֖", "֗", "֘", "֙", "֚", "֛", "֜", "֝",
						"֞", "֟", "֠", "֡", "֢", "֣", "֤", "֥", "֦", "֧", "֨", "֩", "֪",
						"֫", "֬", "֭", "֮", "֯", "ְ", "ֱ", "ֲ", "ִ", "ֵ", "ָ", "ֹ", "ֺ",
						"ֻ", "ּ", "ֽ", "ֿ", "׀", "ׁ", "ׂ", "׃", "ׄ", "ׅ", "׆", "ׇ", "ַ", "ֶ", "֒"];	
	var i;
	
    for (i = 0; i < punctuation.length; i++) {
		var regex = new RegExp(punctuation[i],"g");
		str = str.replace(regex,"");
	}
	
	return str;
}

function getPunctuation(str){
	var arr = new Array();
	
	str.each(function(index, element) {
		arr.push($(this).text());
	});
	
	return arr;
}

















