<?php

class book extends collection
{ 
	protected $collection = "texts";
	
	//Connect to the DB and return array of verses for this $boot,$chapter
	public function select()
	{
		$collection = $this->connect();
		$cursor = $collection->findOne(array('title' => "Genesis"), array('title' => 1, 'chapter' => 1, '_id' => 0));
		if($cursor)
			return $cursor;
		else
			return null;
	}

}