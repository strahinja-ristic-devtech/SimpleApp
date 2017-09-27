<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require '../../vendor/autoload.php';

$configSQL = include('../connection/config.php');
$configMongo = include('../connection/configMongo.php');

$connection = new \Acme\connection\CnWrapper();

//CHANGE $TYPE TO SWITCH BEETWEEN DATABASES
$type = "mongo";
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
$app->get('/guests', function (Request $request,Response $response) use($app,$database,$conn) {



   $data = $database->read($conn);
   /* while ( $row = $result->fetch_assoc()) {
        $data[] = $row;
    }   */

   // print_r($data);
  /*  $app->render('guests.php', array(
            'data' => $data
        )
    );
  */

    $response = $this->view->render($response, "guests.phtml", array('data'=>$data));
    return $response;


})->setName('guestPage');;

//CREATE
$app->post('/guests',function (Request $request, Response $response) use($database,$conn){


    $data = $request->getParsedBody();
    //print_r($data);
    $database ->insert($conn,$data);

    //echo "all clear";
    //$app->response->redirect($app->urlFor(''));

    //Returning to get route after the insert
    return $response->withRedirect($this->router->pathFor('guestPage'));

});
//UPDATE
$app->put('/guests/{id}',function(Request $request,Response $response)use($database,$conn){


    $data = $request->getParsedBody();

    $database->update($conn,$data);

    return $response->withRedirect($this->router->pathFor('guestPage'));

});
//DELETE
$app->delete('/guests/{id}',function(Request $request,Response $response)use($database,$conn){


    $id = $request->getAttribute('id');
    $database->delete($conn,$id);

    return $response->withRedirect($this->router->pathFor('guestPage'));
});



$app->run();

