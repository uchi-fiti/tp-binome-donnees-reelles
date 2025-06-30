<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/style.css">
    <title>Departments list</title>
</head>
<body>
    <h1 style="text-align: center;">Liste des departements</h1>
    <div class="container my-4">
    <?php 
    require("inc/connexion.php");
    require("inc/function.php");
    $bd = connectionbd();
    managerDepartements($bd);
     ?>
     </div>
</body>
</html>