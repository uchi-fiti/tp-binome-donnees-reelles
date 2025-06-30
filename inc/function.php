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
    function afficherclients($bd, $dept_no)
    {
        $req = 'select employees.first_name, employees.last_name from dept_manager join employees on dept_manager.emp_no = employees.emp_no where dept_no = "%s";';
        $req = sprintf($req, $dept_no);
        $a = mysqli_query($bd, $req);
        while($cli = mysqli_fetch_assoc($a))
        {
            ?>
            <div class="col g-3" style="width: 100vw;">
                <div class="card text-center bg-light pt-3">
                    <p style="text-align: center;"><?php echo $cli['first_name'], " ", $cli['last_name'];;?></p>
                </div>
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
        </tr>
        <?php
        while($data = mysqli_fetch_assoc($query))
        {
            ?>
                <tr>
                    <td><?php echo $data['dept_name']; ?></div> </td>
                    <td><?php echo $data['first_name']; echo " ";echo $data ['last_name']; ?> </td>
                </tr>

            <?php
        }?>
        </table>
        <?php
       
    }
    function choixDepartements($bd)
    { 
      $request = "select * from departments;";
      $query = mysqli_query($bd, $request);
      ?>
      <select id="departement" name="departement">  
      <option value="tous"> Tout les departements </option>
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
