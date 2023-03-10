<?php 
// 1- Créez une connexion de base de données au serveur PostgreSQL.

$host = 'localhost';
$dbname = 'pharmdb';
$username = 'postgres';
$password = '59898060';

$dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";

try{
 $conn = new PDO($dsn);
 
 if($conn){
  
 }
}catch (PDOException $e){
 echo $e->getMessage();
}
?>