<?php

class collection
{
	protected $_id = null;
	protected $collection = null;
	
	function __construct()
	{
	}
	
	//select data from the MongoDB
	public function select()
	{
		$collection = $this->connect();
		$cursor = $collection->find();
		if($cursor->getNext())
			include 'layouts/master.layout.php';
		else
			echo "Empty query";
	}
	
	//connect to the MongoDB
	protected function connect(){
		$db = test::getInstance()->getConnect();
		$collection = $this->collection;
		return $db->$collection;
	}
	
	//insert data to the MongoDB
	public function insert($data)
	{
		$collection = $this->connect();
		$cursor = $collection->insert($data);
	}
	
	//update data in MongoDB
	protected function update($condition,$data){
		$collection = $this->connect();
		$newdata = array('$set' => $data);
		$collection->update($condition, $newdata);
	}

	//remove data to the MongoDB
	public function remove($data)
	{
		$collection = $this->connect();
		$cursor = $collection->remove($data);
	}
	
	//chack unsafe data
	function checkQuery($query)
	{
		$data = trim($query);
		$data = stripslashes($query);
		$data = htmlspecialchars($query);
		return $query;
	}
}
