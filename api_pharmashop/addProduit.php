  
<?php
/* Handle CORS */

// Specify domains from which requests are allowed
header('Access-Control-Allow-Origin: *');

// Specify which request methods are allowed
header('Access-Control-Allow-Methods: PUT, POST');

// Additional headers which may be sent along with the CORS request
header('Access-Control-Allow-Headers: X-Requested-With,Authorization,Content-Type');

// Set the age to 1 day to improve speed/caching.
header('Access-Control-Max-Age: 86400');

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
         'message'=>"Article  ajouté",
         'data'=>[]
             ]);
} else {
    http_response_code(500);
    echo json_encode([
        'error' => false,
         'message'=>"Article  non ajouté",
         'data'=>[]
             ]);
exit();
 }
 
}