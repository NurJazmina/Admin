<?php 
    include ('model/imagetest.php');

    $filter = [NULL];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.testing',$query);
    foreach ($cursor as $document)
    {
      $testing_id = strval($document->_id);
      $Date = strval($document->Date);
      $Image = strval($document->Image);
      ?>
      <div class="card">
        <div class="card-header">
        <?php
        echo $testing_id."<br>";
        ?>
        </div>
        <div class="card-body">
        <?php
        echo $Date."<br>";
        echo $Image
        ?>
        </div>
      </div>
      <?php
    }
    ?>

<div class="card">
  <div class="card-header">
   Testing for upload photos
  </div>
  <div class="card-body">
  <form action="index.php?imagetest" method="POST" enctype="multipart/form-data">
      <input type="file" name="file">
      <button type="submit" name="submit" class="btn btn-secondary"> Upload </button>
  </div>
  <div class="card-footer">
  <button type="button" class="btn btn-secondary" name="submit"> Next </button>
  </div>
    
  </div>
</div>
?>
