<h2>Ajouter un déplacement</h2>
<form action="ajouter_deplacement.php" method="post">
  <label for="date">Date :</label>
  <input type="date" name="date" required>
  <br>
  <label for="km">Kilomètres :</label>
  <input type="number" name="km" required>
  <br>
  <label for="objet">Objet :</label>
  <select name="objet_id">
    <?php
    require_once "connect.php"; // inclure le fichier de connexion

    // requête SQL pour récupérer tous les objets
    $sql = "SELECT * FROM objet";
    // exécution de la requête
    $result = mysqli_query($conn, $sql);

    // Vérifier si la requête a retourné des résultats
    if(mysqli_num_rows($result) > 0){
      // boucle pour afficher chaque objet comme option de la liste déroulante
      while($row = mysqli_fetch_assoc($result)){
        echo "<option value='".$row['ID']."'>".$row['objet']."</option>";
      }
    }

    // libérer le résultat de la mémoire
    mysqli_free_result($result);

    // fermer la connexion à la base de données
    mysqli_close($conn);
    ?>
  </select>
  <br>
  <label for="detail">Détail :</label>
  <textarea name="detail"></textarea>
  <br>
  <input type="submit" name="submit" value="Ajouter">
</form>
