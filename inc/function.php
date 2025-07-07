<?php 
    function afficherdepartements($bd)
    {
        $req = 'select * from departments;';
        $a = mysqli_query($bd, $req);
        while($dep = mysqli_fetch_assoc($a))
        {
            ?>
            <a href="page/employees.php?dept_no=<?php echo $dep['dept_no'];?>"> 
                <div class="col">
                    <div class="card text-center bg-light" style="height: 200px;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                        <!-- <?php echo $dep['dept_no'], ": ";?> -->
                        <?php echo $dep['dept_name'];?> 
                        </div>
                    </div>
                </div>
            </a>
            <?php
        }
    }
    function afficheremployees($bd, $dept_no)
    {
        $req = 'select * from dept_emp join employees on dept_emp.emp_no = employees.emp_no join departments on dept_emp.dept_no = departments.dept_no where dept_emp.dept_no = "%s" order by first_name asc;';
        $req = sprintf($req, $dept_no);
        $a = mysqli_query($bd, $req);

        while($cli = mysqli_fetch_assoc($a))
        {
            ?>
            <div class="col g-3" style="width: 100vw;">
                <a href="fiche.php?emp_no=<?php echo $cli['emp_no'];?>&departement=<?php echo $cli['dept_name'];?>">
                <div class="card text-center bg-light pt-3">
                    <p style="text-align: center;"><?php echo $cli['first_name'], " ", $cli['last_name'];;?></p>
                </div>
                </a>
            </div>
            <?php
        }
    }
    function managerDepartements($bd)
    {
        $request = " select * from departments join (select * from dept_manager where to_date > now()) as activeManagers on activeManagers.dept_no = departments.dept_no join employees on activeManagers.emp_no = employees.emp_no;";
        $query = mysqli_query($bd, $request);
        ?>
        <table class="table table-hover">
        <tr>
            <th>Department name</th>
            <th>Manager</th>
             <th>Number of employees</th>
            <th>Tableau</th>
        </tr>
        <?php
        while($data = mysqli_fetch_assoc($query))
        {
            ?>
                <tr>
                    <td><a href="page/employees.php?dept_no=<?php echo $data['dept_no'];?>&dept=<?php echo $data['dept_name'];?>"><?php echo $data['dept_name']; ?></a> </td>
                    <td><?php echo $data['first_name']; echo " ";echo $data ['last_name']; ?> </td>
                  <td><?php echo " ".nbEmpDept($bd,$data['dept_name'])." employees";?></td>
                  <td>
                    <a href="page/tableau.php?dept_no=<?php echo $data['dept_no'];?>">
                        Voir le tableau de cet emploi
                    </a>
                    </td>
                </tr>
            <?php
        }?>
        </table>
        <?php
    }
    function nbEmpDept($bd, $dept)
    {
        $request = "select count(*) as count from employees join dept_emp on dept_emp.emp_no = employees.emp_no join departments on departments.dept_no = dept_emp.dept_no where dept_name like '%".$dept."%'";
        $query = mysqli_query($bd,$request );
        if($data = mysqli_fetch_assoc($query))
        {
            return $data['count'];
        }
        return 0;
    }
    function afficherFicheEmployee($bd, $id_emp)
    {
        $req = 'select * from employees where emp_no = %d;';
        $req2 = 'select * from salaries join employees on salaries.emp_no = employees.emp_no 
        where salaries.emp_no = %d;';
        $req3 = 'select * from dept_emp join departments on dept_emp.dept_no = departments.dept_no 
        where emp_no = %d;';

        $req = sprintf($req, $id_emp);
        $req2 = sprintf($req2, $id_emp);
        $req3 = sprintf($req3, $id_emp);

        $a = mysqli_query($bd, $req);
        $a2 = mysqli_query($bd, $req2);
        $a3 = mysqli_query($bd, $req3);
        if($fiche = mysqli_fetch_assoc($a))
        {
            ?>
            <h3 class="text-center">Fiche de l'employe</h3>
            <table class="table table-hover text-center">
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Gender</th>
                <th>Birth date</th>
                <th>Hire date</th>
                <th>Department</th>
            </tr>
            <tr>
                <td><?php echo $fiche['first_name'];?></td>
                <td><?php echo $fiche['last_name'];?></td>
                <td><?php echo $fiche['gender'];?></td>
                <td><?php echo $fiche['birth_date'];?></td>
                <td><?php echo $fiche['hire_date'];?></td>
                <td><?php echo $_GET['departement'];?></td>
            </tr>
            </table>
            <?php
        }
        ?>
        <h3 class="text-center">Historique salaire</h3>
        <table class="table table-hover text-center">
        <tr>
            <th>From</th>
            <th>To</th>
            <th>Salary</th>
        </tr>
        <?php
        while($fiche = mysqli_fetch_assoc($a2))
        {
            if($fiche['to_date'] != "9999-01-01")
            {
            ?>
            <tr>
                <td><?php echo $fiche['from_date'];?></td>
                <td><?php echo $fiche['to_date'];?></td>
                <td><?php echo $fiche['salary'];?></td>
            </tr>
            <?php
            }
        }
        ?>
        </table>
        <h3 class="text-center">Historique emploi</h3>
        <table class="table table-hover text-center">
        <tr>
            <th>From</th>
            <th>To</th>
            <th>Emploi</th>
        </tr>
        <?php
        while($fiche = mysqli_fetch_assoc($a3))
        {
            if($fiche['to_date'] != "9999-01-01")
            {
            ?>  
            <tr>
                <td><?php echo $fiche['from_date'];?></td>
                <td><?php echo $fiche['to_date'];?></td>
                <td><?php echo $fiche['dept_name'];?></td>
            </tr>
            <?php
            }
        }
        ?>
        </table>
        <?php
    }
    function choixDepartements($bd)
    { 
      $request = "select * from departments;";
      $query = mysqli_query($bd, $request);
      ?>
      <select id="departement" name="departement">  
      <option value="tous"> Tous les departements </option>
        <?php  while($data=mysqli_fetch_assoc($query))
        {
            ?>
             <option value="<?php echo htmlspecialchars($data['dept_name']); ?>"><?php echo $data['dept_name']; ?> </option>
            <?php
        }
        
        ?>
        </select>
        <?php
    }
    
    // function dateMoins18Ans($date) {
    //     $d = new DateTime($date);
    //     $d->modify('-18 years'); // or: $d->sub(new DateInterval('P18Y'));
    //     return $d->format('Y-m-d');
    // }
?>
