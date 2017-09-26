<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require '../../vendor/autoload.php';
//require 'ConnectionWrapper.php';

$configSQL = include('../connection/config.php');
$configMongo = include('../connection/configMongo.php');

//$cat = new \Acme\connection\Cat("something");

$connection = new \Acme\connection\CnWrapper();
$type = "mysql";
$database=null;
$conn = null;
if($type == "mongo"){

    $conn = $connection->getConnection($configMongo,$type);
    $database = new Acme\Controller\databaseWrapper(new Acme\Controller\mongoDBController());

}else{
    $conn = $connection->getConnection($configSQL,$type);
    $database = new Acme\Controller\databaseWrapper(new Acme\Controller\mySQLController());

}


$app = new \Slim\App;

$container = $app->getContainer();
$container['view'] = new \Slim\Views\Twig("../templates/");



$app->get('/',function (Request $request,Response $response){

	$response->getBody()->write("Homepage");

	return $response;

});

//Read all
$app->get('/guests', function () use($app,$database,$conn) {



    $result = $database->read($conn);


    while ( $row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $app->render('guests.php', array(
            'page_title' => "Your Friends",
            'data' => $data
        )
    );


    //echo "something";

});

//CREATE
$app->post('/guests',function (Request $request, Response $response) use($database,$conn){


    $data = $request->getParsedBody();
    $database ->insert($conn,$data);




});
//UPDATE
$app->put('/guests/{id}',function(Request $request,Response $response)use($database,$conn){


    $data = $request->getParsedBody();

     $database->update($conn,$data);



});
//DELETE
$app->delete('/guests/{id}',function(Request $request,Response $response)use($database,$conn){


    $id = $request->getAttribute('id');
    $database->delete($conn,$id);
});



$app->run();

