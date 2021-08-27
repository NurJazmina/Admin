<?php
$_SESSION["title"] = "Classroom";
include 'view/partials/_subheader/subheader-v1.php'; 
?>
<form id="Addclass" name="Addclass" action="index.php?page=modal-recheckclassroomlist" method="post">
  <div id="recheckaddclass" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Class</h5>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Teacher ID</label>
            <div class="col-sm-10">
              <select class="form-control" name="consumer_id">
                <?php
                $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'StaffLevel'=>'0'];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                foreach ($cursor as $document)
                {
                  $ConsumerID = strval($document->ConsumerID);
                  $id = new \MongoDB\BSON\ObjectId($ConsumerID);
                  $filter1 = ['_id'=>$id];
                  $query1 = new MongoDB\Driver\Query($filter1);
                  $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);
                  foreach ($cursor1 as $document1)
                  {
                    $ConsumerFName = strval($document1->ConsumerFName);
                    ?>
                    <option value="<?=($document1->_id)?>"><?= $ConsumerFName; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Class Category</label>
            <div class="col-sm-10">
              <select class="form-control" name="class_category" >
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn-sm" name="Addclass">Re-Checking</button>
        </div>
      </div>
    </div>
  </div>
</form>