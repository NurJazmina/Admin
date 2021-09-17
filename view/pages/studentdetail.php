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
        <h5 class="text-dark font-weight-bold my-1 mr-5">Student info</h5>
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

    $filter = ['Consumer_id'=>$consumer_id];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
    foreach ($cursor as $document)
    {
      $class_id = $document->Class_id;
    }
  }

  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($class_id)];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
  foreach ($cursor as $document)
  {
    $ClassName = $document->ClassName;
  }

  $totalstudent = 0;
  $filter = ['class_id'=>$class_id];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
  foreach ($cursor as $document)
  {
    $totalstudent = $totalstudent + 1;
  }
  $date = date("Y-m-d");
  $today = new MongoDB\BSON\UTCDateTime((new DateTime($date))->getTimestamp()*1000);

  if (isset($_POST['submit_date']))
  {
      $date = $_POST['date'];
  }
  ?>
  <div class="text-dark-50 text-center m-5"><h1>Student Info</h1></div>
  <div class="card">
    <div class="card-body table-responsive">
      <div class="row">
        <!-- begin::Subject/class detail -->
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
                <td>Address</td>
                <td><?= $ConsumerAddress; ?></td>
              </tr>
              <tr>
                <td>Status</td>
                <td><?= $ConsumerStatus; ?></td>
              </tr>
            </tbody>
          </table>
          <table class="table table-bordered">
            <tbody>
              <tr class="bg-light text-dark-50">
                <td>Class</td>
                <td><?= $ClassName; ?> </td>
              </tr>
              <tr>
                <td>Teacher</td>
                <td>
                <?php
                $totalsubject = 0;
                $filter = ['Class_id'=>$class_id];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
                foreach ($cursor as $document)
                {
                  $Subject_id = $document->Subject_id;
                  $Teacher_id = $document->Teacher_id;
                  
                  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Teacher_id)];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                  foreach ($cursor as $document)
                  {
                    $ConsumerID = $document->ConsumerID;

                    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                    foreach ($cursor as $document)
                    {
                      $teacher_id = strval($document->_id);
                      $teacherF_name = $document->ConsumerFName;
                      $teacherL_name = $document->ConsumerLName;
                    }
                  }
                  ?>
                  <a href="index.php?page=staffdetail&id=<?= $teacher_id; ?>"><?= $teacherF_name." ".$teacherL_name;?></a>
                  <?php
                }
                ?>
                </td>
              </tr>
              <tr>
                <td>Subject</td>
                <td>
                <?php
                $filter = ['Class_id'=>$class_id];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
                foreach ($cursor as $document)
                {
                  $Subject_id = $document->Subject_id;
                  $Teacher_id = $document->Teacher_id;

                  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Subject_id)];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
                  foreach ($cursor as $document)
                  {
                    $subject_name = $document->SubjectName;
                    ?>
                    <a href="index.php?page=subjectdetail&id=<?= $Subject_id; ?>">
                    <?= $subject_name."<br>";
                  }
                }
                ?>
              </td>
              </tr>
              <tr>
                <td>Number of Subject</td>
                <td><?= $totalsubject; ?></td>
              </tr>
              <tr>
                <td>Number of Student</td>
                <td><?= $totalstudent; ?></td>
              </tr>
            </tbody>
          </table>
          <table class="table table-bordered">
            <tbody>
              <tr class="bg-light text-dark-50">
                <td>Teacher</td>
                <td>Subject</td>
              </tr>
              <?php
              $filter = ['Class_id'=>$class_id];
              $query = new MongoDB\Driver\Query($filter);
              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
              foreach ($cursor as $document)
              {
                $Teacher_id = $document->Teacher_id;
                $Subject_id = $document->Subject_id;

                $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Teacher_id)];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                foreach ($cursor as $document)
                {
                  $ConsumerID = $document->ConsumerID;

                  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
                  $query = new MongoDB\Driver\Query($filter);
                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                  foreach ($cursor as $document)
                  {
                    $ConsumerFName = $document->ConsumerFName;
                    $ConsumerLName = $document->ConsumerLName;
                  }
                }
                $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Subject_id)];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
                foreach ($cursor as $document)
                {
                  $subject_id = $document->_id;
                  $subject_name = $document->SubjectName;
                }
                ?>
                <tr>
                  <td><a href="index.php?page=staffdetail&id=<?= $ConsumerID; ?>"><?= $ConsumerFName." ".$ConsumerLName;?></th></td>
                  <td><a href="index.php?page=subjectdetail&id=<?= $subject_id; ?>"><?= $subject_name;?></td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>
        <!-- end::Subject/class detail -->
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
                    <form name="add_remark" action="model/student_remark.php" method="POST">
                      <textarea class="class" name="remark"></textarea>
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
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Student_Remarks',$query);
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
                                      <td class="col-2"><?= $ConsumerFName;?></td>
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
                            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Student_Remarks',$query);
                            foreach ($cursor as $document)
                            {
                              $remark_id2 = strval($document->_id);
                              $Staff_id2 = $document->Staff_id;
                              $Details2 = $document->Details;
                              $Date2 = strval($document->Date);
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
                              <form name="add_remark_child" action="model/student_remark.php" method="POST">
                                <div class="m-3">
                                  <textarea class="class" name="remark"></textarea>
                                </div>
                                <div class="m-3 text-right">
                                  <input type="hidden" value="<?= $consumer_id; ?>" name="consumer_id">
                                  <input type="hidden" value="<?= $remark_id1; ?>" name="remark_id">
                                  <button type="submit" class="btn btn-light btn-sm" name="add_remark_child">Add remark</button>
                                  <button type="button" class="btn btn-success btn-hover-light btn-sm" data-bs-toggle="modal" data-bs-target="#update_student_remark" data-bs-whatever="<?= $remark_id1; ?>">Update</button>
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
                        $filter = ['Consumer_id'=>$consumer_id,'SubRemarks'=>'0','Status'=>'PENDING'];
                        $option = ['sort' => ['_id' => -1],'limit'=>10];
                        $query = new MongoDB\Driver\Query($filter, $option);
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Student_Remarks',$query);
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
                          $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                          foreach ($cursor as $document)
                          {
                            $ConsumerFName = $document->ConsumerFName;
                          }
                          ?>
                          <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item" >
                              <h6 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
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
                              <div  id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <?php 
                                $filter = ['Consumer_id'=>$consumer_id,'SubRemarks'=>$remark_id1];
                                $option = ['sort' => ['_id' => -1],'limit'=>10];
                                $query = new MongoDB\Driver\Query($filter, $option);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Student_Remarks',$query);
                                foreach ($cursor as $document)
                                {
                                  $remark_id2 = strval($document->_id);
                                  $Staff_id2 = $document->Staff_id;
                                  $Details2 = $document->Details;
                                  $Date2 = strval($document->Date);
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
                                <form name="add_remark_child" action="model/student_remark.php" method="POST">
                                  <div class="m-3">
                                    <textarea class="class" name="remark"></textarea>
                                  </div>
                                  <div class="m-3 text-right">
                                    <input type="hidden" value="<?= $consumer_id; ?>" name="consumer_id">
                                    <input type="hidden" value="<?= $remark_id1; ?>" name="remark_id">
                                    <button type="submit" class="btn btn-light btn-sm" name="add_remark_child">Add remark</button>
                                    <button type="button" class="btn btn-success btn-hover-light btn-sm" data-bs-toggle="modal" data-bs-target="#update_student_remark" data-bs-whatever="<?= $remark_id1; ?>">Update</button>
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
                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Student_Remarks',$query);
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
                          $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer', $query);
                          foreach ($cursor as $document)
                          {
                            $ConsumerFName = $document->ConsumerFName;
                          }
                          ?>
                          <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item" >
                              <h6 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                  <table class="table table-borderless text-left">
                                    <tbody>
                                      <tr class="row">
                                        <td class="col-2"><?= date_format($Date1,"D,d M Y H:i") ?></td>
                                        <td class="col-2"><?=  $ConsumerFName; ?></td>
                                        <td class="col"><a align="justify"><?= $Details1; ?></a></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </button>
                              </h6>
                              <div  id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <?php 
                                $filter = ['Consumer_id'=>$consumer_id,'SubRemarks'=>$remark_id1];
                                $option = ['sort' => ['_id' => -1],'limit'=>10];
                                $query = new MongoDB\Driver\Query($filter, $option);
                                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Student_Remarks',$query);
                                foreach ($cursor as $document)
                                {
                                  $remark_id2 = strval($document->_id);
                                  $Staff_id2 = $document->Staff_id;
                                  $Details2 = $document->Details;
                                  $Date2 = strval($document->Date);
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
                                <form name="add_remark_child" action="model/student_remark.php" method="POST">
                                  <div class="m-3">
                                    <textarea class="class" name="remark"></textarea>
                                  </div>
                                  <div class="m-3 text-right">
                                    <input type="hidden" value="<?= $consumer_id; ?>" name="consumer_id">
                                    <input type="hidden" value="<?= $remark_id1; ?>" name="remark_id">
                                    <button type="submit" class="btn btn-light btn-sm" name="add_remark_child">Add remark</button>
                                    <button type="button" class="btn btn-success btn-hover-light btn-sm" data-bs-toggle="modal" data-bs-target="#update_student_remark" data-bs-whatever="<?= $remark_id1; ?>">Update</button>
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
  <!-- begin::attendance -->
  <div class="card">
    <div class="card-body text-right">
      <form name="submit_date" action="" method="post">
        <div class="row mb-3">
          <div class="col text-right">
            <input type="date" class="form-control form-control-sm bg-white" name="date" placeholder="Select date" value="<?= $date; ?>"> 
          </div>
          <div class="col text-right">
          <button type="submit" name="submit_date" class="btn btn-success btn-hover-light btn-sm">Submit</button>
            <button type="button" id="submitted" class="btn btn-success btn-hover-light btn-sm ">Export attendance to xls</button>
          </div>
        </div>
      </form>
      <table id="attendance" class="table table-bordered text-left shadow p-3 mb-5 rounded">
        <thead class="bg-white text-success">
            <tr>
              <th>Student ID</th>
              <th>Student Name</th>
              <th>Date</th>
              <th>IN</th>
              <th>OUT</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $Cards_id ='';
        if (isset($_GET['id']) && !empty($_GET['id']))
        {
          $filter = ['_id'=>new \MongoDB\BSON\ObjectId($_GET['id'])];
          $query = new MongoDB\Driver\Query($filter);
          $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
          foreach ($cursor as $document)
          {
            $consumer_id = strval($document->_id);
            $ConsumerFName = $document->ConsumerFName;
            $ConsumerLName = $document->ConsumerLName;
            $ConsumerIDNo = $document->ConsumerIDNo;

            $filter = ['Consumer_id'=>$consumer_id];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Cards',$query);
            foreach ($cursor as $document)
            {
              $Cards_id = strval($document->Cards_id);
            }
            ?>
            <tr>
              <td class="default"><?= $ConsumerIDNo; ?></td>
              <td class="default"><?= $ConsumerFName." ".$ConsumerLName; ?></td>
              <td class="default"><?= $date."<br>"; ?></td>
              <td class="default"><?php
              $count = 0;
              $filter = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $today]];
              $option = ['sort' => ['_id' => 1]];
              $query = new MongoDB\Driver\Query($filter,$option);
              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$query);
              foreach ($cursor as $document)
              {
                $date = strval($document->AttendanceDate);
                $date = new MongoDB\BSON\UTCDateTime($date);
                $date = $date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                $count = $count +1;
                if ($count % 2){
                  echo date_format($date,"H:i:s")."<br>";}
              }
              ?></td>
              <td class="default"><?php
              $count = 0;
              $filter = ['CardID'=>$Cards_id ,'AttendanceDate' => ['$gte' => $today]];
              $option = ['sort' => ['_id' => 1]];
              $query = new MongoDB\Driver\Query($filter,$option);
              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Attendance',$query);
              foreach ($cursor as $document)
              {
                $date = strval($document->AttendanceDate);
                $date = new MongoDB\BSON\UTCDateTime($date);
                $date = $date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                $count = $count +1;
                if ($count % 2){
                }
                else{
                  echo date_format($date,"H:i:s")."<br>";}
              }
              ?></td>
            </tr>
            <?php
          }
        }
        ?>
        </tbody>
      </table>
        <script>
          $(document).ready(function() {
              $("#submitted").click(function() {
                  $("#attendance").table2excel({
                  filename: "attendance_class.xls"
              });
              });

          });
        </script>
        <script type="text/javascript">
        var rows = document.querySelectorAll('tr');

        [...rows].forEach((r) => {
        if (r.querySelectorAll('td:empty').length > 0) {
        r.classList.add('highlight');
        }
        })
        </script>
    </div>
  </div>
  <!-- end::attendance -->
<?php
}
?>
<script type="text/javascript" src='https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/4/tinymce.min.js' referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '.class',
  menubar:false,
  statusbar: false,
  toolbar: false,
  height:100,
});
</script>
<?php include ('view/pages/modal-update_remark.php'); ?>