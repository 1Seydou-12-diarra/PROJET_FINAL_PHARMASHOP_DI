<?php

  /* Handle CORS */

// Specify domains from which requests are allowed
header('Access-Control-Allow-Origin: *');

// Specify which request methods are allowed
header('Access-Control-Allow-Methods: PUT, GET,POST');

// Additional headers which may be sent along with the CORS request
header('Access-Control-Allow-Headers: X-Requested-With,Authorization,Content-Type');

// Set the age to 1 day to improve speed/caching.
header('Access-Control-Max-Age: 86400');




 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 $data = json_decode(file_get_contents('php://input'));
 require 'db.php';

 $nom_categorie =  $data->nom_categorie;
 $description =  $data->description;

 
$result=$conn->query("INSERT INTO categorie(nom_categorie,description)
VALUES ('$nom_categorie','$description')");

header("Content-Type: application/json");
if ($result) {
    echo json_encode([
         'error' => false,
         'message'=>"categorie ajouteé",
         'data'=>[]
        
    ]);
} else {
    echo json_encode([
         'error' => true,
         'message'=>"categorie non ajouté",
         'data'=>[]
    ]);
}
}