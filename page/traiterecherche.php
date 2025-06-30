<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    session_start();

    $_SESSION['dep'] = $_GET['departement'];
    $_SESSION['name']= $_GET['nom'];
    $_SESSION['ageMin'] = $_GET['age_min'];
    $_SESSION['ageMax'] = $_GET['age_max'];
    $_SESSION['indexPage'] = 0;

    header("Location:afficherresult.php");
    
 ?>
