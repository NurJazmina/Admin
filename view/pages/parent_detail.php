<style>
.highlight td.default 
{
  background:#ff8795;
  color:#ffff ;
  border-color:#ffff;
}
</style>
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
  <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <!--begin::Info-->
    <div class="d-flex align-items-center flex-wrap mr-1">
      <!--begin::Page Heading-->
      <div class="d-flex align-items-baseline flex-wrap mr-5">
        <!--begin::Page Title-->
        <h5 class="text-dark font-weight-bold my-1 mr-5">Parent Detail</h5>
        <!--end::Page Title-->
      </div>
      <!--end::Page Heading-->
    </div>
    <!--end::Info-->
  </div>
</div>
<!--end::Subheader-->
<?php
if (isset($_GET['id']) && !empty($_GET['id']))
{
  // group : school
  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_GET['id'])];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
    $_SESSION["consumer_id"] = strval($document->_id);
    $consumer_id = strval($document->_id);
    $ConsumerFName = $document->ConsumerFName;
    $ConsumerLName = $document->ConsumerLName;
    $ConsumerIDType = $document->ConsumerIDType;
    $ConsumerIDNo = $document->ConsumerIDNo;
    $ConsumerEmail = $document->ConsumerEmail;
    $ConsumerPhone = $document->ConsumerPhone;
    $ConsumerAddress = $document->ConsumerAddress;
    $ConsumerStatus = $document->ConsumerStatus;

    $filter = ['ConsumerID'=>$consumer_id];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
    foreach ($cursor as $document)
    {
      $parent_id = strval($document->_id);
    }
  }
}
$date = date("Y-m-d");
$today = new MongoDB\BSON\UTCDateTime((new DateTime($date))->getTimestamp()*1000);

if (isset($_POST['submit_date']))
{
    $date = $_POST['date'];
}
?>
<div class="text-dark-50 text-center">
  <h1>Parent Info</h1>
</div>
<div class="card">
  <div class="card-body">
    <div class="row">
      <!-- begin::staff detail -->
      <div class="col-sm">
        <table class="table table-bordered">
          <tbody>
            <tr class="bg-light text-dark-50">
              <td>Name</td>
              <td><?= $ConsumerFName." ".$ConsumerLName; ?> </td>
            </tr>
            <tr>
              <td>ID Type</td>
              <td><?= $ConsumerIDType; ?></td>
            </tr>
            <tr>
              <td>ID Number</td>
              <td><?= $ConsumerIDNo; ?></td>
            </tr>
            <tr>
              <td>Email</td>
              <td><?= $ConsumerEmail; ?></td>
            </tr>
            <tr>
              <td>Phone Number</td>
              <td><?= $ConsumerPhone; ?></td>
            </tr>
            <tr>
              <td>Address</td>
              <td><?= $ConsumerAddress; ?></td>
            </tr>
            <tr>
              <td>Status</td>
              <td><?= $ConsumerStatus; ?></td>
            </tr>
          </tbody>
        </table>
        <!-- teacher -->
        <?php
        $filter = ['ParentID'=>$parent_id];
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentStudentRel',$query);
        foreach ($cursor as $document)
        {
          $ParentStudentRelation = $document->ParentStudentRelation;
          $StudentID = $document->StudentID;
        
          $filter = ['_id'=>new \MongoDB\BSON\ObjectId($StudentID)];
          $query = new MongoDB\Driver\Query($filter);
          $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
          foreach ($cursor as $document)
          {
            $Consumer_id = $document->Consumer_id;

            $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Consumer_id)];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
            foreach ($cursor as $document)
            {
              $ConsumerFName = $document->ConsumerFName;
              $ConsumerLName = $document->ConsumerLName;
              $ConsumerIDNo = $document->ConsumerIDNo;
            }
          }
          ?>
          <table class="table table-bordered">
            <tr class="bg-light text-dark-50">
              <td>Class</td>
              <td>Subject</td>
            </tr>
            <tbody>
              <tr>
                <td>Relation</td>
                <td>Child</td>
              </tr>
              <tr>
                <td>Name</td>
                <td><a href="index.php?page=student_detail&id=<?= $Consumer_id; ?>"><?= $ConsumerFName." ".$ConsumerLName; ?></a></td>
              </tr>
              <tr>
                <td>ID Number</td>
                <td><?= $ConsumerIDNo; ?></td>
              </tr>
            </tbody>
          </table>
          <?php
        }
        ?>
        <!-- teacher -->
      </div>
      <!-- end::staff detail -->
      <!-- begin::Remark -->
      <div class="col-sm">
        <div class="card">
          <div class="modal-header bg-light text-dark-50">
            <a>Remarks</a>
          </div>
          <div class="card-body">
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="box">
                  <form name="add_remark" action="model/parent_remark.php" method="POST">
                    <textarea class="staff" name="remark"></textarea>
                    <div class="mt-3 text-right">
                      <input type="hidden" value="<?= $consumer_id; ?>" name="consumer_id">
                      <button type="submit" class="btn btn-success btn-hover-light btn-sm" name="add_remark">Add remark</button>
                    </div>
                  </form>
                </div>
                <div class="box">
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
                      <table class="table mx-3">
                        <thead>
                          <tr class="row">
                            <th class="col-2">Date</th>
                            <th class="col-2">Staff</th>
                            <th class="col">Details</th>
                          </tr>
                        </thead>
                      </table>
                      <?php
                      $filter = ['Consumer_id'=>$consumer_id,'SubRemarks'=>'0','Status'=>'ACTIVE'];
                      $option = ['sort' => ['_id' => -1],'limit'=>10];
                      $query = new MongoDB\Driver\Query($filter, $option);
                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parent_Remarks',$query);
                      foreach ($cursor as $document)
                      {
                        $remark_id1 = strval($document->_id);
                        $Details1 = $document->Details;
                        $Staff_id1 = $document->Staff_id;
                        $Date1 = strval($document->Date);
                        $Date1 = new MongoDB\BSON\UTCDateTime(strval($Date1));
                        $Date1 = $Date1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                        $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id1)];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                        foreach ($cursor as $document)
                        {
                          $ConsumerFName = $document->ConsumerFName;
                        }
                        ?>
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                          <div class="accordion-item">
                            <h6 class="accordion-header" id="flush-heading<?= $remark_id1; ?>">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $remark_id1; ?>" aria-expanded="false" aria-controls="flush-collapse<?= $remark_id1; ?>">
                              <table class="table table-borderless text-left">
                                <tbody>
                                  <tr class="row">
                                    <td class="col-2"><?= date_format($Date1,"D,d M Y H:i") ?></td>
                                    <td class="col-2"><?= $ConsumerFName; ?></td>
                                    <td class="col"><a align="justify"><?= $Details1; ?></a></td>
                                  </tr>
                                </tbody>
                                </table>
                              </button>
                            </h6>
                            <div  id="flush-collapse<?= $remark_id1; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?= $remark_id1; ?>" data-bs-parent="#accordionFlushExample">
                              <?php 
                              $filter = ['Consumer_id'=>$consumer_id,'SubRemarks'=>$remark_id1];
                              $option = ['sort' => ['_id' => -1],'limit'=>10];
                              $query = new MongoDB\Driver\Query($filter, $option);
                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parent_Remarks',$query);
                              foreach ($cursor as $document2)
                              {
                                $remark_id2 = strval($document2->_id);
                                $Details2 = $document2->Details;
                                $Staff_id2 = $document2->Staff_id;
                                $Date2 = strval($document2->Date);
                                $Date2 = new MongoDB\BSON\UTCDateTime(strval($Date2));
                                $Date2 = $Date2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                                $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id2)];
                                $query = new MongoDB\Driver\Query($filter);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                foreach ($cursor as $document)
                                {
                                  $ConsumerFName = $document->ConsumerFName;
                                }
                                ?>
                                <div class="accordion-body">
                                <table class="table table-borderless text-left">
                                  <tbody>
                                    <tr class="row">
                                      <td class="col-2"><?= date_format($Date2,"D,d M Y H:i") ?></td>
                                      <td class="col-2"><?= $ConsumerFName; ?></td>
                                      <td class="col"><a align="justify"><?= $Details2;?></a></td>
                                    </tr>
                                  </tbody>
                                </table>
                                </div>
                                <?php
                                }
                                ?>
                                <form name="add_remark_child" action="model/parent_remark.php" method="POST">
                                    <div class="m-3">
                                      <textarea class="staff" name="remark"></textarea>
                                    </div>
                                    <div class="m-3 text-right">
                                      <input type="hidden" value="<?= $consumer_id; ?>" name="consumer_id">
                                      <input type="hidden" value="<?= $remark_id1; ?>" name="remark_id">
                                      <button type="submit" class="btn btn-light btn-sm" name="add_remark_child">Add remark</button>
                                      <button type="button" class="btn btn-success btn-hover-light btn-sm" data-bs-toggle="modal" data-bs-target="#update_parent_remark" data-bs-whatever="<?= $remark_id1; ?>">Update</button>
                                    </div>
                                </form>
                            </div>
                          </div>
                        </div>
                        <?php
                      }
                      ?>
                    </div>
                    <div class="tab-pane fade show pending" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                      <table class="table">
                        <thead>
                          <tr class="row">
                            <th class="col-2">Date</th>
                            <th class="col-2">Staff</th>
                            <th class="col">Details</th>
                          </tr>
                        </thead>
                      </table>
                      <?php
                      $filter = ['Consumer_id'=>$consumer_id,'SubRemarks'=>'0','Status'=>'PENDING'];
                      $option = ['sort' => ['_id' => -1],'limit'=>10];
                      $query = new MongoDB\Driver\Query($filter, $option);
                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parent_Remarks',$query);
                      foreach ($cursor as $document)
                      {
                        $remark_id1 = strval($document->_id);
                        $Details1 = $document->Details;
                        $Staff_id1 = $document->Staff_id;
                        $Date1 = strval($document->Date);
                        $Date1 = new MongoDB\BSON\UTCDateTime(strval($Date1));
                        $Date1 = $Date1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                        $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id1)];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                        foreach ($cursor as $document)
                        {
                          $ConsumerFName = $document->ConsumerFName;
                        }
                        ?>
                          <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                              <h6 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                  <table class="table table-borderless text-left">
                                    <tbody>
                                      <tr class="row">
                                        <td class="col-2"><?= date_format($Date1,"D,d M Y H:i") ?></td>
                                        <td class="col-2"><?= $ConsumerFName; ?></td>
                                        <td class="col"><a align="justify"><?= $Details1;?></a></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </button>
                              </h6>
                              <div  id="flush-collapseOne" class="accordion-collapse collapse mt-3" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <?php 
                                $filter = ['Consumer_id'=>$consumer_id,'SubRemarks'=>$remark_id1];
                                $option = ['sort' => ['_id' => -1],'limit'=>10];
                                $query = new MongoDB\Driver\Query($filter, $option);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parent_Remarks',$query);
                                foreach ($cursor as $document2)
                                {
                                  $remark_id2 = strval($document2->_id);
                                  $Details2 = ($document2->Details);
                                  $Staff_id2 = ($document2->Staff_id);
                                  $Date2 = strval($document2->Date);
                                  $Date2 = new MongoDB\BSON\UTCDateTime($Date2);
                                  $Date2 = $Date2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                                  $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id2)];
                                  $query = new MongoDB\Driver\Query($filter);
                                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                                  foreach ($cursor as $document)
                                  {
                                    $ConsumerFName = $document->ConsumerFName;
                                  }
                                  ?>
                                  <div class="accordion-body">
                                    <table class="table table-borderless text-left">
                                      <tbody>
                                        <tr class="row">
                                          <td class="col-2"><?= date_format($Date2,"D,d M Y H:i") ?></td>
                                          <td class="col-2"><?= $ConsumerFName; ?></td>
                                          <td class="col"><a align="justify"><?= $Details2;?></a></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                  <?php
                                }
                                ?>
                                <form name="add_remark_child" action="model/parent_remark.php" method="POST">
                                  <div class="m-3">
                                    <textarea class="staff" name="remark"></textarea>
                                  </div>
                                  <div class="m-3 text-right">
                                    <input type="hidden" value="<?= $consumer_id; ?>" name="consumer_id">
                                    <input type="hidden" value="<?= $remark_id1; ?>" name="remark_id">
                                    <button type="submit" class="btn btn-light btn-sm" name="add_remark_child">Add remark</button>
                                    <button type="button" class="btn btn-success btn-hover-light btn-sm" data-bs-toggle="modal" data-bs-target="#update_parent_remark" data-bs-whatever="<?= $remark_id1; ?>">update</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        <?php
                      }
                      ?>
                    </div>
                    <div class="tab-pane fade show completed" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                      <table class="table mx-3">
                        <thead>
                          <tr class="row">
                            <th class="col-2">Date</th>
                            <th class="col-2">Staff</th>
                            <th class="col">Details</th>
                          </tr>
                        </thead>
                      </table>
                      <?php
                      $filter = ['Consumer_id'=>$consumer_id,'SubRemarks'=>'0','Status'=>'COMPLETED'];
                      $option = ['sort' => ['_id' => -1],'limit'=>10];
                      $query = new MongoDB\Driver\Query($filter, $option);
                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parent_Remarks',$query);
                      foreach ($cursor as $document)
                      {
                        $remark_id1 = strval($document->_id);
                        $Staff_id1 = $document->Staff_id;
                        $Details1 = $document->Details;
                        $Date1 = strval($document->Date);
                        $Date1 = new MongoDB\BSON\UTCDateTime(strval($Date1));
                        $Date1 = $Date1->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                        
                        $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id1)];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                        foreach ($cursor as $document)
                        {
                          $ConsumerFName = $document->ConsumerFName;
                        }
                        ?>
                          <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                              <h6 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                  <table class="table table-borderless text-left">
                                    <tbody>
                                        <tr class="row">
                                          <td class="col-2"><?= date_format($Date1,"D,d M Y H:i") ?></td>
                                          <td class="col-2"><?= $ConsumerFName;?></td>
                                          <td class="col"><a align="justify"><?= $Details1;?></a></td>
                                        </tr>
                                    </tbody>
                                  </table>
                                </button>
                              </h6>
                              <div  id="flush-collapseOne" class="accordion-collapse collapse mt-3" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <?php 
                                $filter = ['Consumer_id'=>$consumer_id,'SubRemarks'=>$remark_id1];
                                $option = ['sort' => ['_id' => -1],'limit'=>10];
                                $query = new MongoDB\Driver\Query($filter,$option);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parent_Remarks',$query);
                                foreach ($cursor as $document2)
                                {
                                  $remark_id2 = strval($document2->_id);
                                  $Details2 = $document2->Details;
                                  $Staff_id2 = $document2->Staff_id;
                                  $Date2 = $document2->Date;
                                  $Date2 = new MongoDB\BSON\UTCDateTime(strval($Date2));
                                  $Date2 = $Date2->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                                  $filter = ['_id' => new \MongoDB\BSON\ObjectId($Staff_id2)];
                                  $query = new MongoDB\Driver\Query($filter);
                                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                                  foreach ($cursor as $document)
                                  {
                                    $ConsumerFName = $document->ConsumerFName;
                                  }
                                  ?>
                                  <div class="accordion-body">
                                    <table class="table table-borderless text-left">
                                      <tbody>
                                        <tr class="row">
                                          <td class="col-2"><?= date_format($Date2,"D,d M Y H:i") ?></td>
                                          <td class="col-2"><?= $ConsumerFName;?></td>
                                          <td class="col"><a align="justify"><?= $Details2;?></a></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                  <?php
                                  }
                                  ?>
                                  <form name="add_remark_child" action="model/parent_remark.php" method="POST">
                                    <div class="m-3">
                                      <textarea class="staff" name="remark"></textarea>
                                    </div>
                                    <div class="m-3 text-right">
                                      <input type="hidden" value="<?= $consumer_id; ?>" name="consumer_id">
                                      <input type="hidden" value="<?= $remark_id1; ?>" name="remark_id">
                                      <button type="submit" class="btn btn-light btn-sm" name="add_remark_child">Add remark</button>
                                      <button type="button" class="btn btn-success btn-hover-light btn-sm" data-bs-toggle="modal" data-bs-target="#update_parent_remark" data-bs-whatever="<?= $remark_id1; ?>">update</button>
                                    </div>
                                  </form>
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
          </div>
        </div>
      </div>
      <!-- end::Remark -->
    </div>
  </div>
</div>
<script type="text/javascript" src='https://cdn.tiny.cloud/1/ctl5tdxtaqli3dvaw5f3zolgpcusntlmonfxnq4673uy1x7d/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '.staff',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:100,
});
</script>
<?php include ('view/pages/modal-update_remark.php'); ?>