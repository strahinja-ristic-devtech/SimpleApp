<?php

namespace Acme\connection;

include('config.php');
include('configMongo.php');

class CnWrapper {

	public $conn;

	//send either mongo or mySQL as type to determine which database should be used
	public function getConnection($config,$type){

		if($type == "mongo"){
           // $c = new \MongoClient();
			$m =   new \MongoDB\Client("mongodb://" . $config['host'] );
           // echo "connacted to mongo mon";
            $name = $config['name'];
			$this->conn = $m-> $name;

            //var_dump($this->conn);

		} else {


			$this->conn=   mysqli_connect($config[host],$config[user],
				$config[pass],$config[name]);
			
			if (mysqli_connect_errno()){
  				echo "Failed to connect to MySQL: " . mysqli_connect_error();
  			}

		}

		return $this -> conn;

	}

}

?>