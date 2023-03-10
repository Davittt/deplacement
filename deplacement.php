<?php
require_once "connect.php"; // inclure le fichier de connexion

// requête SQL pour récupérer tous les déplacements et les objets correspondants
$sql = "SELECT deplacement.*, objet.objet AS objet_nom FROM deplacement 
        JOIN objet ON deplacement.objet = objet.ID ORDER by Date";

// exécution de la requête
$result = mysqli_query($conn, $sql);

// Vérifier si la requête a retourné des résultats
if(mysqli_num_rows($result) > 0){
    echo "<h2>Liste des déplacements</h2>";
    echo "<table border='1' width='800'>";
    echo "<tr><th>ID</th><th>Date</th><th>Kilomètres</th><th>Objet</th><th>Detail</th></tr>";
   
    $total_km = 0; // initialiser le total des km à zéro
   
    // boucle pour afficher chaque ligne de résultat
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>" . $row["ID"] . "</td>";
        echo "<td>" . $row["Date"] . "</td>";
        echo "<td>" . $row["Km"] . "</td>";
        echo "<td>" . $row["objet_nom"] . "</td>";
        echo "<td>" . $row["Detail"] . "</td>";
        echo "</tr>";
     // ajouter les km de chaque ligne au total
     $total_km += $row["Km"];
    }
    
    // afficher le total des km
    echo "<tr><td colspan='2'></td><td><strong>Total : </strong></td><td></td><td><strong>" . $total_km . "</strong></td></tr>";
    
    echo "</table>";
} else {
    echo "Aucun déplacement trouvé.";
}

// libérer le résultat de la mémoire
mysqli_free_result($result);

// fermer la connexion à la base de données
mysqli_close($conn);
?>
