<?php

class index extends collection
{ 
	protected $collection = "index";
	protected $nameVerses = array("א","ב","ג","ד","ה","ו","ז","ח","ט","י","יא","יב","יג","יד","טו","טז","יח","יח","יט","כ","כא","כב","כג",
					"כד","כה","כו","כז","כח","כט","ל","לא","לב","לג","לד","לה","לו","לז","לח","לט","מ","מא","מב","מג","מד","מה","מו","מז",
					"מח","מט","נ","נא","נב","נג","נד","נה","נו","נז","נח","נט","ס","סא","סב","סג","סד","סה","סו","סז","סח","סט","ע","עא",
					"עב","עג","עד","עה","עו","עז","עח","עט","פ","פא","פב","פג","פד","פה","פו","פז","פח","פט","צ","צא","צב","צג","צד","צה",
					"צו","צז","צח","צט","ק","קא","קב","קג","קד","קה","קו","קז","קח","קט","קי","קיא","קיב","קיג","קיד","קטו","קטז","קיז",
					"קיח","קיט","קכ","קכא","קכב","קכג","קכד","קכה","קכו","קכז","קכח","קכט","קל","קלא","קלב","קלג","קלד","קלה","קלו","קלז",
					"קלח","קלט","קמ","קמא","קמב","קמג","קמד","קמה","קמו","קמז","קמח","קמט","קנ");

	//Get title in english and return the title in hebrew
	public function getHeTitleName($title){
		$collection = $this->connect();
		
		$document = $collection->findOne(array('title' => $title));
		if ($document['heTitle'])
			return $document['heTitle'];
			
		$title = $this->subStrPos($title," on ");
		$document = $collection->findOne(array('title' => $title));
		if ($document['heTitle'])
			return $document['heTitle'];
		else
			return null;
	}
	
	//Get $book,$chapter and return how meny verses in the chapter
	public function getVerses($book,$chapter){
		$collection = $this->connect();
		$document = $collection->findOne(array('title' => $book));
		if ($document['lengths'])
			return $document['lengths'][$chapter];
		else
			return null;
	}
	
	//Get $book and return how meny chapters
	public function getChapters($book){
		$collection = $this->connect();
		$document = $collection->findOne(array('title' => $book));
		if ($document['length'])
			return $document['length'];
		else
			return null;
	}
	
	//Get string and substring, return the string until the substring
	public function subStrPos($str, $strPos){
		$strPosition = strpos($str,$strPos);
		if($strPosition != "")
			return substr($str, 0, $strPosition);
		return $str;	
	}
	
	//Get the verse by index
	public function getNameVerse($index){
		if($index >= 0 && $index < count($this->nameVerses))
			return $this->nameVerses[$index];
	}
	
	//Get the index by verse
	public function getIndexByVerse($verse){
		$arr = $this->nameVerses;
		foreach ($arr as $key => $val){
			if ($val == $verse)
				return $key;
		}
	}
}





