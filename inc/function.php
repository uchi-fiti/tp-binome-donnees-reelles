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
                        <?php echo $dep['dept_no'], ": ";?>
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
            <div class="col">
                <div class="card text-center" style="height: 50px">
                    <p><?php echo $cli['first_name'], " ", $cli['last_name'];;?></p>
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
        <div class="BigBox">
        <div class="row">
                <div class="col-6">Department name</div>
                <div class="col-6">Manager's full name</div>
            </div>
        <?php
        while($data = mysqli_fetch_assoc($query))
        {
            ?>
        <div class="row">
                <div class="col-6"><?php echo $data['dept_name']; ?></div> 
                <div class="col-6"><?php echo $data['first_name']; echo " ";echo $data ['last_name']; ?></div> 
            </div>

            <?php
        }?></div><?php
       
    }
?>
