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
?>
