<?php

return [

	'host' => 'localhost',
	'name' => 'guests',
	'user' => 'root',
	'pass' => '1234'


];
/*
$dbSQL_host = 'localhost';
$dbSQL_name = 'guest';
$dbSQL_user = 'root';
$dbSQL_pass = '1234';
*/

/*try {
    // http://php.net/manual/en/pdo.connections.php
    $dbConn = new PDO("mysql:host={$databaseHost};dbname={$databaseName}", $databaseUsername, $databasePassword);
   
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Setting Error Mode as Exception
    // More on setAttribute: http://php.net/manual/en/pdo.setattribute.php
} catch(PDOException $e) {
    echo $e->getMessage();
}
 */


 //$dbConn = new mysqli($databaseHost,$databaseUsername,$databasePassword,$databaseName);
 
?>