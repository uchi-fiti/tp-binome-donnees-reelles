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
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    require("../inc/function.php");
    require("../inc/connexion.php");
    session_start();
    if(!isset($_SESSION['indexPage']))
    {
        $_SESSION['indexPage'] = 0;
    }
    if(isset($_GET['ajoutpage']))
    {
        $_SESSION['indexPage'] = $_SESSION['indexPage'] + $_GET['ajoutpage'];
    }
    $bd = connectionbd();

    $request = "select * from dept_emp join employees on dept_emp.emp_no = employees.emp_no join departments on departments.dept_no = dept_emp.dept_no where 1=1 ";
    $rcount = "select count(*) as count from dept_emp join employees on dept_emp.emp_no = employees.emp_no join departments on departments.dept_no = dept_emp.dept_no where 1=1 ";
    if(isset($_SESSION['dep']) && $_SESSION['dep'] != "tous")
    {
        $request .= " and departments.dept_name = '".$_SESSION['dep']."'";
        $rcount .= " and departments.dept_name = '".$_SESSION['dep']."'";
    }
    if(isset($_SESSION['name']) && $_SESSION['name'] != "")
    {
        $request .= " and employees.first_name like '%".$_SESSION['name']."%' or employees.last_name like '%".$_SESSION['name']."%'";
        $rcount .= " and employees.first_name like '%".$_SESSION['name']."%' or employees.last_name like '%".$_SESSION['name']."%'";
    }
    if(isset($_SESSION['ageMin']) && $_SESSION['ageMin'] != "")
    {
        
        $add = " and employees.birth_date >= DATE_SUB(CURDATE(), INTERVAL ".$_SESSION['ageMin']." YEAR)";
        $rcount .= $add;
        $request .= $add;
    }
    if(isset($_SESSION['ageMax']) && $_SESSION['ageMax'] != "")
    {
        $add = " and employees.birth_date >= DATE_SUB(CURDATE(), INTERVAL ".$_SESSION['ageMax']." YEAR)";
        $rcount .= $add;
        $request .= $add;
       
    }
    $count = $_SESSION['indexPage']*20 ;
    $add = " order by employees.last_name asc limit %d ,20; ";
    $request .= sprintf($add, $count);
    $query = mysqli_query($bd, $request);
    $queryCount = mysqli_query($bd, $rcount);
    $dataCount = mysqli_fetch_assoc($queryCount);
    $count = $dataCount['count'];

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
        if($count < 20)
        {
            for($i = 0; $i < (20 - $count); $i++)
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
    <?php
        $nbPage = ceil($count / 20);
        if($_SESSION['indexPage'] > 0)
        {
            ?>
            <a href="afficherresult.php?ajoutpage=<?php echo -1; ?>"><button>Precedent</button></a>
            <?php
        }
        if($_SESSION['indexPage'] < $nbPage - 1)
        {
            ?>
            <a href="afficherresult.php?ajoutpage=<?php echo 1; ?>"><button>Suivant</button></a>
            <?php
        }

    ?>
</body>
</html>