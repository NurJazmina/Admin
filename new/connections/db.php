<?php
<<<<<<< HEAD
  
  //database server//
  $GoNGetzConnectionString="mongodb://admin:TempPassword@51.79.173.45:27017/gngoffice?authSource=admin";

  //production server//
  //$GoNGetzConnectionString="mongodb://admin:TempPassword@124.217.235.244:27017/gngoffice?authSource=admin";
=======
  //$GoNGetzConnectionString="mongodb://admin:TempPassword@51.79.173.45:27017/gngoffice?authSource=admin";
  $GoNGetzConnectionString="mongodb://admin:TempPassword@51.79.173.45:27017/gngoffice?authSource=admin";
>>>>>>> 5c6f3487f0bce238ab6e344ca603b9677e720b0b
  $GoNGetzDatabase = new MongoDB\Driver\Manager($GoNGetzConnectionString);
?>
