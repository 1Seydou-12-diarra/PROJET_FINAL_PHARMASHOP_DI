<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Récupération des données de la commande et des produits
$data = json_decode(file_get_contents("php://input"));

$id_users = $data->id_users;
$produit_id = $data->produit_id;
$date_commande= $data->date_commande;
$mode_paiement= $data->mode_paiement;
$etat_commande= $data->etat_commande;
$quantite =$data->quantite;

// // Insertion de la nouvelle commande dans la base de données
 $re
 sult = $conn->query("INSERT INTO commande(id_users,produit_id,date_commande,mode_paiement,etat_commande,quantite)
VALUES('$id_users','$produit_id','$date_commande','$mode_paiement','$etat_commande','$quantite')");

  header("Content-Type: application/json");
if (!$result) {
    echo json_encode([
         'error' => false,
         'message'=>"commande ajouté avec succès",
         'data'=>[]
        
    ]);
} else {
    echo json_encode([
         'error' => true,
         'message'=>"Une erreur est survenue lors de l'ajout de la commande.",
         'data'=>[]
    ]);
}
exit();
}
?>