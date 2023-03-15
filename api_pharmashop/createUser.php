  
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

require 'db.php';
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 //initialisation des proprétés de la table users
 $data = json_decode(file_get_contents('php://input'));
 $username = $data->username;
 $email =  $data->email;
 $hash = password_hash($data->passwords, PASSWORD_DEFAULT);

 //insertion 
$result=$conn->query("INSERT INTO users(username,email,passwords)
VALUES ('$username','$email','$hash')");
//encodage json des resultats
header("Content-Type: application/json");
$data ='utilisateur';

if ($result) {
    http_response_code(200);
    echo json_encode([
        'error' => false,
        'message'=>"user creer avec succès",

    ]);
} else {
    echo json_encode([
   'error' => true,
   'message'=>"user non creer"
   
    ]);}
   exit();
 }