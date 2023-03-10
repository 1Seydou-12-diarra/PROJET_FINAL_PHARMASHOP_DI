<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db.php';
// Récupération des données de la commande et des produits
$data = json_decode(file_get_contents("php://input"));

// Début de la transaction
$conn->beginTransaction();

try {
    // Insertion de la commande
    $stmt =$conn->prepare("INSERT INTO commande (id_users,id_produits,date_commande,montant_total,mode_paiement,etat_commande) 
    VALUES (:id_users, :id_produits,:date_commande,:montant_total,:mode_paiement,:etat_commande) RETURNING id_commande");
    $stmt->execute([
        'id_users' => $data->id_users,
        'id_produits' => $data->id_produits,
        'date_commande '=> $data->data_commande,
        'montant_total' => $data->montant_total,
        'mode_paiement' => $data->mode_paiement,
        'etat_commande'=>$data->etat_commande
    ]);

    // Récupération de l'id de la commande insérée
    $commande_id = $stmt->fetchColumn();

    // Insertion des produits
    foreach ($data->products as $product) {
        $stmt = $conn->prepare("INSERT INTO produits (produit_id, nom, quantite, prix) VALUES (:produit_id, :nom, :quantite, :prix)");
        $stmt->execute([
            'produit_id' => $produit_id,
            'nom' => $product->name,
            'quantite' => $product->quantite,
            'prix' => $product->prix,
        ]);
    }

    // Validation de la transaction
    $conn->commit();

    // Retourne la réponse au client
    echo json_encode(['status' => 'success', 'message' => 'Commande ajoutée avec succès']);
} catch (Exception $e) {
    // Annulation de la transaction en cas d'erreur
    $conn->rollback();
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
