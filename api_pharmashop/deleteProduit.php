 

<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db.php';
$data = json_decode(file_get_contents('php://input'));
$id = $data->produit_id;
$sql = 'DELETE  FROM produits WHERE produit_id=:produit_id';
$statement = $conn->prepare($sql);
$statement->execute([':produit_id'=>$id]);
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


?>




