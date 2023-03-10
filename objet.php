<?php
require_once('connect.php');

// Requête SQL pour sélectionner toutes les lignes de la table "objet"
$sql = "SELECT * FROM objet";

// Exécution de la requête SQL
$result = mysqli_query($conn, $sql);

// Vérification des erreurs éventuelles
if (!$result) {
    echo 'Erreur SQL : ' . mysqli_error($conn);
    exit;
}

// Affichage des résultats sous forme de tableau HTML
echo '<table>';
echo '<tr><th>ID</th><th>Objet</th></tr>';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['ID'] . '</td>';
    echo '<td>' . $row['objet'] . '</td>';
    echo '</tr>';
}
echo '</table>';

// Libération de la mémoire associée au résultat de la requête SQL
mysqli_free_result($result);

// Fermeture de la connexion à la base de données
mysqli_close($conn);
?>
