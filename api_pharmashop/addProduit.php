  
<?php
//  post:http://localhost:8000/createUser.php
// Headers requis
header("Access-Control-Allow-Origin: ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
//appel de la base de donnee
 require 'db.php';
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 //initialisation des proprétés de la table users
 $data = json_decode(file_get_contents('php://input'));
 $nom= $data->nom;
 $descriptions =  $data->descriptions;
 $prix =  $data->prix;
 $img =  $data->img;
 $quantite="";
 $quantite = $data->quantite;
 $categorie_id=  $data->categorie_id;
 //insertion 
$result=$conn->query("INSERT INTO produit(nom,descriptions,prix,img,quantite,categorie_id)
VALUES ('$nom','$descriptions','$prix','$img','$quantite','$categorie_id')");
//encodage json des resultats
header("Content-Type: application/json");
if ($result) {
    http_response_code(200);
    echo json_encode([
         'error' => false,
         'message'=>"produit ajouté avec succès",
         'data'=>[]
        
    ]);
} else {
    http_response_code(500);
    echo json_encode([
         'error' => true,
         'message'=>"produit non ajouté",
         'data'=>[]
    ]);
}
exit();
 }