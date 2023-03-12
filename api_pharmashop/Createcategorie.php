<?php
//post:http://localhost:8000/categorie.php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

 require 'db.php';
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 $data = json_decode(file_get_contents('php://input'));
 

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