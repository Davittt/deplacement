<?php
require_once "connect.php"; // inclure le fichier de connexion

// requête SQL pour récupérer toutes les années disponibles
$sql_years = "SELECT DISTINCT YEAR(Date) AS year FROM deplacement ORDER BY year DESC";

// exécution de la requête
$result_years = mysqli_query($conn, $sql_years);

// Vérifier si la requête a retourné des résultats
if(mysqli_num_rows($result_years) > 0){
    // Créer une liste déroulante pour les années
    $options = "<option value=''>-- Sélectionner une année --</option>";
    while($row = mysqli_fetch_assoc($result_years)){
        $options .= "<option value='" . $row['year'] . "'>" . $row['year'] . "</option>";
    }
}

// Vérifier si le formulaire a été soumis
if(isset($_POST['submit'])) {
    // récupérer l'année sélectionnée
    $year = $_POST['year'];

    // requête SQL pour récupérer tous les déplacements de l'année sélectionnée et les objets correspondants
    $sql = "SELECT deplacement.*, objet.objet AS objet_nom FROM deplacement 
            JOIN objet ON deplacement.objet = objet.ID WHERE YEAR(Date) = '$year' ORDER by Date";

    // exécution de la requête
    $result = mysqli_query($conn, $sql);

    // Vérifier si la requête a retourné des résultats
    if(mysqli_num_rows($result) > 0){
        echo "<h2>Liste des déplacements en $year</h2>";
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
        echo "Aucun déplacement trouvé pour l'année $year.";
    }

    // libérer le résultat de la mémoire
    mysqli_free_result($result);
}

// afficher le formulaire
?>
<h2>Afficher les déplacements par année</h2>
<form method="post" action="">
    <label for="year">Année :</label>
    <select id="year" name="year">
        <?php echo $options; ?>
    </select>
    <br><br>
    <input type="submit" name="submit">
</form>
