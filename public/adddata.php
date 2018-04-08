<?php
  require '../vendor/autoload.php';

  class Person{
    public $name;
    public $email;
  }

  if($_POST) {
    $connection = new MongoDB\Client;
    $db = $connection->formUsers;

    $person1 = new Person;

    // $result1 =
    $person1->name = $_POST['name'];
    // $result2 =
    $person1->email = $_POST['email'];

    // $collection = $db->createCollection('form_user_list');

    $collection = $db->selectCollection('customer_list');

    echo $person1->fname;
    echo $person1->email;

    $insertResult = $collection->insertOne(
      ['name' => $person1->fname, 'email' => $person1->email]
    );

    // var_dump($insertResult);
  }
 ?>
