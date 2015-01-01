<?php 

class controller {
	 
	private $index;
	private $book;
	private $commentary;
	
	public function __construct()  
    {
		//require 'config.php';
		
		$configMongo = array(
			'host' => '10.40.44.214',
			'user' => '',
			'pass' => '',
			'dbName'   => 'sefaria',
		);
		
        $mongodb = test::getInstance();
        $db = $mongodb->connect($configMongo);
		
		$this->book = new book();
		
		$cursor = $this->book->select();
		//print_r($cursor);
    }

	public function invoke($book, $chapter)
	{
		include 'layouts/navbar.layout.php';
		
		$cursor = $this->book->select($book);
		$title = $this->index->getHeTitleName($cursor['title'])." ".$this->index->getNameVerse($chapter);
		$cursor = $cursor['chapter'][$chapter];
		include 'layouts/books.layout.php';
		
		$cursor = $this->commentary->select($book, $chapter);
		include 'layouts/commentary.layout.php';
		
		include 'layouts/toolbar.layout.php';
	}
	
	public function getVersesListByBook($book){
		$bookHe = $this->index->getHeTitleName($book);
		$length = $this->index->getChapters($book);
		include 'layouts/verses-list.layout.php';
	}
	
}
