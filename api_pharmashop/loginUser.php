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
require 'jwt.php';
// Exit early so the page isn't fully loaded for options requests

    

// Si la méthode HTTP est POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $data= json_decode(file_get_contents('php://input'));
  $username= $data->username;
  $password = $data->passwords;
  

    // Vérification de l'utilisateur et de son rôle
    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['passwords'])) {
       // Création d'un jeton d'authentification
       $jwt_secret = bin2hex(random_bytes(32));
       $jwt_payload = array(
           "iss" => "localhost",
           "iat" => time(),
           "exp" => time() + (7 * 24 * 60 * 60), // Expire dans une semaine
           "sub" => $user['id'],
           "username" => $user['username']
       );
       $jwt_token = jwt_encode($jwt_payload, $jwt_secret);

       http_response_code(200);
       echo json_encode(['token' => $jwt_token,
       'message' =>"vous êtes connecté"]
       );
   } else {
       // Mot de passe incorrect
       http_response_code(401);
       echo json_encode(['message' => 'Mot de passe incorrect']);
   }

}

?>

        
       
        