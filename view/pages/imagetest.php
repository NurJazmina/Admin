
<div class="col-lg-4">
        <div class="card card-custom gutter-b">
            <div class="card-header">
              <div class="card-title">
              hello <?php echo $testing; ?>
                <!-- <strong><a href="index.php?page=newsdetail&id=<?php echo $Newsid ; ?>"><?php echo $NewsTitle; ?></a></strong> -->
              </div>
            </div>
        </div>

    <?php
    $calc = 0;
    $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"]];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.testing',$query);
    foreach ($cursor as $document)
    {
        $testing = strval($document->testing);
    }
    ?>

</div>