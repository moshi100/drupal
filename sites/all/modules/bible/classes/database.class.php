<?php

class databaseMongoDBMoshik
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
