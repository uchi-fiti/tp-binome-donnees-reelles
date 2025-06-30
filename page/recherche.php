<?php
    require("../inc/connexion.php");
    require("../inc/function.php");

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Formulaire de recherche</title>
  <link rel="stylesheet" href="../assets/rstyle.css">
</head>
<body>
    <div class="form-container">
      <h2>Fiche de recherche d'employes</h2>
    <form action="traiterecherche.php" method = "get">
      <label for="nom">Nom :</label>
      <input type="text" id="nom" name="nom" placeholder="Entrez un nom">

      <label for="age-min">Age minimum :</label>
      <input type="number" id="age-min" name="age_min" min="0" placeholder="Min">

      <label for="age-max">Age maximum :</label>
      <input type="number" id="age-max" name="age_max" min="0" placeholder="Max">

      <label for="departement">Département :</label>
    <?php   $bd = connectionbd();
        choixDepartements($bd);?>

      <button type="submit">Rechercher</button>
    </form>
  </div>
</body>
</html>
