<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

class Customer{
  public $id;
  public $name;
  public $email;
}

// Get All Customers
$app->get('/customers', function(Request $request, Response $response){
    $sql = "SELECT * FROM customers";
    try{
        // Get DB Object & Connect to db and collection
        $connection = new MongoDB\Client;
        $db = $connection->formUsers;
        $collection = $db->selectCollection('customer_list');
        $document = $collection->find();

        var_dump($document);
    } catch (MongoDB\Driver\Exception\AuthenticationException $e) {
        echo "Exception:", $e->getMessage(), "\n";
    } catch (MongoDB\Driver\Exception\ConnectionException $e) {
        echo "Exception:", $e->getMessage(), "\n";
    } catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
        echo "Exception:", $e->getMessage(), "\n";
    }
});

// Get Single Customer
$app->get('/customer/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    try{
        // Get DB Object & Connect to db and collection
        $connection = new MongoDB\Client;
        $db = $connection->formUsers;
        $collection = $db->selectCollection('customer_list');
        $document = $collection->findOne([
            'id' => $id
        ]);

        var_dump($document);
    } catch (MongoDB\Driver\Exception\AuthenticationException $e) {
        echo "Exception:", $e->getMessage(), "\n";
    } catch (MongoDB\Driver\Exception\ConnectionException $e) {
        echo "Exception:", $e->getMessage(), "\n";
    } catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
        echo "Exception:", $e->getMessage(), "\n";
    }
});

// Add Customer
$app->post('/customer/add', function(Request $request, Response $response){
    $id = $request->getParam('id');
    $name = $request->getParam('name');
    $email = $request->getParam('email');

    try{
        // Get DB Object
        $connection = new MongoDB\Client;
        $db = $connection->formUsers;
        $collection = $db->selectCollection('customer_list');
        $insertResult = $collection->insertOne([
          'id' => $id,
          'name' => $name,
          'email' => $email
        ]);

        echo '{"notice": {"text": "Customer Added"}';
    } catch (MongoDB\Driver\Exception\AuthenticationException $e) {
        echo "Exception:", $e->getMessage(), "\n";
    } catch (MongoDB\Driver\Exception\ConnectionException $e) {
        echo "Exception:", $e->getMessage(), "\n";
    } catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
        echo "Exception:", $e->getMessage(), "\n";
    }
});

// Update Customer
$app->put('/customer/update/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $name = $request->getParam('name');
    $email = $request->getParam('email');

    try{
        // Get DB Object
        $connection = new MongoDB\Client;
        $db = $connection->formUsers;
        $collection = $db->selectCollection('customer_list');
        $updateResult = $collection->updateOne(
          ['id' => $id],
          ['$set' => ['name' => $name]],
          ['$set' => ['email' => $email]]
        );

        echo '{"notice": {"text": "Customer Updated"}';
    } catch (MongoDB\Driver\Exception\AuthenticationException $e) {
        echo "Exception:", $e->getMessage(), "\n";
    } catch (MongoDB\Driver\Exception\ConnectionException $e) {
        echo "Exception:", $e->getMessage(), "\n";
    } catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
        echo "Exception:", $e->getMessage(), "\n";
    }
});

// Delete Customer
$app->delete('/customer/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    try{
        // Get DB Object
        $connection = new MongoDB\Client;
        $db = $connection->formUsers;
        $collection = $db->selectCollection('customer_list');
        $deleteResult = $collection->deleteOne(
          ['id' => $id]
        );

        echo '{"notice": {"text": "Customer Deleted"}';
    } catch (MongoDB\Driver\Exception\AuthenticationException $e) {
        echo "Exception:", $e->getMessage(), "\n";
    } catch (MongoDB\Driver\Exception\ConnectionException $e) {
        echo "Exception:", $e->getMessage(), "\n";
    } catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
        echo "Exception:", $e->getMessage(), "\n";
    }
});
