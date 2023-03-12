
<?php

// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'UPDATE') {
$data = json_decode(file_get_contents('php://input'));

$id =$data->produit_id;

$sql = 'SELECT * FROM  produits WHERE produit_id=:produit_id';
$statement = $conn->prepare($sql);
$statement->execute(['produit_id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);


$id =$data->produit_id;
$nom =$data->nom;
$prix =$data->prix;
$descript=$data->descript;
$quantite =$data->quantite;
$sql = 'UPDATE produits SET produit_id=:produit_id, nom=:nom ,prix=:prix,quantite=:quantite WHERE produit_id=:produit_id';
  $statement = $conn->prepare($sql);
  if ($result=$statement->execute([':produit_id'=>$id,':nom' =>$nom, ':prix' =>$prix ,':quantite' =>$quantite])){
   
  header("Content-Type: application/json");
if ($result) {
  echo json_encode([
    'status'=>200,
    'error' => false,
    'message'=>"L'article a été modifié",
    'data'=>[]

  ]);
} else {
  echo json_encode([
    'status'=>404,
    'error' => true,
    'message'=>"l'article na pas été modifié",
    'data'=>[]
    
  ]);
}
exit();
  }
    
  }
 ?>

  
  
$produits=$id_produits->id_commande;
    $produit = $id_produits->produit;
    $quantite = $id_produits->quantite;
    $prix_produit = $id_produits->prix_unitaire;
          