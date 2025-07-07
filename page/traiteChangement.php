<?php
    require("../inc/connexion.php");
    require("../inc/function.php");
    $bd = connectionbd();

    $depno = departementNo($bd, $_GET['departement']);
    $request = "update dept_emp set from_date = '%s', dept_no = '%s' where emp_no = %d";
    $request = sprintf($request, $_GET['daty'], $depno, $_GET['id_emp']);

    mysqli_query($bd, $request);
    header("Location:changeDepartement.php?idempl=".$_GET['id_emp']."");
?>