  
<?php
//  post:http://localhost:8000/createUser.php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

 require '../db.php';
 
 $data = json_decode(file_get_contents('php://input'));
 

 $name = $data->name;
 $email =  $data->email;
 $hash = password_hash($data->passwords, PASSWORD_DEFAULT);
 $adress =  $data->adress_livraison;
 
$result=$conn->query("INSERT INTO users(username,email,passwords,adress_livraison)
VALUES ('$name','$email','$hash','$adress')");

header("Content-Type: application/json");
if ($result) {
    echo json_encode([
         'error' => false,
         'message'=>"client ajouté avec succès",
         'data'=>[]
        
    ]);
} else {
    echo json_encode([
         'error' => true,
         'message'=>"Client non ajouté",
         'data'=>[]
    ]);
}
exit();
