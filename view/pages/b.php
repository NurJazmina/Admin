
<!-- <form action="process.php" method="post" class="mt-10">
    <button name="submit" type="submit" class="btn btn-success btn-block float-center">download</button>
</form> -->

<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);
$writer->save('./downloads/hello world.xlsx');

?>