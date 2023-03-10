<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require '../db.php';
  
 $data= json_decode(file_get_contents("php://input"), true);
 
 $array = ["passwords" => "passwords"];
 $obj = json_decode(json_encode($array));
 $password = $obj->passwords;
 
 $array = ["username" => "username"];
$obj = json_decode(json_encode($array));
$name = $obj->username;

header("Content-Type: application/json");
$stmt= $conn->prepare("SELECT * FROM users where username = :username ");
$stmt->execute(array(':username' => $name));
$donn = $stmt->fetch();
var_dump($donn);
if(password_verify($password, $data['passwords'])){ 

header("Content-Type: application/json");
if (!isset($donn)){
echo json_encode([
'error' => true,
'message'=>"vous ête connecté",
'data'=>[]
]);
echo json_encode([
    'error' => true,
    'message'=>"Mot de pass ou nom d'utilisateur incorrect",
    'data'=>[]
    ]);
die();
}
}
?>
        
       
        