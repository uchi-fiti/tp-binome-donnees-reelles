<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/rstyle.css">
    <title>Document</title>
</head>
<body>
    <?php
    require("../inc/function.php");
    require("../inc/connexion.php");

    $bd = connectionbd();
    $dep = $_GET['departement'];
    $name = $_GET['nom'];
    $ageMin = $_GET['age_min'];
    $ageMax = $_GET['age_max'];

    $count = 0;
    $request = "";
    
    if($dep = "tous")
    {
        if($ageMin == '' && $ageMax != '')
        {
            $anneeMin = 2025 - $ageMax;
            $request = "select * from dept_emp join employees on dept_emp.emp_no = employees.emp_no join departments on departments.dept_no = dept_emp.dept_no where  first_name = '%s' AND YEAR(birth_date) >= %d limit 20;";
            $request = sprintf($request, $name, $anneeMin);
    
        }
        else if($ageMax == ''&& $ageMin != '')
        {
            $anneeMax = 2025 - $ageMin;
            $request = "select * from dept_emp join employees on dept_emp.emp_no = employees.emp_no join departments on departments.dept_no = dept_emp.dept_no where first_name = '%s' AND YEAR(birth_date) <= %d limit 20;";
            $request = sprintf($request,  $name, $anneeMax);
        }
        else if ($ageMax == '' && $ageMin == '')
        {
            $request = "select * from dept_emp join employees on dept_emp.emp_no = employees.emp_no join departments on departments.dept_no = dept_emp.dept_no where first_name = '%s' limit 20;";
            $request = sprintf($request,  $name);
        }
        else{
            $anneeMax = 2025 - $ageMin;
            $anneeMin = 2025 - $ageMax;
            $request = "select * from dept_emp join employees on dept_emp.emp_no = employees.emp_no join departments on departments.dept_no = dept_emp.dept_no where first_name = '%s' AND YEAR(birth_date) <= %d AND YEAR(birth_date) >= %d limit 20;";
            $request = sprintf($request, $name, $anneeMax, $anneeMin);
        }
    }
    else{
        if($ageMin == '' && $ageMax != '')
        {
            $anneeMax = 2025 - $ageMin;
            $request = "select * from dept_emp join employees on dept_emp.emp_no = employees.emp_no join departments on departments.dept_no = dept_emp.dept_no where dept_name = '%s' AND first_name = '%s' AND YEAR(birth_date) >= %d limit 20;";
            $request = sprintf($request, $dep, $name, $anneeMin);
    
        }
        else if($ageMax == '' && $ageMin != '')
        {
            $anneeMax = 2025 - $ageMin;
            
            $request = "select * from dept_emp join employees on dept_emp.emp_no = employees.emp_no join departments on departments.dept_no = dept_emp.dept_no where dept_name = '%s' AND first_name = '%s' AND YEAR(birth_date) <= %d limit 20;";
            $request = sprintf($request, $dep, $name, $anneeMax);
        }
        else if ($ageMax == '' && $ageMin == '')
        {
            
            $request = "select * from dept_emp join employees on dept_emp.emp_no = employees.emp_no join departments on departments.dept_no = dept_emp.dept_no where dept_name = '%s' AND first_name = '%s' limit 20;";
            $request = sprintf($request, $dep, $name);
        }
        else{
            $anneeMax = 2025 - $ageMin;
            $anneeMin = 2025 - $ageMax;
            $request = "select * from dept_emp join employees on dept_emp.emp_no = employees.emp_no join departments on departments.dept_no = dept_emp.dept_no where dept_name = '%s' AND first_name = '%s' AND YEAR(birth_date) <= %d AND YEAR(birth_date) >= %d limit 20;";
            $request = sprintf($request, $dep, $name, $anneeMax, $anneeMin);

        }
    }
    
    $query = mysqli_query($bd, $request);
    ?>
    <table>
        <tr>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Birth date</td>
            <td>Department</td>
        </tr>
        <?php
        if($data = mysqli_fetch_assoc($query)){

         while($data = mysqli_fetch_assoc($query))
        {
            ?>
            <tr>
                <td><?php echo $data['first_name'];?></td>
                <td><?php echo $data['last_name'];?></td>
                <td><?php echo $data['birth_date']; ?></td>
                <td><?php echo $data['dept_name']; ?></td>
            </tr>
            <?php $count = $count + 1;
        }
    }
        if($count < 5)
        {
            for($i = 0; $i < (5 - $count); $i++)
            {
                ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
                <?php
            }
        }
        ?>
    </table>
    <a href = "recherche.php"><button >Retour a la fiche</button></a>
</body>
</html>