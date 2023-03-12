  
<?php
//  post:http://localhost:8000/createUser.php
// Headers requis
header("Access-Control-Allow-Origin: ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
//appel de la base de donnee
 require 'db.php';
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 //initialisation des proprétés de la table users
 $data = json_decode(file_get_contents('php://input'));
 $name = $data->name;
 $email =  $data->email;
 $hash = password_hash($data->passwords, PASSWORD_DEFAULT);
 $roles =  $data->roles;
 //insertion 
$result=$conn->query("INSERT INTO users(username,email,passwords,roles)
VALUES ('$name','$email','$hash','$roles')");
//encodage json des resultats
header("Content-Type: application/json");
if ($result) {
    http_response_code(200);
    echo json_encode([
         'error' => false,
         'message'=>"client ajouté avec succès",
         'data'=>[]
        
    ]);
} else {
    http_response_code(500);
    echo json_encode([
         'error' => true,
         'message'=>"Client non ajouté",
         'data'=>[]
    ]);
}
exit();
 }