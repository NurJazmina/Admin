<?php
    $json = json_decode($_POST['json']);
    print_r($_POST['json']);
    // $nric = $json['nric'];
    // $password = $json['password'];
    
    foreach ($json as $value) {
        echo "<br> $value";
    }
?>