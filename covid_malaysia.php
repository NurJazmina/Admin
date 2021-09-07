<?php
$filename = 'https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_malaysia.csv';

// Open the file for reading
if (($h = fopen("{$filename}", "r")) !== FALSE) 
{
    while (($row = fgetcsv($h, 0, ",")) !== FALSE) {
        //Print out my column data.
        echo 'date: ' . $row[0] . '<br>';
        echo 'cases_new: ' . $row[1] . '<br>';
        echo 'cases_import: ' . $row[2] . '<br>';
        echo 'cluster_import: ' . $row[3] . '<br>';
        echo 'cluster_religious: ' . $row[4] . '<br>';
        echo 'cluster_community: ' . $row[6] . '<br>';
        echo 'cluster_highRisk: ' . $row[7] . '<br>';
        echo 'cluster_education: ' . $row[8] . '<br>';
        echo 'cluster_detentionCentre: ' . $row[9] . '<br>';
        echo 'cluster_workplace: ' . $row[10] . '<br>';
        echo '<br>';
    }

  // Close the file
  fclose($h);
}
?>

