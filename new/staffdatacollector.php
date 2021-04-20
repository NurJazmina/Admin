<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$DatabaseConnectionString="mongodb://admin:TempPassword@124.217.235.244:27017/gngoffice?authSource=admin";
$Database = new MongoDB\Driver\Manager($DatabaseConnectionString);

if (isset($_POST["sid"]) && !empty($_POST["sid"])) {
  if (!isset($_POST["txtfullname"]) && empty($_POST["txtfullname"])) {
    
  } else {
    $varfullname = strtoupper($_POST["txtfullname"]); 
  }
  if (!isset($_POST["txtjob"]) && empty($_POST["txtjob"])) {
    
  } else {
    $varjob = strtoupper($_POST["txtjob"]); 
  }
  if (!isset($_POST["txtdocumentno"]) && empty($_POST["txtdocumentno"])) {
    
  } else {
    $vardocumentno = $_POST["txtdocumentno"]; 
  }
  if (!isset($_POST["txtemail"]) && empty($_POST["txtemail"])) {
    
  } else {
    $varemail = $_POST["txtemail"]; 
  }
  if (!isset($_POST["txtphone"]) && empty($_POST["txtphone"])) {
    
  } else {
    $varphone = $_POST["txtphone"]; 
  }
  $varschooldid = $_POST["sid"];
  
  $filter = ['StaffDocumentNo'=>$vardocumentno];
  $query = new MongoDB\Driver\Query($filter);
  $cursor1 = $Database->executeQuery('GoNGetzSmartSchool.StaffDataCollector',$query);
  $varerror = "1";
  
  foreach ($cursor1 as $document1) {
    $varerror = "0";
  }
  
  if ($varerror=="1") {
    $GoNGetzBackEndConnectionString="mongodb://admin:TempPassword@124.217.235.244:27017/gngoffice?authSource=admin";
    $GoNGetzBackEnd = new MongoDB\Driver\Manager($GoNGetzBackEndConnectionString);
    $bulk = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
    $bulk->insert(['School_id'=>$varschooldid,
                   'StaffName'=>$varfullname,
                   'StaffJobTitle'=>$varjob,
                   'StaffDocumentType'=>"MYKAD",
                   'StaffDocumentNo'=>$vardocumentno,
                   'StaffEmail'=>$varemail,
                   'StaffPhoneNo'=>$varphone,
                  ]);
    $GoNGetzBackEnd = new MongoDB\Driver\Manager($GoNGetzBackEndConnectionString);
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);

    $result = $GoNGetzBackEnd->executeBulkWrite('GoNGetzSmartSchool.StaffDataCollector', $bulk, $writeConcern);  
  }
  
} else {
  if (isset($_GET['sid']) && !empty($_GET['sid'])) {
    $id = new \MongoDB\BSON\ObjectId($_GET['sid']);
    $filter = ['_id'=>$id];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $Database->executeQuery('GoNGetzSmartSchool.Schools',$query);

    foreach ($cursor as $document) {
      $_SESSION["SchoolName"] = ($document->SchoolsName);
      $_SESSION["SchoolID"] = ($document->_id);
    }  
  }
}
?>
<!-- live chat start-->
<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="688d97be-cab6-4cc7-9458-e78b5df8cba4";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
<!-- live chat end-->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
      .row {
        margin-top:5px;
      }
      .readonly {
        background-color:#EDEDED;
      }
    </style>
    <title>Go N Getz - Pendaftaran</title>
  </head>
  <body>
    <div class="row" style="padding-top:0px;margin-top:0px;">
      <div class="col">
        <img src="image/datacollector-bg-header.png" class="img-fluid" style="width:100%;">
      </div>
    </div>
    <nav class="navbar fixed-bottom navbar-light bg-light">
      <div class="container-fluid text-center">
        <span class="navbar-text">
          Untuk bantuan, hubungi <a href="tel:+60127180877">+60127180877</a>
        </span>
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <strong><?php echo $_SESSION["SchoolName"]; ?></strong>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <?php
              if (!isset($_POST["sid"]) && empty($_POST["sid"])) {
                ?>
                <form name="data" method="POST" action="staffdatacollector.php" >
                  <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Nama Penuh</label>
                    <div class="col-sm-10">
                      <input name="txtfullname" type="text" class="form-control" placeholder="ALI BIN ABU">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Jawatan</label>
                    <div class="col-sm-10">
                      <input name="txtjob" type="text" class="form-control" placeholder="GURU">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">MyKad</label>
                    <div class="col-sm-10">
                      <input name="txtdocumentno" type="text" class="form-control" placeholder="123456789012">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input name="txtemail" type="text" class="form-control" placeholder="saya@gmail.com">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Telefon Bimbit</label>
                    <div class="col-sm-10">
                      <input name="txtphone" type="text" class="form-control" placeholder="0123456789">
                    </div>
                  </div>
                  <input name="sid" type="hidden" value="<?php echo $_SESSION["SchoolID"] ;?>">
                  <button type="submit" class="btn btn-primary">Daftar</button>
                </form>
                <?php
              } else {
                ?>
                <div class="row">
                  <div class="col">
                    <div class="card alert-primary">
                      <div class="card-body">
                        <div class="text-center">
                          Anda telah didaftarkan.
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>