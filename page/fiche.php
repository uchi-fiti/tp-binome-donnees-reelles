<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css"/>

</head>
<body>
    <?php 
        require("../inc/connexion.php");
        require("../inc/function.php");
    ?>
        
    <?php 
        $bd = connectionbd();
        $id_emp = $_GET['emp_no'];
        afficherFicheEmployee($bd, $id_emp);
        ?>
</body>
</html>
