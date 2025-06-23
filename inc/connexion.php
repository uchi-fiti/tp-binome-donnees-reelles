<?php 
function connectionbd()
{
    $bd = mysqli_connect('localhost', 'root', '', 'employees');
    return $bd;
}
?>