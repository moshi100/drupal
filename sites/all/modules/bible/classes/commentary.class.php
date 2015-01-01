<?php

class commentary extends collection
{ 
	protected $collection = "texts";
	protected $index;
	
	public function __construct()  
    {
		$this->index = new index();
	}
	
	// Connect to the DB and return array of commentrys for this $boot,$chapter
	public function select($book,$chapter)
	{
		$collection = $this->connect();
		$regex = new MongoRegex("/ on ".$book."/");
		$cursor = $collection->find(array('language' => 'he', 'title' => $regex), array('title' => 1, 'chapter' => 1, '_id' => 0));
		if($cursor->getNext()){
			$cursor = $this->arrCommentary($cursor,$book,$chapter);
			return $cursor;
		}
		else
			die("Empty query - commentary class");
	}
	
	// Get array of commentrys for all the chapter
	private function arrCommentary($cursor,$book,$chapterNum){
		$verse = 0;
		$arr = array();
		$length = $this->index->getVerses($book,$chapterNum);
		for ($verse = 0; $verse < $length; $verse++){
			array_push($arr,$this->arrCommentaryByVerse($cursor,$chapterNum,$verse));
		}
		return $arr;
	}

	// Get array of commentrys for one verse
	private function arrCommentaryByVerse($cursor,$chapterNum,$verse){
		$arr = array();
		foreach ($cursor as $chapter){ 
			// check if exist commentary for this verse
			if (!empty($chapter['chapter'][$chapterNum][$verse])){ 	
				$title = $this->index->getHeTitleName($chapter['title']);
				$titleEnForCSS = str_replace(" ", "-", $this->index->subStrPos($chapter['title']," on "));
				$chapter = $chapter['chapter'][$chapterNum][$verse];
				if(is_array($chapter)){
					foreach ($chapter as $key => $value)
						$arr = $this->array_push($arr,$title,$titleEnForCSS,$value,$verse);
				}
				else{
					$arr = $this->array_push($arr,$title,$titleEnForCSS,$chapter,$verse);
				}
			}
		}
		
		return $arr;
	}
	
	// Push 1 commentary to the array
	private function array_push($arr,$title,$titleEn,$value,$verse){
		if ($value != "")
			array_push($arr,array('title' => $title, 'titleEn' => $titleEn, 'value' => $value, 'verse' => $verse));
		return $arr;
	}

}
