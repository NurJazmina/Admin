<?php
  //database server//
  $GoNGetzConnectionString="mongodb://admin:TempPassword@139.99.97.227:27017/gngbazzar?authSource=admin";
  //$GoNGetzConnectionString="mongodb://admin:TempPassword@51.79.173.45:27017/gngoffice?authSource=admin";

  //production server//
  //$GoNGetzConnectionString="mongodb://admin:TempPassword@124.217.235.244:27017/gngoffice?authSource=admin";

  $GnGBazzar = new MongoDB\Driver\Manager($GoNGetzConnectionString);
?>
