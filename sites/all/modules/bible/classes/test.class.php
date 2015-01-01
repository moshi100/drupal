<?php

class test
{
	private static $instance;
	private $host;
	private $user;
	private $pass;
	private $dbName;
	private $connection;
	private $results;

	function __construct()
	{
	}

    static function getInstance()
    {
    	if(!self::$instance)
    	{
    		self::$instance = new self();
    	}
    	return self::$instance;
    }

    public function connect($config)
    {
    	foreach($config as $key => $value){
    		$this->$key = $value;
    	}
		
    	$mongodb = new MongoClient();
    	$this->connection = $mongodb->$config["dbName"];
    }

    public function getConnect(){
    	if ($this->connection){
    		return $this->connection;
    	}
    	die("Database not available");
    }

}// end class

/*
class test extends collection
{ 
	protected $collection = "texts";
	
	public function select() 
	{
		$collection = $this->connect();
		$cursor = $collection->find(array('$or' => array(
		  				array("title" => new MongoRegex("/Bereishit Rabbah/"))
		)));
		include 'layouts/master.layout.php';
	}
	
}
*/