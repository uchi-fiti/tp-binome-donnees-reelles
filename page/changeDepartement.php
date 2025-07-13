<?php
    require("../inc/connexion.php");
    require("../inc/function.php");

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Changer de departement</title>
  <link rel="stylesheet" href="../assets/rstyle.css">
</head>
<body>
    <div class="form-container">
      <h2>Fiche de changement d'employes</h2>
    <form action="traiteChangement.php" method = "get">


      <label for="departement">Département :</label>
    <?php   $bd = connectionbd();
        choixDepartementsUnique($bd);?>

    <label for="daty">Beginning date :</label> 
    <!-- Nom ou partie du nom a rechercher -->
    <input type="date" id="daty" name="daty" placeholder="Entrez une date">
    <input type="hidden" name="id_emp" value= <?php echo $_GET["idempl"]; ?>>
      <button type="submit">Confirmer</button>
      <button><a href="fiche.php?emp_no=<?php echo $_GET["idempl"]; ?>"> Retour </a> </button>
    </form>
  </div>
</body>
</html>
