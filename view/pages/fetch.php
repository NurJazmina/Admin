<?php
$emps = json_decode($_POST['emps']);

print_r($emps);
foreach ($emps as $emp) {
    print_r($emp->name);
}
?>