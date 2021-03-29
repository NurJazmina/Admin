<?php
session_start();

if (isset($_GET["reset"]) && !empty($_GET["reset"])) {
  if ($_GET["reset"]=="yes") {
    session_unset();
    session_destroy();
    session_start();
  } 
}

$DatabaseConnectionString="mongodb://admin:TempPassword@124.217.235.244:27017/gngoffice?authSource=admin";
$Database = new MongoDB\Driver\Manager($DatabaseConnectionString);

 if (isset($_GET['sid']) && !empty($_GET['sid'])) {
   $id = new \MongoDB\BSON\ObjectId($_GET['sid']);
   $filter = ['_id'=>$id];
   $query = new MongoDB\Driver\Query($filter);
   $cursor = $Database->executeQuery('GoNGetzSmartSchool.Schools',$query);
   $varcounterid = 0;
   
   foreach ($cursor as $document) {
     $_SESSION["SchoolName"] = ($document->SchoolsName);
     $_SESSION["SchoolID"] = ($document->_id);
   }
 } else {
   $id = new \MongoDB\BSON\ObjectId($_POST['sid']);
   $filter = ['_id'=>$id];
   $query = new MongoDB\Driver\Query($filter);
   $cursor = $Database->executeQuery('GoNGetzSmartSchool.Schools',$query);
   $varcounterid = 0;
   
   foreach ($cursor as $document) {
     $_SESSION["SchoolName"] = ($document->SchoolsName);
     $_SESSION["SchoolID"] = ($document->_id);
   }
 }
if (isset($_GET["step"]) && !empty($_GET["step"])) {
  $_SESSION["step"] = $_GET["step"]; 
} else {
  $_SESSION["step"] = "0";
}
if (isset($_GET["step"]) && !empty($_GET["step"])) {
  if ($_GET["step"]=="1") {
    $_SESSION["step"] = "1";
    
    $filter = ['SchoolID'=>$_GET["sid"]];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $Database->executeQuery('GoNGetzSmartSchool.DataCollector',$query);
    
    foreach ($cursor as $document) {
      $datadocumentid = ($document->Parent1DocumentNumber);
      if ($datadocumentid==$_GET["txtdocumentno1"]){
        header('location:http://smartschool.gongetz.com/datacollector.php?page=registered'); 
      }
    }
    if (isset($_GET["txtparentname1"]) && !empty($_GET["txtparentname1"])) {
      $_SESSION["parentname1"] = strtoupper($_GET["txtparentname1"]);
      if (isset($_GET["txtdocumenttype1"]) && !empty($_GET["txtdocumenttype1"])) {
        $_SESSION["documenttype1"] = $_GET["txtdocumenttype1"];
        if (isset($_GET["txtdocumentno1"]) && !empty($_GET["txtdocumentno1"])) {
          $_SESSION["documentno1"] = strtoupper($_GET["txtdocumentno1"]);
          if (isset($_GET["txtphone11"]) && !empty($_GET["txtphone11"])) {
            $_SESSION["phone11"] = $_GET["txtphone11"];
            if (isset($_GET["txtphone12"]) && !empty($_GET["txtphone12"])) {
              $_SESSION["phone12"] = $_GET["txtphone12"];
              if (isset($_GET["txtrelation1"]) && !empty($_GET["txtrelation1"])) {
                $_SESSION["relation1"] = $_GET["txtrelation1"];
                if (isset($_GET["txtmaritalstatus"]) && !empty($_GET["txtmaritalstatus"])) {
                  $_SESSION["maritalstatus"] = $_GET["txtmaritalstatus"];
                  if (isset($_GET["txthelp"]) && !empty($_GET["txthelp"])) {
                    $_SESSION["help"] = $_GET["txthelp"];
                  } else {
                    header('location:http://smartschool.gongetz.com/datacollector.php?sid='.$_Session["SchoolID"] . "&error=notcomplete");
                  }
                } else {
                  header('location:http://smartschool.gongetz.com/datacollector.php?sid='.$_Session["SchoolID"] . "&error=notcomplete");
                }
              } else {
                header('location:http://smartschool.gongetz.com/datacollector.php?sid='.$_Session["SchoolID"] . "&error=notcomplete");
              }
            } else {
              $_SESSION["phone12"] = "";
            }
          } else {
            header('location:http://smartschool.gongetz.com/datacollector.php?sid='.$_Session["SchoolID"] . "&error=notcomplete");
          }
        } else {
          header('location:http://smartschool.gongetz.com/datacollector.php?sid='.$_Session["SchoolID"] . "&error=notcomplete");
        }
      } else {
        header('location:http://smartschool.gongetz.com/datacollector.php?sid='.$_Session["SchoolID"] . "&error=notcomplete");
      }
    } else {
      header('location:http://smartschool.gongetz.com/datacollector.php?sid='.$_Session["SchoolID"] . "&error=notcomplete");
    }
  }
  elseif ($_GET["step"]=="2") {
    $_SESSION["step"] = "2";
    if (isset($_GET["txtparentname2"]) && !empty($_GET["txtparentname2"])) {
      $_SESSION["parentname2"] = strtoupper($_GET["txtparentname2"]);
      if (isset($_GET["txtdocumenttype2"]) && !empty($_GET["txtdocumenttype2"])) {
        $_SESSION["documenttype2"] = $_GET["txtdocumenttype2"];
        if (isset($_GET["txtdocumentno2"]) && !empty($_GET["txtdocumentno2"])) {
          $_SESSION["documentno2"] = strtoupper($_GET["txtdocumentno2"]);
          if (isset($_GET["txtphone21"]) && !empty($_GET["txtphone21"])) {
            $_SESSION["phone21"] = $_GET["txtphone21"];
            if (isset($_GET["txtphone22"]) && !empty($_GET["txtphone22"])) {
              $_SESSION["phone22"] = $_GET["txtphone22"];
              if (isset($_GET["txtrelation2"]) && !empty($_GET["txtrelation2"])) {
                $_SESSION["relation2"] = $_GET["txtrelation2"];
              }
            }
          } else {
            $_SESSION["step"]="1";
            header('location:http://smartschool.gongetz.com/datacollector.php?step=1&'.$_Session["SchoolID"] . "&error=notcomplete");
          }
        } else {
          $_SESSION["step"]="1";
          header('location:http://smartschool.gongetz.com/datacollector.php?step=1&sid='.$_Session["SchoolID"] . "&error=notcomplete");
        }
      }
    } else {
      $_SESSION["step"]="1";
      header('location:http://smartschool.gongetz.com/datacollector.php?step=1&sid='.$_Session["SchoolID"] . "&error=notcomplete");
    }
  }
  elseif ($_GET["step"]=="3") {
    $_SESSION["step"] = "3";
    $count = intval($_GET["txtnumberchild"]);
    $_SESSION["totalchild"] = $count;
  } 
  elseif ($_GET["step"]=="4") {
    $_SESSION["step"] = "4";
    $_SESSION["childname1"] = strtoupper($_GET["txtchildname1"]);
    $_SESSION["childdocumenttype1"] = $_GET["txtchilddocumenttype1"];
    $_SESSION["childdocumentno1"] = strtoupper($_GET["txtchilddocumentno1"]);
    if (isset($_GET["txtchildname2"]) && !empty($_GET["txtchildname2"])) {
      $_SESSION["childname2"] = strtoupper($_GET["txtchildname2"]);
      $_SESSION["childdocumenttype2"] = $_GET["txtchilddocumenttype2"];
      $_SESSION["childdocumentno2"] = strtoupper($_GET["txtchilddocumentno2"]);
    }
    if (isset($_GET["txtchildname3"]) && !empty($_GET["txtchildname3"])) {
      $_SESSION["childname3"] = strtoupper($_GET["txtchildname3"]);
      $_SESSION["childdocumenttype3"] = $_GET["txtchilddocumenttype3"];
      $_SESSION["childdocumentno3"] = strtoupper($_GET["txtchilddocumentno3"]);
    }
    if (isset($_GET["txtchildname4"]) && !empty($_GET["txtchildname4"])) {
      $_SESSION["childname4"] = strtoupper($_GET["txtchildname4"]);
      $_SESSION["childdocumenttype4"] = $_GET["txtchilddocumenttype4"];
      $_SESSION["childdocumentno4"] = strtoupper($_GET["txtchilddocumentno4"]);
    }
    if (isset($_GET["txtchildname5"]) && !empty($_GET["txtchildname5"])) {
      $_SESSION["childname5"] = strtoupper($_GET["txtchildname5"]);
      $_SESSION["childdocumenttype5"] = $_GET["txtchilddocumenttype5"];
      $_SESSION["childdocumentno5"] = strtoupper($_GET["txtchilddocumentno5"]);
    }
    if (isset($_GET["txtchildname6"]) && !empty($_GET["txtchildname6"])) {
      $_SESSION["childname6"] = strtoupper($_GET["txtchildname6"]);
      $_SESSION["childdocumenttype6"] = $_GET["txtchilddocumenttype6"];
      $_SESSION["childdocumentno6"] = strtoupper($_GET["txtchilddocumentno6"]);
    }
    if (isset($_GET["txtchildname7"]) && !empty($_GET["txtchildname7"])) {
      $_SESSION["childname7"] = strtoupper($_GET["txtchildname7"]);
      $_SESSION["childdocumenttype7"] = $_GET["txtchilddocumenttype7"];
      $_SESSION["childdocumentno7"] = strtoupper($_GET["txtchilddocumentno7"]);
    }
    if (isset($_GET["txtchildname8"]) && !empty($_GET["txtchildname8"])) {
      $_SESSION["childname8"] = strtoupper($_GET["txtchildname8"]);
      $_SESSION["childdocumenttype8"] = $_GET["txtchilddocumenttype8"];
      $_SESSION["childdocumentno8"] = strtoupper($_GET["txtchilddocumentno8"]);
    }
    if (isset($_GET["txtchildname9"]) && !empty($_GET["txtchildname9"])) {
      $_SESSION["childname9"] = strtoupper($_GET["txtchildname9"]);
      $_SESSION["childdocumenttype9"] = $_GET["txtchilddocumenttype9"];
      $_SESSION["childdocumentno9"] = strtoupper($_GET["txtchilddocumentno9"]);
    }
    if (isset($_GET["txtchildname10"]) && !empty($_GET["txtchildname10"])) {
      $_SESSION["childname10"] = strtoupper($_GET["txtchildname10"]);
      $_SESSION["childdocumenttype10"] = $_GET["txtchilddocumenttype10"];
      $_SESSION["childdocumentno10"] = strtoupper($_GET["txtchilddocumentno10"]);
    }
  }
  elseif ($_GET["step"]=="5") {
    $_SESSION["step"] = "5";
    if (isset($_GET["txtaddress"]) && !empty($_GET["txtaddress"])) {
      $_SESSION["address"] = strtoupper($_GET["txtaddress"]);
      if (isset($_GET["txthomephone"]) && !empty($_GET["txthomephone"])) {
        $_SESSION["homephone"] = $_GET["txthomephone"];
      }
    }
  }
  elseif ($_GET["step"]=="6") {
    $_SESSION["step"] = "6";
    
    if (!isset($_SESSION["childname2"]) && empty($_SESSION["childname2"])) {
      $_SESSION["childname2"] = "-";
      $_SESSION["childdocumenttype2"] = "-";
      $_SESSION["childdocumentno2"] = "-";
    }
    if (!isset($_SESSION["childname3"]) && empty($_SESSION["childname3"])) {
      $_SESSION["childname3"] = "-";
      $_SESSION["childdocumenttype3"] = "-";
      $_SESSION["childdocumentno3"] = "-";
    }
    if (!isset($_SESSION["childname4"]) && empty($_SESSION["childname4"])) {
      $_SESSION["childname4"] = "-";
      $_SESSION["childdocumenttype4"] = "-";
      $_SESSION["childdocumentno4"] = "-";
    }
    if (!isset($_SESSION["childname5"]) && empty($_SESSION["childname5"])) {
      $_SESSION["childname5"] = "-";
      $_SESSION["childdocumenttype5"] = "-";
      $_SESSION["childdocumentno5"] = "-";
    }
    if (!isset($_SESSION["childname6"]) && empty($_SESSION["childname6"])) {
      $_SESSION["childname6"] = "-";
      $_SESSION["childdocumenttype6"] = "-";
      $_SESSION["childdocumentno6"] = "-";
    }
    if (!isset($_SESSION["childname7"]) && empty($_SESSION["childname7"])) {
      $_SESSION["childname7"] = "-";
      $_SESSION["childdocumenttype7"] = "-";
      $_SESSION["childdocumentno7"] = "-";
    }
    if (!isset($_SESSION["childname8"]) && empty($_SESSION["childname8"])) {
      $_SESSION["childname8"] = "-";
      $_SESSION["childdocumenttype8"] = "-";
      $_SESSION["childdocumentno8"] = "-";
    }
    if (!isset($_SESSION["childname9"]) && empty($_SESSION["childname9"])) {
      $_SESSION["childname9"] = "-";
      $_SESSION["childdocumenttype9"] = "-";
      $_SESSION["childdocumentno9"] = "-";
    }
    if (!isset($_SESSION["childname10"]) && empty($_SESSION["childname10"])) {
      $_SESSION["childname10"] = "-";
      $_SESSION["childdocumenttype10"] = "-";
      $_SESSION["childdocumentno10"] = "-";
    }
    if (isset($_SESSION["totalchild"]) && !empty($_SESSION["totalchild"])) {
      $vartotalchild = intval($_SESSION["totalchild"]);  
    }
    
    $GoNGetzBackEndConnectionString="mongodb://admin:TempPassword@124.217.235.244:27017/gngoffice?authSource=admin";
    $GoNGetzBackEnd = new MongoDB\Driver\Manager($GoNGetzBackEndConnectionString);
    $bulk = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
    $bulk->insert(['SchoolID'=>$_GET["sid"],
                   'ParentName1'=>$_SESSION["parentname1"],
                   'Parent1DocumentType'=>$_SESSION["documenttype1"],
                   'Parent1DocumentNumber'=>$_SESSION["documentno1"],
                   'Parent1Phone1'=>$_SESSION["phone11"],
                   'Parent1Phone2'=>$_SESSION["phone21"],
                   'Parent1Rel'=>$_SESSION["relation1"],
                   'Parent1Marital'=>$_SESSION["maritalstatus"],
                   'GotAnyHelp'=>$_SESSION["help"],
                   'ParentName2'=>$_SESSION["parentname2"],
                   'Parent2DocumentType'=>$_SESSION["documenttype2"],
                   'Parent2DocumentNumber'=>$_SESSION["documentno2"],
                   'Parent2Phone1'=>$_SESSION["phone12"],
                   'Parent2Phone2'=>$_SESSION["phone22"],
                   'Parent2Rel'=>$_SESSION["relation2"],
                   'TotalChild'=>$vartotalchild,
                   'ChildName1'=>$_SESSION["childname1"],
                   'Child1DocumentType'=>$_SESSION["childdocumenttype1"],
                   'Child1DocumentNumber'=>$_SESSION["childdocumentno1"],
                   'ChildName2'=>$_SESSION["childname2"],
                   'Child2DocumentType'=>$_SESSION["childdocumenttype2"],
                   'Child2DocumentNumber'=>$_SESSION["childdocumentno2"],
                   'ChildName3'=>$_SESSION["childname3"],
                   'Child3DocumentType'=>$_SESSION["childdocumenttype3"],
                   'Child3DocumentNumber'=>$_SESSION["childdocumentno3"],
                   'ChildName4'=>$_SESSION["childname4"],
                   'Child4DocumentType'=>$_SESSION["childdocumenttype4"],
                   'Child4DocumentNumber'=>$_SESSION["childdocumentno4"],
                   'ChildName5'=>$_SESSION["childname5"],
                   'Child5DocumentType'=>$_SESSION["childdocumenttype5"],
                   'Child5DocumentNumber'=>$_SESSION["childdocumentno5"],
                   'ChildName6'=>$_SESSION["childname6"],
                   'Child6DocumentType'=>$_SESSION["childdocumenttype6"],
                   'Child6DocumentNumber'=>$_SESSION["childdocumentno6"],
                   'ChildName7'=>$_SESSION["childname7"],
                   'Child7DocumentType'=>$_SESSION["childdocumenttype7"],
                   'Child7DocumentNumber'=>$_SESSION["childdocumentno7"],
                   'ChildName8'=>$_SESSION["childname8"],
                   'Child8DocumentType'=>$_SESSION["childdocumenttype8"],
                   'Child8DocumentNumber'=>$_SESSION["childdocumentno8"],
                   'ChildName9'=>$_SESSION["childname9"],
                   'Child9DocumentType'=>$_SESSION["childdocumenttype9"],
                   'Child9DocumentNumber'=>$_SESSION["childdocumentno9"],
                   'ChildName10'=>$_SESSION["childname10"],
                   'Child10DocumentType'=>$_SESSION["childdocumenttype10"],
                   'Child10DocumentNumber'=>$_SESSION["childdocumentno10"],
                  ]);

    $GoNGetzBackEnd = new MongoDB\Driver\Manager($GoNGetzBackEndConnectionString);
    $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);

    try {
      $result = $GoNGetzBackEnd->executeBulkWrite('GoNGetzSmartSchool.DataCollector', $bulk, $writeConcern);
      session_unset();
    } catch (MongoDB\Driver\Exception\BulkWriteException $e) {
      $result = $e->getWriteResult();

      // Check if the write concern could not be fulfilled
      if ($writeConcernError = $result->getWriteConcernError()) {
          printf("%s (%d): %s\n",
              $writeConcernError->getMessage(),
              $writeConcernError->getCode(),
              var_export($writeConcernError->getInfo(), true)
          );
      }

      // Check if any write operations did not complete at all
      foreach ($result->getWriteErrors() as $writeError) {
          printf("Operation#%d: %s (%d)\n",
              $writeError->getIndex(),
              $writeError->getMessage(),
              $writeError->getCode()
          );
      }
    } catch (MongoDB\Driver\Exception\Exception $e) {
      printf("Other error: %s\n", $e->getMessage());
      exit;
    }
  }
} else {
  $_SESSION["step"] = "0";
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
      <?php
      if ($_GET["page"]=="registered") {
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
        } else {
          ?>
          <?php
          if (isset($_GET["error"]) && !empty($_GET["error"])) {
            ?>
            <div class="row">
              <div class="col">
                <div class="alert alert-danger text-center" role="alert">
                  Sila isi sepenuhnya borang ini.
                </div>
              </div>
            </div>
            <?php
          }
          ?>
          <?php
          if (!isset($_GET["step"]) && empty($_GET["step"])) {
            ?>
            <div class="row">
              <div class="col">
                <div class="card alert-primary">
                  <div class="card-body">
                    <div class="text-center">
                      Penyertaan program<br /><strong>SMART SCHOOL GO N GETZ</strong><br />di sekolah<br /><strong><?php echo $_SESSION["SchoolName"]; ?></strong>.
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
          }
          ?>
          <?php
          if ($_GET["step"]=="6"){

          } else {
            ?>
            <div class="row">
              <div class="col">
                <div class="card alert-info">
                  <div class="card-header">
                    <strong>Senarai Semak</strong>
                  </div>
                  <div class="card-body">
                    <?php
                    if (isset($_SESSION["step"]) && !empty($_SESSION["step"])) {
                      if ($_SESSION["step"]=="1"){
                        echo "&#x2705; Info bapa / ibu / penjaga 1<br />";
                        echo "Info bapa / ibu / penjaga 2<br />";
                        echo "Info anak / anak jagaan<br />";
                        echo "Info Kediaman";
                      }
                      elseif ($_SESSION["step"]=="2"){
                        echo "&#x2705; Info bapa / ibu / penjaga 1<br />";
                        echo "&#x2705; Info bapa / ibu / penjaga 2<br />";
                        echo "Info anak / anak jagaan<br />";
                        echo "Info Kediaman";
                      }
                      elseif ($_SESSION["step"]=="3"){
                        echo "&#x2705; Info bapa / ibu / penjaga 1<br />";
                        echo "&#x2705; Info bapa / ibu / penjaga 2<br />";
                        echo "Info anak / anak jagaan<br />";
                        echo "Info Kediaman";
                      }
                      elseif ($_SESSION["step"]=="4"){
                        echo "&#x2705; Info bapa / ibu / penjaga 1<br />";
                        echo "&#x2705; Info bapa / ibu / penjaga 2<br />";
                        echo "&#x2705; Info anak / anak jagaan<br />";
                        echo "Info Kediaman";
                      }
                      elseif ($_SESSION["step"]=="5"){
                        echo "&#x2705; Info bapa / ibu / penjaga 1<br />";
                        echo "&#x2705; Info bapa / ibu / penjaga 2<br />";
                        echo "&#x2705; Info anak / anak jagaan<br />";
                        echo "&#x2705; Info Kediaman";
                      }
                    } else {
                      echo "Info bapa / ibu / penjaga 1<br />";
                      echo "Info bapa / ibu / penjaga 2<br />";
                      echo "Info anak / anak jagaan<br />";
                      echo "Info Alamat";
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <?php
          }
          ?>
          <div class="row">
            <div class="col">
              <?php
               $varstep = $_SESSION["step"];
                if ($varstep=="0") {
                $_SESSION["step"] = "1";
                ?>
                <div class="card">
                  <div class="card-header">
                    <strong>Borang bapa / ibu / penjaga 1</strong>
                  </div>
                  <div class="card-body">
                    <form name="data1" method="GET" action="datacollector.php" >
                      <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Nama Penuh Bapa / Ibu / Penjaga</label>
                        <div class="col-sm-10">
                          <?php
                          if (!isset($_GET['parentname']) && empty($_GET['parentname'])) {
                            if (!isset($_SESSION["parentname1"]) && empty($_SESSION["parentname1"])) {
                              ?>
                              <input name="txtparentname1" type="text" class="form-control" placeholder="ALI BIN ABU">
                              <?php
                            } else {
                              ?>
                              <input name="txtparentname1" type="text" class="form-control" value="<?php echo $_SESSION['parentname1']; ?>">
                              <?php
                            }
                          } else {
                            ?>
                            <input name="txtparentname1" type="text" class="form-control" value="<?php echo $_GET['parentname']; ?>">
                            <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Jenis Pengenalan Diri</label>
                        <div class="col-sm-10">
                          <select name="txtdocumenttype1" class="form-select" aria-label="Default select example">
                            <option selected value="MYKAD">MyKad</option>
                            <option value="MYTENTERA">MyTentera</option>
                            <option value="KAD POLIS">Kad Polis</option>
                            <option value="MYPR">MyPR</option>
                            <option value="MYKAS">MYKAS</option>
                            <option value="PASSPORT">Passport</option>
                          </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Nombor Pengenalan Diri</label>
                        <div class="col-sm-10">
                          <?php
                          if (!isset($_SESSION["documentno1"]) && empty($_SESSION["documentno1"])) {
                            ?>
                            <input name="txtdocumentno1" type="text" class="form-control" placeholder="820627065344">
                            <?php
                          }
                          else {
                            ?>
                            <input name="txtdocumentno1" type="text" class="form-control" value="<?php echo $_SESSION["documentno1"]; ?>">
                            <?php
                          }
                          ?>

                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Nombor Telefon Peribadi</label>
                        <div class="col-sm-10">
                          <?php
                          if (!isset($_GET['phone']) && empty($_GET['phone'])) {
                            if (isset($_SESSION["phone11"]) && !empty($_SESSION["phone11"])) {
                            ?>
                              <input name="txtphone11" type="text" class="form-control" value="<?php echo $_SESSION["phone11"]; ?>">
                            <?php
                            } else {
                              ?>
                              <input name="txtphone11" type="text" class="form-control" placeholder="01234567890">
                              <?php
                            }
                            } else {
                            ?>
                            <input name="txtphone11" type="text" class="form-control" value=<?php echo $_GET['phone']; ?>
                            <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Nombor Telefon Pejabat / Keluarga / Kenalan</label>
                        <div class="alert alert-warning" role="alert">
                          Untuk tujuan kecemasan.
                        </div>
                        <div class="col-sm-10">
                          <?php
                          if (!isset($_SESSION["phone12"]) && empty($_SESSION["phone12"])) {
                            ?>
                            <input name="txtphone12" type="text" class="form-control" placeholder="012345678">
                            <?php
                          } else {
                            ?>
                            <input name="txtphone12" type="text" class="form-control" value="<?php echo $_SESSION["phone12"]; ?>">
                            <?php
                          }
                          ?>

                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Hubungan</label>
                        <div class="col-sm-10">
                          <select name="txtrelation1" class="form-select" aria-label="Default select example">
                            <option selected value="FATHER">Bapa</option>
                            <option value="MOTHER">Ibu</option>
                            <option value="GUARDIAN">Penjaga</option>
                          </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Status Perkahwinan</label>
                        <div class="col-sm-10">
                          <select name="txtmaritalstatus" class="form-select" aria-label="Default select example">
                            <option selected value="MARRIED">Berkahwin</option>
                            <option value="DIVORCE">Bercerai</option>
                            <option value="SINGLE">Bujang</option>
                          </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Adakah anda penerima salah satu bantuan dibawah?<div class="alert alert-light" role="alert">Zakat / Bantuan Sara Hidup Rakyat / Bantuan Awal Persekolahan</div></label>
                        <div class="col-sm-10">
                          <select name="txthelp" class="form-select" aria-label="Default select example">
                            <option selected value="NO">Tidak</option>
                            <option value="YES">Ya</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col text-end">
                          <input name="step" type="hidden" value="<?php echo $_SESSION["step"]; ?>">
                          <input name="sid" type="hidden" value="<?php echo $_Session["SchoolID"] ;?>">
                          <button type="submit" class="btn btn-primary">Buka Borang Bapa / Ibu / penjaga 2</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              <hr>
                <?php
              } else {
                if ($_GET["step"]=="1") {
                  $_SESSION["step"]="2";
                  ?>
                  <div class="card">
                    <div class="card-header">
                      <strong>Borang bapa / ibu / penjaga 2</strong>
                    </div>
                    <div class="card-body">
                      <form name="data2" method="GET" action="datacollector.php">
                        <div class="mb-3 row">
                          <label class="col-sm-2 col-form-label">Nama Penuh Ibu / Bapa / Penjaga</label>
                          <div class="col-sm-10">
                            <input name="txtparentname2" type="text" class="form-control" placeholder="PUTRI BINTI MASITAH">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-2 col-form-label">Jenis Pengenalan Diri</label>
                          <div class="col-sm-10">
                            <select name="txtdocumenttype2" class="form-select" aria-label="Default select example">
                              <option selected value="MYKAD">MyKad</option>
                              <option value="MYTENTERA">MyTentera</option>
                              <option value="KAD POLIS">Kad Polis</option>
                              <option value="MYPR">MyPR</option>
                              <option value="MYKAS">MYKAS</option>
                              <option value="PASSPORT">Passport</option>
                            </select>
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-2 col-form-label">Nombor Pengenalan Diri</label>
                          <div class="col-sm-10">
                            <input name="txtdocumentno2" type="text" class="form-control" placeholder="820627065344">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-2 col-form-label">Nombor Telefon Peribadi</label>
                          <div class="col-sm-10">
                            <input name="txtphone21" type="text" class="form-control" placeholder="01234567890">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-2 col-form-label">Nombor Telefon Pejabat / Keluarga / Kenalan</label>
                          <div class="alert alert-warning" role="alert">
                            Untuk tujuan kecemasan.
                          </div>
                          <div class="col-sm-10">
                            <input name="txtphone22" type="text" class="form-control" placeholder="012345678">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-2 col-form-label">Hubungan</label>
                          <div class="col-sm-10">
                            <select name="txtrelation2" class="form-select" aria-label="Default select example">
                              <option selected value="FATHER">Bapa</option>
                              <option value="MOTHER">Ibu</option>
                              <option value="GUARDIAN">Penjaga</option>
                            </select>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col text-end">
                            <input name="step" type="hidden" value="<?php echo $_SESSION["step"]; ?>">
                            <input name="sid" type="hidden" value="<?php echo $_Session["SchoolID"] ;?>">
                            <button type="submit" class="btn btn-primary">Buka Borang Anak / Anak Jagaan</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <?php
                }
                elseif ($_GET["step"]=="2") {
                  $_SESSION["step"]="3";
                ?>
                  <div class="card">
                    <div class="card-header">
                      <strong>Borang Anak / Anak Jagaan</strong>
                    </div>
                    <div class="card-body">
                      <form name="data3" method="GET" action="datacollector.php">
                        <div class="mb-3 row">
                          <label class="col-sm-2 col-form-label">Jumlah Anak yang Bersekolah di <?php echo $_SESSION["SchoolName"]; ?></label>
                          <div class="col-sm-10">
                            <input name="txtnumberchild" type="text" class="form-control" placeholder="0">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col text-end">
                            <input name="step" type="hidden" value="<?php echo $_SESSION["step"] ?>">
                            <input name="sid" type="hidden" value="<?php echo $_Session["SchoolID"] ;?>">
                            <button type="submit" class="btn btn-primary">Buka Seterusnya</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                <?php
                }
                elseif ($_GET["step"]=="3") {
                  $_SESSION["step"]="4";
                ?>
                  <div class="card">
                    <div class="card-header">
                      <strong>Borang Anak / Anak Jagaan <?php echo $count;?></strong>
                    </div>
                    <div class="card-body">
                      <form name="data3" method="GET" action="datacollector.php">
                        <?php
                        for($i=1; $i<=$count; $i++){
                          ?>
                          <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Nama Penuh (<?php echo $i; ?>)</label>
                            <div class="col-sm-10">
                              <input name="txtchildname<?php echo $i;?>" type="text" class="form-control" placeholder="SITI">
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Jenis Pengenalan Diri (<?php echo $i; ?>)</label>
                            <div class="col-sm-10">
                              <select name="txtchilddocumenttype<?php echo $i;?>" class="form-select" aria-label="Default select example">
                                <option value="MYKID">MyKid</option>
                                <option selected value="MYKAD">MyKad</option>
                                <option value="PASSPORT">Passport</option>
                              </select>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Nombor Pengenalan Diri (<?php echo $i; ?>)</label>
                            <div class="col-sm-10">
                              <input name="txtchilddocumentno<?php echo $i;?>" type="text" class="form-control" placeholder="xxxxxxxxxxxx">
                            </div>
                          </div>
                        <hr>
                          <?php
                        }
                        ?>
                        <div class="row">
                          <div class="col text-end">
                            <input name="step" type="hidden" value="<?php echo $_SESSION["step"]; ?>">
                            <input name="sid" type="hidden" value="<?php echo $_Session["SchoolID"] ;?>">
                            <button type="submit" class="btn btn-primary">Buka Seterusnya</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                <?php
                }
                elseif ($_GET["step"]=="4") {
                  $_SESSION["step"]="5";
                ?>
                  <div class="card">
                    <div class="card-header">
                      <strong>Borang Kediaman</strong>
                    </div>
                    <div class="card-body">
                      <form name="data3" method="GET" action="datacollector.php">
                        <div class="mb-3 row">
                          <label class="col-sm-2 col-form-label">Alamat</label>
                          <div class="col-sm-10">
                            <textarea name="txtaddress" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-2 col-form-label">Nombor Telefon Kediaman</label>
                          <div class="col-sm-10">
                            <input name="txthomephone" type="text" class="form-control" placeholder="012345678">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col text-end">
                            <input name="step" type="hidden" value="<?php echo $_SESSION["step"] ?>">
                            <input name="sid" type="hidden" value="<?php echo $_Session["SchoolID"];?>">
                            <button type="submit" class="btn btn-primary">Semak</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                <?php
                }
                elseif ($_GET["step"]=="5") {
                  $_SESSION["step"]="6";
                  ?>
                  <div class="card">
                    <div class="card-header">
                      <strong>Maklumat</strong>
                    </div>
                    <div class="card-body">
                      <form name="data3" method="GET" action="datacollector.php">
                        <div class="alert alert-primary" role="alert">
                          Sila pastikan maklumat dibawah adalah tepat.
                        </div>
                        <form>
                          <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Nama Penuh Bapa / Ibu / Penjaga</label>
                            <div class="col-sm-10">
                              <input name="txtparentname1" type="text" class="form-control" value="<?php echo $_SESSION["parentname1"]; ?>">
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Jenis Pengenalan Diri</label>
                            <div class="col-sm-10">
                              <select name="txtdocumenttype1" class="form-select" aria-label="Default select example">
                                <option selected value="<?php echo $_SESSION["documenttype1"] ?>"><?php echo $_SESSION["documenttype1"] ?></option> 
                                <option value="MYKAD">MyKad</option>
                                <option value="MYTENTERA">MyTentera</option>
                                <option value="KAD POLIS">Kad Polis</option>
                                <option value="MYPR">MyPR</option>
                                <option value="MYKAS">MYKAS</option>
                                <option value="PASSPORT">Passport</option>
                              </select>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Nombor Pengenalan Diri</label>
                            <div class="col-sm-10">
                              <input name="txtdocumentno1" type="text" class="form-control" value="<?php echo $_SESSION["documentno1"]; ?>">
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Nombor Telefon Peribadi</label>
                            <div class="col-sm-10">
                              <input name="txtphone11" type="text" class="form-control" value=<?php echo $_SESSION["phone11"]; ?>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Nombor Telefon Pejabat / Keluarga / Kenalan</label>
                            <div class="alert alert-warning" role="alert">
                              Untuk tujuan kecemasan.
                            </div>
                            <div class="col-sm-10">
                              <input name="txtphone12" type="text" class="form-control" value="<?php echo $_SESSION["phone21"]; ?>">
                            </div>
                          </div>
                          <?php
                          $varrelation1 = $_SESSION["relation1"];
                          if ($varrelation1=="FATHER") {
                            $varrelation1 = "BAPA";
                          } elseif ($_SESSION["relation1"]="MOTHER") {
                            $varrelation1 = "IBU";
                          } else {
                            $varrelation1 = "PENJAGA";
                          }
                          ?>
                          <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Hubungan</label>
                            <div class="col-sm-10">
                              <select name="txtrelation1" class="form-select" aria-label="Default select example">
                                <option selected value="<?php echo $_SESSION["relation1"]; ?>"><?php echo $varrelation1; ?></option>
                                <option value="FATHER">Bapa</option>
                                <option value="MOTHER">Ibu</option>
                                <option value="GUARDIAN">Penjaga</option>
                              </select>
                            </div>
                          </div>
                          <?php
                          $varmaritalstatus = $_SESSION["maritalstatus"];
                          if ($varmaritalstatus=="SINGLE") {
                            $varmaritalstatus = "BUJANG";
                          } elseif ($varmaritalstatus=="DIVORCE") {
                            $varmaritalstatus = "BERCERAI";
                          } elseif ($varmaritalstatus=="MARRIED") {
                            $varmaritalstatus = "BERKAHWIN";
                          }
                          ?>
                          <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Status Perkahwinan</label>
                            <div class="col-sm-10">
                              <select name="txtmaritalstatus" class="form-select" aria-label="Default select example">
                                <option selected value="<?php echo $_SESSION["maritalstatus"]; ?>"><?php echo $varmaritalstatus; ?></option>
                                <option selected value="MARRIED">Berkahwin</option>
                                <option value="DIVORCE">Bercerai</option>
                                <option value="SINGLE">Bujang</option>
                              </select>
                            </div>
                          </div>
                          <?php
                          $varhelp = $_SESSION["help"];
                          if ($varhelp=="YES") {
                            $varhelp = "YA";
                          } else {
                            $varhelp = "TIDAK";
                          }
                          ?>
                          <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Penerima Bantuan</label>
                            <div class="col-sm-10">
                              <select name="txthelp" class="form-select" aria-label="Default select example">
                                <option selected value="<?php echo $_SESSION["help"]; ?>"><?php echo $varhelp; ?></option>
                                <option selected value="NO">Tidak</option>
                                <option value="YES">Ya</option>
                              </select>
                            </div>
                          </div>
                          <hr />
                          <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Nama Penuh Ibu / Bapa / Penjaga</label>
                            <div class="col-sm-10">
                              <input name="txtparentname2" type="text" class="form-control" value="<?php echo $_SESSION["parentname2"]; ?>">
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Jenis Pengenalan Diri</label>
                            <div class="col-sm-10">
                              <select name="txtdocumenttype2" class="form-select" aria-label="Default select example">
                                <option selected value="<?php echo $_SESSION["documenttype2"]; ?>"><?php echo $_SESSION["documenttype2"]; ?></option>
                                <option value="MYKAD">MyKad</option>
                                <option value="MYTENTERA">MyTentera</option>
                                <option value="KAD POLIS">Kad Polis</option>
                                <option value="MYPR">MyPR</option>
                                <option value="MYKAS">MYKAS</option>
                                <option value="PASSPORT">Passport</option>
                              </select>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Nombor Pengenalan Diri</label>
                            <div class="col-sm-10">
                              <input name="txtdocumentno2" type="text" class="form-control" value="<?php echo $_SESSION["documentno2"]; ?>">
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Nombor Telefon Peribadi</label>
                            <div class="col-sm-10">
                              <input name="txtphone21" type="text" class="form-control" value="<?php echo $_SESSION["phone12"]; ?>">
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Nombor Telefon Pejabat / Keluarga / Kenalan</label>
                            <div class="alert alert-warning" role="alert">
                              Untuk tujuan kecemasan.
                            </div>
                            <div class="col-sm-10">
                              <input name="txtphone22" type="text" class="form-control" value="<?php echo $_SESSION["phone22"]; ?>">
                            </div>
                          </div>
                          <?php
                          $varrelation2 = $_SESSION["relation2"];
                          if ($varrelation2=="FATHER") {
                            $varrelation2 = "BAPA";
                          } elseif ($varrelation2=="MOTHER") {
                            $varrelation2 = "IBU";
                          } else {
                            $varrelation2 = "PENJAGA";
                          }
                          ?>
                          <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Hubungan</label>
                            <div class="col-sm-10">
                              <select name="txtrelation2" class="form-select" aria-label="Default select example">
                                <option selected value="<?php echo $_SESSION["relation2"]; ?>"><?php echo $varrelation2; ?></option>
                                <option value="FATHER">Bapa</option>
                                <option value="MOTHER">Ibu</option>
                                <option value="GUARDIAN">Penjaga</option>
                              </select>
                            </div>
                          </div>
                          <hr />
                          <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Nama Penuh (1)</label>
                            <div class="col-sm-10">
                              <input name="txtchildname1" type="text" class="form-control" value="<?php echo $_SESSION["childname1"]; ?>">
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Jenis Pengenalan Diri (1)</label>
                            <div class="col-sm-10">
                              <select name="txtchilddocumenttype1" class="form-select" aria-label="Default select example">
                                <option value="<?php echo $_SESSION["childdocumenttype1"]; ?>"><?php echo $_SESSION["childdocumenttype1"]; ?></option>
                                <option value="MYKID">MyKid</option>
                                <option selected value="MYKAD">MyKad</option>
                                <option value="PASSPORT">Passport</option>
                              </select>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Nombor Pengenalan Diri (1)</label>
                            <div class="col-sm-10">
                              <input name="txtchilddocumentno1" type="text" class="form-control" value="<?php echo $_SESSION["childdocumentno1"]; ?>">
                            </div>
                          </div>
                          <hr>
                          <?php
                          if (isset($_SESSION["childname2"]) && !empty($_SESSION["childname2"])) {
                            ?>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Nama Penuh (2)</label>
                              <div class="col-sm-10">
                                <input name="txtchildname2" type="text" class="form-control" value="<?php echo $_SESSION["childname2"]; ?>">
                              </div>
                            </div>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Jenis Pengenalan Diri (2)</label>
                              <div class="col-sm-10">
                                <select name="txtchilddocumenttype2" class="form-select" aria-label="Default select example">
                                  <option value="<?php echo $_SESSION["childdocumenttype2"]; ?>"><?php echo $_SESSION["childdocumenttype2"]; ?></option>
                                  <option value="MYKID">MyKid</option>
                                  <option selected value="MYKAD">MyKad</option>
                                  <option value="MYPR">MyPR</option>
                                  <option value="MYKAS">MYKAS</option>
                                  <option value="PASSPORT">Passport</option>
                                </select>
                              </div>
                            </div>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Nombor Pengenalan Diri (2)</label>
                              <div class="col-sm-10">
                                <input name="txtchilddocumentno2" type="text" class="form-control" value="<?php echo $_SESSION["childdocumentno2"]; ?>">
                              </div>
                            </div>
                            <hr>
                            <?php 
                          }
                          if (isset($_SESSION["childname3"]) && !empty($_SESSION["childname3"])) {
                            ?>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Nama Penuh (3)</label>
                              <div class="col-sm-10">
                                <input name="txtchildname3" type="text" class="form-control" value="<?php echo $_SESSION["childname3"]; ?>">
                              </div>
                            </div>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Jenis Pengenalan Diri (3)</label>
                              <div class="col-sm-10">
                                <select name="txtchilddocumenttype3" class="form-select" aria-label="Default select example">
                                  <option value="<?php echo $_SESSION["childdocumenttype3"]; ?>"><?php echo $_SESSION["childdocumenttype3"]; ?></option>
                                  <option value="MYKID">MyKid</option>
                                  <option selected value="MYKAD">MyKad</option>
                                  <option value="MYPR">MyPR</option>
                                  <option value="MYKAS">MYKAS</option>
                                  <option value="PASSPORT">Passport</option>
                                </select>
                              </div>
                            </div>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Nombor Pengenalan Diri (3)</label>
                              <div class="col-sm-10">
                                <input name="txtchilddocumentno3" type="text" class="form-control" value="<?php echo $_SESSION["childdocumentno3"]; ?>">
                              </div>
                            </div>
                            <hr>
                            <?php
                          }
                          if (isset($_SESSION["childname4"]) && !empty($_SESSION["childname4"])) {
                            ?>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Nama Penuh (4)</label>
                              <div class="col-sm-10">
                                <input name="txtchildname4" type="text" class="form-control" value="<?php echo $_SESSION["childname4"]; ?>">
                              </div>
                            </div>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Jenis Pengenalan Diri (4)</label>
                              <div class="col-sm-10">
                                <select name="txtchilddocumenttype4" class="form-select" aria-label="Default select example">
                                  <option value="<?php echo $_SESSION["childdocumenttype4"]; ?>"><?php echo $_SESSION["childdocumenttype4"]; ?></option>
                                  <option value="MYKID">MyKid</option>
                                  <option selected value="MYKAD">MyKad</option>
                                  <option value="MYPR">MyPR</option>
                                  <option value="MYKAS">MYKAS</option>
                                  <option value="PASSPORT">Passport</option>
                                </select>
                              </div>
                            </div>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Nombor Pengenalan Diri (4)</label>
                              <div class="col-sm-10">
                                <input name="txtchilddocumentno4" type="text" class="form-control" value="<?php echo $_SESSION["childdocumentno4"]; ?>">
                              </div>
                            </div>
                            <hr>
                            <?php
                          }
                          if (isset($_SESSION["childname5"]) && !empty($_SESSION["childname5"])) {
                            ?>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Nama Penuh (5)</label>
                              <div class="col-sm-10">
                                <input name="txtchildname5" type="text" class="form-control" value="<?php echo $_SESSION["childname5"]; ?>">
                              </div>
                            </div>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Jenis Pengenalan Diri (5)</label>
                              <div class="col-sm-10">
                                <select name="txtchilddocumenttype5" class="form-select" aria-label="Default select example">
                                  <option value="<?php echo $_SESSION["childdocumenttype5"]; ?>"><?php echo $_SESSION["childdocumenttype5"]; ?></option>
                                  <option value="MYKID">MyKid</option>
                                  <option selected value="MYKAD">MyKad</option>
                                  <option value="MYPR">MyPR</option>
                                  <option value="MYKAS">MYKAS</option>
                                  <option value="PASSPORT">Passport</option>
                                </select>
                              </div>
                            </div>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Nombor Pengenalan Diri (5)</label>
                              <div class="col-sm-10">
                                <input name="txtchilddocumentno5" type="text" class="form-control" value="<?php echo $_SESSION["childdocumentno5"]; ?>">
                              </div>
                            </div>
                            <hr>
                            <?php
                          }
                          if (isset($_SESSION["childname6"]) && !empty($_SESSION["childname6"])) {
                            ?>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Nama Penuh (6)</label>
                              <div class="col-sm-10">
                                <input name="txtchildname6" type="text" class="form-control" value="<?php echo $_SESSION["childname6"]; ?>">
                              </div>
                            </div>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Jenis Pengenalan Diri (6)</label>
                              <div class="col-sm-10">
                                <select name="txtchilddocumenttype6" class="form-select" aria-label="Default select example">
                                  <option value="<?php echo $_SESSION["childdocumenttype6"]; ?>"><?php echo $_SESSION["childdocumenttype6"]; ?></option>
                                  <option value="MYKID">MyKid</option>
                                  <option selected value="MYKAD">MyKad</option>
                                  <option value="MYPR">MyPR</option>
                                  <option value="MYKAS">MYKAS</option>
                                  <option value="PASSPORT">Passport</option>
                                </select>
                              </div>
                            </div>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Nombor Pengenalan Diri (6)</label>
                              <div class="col-sm-10">
                                <input name="txtchilddocumentno6" type="text" class="form-control" value="<?php echo $_SESSION["childdocumentno6"]; ?>">
                              </div>
                            </div>
                            <hr>
                            <?php
                          }
                          if (isset($_SESSION["childname7"]) && !empty($_SESSION["childname7"])) {
                            ?>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Nama Penuh (7)</label>
                              <div class="col-sm-10">
                                <input name="txtchildname7" type="text" class="form-control" value="<?php echo $_SESSION["childname7"]; ?>">
                              </div>
                            </div>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Jenis Pengenalan Diri (7)</label>
                              <div class="col-sm-10">
                                <select name="txtchilddocumenttype7" class="form-select" aria-label="Default select example">
                                  <option value="<?php echo $_SESSION["childdocumenttype7"]; ?>"><?php echo $_SESSION["childdocumenttype7"]; ?></option>
                                  <option value="MYKID">MyKid</option>
                                  <option selected value="MYKAD">MyKad</option>
                                  <option value="MYPR">MyPR</option>
                                  <option value="MYKAS">MYKAS</option>
                                  <option value="PASSPORT">Passport</option>
                                </select>
                              </div>
                            </div>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Nombor Pengenalan Diri (7)</label>
                              <div class="col-sm-10">
                                <input name="txtchilddocumentno7" type="text" class="form-control" value="<?php echo $_SESSION["childdocumentno7"]; ?>">
                              </div>
                            </div>
                            <hr>
                            <?php
                          }
                          if (isset($_SESSION["childname8"]) && !empty($_SESSION["childname8"])) {
                            ?>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Nama Penuh (8)</label>
                              <div class="col-sm-10">
                                <input name="txtchildname8" type="text" class="form-control" value="<?php echo $_SESSION["childname8"]; ?>">
                              </div>
                            </div>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Jenis Pengenalan Diri (8)</label>
                              <div class="col-sm-10">
                                <select name="txtchilddocumenttype8" class="form-select" aria-label="Default select example">
                                  <option value="<?php echo $_SESSION["childdocumenttype8"]; ?>"><?php echo $_SESSION["childdocumenttype8"]; ?></option>
                                  <option value="MYKID">MyKid</option>
                                  <option selected value="MYKAD">MyKad</option>
                                  <option value="MYPR">MyPR</option>
                                  <option value="MYKAS">MYKAS</option>
                                  <option value="PASSPORT">Passport</option>
                                </select>
                              </div>
                            </div>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Nombor Pengenalan Diri (8)</label>
                              <div class="col-sm-10">
                                <input name="txtchilddocumentno8" type="text" class="form-control" value="<?php echo $_SESSION["childdocumentno8"]; ?>">
                              </div>
                            </div>
                            <hr>
                            <?php
                          }
                          if (isset($_SESSION["childname9"]) && !empty($_SESSION["childname9"])) {
                            ?>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Nama Penuh (9)</label>
                              <div class="col-sm-10">
                                <input name="txtchildname9" type="text" class="form-control" value="<?php echo $_SESSION["childname9"]; ?>">
                              </div>
                            </div>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Jenis Pengenalan Diri (9)</label>
                              <div class="col-sm-10">
                                <select name="txtchilddocumenttype9" class="form-select" aria-label="Default select example">
                                  <option value="<?php echo $_SESSION["childdocumenttype9"]; ?>"><?php echo $_SESSION["childdocumenttype9"]; ?></option>
                                  <option value="MYKID">MyKid</option>
                                  <option selected value="MYKAD">MyKad</option>
                                  <option value="MYPR">MyPR</option>
                                  <option value="MYKAS">MYKAS</option>
                                  <option value="PASSPORT">Passport</option>
                                </select>
                              </div>
                            </div>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Nombor Pengenalan Diri (9)</label>
                              <div class="col-sm-10">
                                <input name="txtchilddocumentno9" type="text" class="form-control" value="<?php echo $_SESSION["childdocumentno9"]; ?>">
                              </div>
                            </div>
                            <hr>
                            <?php
                          }
                          if (isset($_SESSION["childname10"]) && !empty($_SESSION["childname10"])) {
                            ?>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Nama Penuh (10)</label>
                              <div class="col-sm-10">
                                <input name="txtchildname10" type="text" class="form-control" value="<?php echo $_SESSION["childname10"]; ?>">
                              </div>
                            </div>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Jenis Pengenalan Diri (10)</label>
                              <div class="col-sm-10">
                                <select name="txtchilddocumenttype10" class="form-select" aria-label="Default select example">
                                  <option value="<?php echo $_SESSION["childdocumenttype10"]; ?>"><?php echo $_SESSION["childdocumenttype10"]; ?></option>
                                  <option value="MYKID">MyKid</option>
                                  <option selected value="MYKAD">MyKad</option>
                                  <option value="MYPR">MyPR</option>
                                  <option value="MYKAS">MYKAS</option>
                                  <option value="PASSPORT">Passport</option>
                                </select>
                              </div>
                            </div>
                            <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Nombor Pengenalan Diri (10)</label>
                              <div class="col-sm-10">
                                <input name="txtchilddocumentno10" type="text" class="form-control" value="<?php echo $_SESSION["childdocumentno10"]; ?>">
                              </div>
                            </div>
                            <hr>
                            <?php
                          }
                          ?>
                          <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                              <textarea name="txtaddress" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $_SESSION["address"]; ?></textarea>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Nombor Telefon Kediaman</label>
                            <div class="col-sm-10">
                              <input name="txthomephone" type="text" class="form-control" value="<?php echo $_SESSION["homephone"]; ?>">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col text-end">
                              <a href="datacollector.php?sid=<?php echo $_Session["SchoolID"];?>&reset=yes" class="btn btn-primary">Ulang</a>
                              <input name="step" type="hidden" value="<?php echo $_SESSION["step"]; ?>">
                              <input name="sid" type="hidden" value="<?php echo $_Session["SchoolID"] ;?>">
                              <button type="submit" class="btn btn-primary">Daftar</button>
                            </div>
                          </div>
                      </form>
                    </div>
                  </div>
                  <?php
                }
                elseif ($_GET["step"]=="6") {
                  ?>
                  <div class="row">
                    <div class="col">
                      <div class="card alert-primary">
                        <div class="card-body">
                          <div class="text-center">
                            Pendaftaran anda telah berjaya! Terima kasih kerana menyertai Go N Getz.
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                }
              }
              ?>
            </div>
          </div>
          <?php
        }
      ?>
      
    </div>
    <div style="height:30px;">
    </div>
    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>