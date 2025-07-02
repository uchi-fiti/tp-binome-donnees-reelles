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
<nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4">

<div class="collapse navbar-collapse" id="navbarContent">
    <ul class="navbar-nav ms-7">
        <li class="nav-item">
            <a class="nav-link" href="page/recherche.php">Rechercher un employé</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="page/tableau.php?dept_no=<?php echo $data['dept_no']; ?>">Tableau des emplois</a>
        </li>
    </ul>
</div>
</nav>
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