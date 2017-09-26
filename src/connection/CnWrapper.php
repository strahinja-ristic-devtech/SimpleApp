<?php

namespace Acme\connection;

include('config.php');
include('configMongo.php');

class CnWrapper {





	public $conn;

	//send either mongo or mySQL as type to determine which database should be used
	public function getConnection($config,$type){




		if($type == "mongo"){

		//	$m = new Mongo("mongodb://" . $config['host'] );
		//	$this->conn = $m-> $config['name'];


		} else {


			$this->conn=   mysqli_connect($config[host],$config[user],
				$config[pass],$config[name]);



		}

		return $this -> conn;


	}



}

?>