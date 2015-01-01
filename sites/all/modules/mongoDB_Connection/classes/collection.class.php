<?php

class collection
{
	protected $_id = null;
	protected $collection = null;
	
	function __construct()
	{
		$this->connect();
	}
	
	//select data from the MongoDB
	public function select($condition)
	{
		$collection = $this->connect();
		$cursor = $collection->find($condition);
		
		if($cursor)
			return $cursor;
		else
			return null;
	}
	
	//connect to MongoDB
	protected function connect(){
		$db = connectMongo::getInstance()->getConnect();
		$collection = $this->collection;
		return $db->$collection;
	}
	
	//insert data to MongoDB
	public function insert($data)
	{
		$collection = $this->connect();
		if(isset($collection))
			$collection->insert($data); //duplicate documents in collection -> "_id"=> new MongoId($uid)
		else 
			return false;
	}
	
	//update data in MongoDB
	public function update($condition,$data){
		$collection = $this->connect();
		if(isset($collection)){
			$newdata = array('$set' => $data);
			$collection->update($condition, $newdata);
		}
		else 
			return false;
	}

	//remove data to the MongoDB
	public function remove($data)
	{
		$collection = $this->connect();
		if(isset($collection))
			$cursor = $collection->remove($data);
		else 
			return false;
	}
	
	//check unsafe data
	function checkQuery($query)
	{
		$data = trim($query);
		$data = stripslashes($query);
		$data = htmlspecialchars($query);
		return $query;
	}
	
	public function toString($arr){
		$retStr = '<ul>';
		if (is_array($arr)){
			foreach ($arr as $key=>$val){
				if (is_array($val)){
					$retStr .= '<li>' . $key . ' => ' . $this->toString($val) . '</li>';
				}else{
					$retStr .= '<li>' . $key . ' => ' . $val . '</li>';
				}
			}
		}
		$retStr .= '</ul>';
		return $retStr;
	}
}
