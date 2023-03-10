<?php
//post:http://localhost:8000/createProduit.php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db.php';
 
 $data = json_decode(file_get_contents('php://input'));
 //propiété de la table produits
 $nom =$data->nom;
 $prix =$data->prix;
 $descript=$data->descript;
 $categorie_id =$data->categorie_id;
 $img =$data->img;
 $quantite =$data->quantite;
 
 //inertion a la table

$result = $conn->query("INSERT INTO produits(nom,prix,descript,categorie_id,img,quantite)
VALUES ('$nom','$prix','$descript','$categorie_id','$img',' $quantite')");
 
header("Content-Type: application/json");
if ($result) {
    echo json_encode([
         'error' => false,
         'message'=>"produit ajouté avec succès",
         'data'=>[]
        
    ]);
} else {
    echo json_encode([
         'error' => true,
         'message'=>"produit  non ajouté ",
         'data'=>[]
    ]);
}
exit();
