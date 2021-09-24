<?php
// We'll be outputting a PDF
// header('Content-Type: application/vnd.ms-excel; charset=utf-8');

// // It will be called downloaded.pdf
// header('Content-Disposition: attachment; filename="downloaded.xls"');

// // The PDF source is in original.pdf
// readfile('original.xls');

header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=attendance.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
?>
<table id="attendance" class="table table-border table-white">
<thead>
    <tr>
        <th>Staff ID</th>
        <th>Staff Name</th>
        <th>Date</th>
        <th>IN</th>
        <th>OUT</th>
    </tr>
</thead>
<tbody>
    <tr>
        <th>a</th>
        <th>b</th>
        <th>c</th>
        <th>d</th>
        <th>e</th>
    </tr>
</tbody>
</table>
<?php
header ('smartschool.gongetz.com/index.php?page=a');