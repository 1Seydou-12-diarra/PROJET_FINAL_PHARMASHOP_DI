 

<?php
/* Handle CORS */

// Specify domains from which requests are allowed
header('Access-Control-Allow-Origin: *');

// Specify which request methods are allowed
header('Access-Control-Allow-Methods: PUT, POST,DELETE');

// Additional headers which may be sent along with the CORS request
header('Access-Control-Allow-Headers: X-Requested-With,Authorization,Content-Type');

// Set the age to 1 day to improve speed/caching.
header('Access-Control-Max-Age: 86400');

require 'db.php';
 if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
$data = json_decode(file_get_contents('php://input'));
$id = $data->id;
$sql = 'DELETE  FROM produit WHERE id=:id';
$statement = $conn->prepare($sql);
$statement->execute([':id'=>$id]);
 header("Content-Type: application/json");
$data = $statement->fetchAll(PDO::FETCH_OBJ);
header("Content-Type: application/json");
if ($data) {
    echo json_encode([
    'error' => false,
     'message'=>"Article  supprimer",
     'data'=>[]
         ]);
         } else {
         echo json_encode([
        'error' => true,
        'message'=>"L'Article non supprimé",
        'data'=>[]
         ]);}
        exit();

        }
?>




