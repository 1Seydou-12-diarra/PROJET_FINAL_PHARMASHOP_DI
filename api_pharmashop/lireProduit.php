
<?php 
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get:http://localhost:8000/lireProduit.php
require 'db.php';

json_decode(file_get_contents('php://input'));
$sql = 'SELECT * FROM produits ';
$statement = $conn->prepare($sql);
$statement->execute();
$data = $statement->fetchAll(PDO::FETCH_OBJ);
header("Content-Type: application/json");
  echo json_encode(
     $data
  );

?>