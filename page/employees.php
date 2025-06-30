<?php 
    require("../inc/connexion.php");
    require("../inc/function.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../assets/style.css">
    <title>Employees</title>
</head>
<body>
    <h3 style="text-align: center;">Liste des employees du departement <?php echo $_GET['dept'];?></h3>
    <div class="container my-4">
        <div class="row row-cols-1">
            <?php 
                $bd = connectionbd();
                $dept_no = $_GET['dept_no'];
                afficheremployees($bd, $dept_no);
            ?>
        </div>
    </div>
</body>
</html>