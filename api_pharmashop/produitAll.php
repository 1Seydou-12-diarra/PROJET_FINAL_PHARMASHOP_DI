
<?php 

  
  
  /* Handle CORS */

// Specify domains from which requests are allowed
header('Access-Control-Allow-Origin: *');

// Specify which request methods are allowed
header('Access-Control-Allow-Methods: PUT, GET');

// Additional headers which may be sent along with the CORS request
header('Access-Control-Allow-Headers: X-Requested-With,Authorization,Content-Type');

// Set the age to 1 day to improve speed/caching.
header('Access-Control-Max-Age: 86400');

require 'db.php';
// Exit early so the page isn't fully loaded for options requests
if (($_SERVER['REQUEST_METHOD']) == 'GET') {
    
    // include"is-login.php";
    
    $sql = 'SELECT * from produit ORDER BY id DESC';
    $statement = $conn->prepare($sql);
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_OBJ);
    
    header("Content-Type: application/json");
      echo json_encode(
        
        $data
      );
      
    exit();
}

?>