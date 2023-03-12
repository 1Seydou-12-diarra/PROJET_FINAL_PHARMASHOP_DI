<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db.php';
session_start();
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
        if ($user['roles'] == 'admin') {
            $_SESSION['admin_id'] = $user['id'];
            http_response_code(200);
            echo json_encode(array('message' => 'Vous êtes connecté en tant qu\'administrateur.'));
        } else {
            $_SESSION['user_id'] = $user['id'];
            http_response_code(200);
            echo json_encode(array('message' => 'Vous êtes connecté en tant qu\'utilisateur.'));
        }
    } else {
        http_response_code(401);
        echo json_encode(array('message' => 'Nom ou mot de passe incorrect.'));
    }
}
?>

        
       
        