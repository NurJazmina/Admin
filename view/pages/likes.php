<?php

$existingname = array("Daniel", "Dennis", "Danny", "Jane");

if (isset($_POST['like'])){
    $name = $_POST['like'];
    foreach ($existingname as $newname){
        if(stripos($newname, $name) !== false){
            echo $newname;
            echo "<br>";
        }
    }
}


?>