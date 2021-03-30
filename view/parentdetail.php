<?php
$id = new \MongoDB\BSON\ObjectId($_GET['id']);
$filter = ['_id' => $id];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
foreach ($cursor as $document)
{
    $_SESSION["parentremarkid"] = strval($document->_id);
    $consumerid = strval($document->_id);
    $ConsumerFName = ($document->ConsumerFName);
    $ConsumerLName = ($document->ConsumerLName);
    $ConsumerIDType = ($document->ConsumerIDType);
    $ConsumerIDNo = ($document->ConsumerIDNo);
    $ConsumerEmail = ($document->ConsumerEmail);
    $ConsumerPhone = ($document->ConsumerPhone);
    $ConsumerAddress = ($document->ConsumerAddress);
    $ConsumerStatus = ($document->ConsumerStatus);

    $filter0 = ['ConsumerID'=>$consumerid];
    $query0 = new MongoDB\Driver\Query($filter0);
    $cursor0 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query0);
    foreach ($cursor0 as $document0)
    {
      $parentid = strval($document0->_id);
    }
}
?>
<div><br><br><br><h1 style="color:#696969; text-align:center">Parent Personal Info</h1>
<div class="row">
  <div class="col-md-1 section-1-box wow fadeInUp"></div>
  <div class="col-md-10 section-1-box wow fadeInUp">
      <div class="card">
        <div class="card-header">
          <strong>Details</strong>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-12 col-lg-6">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead class="table-light">
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row" class="table-secondary">Name</th>
                      <td class="table-secondary">
                        <?php echo $ConsumerFName." ".$ConsumerLName;
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">ID Type</th>
                      <td>
                        <?php echo $ConsumerIDType; ?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">ID Number</th>
                      <td>
                        <?php echo $ConsumerIDNo; ?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Email</th>
                      <td>
                        <?php echo $ConsumerEmail; ?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Phone Number</th>
                      <td>
                        <?php echo $ConsumerPhone; ?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Address</th>
                      <td>
                        <?php echo $ConsumerAddress; ?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Status</th>
                      <td>
                        <?php echo $ConsumerStatus; ?>
                      </td>
                    </tr>
                  </tbody>
                </table>
              <?php
              $varcount = 1;
              do
              {
              $filter1 = ['ParentID'=>$parentid];
              $query1 = new MongoDB\Driver\Query($filter1);
              $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentStudentRel',$query1);
              foreach ($cursor1 as $document1)
              {
              $ParentStudentRelation = ($document1->ParentStudentRelation);
              $StudentID = ($document1->StudentID);
              $studentid = new \MongoDB\BSON\ObjectId($StudentID);
              $filter2 = ['_id'=>$studentid];
              $query2 = new MongoDB\Driver\Query($filter2);
              $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query2);
              foreach ($cursor2 as $document2)
              {
              $Consumer_id = strval($document2->Consumer_id);
              $studentid = new \MongoDB\BSON\ObjectId($Consumer_id);
              $filter3 = ['_id'=>$studentid];
              $query3 = new MongoDB\Driver\Query($filter3);
              $cursor3 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query3);
              foreach ($cursor3 as $document3)
              {
                $ParentFName = ($document3->ConsumerFName);
                $ParentLName = ($document3->ConsumerLName);
                $ParentIDNo = ($document3->ConsumerIDNo);
                $ParentEmail = ($document3->ConsumerEmail);
                $ParentPhone = ($document3->ConsumerPhone);
              ?>
              <table class="table table-bordered">
              <thead class="table-light">
              <tbody>
                <tr>
                  <th scope="row" class="table-secondary">Relation</th>
                  <td class="table-secondary">Child</td>
                </tr>
                <tr>
                  <th scope="row">Name</th>
                  <td><?php echo $ParentFName; echo " "; echo $ParentLName; ?> </td>
                </tr>
                <tr>
                <th scope="row">ID Number</th>
                <td><?php echo $ParentIDNo; ?></td>
                </tr>
                <tr>
                  <th scope="row">Email</th>
                <td><?php echo $ParentEmail; ?></td>
                </tr>
                <tr>
                   <th scope="row">Phone Number</th>
                    <td><?php echo $ParentPhone; ?></td>
                </tr>
              </tbody>
                </table>
              <?php
              }
              }
              }
              $varcount = $varcount + 1;
              }
              while ($varcount <= 1);
              ?>
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="row">
                <div class="col-12 col-lg-12">
                  <div class="card">
                    <div class="card-header">
                      <strong>Remarks</strong>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12">
                        <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                          <div class="box">
                            <form name="AddParentRemarkFormSubmit" action="model/addparentremark.php" method="POST">
                            <div class="row">
                              <div class="col">
                                  <textarea class="form-control" name="txtconsumerRemark" rows="3"></textarea>
                                  <div class="row">
                                    <div class="col text-right">
                                      <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtconsumerid">
                                      <button type="submit" class="btn btn-primary" name="AddParentRemarkFormSubmit">Add remark</button>
                                    </div>
                                  </div>
                                </div>
                            </div>
                          </form>
                        </div>
                        <div class="box">
                          <strong></strong>
                          <br>
                          <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <a class="nav-link active" id="active-tab" data-bs-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true">Active</a>
                            </li>
                            <li class="nav-item" role="presentation">
                              <a class="nav-link" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">Pending</a>
                            </li>
                            <li class="nav-item" role="presentation">
                              <a class="nav-link" id="completed-tab" data-bs-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">Completed</a>
                            </li>
                          </ul>
                          <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                              <div class="table-responsive">
                                <table class="table table-striped table-sm ">
                                  <thead>
                                    <tr>
                                      <th>Date</th>
                                      <th>Details</th>
                                      <th>Staff</th>
                                    </tr>
                                  </thead>
                                </table>
                                <?php
                                $filter2 = ['Consumer_id'=>$_GET['id'],'SubRemarks'=>'0','ConsumerRemarksStatus'=>'ACTIVE'];
                                $option2 = ['sort' => ['_id' => -1],'limit'=>10];
                                $query2 = new MongoDB\Driver\Query($filter2, $option2);
                                $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentRemarks',$query2);

                                foreach ($cursor2 as $document2)
                                {
                                  $_SESSION["staffremarkidparent"] = strval($document2->_id);
                                  $remarkid = strval($document2->_id);
                                  $parentremark = ($document2->ConsumerRemarksDetails);
                                  $consumerremarkdate = ($document2->ConsumerRemarksDate);
                                  $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($consumerremarkdate));
                                  $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                  $parentremarkstaffid = ($document2->ConsumerRemarksStaff_id);
                                  ?>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item" >
                                      <h6 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        <tbody>
                                          <tr>
                                          <td><?php print_r($datetime->format('r')); ?></td>
                                          <td>
                                            <?php
                                            $varstaffid1 = new \MongoDB\BSON\ObjectId($parentremarkstaffid);
                                            $filter1 = ['_id' => $varstaffid1];
                                            $query1 = new MongoDB\Driver\Query($filter1);
                                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
                                            foreach ($cursor1 as $document1)
                                            {
                                            $ConsumerFName = ($document1->ConsumerFName);
                                            echo $ConsumerFName;
                                            ?>
                                          </td>
                                          <td><?php echo $parentremark;?></td>
                                          </tr>
                                          </tbody>
                                        </button>
                                      </h6>
                                      <div  id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                      <?php 
                                      $filter4 = ['Consumer_id'=>$_GET['id'],'SubRemarks'=>$_SESSION["staffremarkidparent"],'ConsumerRemarksStatus'=>'ACTIVE'];
                                      $option4 = ['sort' => ['_id' => -1],'limit'=>10];
                                      $query4 = new MongoDB\Driver\Query($filter4, $option4);
                                      $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentRemarks',$query4);
                                      foreach ($cursor4 as $document4)
                                      {
                                        $childremark = ($document4->ConsumerRemarksDetails);
                                        $consumerremarkdate = (($document4->ConsumerRemarksDate));
                                        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($consumerremarkdate));
                                        $date = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        $childremarkstaffid = ($document4->ConsumerRemarksStaff_id);
                                        ?>
                                        <div class="accordion-body">
                                        <tbody>
                                          <tr>
                                            <td><?php print_r($date->format('r')); ?></td>
                                            <td>
                                              <?php echo $childremark;?>
                                            </td>
                                          </tr>
                                          </tbody>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <form name="AddParentRemarkChildFormSubmit" action="model/addparentremarkchild.php" method="POST">
                                        <div class="row">
                                          <div class="col">
                                            <textarea class="form-control" name="txtconsumerRemark" rows="3"></textarea>
                                            <div class="row">
                                              <div class="col text-right">
                                                <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtconsumerid">
                                                <input type="hidden" value="<?php echo $remarkid; ?>" name="txtremarkid">
                                                <button type="submit" class="btn btn-primary" name="AddParentRemarkChildFormSubmit">Add remark</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </form>
                                        <button style="float: right;"type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#UpdateParentremark" data-bs-whatever="<?php echo $remarkid; ?>" style="display: flex;  ">update</button>
                                      </div>
                                      </div>
                                    </div>
                                <?php
                                }
                                }
                                ?>
                              </div>
                            </div>
                            <div class="tab-pane fade show pending" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                              <div class="table-responsive">
                                <table class="table table-striped table-sm ">
                                  <thead>
                                    <tr>
                                      <th>Date</th>
                                      <th>Details</th>
                                      <th>Staff</th>
                                    </tr>
                                  </thead>
                                </table>
                                <?php
                                $filter2 = ['Consumer_id'=>$_GET['id'],'SubRemarks'=>'0','ConsumerRemarksStatus'=>'PENDING'];
                                $option2 = ['sort' => ['_id' => -1],'limit'=>10];
                                $query2 = new MongoDB\Driver\Query($filter2, $option2);
                                $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentRemarks',$query2);

                                foreach ($cursor2 as $document2)
                                {
                                  $_SESSION["staffremarkidparent"] = strval($document2->_id);
                                  $remarkid = strval($document2->_id);
                                  $parentremark = ($document2->ConsumerRemarksDetails);
                                  $consumerremarkdate = ($document2->ConsumerRemarksDate);
                                  $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($consumerremarkdate));
                                  $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                  $parentremarkstaffid = ($document2->ConsumerRemarksStaff_id);
                                  ?>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item" >
                                      <h6 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        <tbody>
                                          <tr>
                                          <td><?php print_r($datetime->format('r')); ?></td>
                                          <td>
                                            <?php
                                            $varstaffid1 = new \MongoDB\BSON\ObjectId($parentremarkstaffid);
                                            $filter1 = ['_id' => $varstaffid1];
                                            $query1 = new MongoDB\Driver\Query($filter1);
                                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
                                            foreach ($cursor1 as $document1)
                                            {
                                            $ConsumerFName = ($document1->ConsumerFName);
                                            echo $ConsumerFName;
                                            ?>
                                          </td>
                                          <td><?php echo $parentremark;?></td>
                                          </tr>
                                          </tbody>
                                        </button>
                                      </h6>
                                      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                      <?php 
                                      $filter4 = ['Consumer_id'=>$_GET['id'],'SubRemarks'=>$_SESSION["staffremarkidparent"],'ConsumerRemarksStatus'=>'PENDING'];
                                      $option4 = ['sort' => ['_id' => -1],'limit'=>10];
                                      $query4 = new MongoDB\Driver\Query($filter4, $option4);
                                      $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentRemarks',$query4);
                                      foreach ($cursor4 as $document4)
                                      {
                                        $childremark = ($document4->ConsumerRemarksDetails);
                                        $consumerremarkdate = (($document4->ConsumerRemarksDate));
                                        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($consumerremarkdate));
                                        $date = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        $childremarkstaffid = ($document4->ConsumerRemarksStaff_id);
                                        ?>
                                        <div class="accordion-body">
                                        <tbody>
                                          <tr>
                                            <td><?php print_r($date->format('r')); ?></td>
                                            <td>
                                              <?php echo $childremark;?>
                                            </td>
                                          </tr>
                                          </tbody>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <form name="AddParentRemarkChildFormSubmit" action="model/addparentremarkchild.php" method="POST">
                                        <div class="row">
                                          <div class="col">
                                            <textarea class="form-control" name="txtconsumerRemark" rows="3"></textarea>
                                            <div class="row">
                                              <div class="col text-right">
                                                <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtconsumerid">
                                                <input type="hidden" value="<?php echo $remarkid; ?>" name="txtremarkid">
                                                <button type="submit" class="btn btn-primary" name="AddParentRemarkChildFormSubmit">Add remark</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </form>
                                        <button style="float: right;"type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#UpdateParentremark" data-bs-whatever="<?php echo $remarkid; ?>" style="display: flex;">update</button>
                                      </div>
                                      </div>
                                    </div>
                                <?php
                                }
                                }
                                ?>
                              </div>
                            </div>
                            <div class="tab-pane fade show completed" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                              <div class="table-responsive">
                                <table class="table table-striped table-sm ">
                                  <thead>
                                    <tr>
                                      <th>Date</th>
                                      <th>Details</th>
                                      <th>Staff</th>
                                    </tr>
                                  </thead>
                                </table>
                                <?php
                                $filter2 = ['Consumer_id'=>$_GET['id'],'SubRemarks'=>'0','ConsumerRemarksStatus'=>'COMPLETED'];
                                $option2 = ['sort' => ['_id' => -1],'limit'=>10];
                                $query2 = new MongoDB\Driver\Query($filter2, $option2);
                                $cursor2 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentRemarks',$query2);

                                foreach ($cursor2 as $document2)
                                {
                                  $_SESSION["staffremarkidparent"] = strval($document2->_id);
                                  $remarkid = strval($document2->_id);
                                  $parentremark = ($document2->ConsumerRemarksDetails);
                                  $consumerremarkdate = ($document2->ConsumerRemarksDate);
                                  $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($consumerremarkdate));
                                  $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                  $parentremarkstaffid = ($document2->ConsumerRemarksStaff_id);
                                  ?>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item" >
                                      <h6 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        <tbody>
                                          <tr>
                                          <td><?php print_r($datetime->format('r')); ?></td>
                                          <td>
                                            <?php
                                            $varstaffid1 = new \MongoDB\BSON\ObjectId($parentremarkstaffid);
                                            $filter1 = ['_id' => $varstaffid1];
                                            $query1 = new MongoDB\Driver\Query($filter1);
                                            $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query1);
                                            foreach ($cursor1 as $document1)
                                            {
                                            $ConsumerFName = ($document1->ConsumerFName);
                                            echo $ConsumerFName;
                                            ?>
                                          </td>
                                          <td><?php echo $parentremark;?></td>
                                          </tr>
                                          </tbody>
                                        </button>
                                      </h6>
                                      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                      <?php 
                                      $filter4 = ['Consumer_id'=>$_GET['id'],'SubRemarks'=>$_SESSION["staffremarkidparent"],'ConsumerRemarksStatus'=>'COMPLETED'];
                                      $option4 = ['sort' => ['_id' => -1],'limit'=>10];
                                      $query4 = new MongoDB\Driver\Query($filter4, $option4);
                                      $cursor4 = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentRemarks',$query4);
                                      foreach ($cursor4 as $document4)
                                      {
                                        $childremark = ($document4->ConsumerRemarksDetails);
                                        $consumerremarkdate = (($document4->ConsumerRemarksDate));
                                        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($consumerremarkdate));
                                        $date = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        $childremarkstaffid = ($document4->ConsumerRemarksStaff_id);
                                        ?>
                                        <div class="accordion-body">
                                        <tbody>
                                          <tr>
                                            <td><?php print_r($date->format('r')); ?></td>
                                            <td>
                                              <?php echo $childremark;?>
                                            </td>
                                          </tr>
                                          </tbody>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <form name="AddParentRemarkChildFormSubmit" action="model/addparentremarkchild.php" method="POST">
                                        <div class="row">
                                          <div class="col">
                                            <textarea class="form-control" name="txtconsumerRemark" rows="3"></textarea>
                                            <div class="row">
                                              <div class="col text-right">
                                                <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txtconsumerid">
                                                <input type="hidden" value="<?php echo $remarkid; ?>" name="txtremarkid">
                                                <button type="submit" class="btn btn-primary" name="AddParentRemarkChildFormSubmit">Add remark</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </form>
                                        <button style="float: right;"type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#UpdateParentremark" data-bs-whatever="<?php echo $remarkid; ?>" style="display: flex;">update</button>
                                      </div>
                                      </div>
                                    </div>
                                <?php
                                }
                                }
                                ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="col-md-1 section-1-box wow fadeInUp"></div>
</div>
</div>
<?php include ('view/modal-updateparentremark.php'); ?>
<script>
var UpdateParentremark = document.getElementById('UpdateParentremark')
UpdateParentremark.addEventListener('show.bs.modal', function(event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = UpdateParentremark.querySelector('.modal-title')
  var modalBodyInput = UpdateParentremark.querySelector('.modal-body input')
  modalBodyInput.value = recipient
})
</script>
