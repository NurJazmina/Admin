<?php
include '../connections/db.php';
if (isset($_POST['DepartmentName']))
{
    $DepartmentName = $_POST['DepartmentName'];
    echo $DepartmentName;
}