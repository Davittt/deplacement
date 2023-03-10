<?php
// Informations d'identification MySQL
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'xxxx');
define('DB_PASSWORD', 'xxxxxxxxxx');
define('DB_NAME', 'xxxxxx');

// Tentative de connexion à la base de données MySQL
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Vérifier la connexion
if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}
?>
