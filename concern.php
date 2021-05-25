<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php
$DatabaseConnectionString="mongodb://admin:TempPassword@124.217.235.244:27017/gngoffice?authSource=admin";
$Database = new MongoDB\Driver\Manager($DatabaseConnectionString);

 if (isset($_GET['sid']) && !empty($_GET['sid'])) {
   $id = new \MongoDB\BSON\ObjectId($_GET['sid']);
   $filter = ['_id'=>$id];
   $query = new MongoDB\Driver\Query($filter);
   $cursor = $Database->executeQuery('GoNGetzSmartSchool.Schools',$query);
   $varcounterid = 0;
   
   foreach ($cursor as $document) {
     $SchoolName = ($document->SchoolsName);
     
     $varcountername = "CONCERN";
     $varcountersubname = $_GET['sid'];
     $varcounterno = 1;
     
     $filter = ['CounterSubName'=>($_GET['sid'])];
     $query = new MongoDB\Driver\Query($filter);
     $cursor = $Database->executeQuery('GoNGetzSmartSchool.Counter',$query);
     
     foreach ($cursor as $document) {
       $varcounterid = ($document->_id);
       $varcountertotal = ($document->CounterTotal);
      }
     if (empty($varcountertotal)) {
         $varresult = 'EMPTY';
         $DatabaseConnectionString="mongodb://admin:TempPassword@124.217.235.244:27017/gngoffice?authSource=admin";
         $Database = new MongoDB\Driver\Manager($DatabaseConnectionString);
         $bulk = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
         $bulk->insert(['CounterName'=> $varcountername,'CounterSubName'=>$varcountersubname,'CounterTotal'=>$varcounterno]);
         $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
         
         $result = $Database->executeBulkWrite('GoNGetzSmartSchool.Counter', $bulk, $writeConcern);
         } else {
          $varresult = 'NOT EMPTY';
          $varcounterno = $varcountertotal + 1;
          $DatabaseConnectionString="mongodb://admin:TempPassword@124.217.235.244:27017/gngoffice?authSource=admin";
          $Database = new MongoDB\Driver\Manager($DatabaseConnectionString);
          $bulk = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
          $bulk->update(['_id'=>$varcounterid],['CounterName'=>$varcountername,'CounterSubName'=>$varcountersubname,'CounterTotal'=>$varcounterno]);
          $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
          
          $result = $Database->executeBulkWrite('GoNGetzSmartSchool.Counter', $bulk, $writeConcern);  
        }
    }
 } else {
   $SchoolName = "??";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
      body {
        background-color:#E1E1E1;
      }
      .card {
        margin:5px;
        -webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
      }
    </style>
    <title>Go N Getz</title>
  </head>
  <body>
    <?php
    if (!isset($_POST['pdpaddformsubmit']) && empty($_POST['pdpaaddformsubmit'])) {
      if (!isset($_GET['f']) && empty($_GET['f'])) {
        ?>
        <div class="alert alert-warning text-center">
          Sila isi dan hantarkan segera dalam jangkamasa 3 hari!
        </div>
        <?php
      } else {
          if ($_GET['f']=="parentname"){
          ?>
          <div class="alert alert-danger" role="alert">
            Sila isikan nama penuh.
          </div>
          <?php
          } 
          if ($_GET['f']=="parentdocumentno"){
          ?>
          <div class="alert alert-danger" role="alert">
            Sila isikan No ID.
          </div>
          <?php
          }
          if ($_GET['f']=="parentphoneno"){
          ?>
          <div class="alert alert-danger" role="alert">
            Sila isikan No ID.
          </div>
          <?php
          }
        }
      ?>
      
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="ratio ratio-16x9">
                  <iframe src="https://www.youtube.com/embed/_Zes3V6lUp8?controls=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
              </div>  
            </div>
          </div>
        </div>
        <form name="pdpaaddform" method="post" action="concern.php">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h5>PERSETUJUAN UNTUK MENYERTAI PROGRAM SMART SCHOOL GO N GETZ</h5>
                </div>
                <div class="card-body">
                  <P>
                    Saya <input type="text" class="form-control" name="parentname" placeholder="Nama Penuh">ID<select name="parentdocumenttype" class="form-select"><option value="MYKAD">MyKad</option><option value="KAD POLIS">Kad Polis</option><option value="KAD TENTERA">Kad Tentera</option><option value="PASSPORT">Passport</option><option value="MYPR">MyPr</option><option value="MYKAS">MyKas</option></select> No. ID<input type="text" class="form-control" name="parentDocumentNo" placeholder="xxxxxxxxxxxxxx" >Tel. No.<input type="text" class="form-control" name="parentPhoneNo" placeholder="0123456789" >
                  </P>
                  <p>
                    dengan ini <select name="parentaction" class="form-select"><option value="AGREE">BERSETUJU</option><option value="DISAGREE">TIDAK BERSETUJU</option></select>
                  </p>
                  <p class="text-justify">
                    diri saya sendiri, anak / anak jagaan saya menyertai program Smart School Go N Getz. Keputusan saya ini tertakluk dengan pemegangan, pemprosesan dan perkongsian maklumat peribadi saya dan anak / anak jagaan saya diantara pihak <strong><?php echo $SchoolName; ?></strong> dengan <strong>G&#38;G SOFTECH SDN BHD</strong> untuk tujuan program berkenaan. 
                  </p>
                  <input type="hidden" name="schoolid" value="<?php echo $_GET['sid']; ?>">
                  <button class="btn btn-primary" type="submit" name="pdpaddformsubmit">Hantar</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <p class="text-justify">
                  Untuk sebarang pertanyaan, sila hubungi Whatsapp +60 11 1515 100 atau <a href="mailto:care@gongetz.com">care@gongetz.com</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
    } else {
      function clean($string) {
      $string = str_replace('-', '', $string); // Replaces all spaces with hyphens.

      return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
      }
      if (isset($_POST['parentname']) && !empty($_POST['parentname'])) {
        $varparentname = strtoupper($_POST['parentname']);
        if (isset($_POST['parentdocumenttype']) && !empty($_POST['parentdocumenttype'])) {
          $varparentdocumenttype = $_POST['parentdocumenttype'];  
          if (isset($_POST['parentDocumentNo']) && !empty($_POST['parentDocumentNo'])) {
            $varparentdocumentno = clean($_POST['parentDocumentNo']);
            if (isset(($_POST['parentPhoneNo'])) && !empty($_POST['parentPhoneNo'])) {
              $varparentphoneno = clean($_POST['parentPhoneNo']);
              $varparentaction = $_POST['parentaction'];
              $varparentsubmitdate = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
              $varparentremark = "";
              $varschoolid = $_POST['schoolid'];

              $DatabaseConnectionString="mongodb://admin:TempPassword@124.217.235.244:27017/gngoffice?authSource=admin";
              $Database = new MongoDB\Driver\Manager($DatabaseConnectionString);
              $bulk = new MongoDB\Driver\BulkWrite(['ordered'=>true]);
              $bulk->insert(['School_id'=>$varschoolid,'PDPADate'=>$varparentsubmitdate,'PDPAParentName'=>$varparentname,'PDPAParentDocumentIDType'=>$varparentdocumenttype,'PDPAParentDocumentID'=>$varparentdocumentno,'PDPAParentPhoneNo'=>$varparentphoneno,'PDPAParentAction'=>$varparentaction,'PDPARemark'=>$varparentremark]);
              $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
              try {
                $result = $Database->executeBulkWrite('GoNGetzSmartSchool.PDPA', $bulk, $writeConcern);
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
              if ($_POST['parentaction']=="AGREE") {
                header('location:http://smartschool.gongetz.com/datacollector.php?step=0&sid=' . $_POST['schoolid'] . '&parentname=' . $_POST['parentname'] . '&phone=' . $_POST['parentPhoneNo']);
              }
            } else {
              header('location:http://smartschool.gongetz.com/concern.php?step=0&sid='.$_POST['schoolid'] . "&f=parentphoneno");
            }
          } else {
            header('location:http://smartschool.gongetz.com/concern.php?step=0&sid='.$_POST['schoolid'] . "&f=parentdocumentno");
          }
        } else {
          header('location:http://smartschool.gongetz.com/concern.php?step=0&sid='.$_POST['schoolid'] . "&f=parentdocumenttype");
        }
      } else {
        header('location:http://smartschool.gongetz.com/concern.php?step=0&sid='.$_POST['schoolid'] . "&f=parentname");
      }
      ?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card alert-primary">
              <div class="card-body">
                <p>
                  Terima kasih kerana memberi maklumbalas demi kebaikan anak / anak jagaan anda.
                </p>
                <p>
                  Anda akan dihubungi oleh pihak sekolah seandainya anda memilih SETUJU sebentar tadi.
                </p>
              </div>  
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <p class="text-justify">
                  Untuk sebarang pertanyaan, sila hubungi Whatsapp +60 11 1515 100 atau <a href="mailto:care@gongetz.com">care@gongetz.com</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
    }
    ?>
    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  </body>
</html>