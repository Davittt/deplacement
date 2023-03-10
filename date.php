<?php
require_once "connect.php"; // inclure le fichier de connexion

// Vérifier si le formulaire a été soumis
if(isset($_POST['submit'])){
    // Récupérer les valeurs des champs de date
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // requête SQL pour récupérer les déplacements et les objets correspondants entre deux dates
    $sql = "SELECT deplacement.*, objet.objet AS objet_nom FROM deplacement 
            JOIN objet ON deplacement.objet = objet.ID
            WHERE Date BETWEEN '$start_date' AND '$end_date' ORDER BY date ASC";

    // exécution de la requête
    $result = mysqli_query($conn, $sql);

    // Vérifier si la requête a retourné des résultats
    if(mysqli_num_rows($result) > 0){
        echo "<h2>Liste des déplacements entre le $start_date et le $end_date</h2>";
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
        echo "Aucun déplacement trouvé entre le $start_date et le $end_date.";
    }

    // libérer le résultat de la mémoire
    mysqli_free_result($result);
}

// fermer la connexion à la base de données
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des déplacements</title>
</head>
<body>
    <h2>Choisir une période de temps</h2>
    <form method="post">
        <label for="start_date">Date de début :</label>
        <input type="date" id="start_date" name="start_date" required>

        <label for="end_date">Date de fin :</label>
        <input type="date" id="end_date" name="end_date" required>

        <input type="submit" name="submit" value="Afficher">
</form>    
    