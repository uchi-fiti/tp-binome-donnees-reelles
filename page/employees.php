<?php 
    require("../inc/connexion.php");
    require("../inc/function.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
</head>
<body>
    <div class="container my-4">
        <div class="row row-cols-1">
            <?php 
                $bd = connectionbd();
                $dept_no = $_GET['dept_no'];
                afficherclients($bd, $dept_no);
            ?>
        </div>
    </div>
</body>
</html>