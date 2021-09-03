<?php 
include ('model/studentlist.php'); 

if (isset($_GET['paging']) && !empty($_GET['paging']))
{
  $datapaging = ($_GET['paging']*50);
  $pagingprevious = $_GET['paging']-1;
  $pagingnext = $_GET['paging']+1;
} else
{
  $datapaging = 0;
  $pagingnext = 1;
  $pagingprevious = 0;
}
if (!isset($_POST['search_parent']) && empty($_POST['search_parent']))
{
  $filter = ['Schools_id'=>$_SESSION["loggeduser_school_id"]];
  $option = ['limit'=>50,'skip'=>$datapaging,'sort' => ['_id' => -1]];
  $query = new MongoDB\Driver\Query($filter,$option);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
}
else
{
  $consumer = ($_POST['consumer']);
  $filter = [NULL];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document)
  {
    $consumer_id = strval($document->_id);
    $ConsumerIDNo = $document->ConsumerIDNo;
    $ConsumerFName = $document->ConsumerFName;
    
    if ($ConsumerIDNo == $consumer || $ConsumerFName == $consumer)
    {
      $filter = ['Schools_id'=>$_SESSION["loggeduser_school_id"], 'ConsumerID'=>$consumer_id];
      $query = new MongoDB\Driver\Query($filter);
      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
    }
  }
}
?>
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
  <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <!--begin::Info-->
    <div class="d-flex align-items-center flex-wrap mr-1">
      <!--begin::Page Heading-->
      <div class="d-flex align-items-baseline flex-wrap mr-5">
        <!--begin::Page Title-->
        <h5 class="text-dark font-weight-bold my-1 mr-5">Parent</h5>
        <!--end::Page Title-->
      </div>
      <!--begin::Separator-->
      <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
      <!--end::Separator-->
      <!--begin::Detail-->
      <div class="d-flex align-items-center" id="kt_subheader_search">
      <span class="text-dark-50 font-weight-bold" id="kt_subheader_total"><?= $school = $_SESSION["totalparent"]; ?> Total Student</span>
      </div>
      <!--end::Detail-->
      <!--end::Page Heading-->
    </div>
    <!--end::Info-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
      <form name="search_parent" class="form-inline" action="index.php?page=parentlist" method="post">
        <div class="text-right">
          <?php 
          if($_SESSION["loggeduser_ACCESS"] =='STAFF') 
          {
            ?>
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#add_student">Add</button>
            <input  type="text" class="form-control" name="consumer" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="search by ID/Name">
            <button type="submit" class="btn btn-success btn-sm" name="search_parent">Search</button>
            <?php
          } 
          else
          {
            ?>
            <input  type="text" class="form-control" name="consumer" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="search by ID/Name">
            <button type="submit" class="btn btn-success btn-sm" name="search_parent">Search</button>
            <?php
          }
          ?>
        </div>
      </form>
    </div>
    <!--end::Toolbar-->
  </div>
</div>
<!--end::Subheader-->
<div class="row">
  <!-- begin::staff list -->
  <div class="col-12 col-lg-8">
    <div class="card">
      <!-- begin :: card header -->
      <div class="modal-header">
        <strong>List</strong>
        <button class="btn btn-light btn-hover-success bolder btn-sm" type="button" data-bs-toggle="dropdown">Sort by &nbsp;&nbsp;&nbsp;<i class="fas fa-sort"></i></button>
        <ul class="dropdown-menu">
        <li class="dropdown-item"><a href="index.php?page=parentlist">All</a></li>
            <li class="dropdown-item"><a href="index.php?page=parentlist&level=1">category 1</a></li>
            <li class="dropdown-item"><a href="index.php?page=parentlist&level=2">category 2</a></li>
            <li class="dropdown-item"><a href="index.php?page=parentlist&level=3">category 3</a></li>
            <li class="dropdown-item"><a href="index.php?page=parentlist&level=4">category 4</a></li>
            <li class="dropdown-item"><a href="index.php?page=parentlist&level=5">category 5</a></li>
            <li class="dropdown-item"><a href="index.php?page=parentlist&level=6">category 6</a></li>
        </ul>
      </div>
      <!-- end :: card header -->
      <!-- begin :: card body -->
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm text-left table-bordered">
            <thead class="bg-success text-white">
              <tr class="text-center">
                <th scope="col">Name</th>
                <th scope="col">ID Type</th>
                <th scope="col">ID No</th>
                <th scope="col">Relation</th>
                <th scope="col">Son/Daughter</th>
                <th scope="col">Total Child</th>
                <th scope="col">Status</th>
                <th scope="col">Update</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($cursor as $document)
              {
                $date = new MongoDB\BSON\UTCDateTime((new DateTime('now'))->getTimestamp()*1000);
                $date = $date->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));

                $parent_id = strval($document->_id);
                $ConsumerID = $document->ConsumerID;
                $ParentStatus = $document->ParentStatus;

                $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
                $query = new MongoDB\Driver\Query($filter);
                $cursor =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                foreach ($cursor as $document)
                {
                  $parent_consumer_id = strval($document->_id);
                  $ConsumerFName = $document->ConsumerFName;
                  $ConsumerLName = $document->ConsumerLName;
                  $ConsumerIDType = $document->ConsumerIDType;
                  $ConsumerIDNo = $document->ConsumerIDNo;
                }
                ?>
                <tr>
                  <td><a href="index.php?page=parentdetail&id=<?=$parent_consumer_id; ?>"><?=$ConsumerFName." ".$ConsumerLName;?></a></td>
                  <td><?= $ConsumerIDType; ?></td>
                  <td><?= $ConsumerIDNo; ?></td>
                  <td>
                    <?php
                    $filter = ['ParentID'=>$parent_id];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentStudentRel',$query);
                    foreach ($cursor as $document)
                    {
                      $ParentStudentRelation = $document->ParentStudentRelation;
                      ?>
                      <a class="text-primary"><?=$ParentStudentRelation;?></a><br>
                      <?php
                    }
                    ?>
                  </td>
                  <td>
                    <?php
                    $count = 0;
                    $filter = ['ParentID'=>$parent_id];
                    $query = new MongoDB\Driver\Query($filter);
                    $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentStudentRel',$query);
                    foreach ($cursor as $document)
                    {
                      $relation_id = strval($document->_id);
                      $StudentID = $document->StudentID;
                      $ParentStudentRelation = $document->ParentStudentRelation;

                      $filter = ['_id'=>new \MongoDB\BSON\ObjectId($StudentID)];
                      $query = new MongoDB\Driver\Query($filter);
                      $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
                      foreach ($cursor as $document)
                      {
                        $count = $count + 1;
                        $Consumer_id = $document->Consumer_id;

                        $filter = ['_id'=>new \MongoDB\BSON\ObjectId($Consumer_id)];
                        $query = new MongoDB\Driver\Query($filter);
                        $cursor =$GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                        foreach ($cursor as $document)
                        {
                          $student_consumer_id = strval($document->_id);
                          $ConsumerFName = $document->ConsumerFName;
                          $ConsumerLName = $document->ConsumerLName;
                        }
                      }
                      ?>
                      <a href="index.php?page=studentdetail&id=<?=$student_consumer_id; ?>"><?=$ConsumerFName." ".$ConsumerLName;?></a><br>
                      <?php
                    }
                    ?>
                  </td>
                  <td class="text-center"><?= $count; ?></td>
                  <?php
                  if($ParentStatus == "ACTIVE")
                  {
                    ?>
                    <td class="text-warning"><?= $ParentStatus; ?></td>
                    <?php
                  }
                  else
                  {
                    ?>
                    <td class="text-danger"><?= $ParentStatus; ?></td>
                    <?php
                  }
                  ?> 
                  <td>
                  <?php
                    if($_SESSION["loggeduser_ACCESS"] =='STAFF') 
                    {
                      ?>
                      <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#status_parent" data-bs-whatever="<?= $parent_consumer_id; ?>">
                        <i class="flaticon2-reload icon-md text-hover-success"></i>
                      </button>
                      <?php
                    }
                  ?>
                  </td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
          <div class="col-12 text-right">
            <div class="btn-group" role="group" aria-label="Basic example">
              <?php
              if (isset($_GET['paging']) && !empty($_GET['paging']))
              {
                if ($_GET['paging'] == 0) 
                {
                  ?>
                  <a class="btn btn-light btn-hover-success btn-sm">Previous</a>
                  <a href="index.php?page=parentlist&paging=<?= $pagingnext;?>" class="btn btn-success btn-hover-light btn-sm">Next</a>
                  <?php
                } 
                else
                {
                  ?>
                  <a href="index.php?page=parentlist&paging=<?= $pagingprevious;?>" class="btn btn-light btn-hover-success btn-sm">Previous</a>
                  <a href="index.php?page=parentlist&paging=<?= $pagingnext;?>" class="btn btn-success btn-hover-light btn-sm">Next</a>
                  <?php
                }
              }
              else if (!isset($_GET['paging']) && empty($_GET['paging']))
              {
                ?>
                <a class="btn btn-light btn-hover-success btn-sm">Previous</a>
                <a href="index.php?page=parentlist&paging=<?= $pagingnext;?>" class="btn btn-success btn-hover-light btn-sm">Next</a>
                <?php
              }
              ?>
            </div>
          </div>
        </div>
      </div>
      <!-- end :: card body -->
    </div>
  </div>
  <!-- end::staff list -->
    <!-- begin::latest summary -->
    <div class="col-12 col-lg-4">
    <div class="row">
        <div class="col-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>Latest Summary</strong>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <div class="tab-content" id="v-pills-tabContent">
                    <!--Tab by all class -->
                    <div class="tab-pane fade show active" id="v-pills-class" role="tabpanel" aria-labelledby="v-pills-class-tab">
                      <div class="box">
                        <strong>Total</strong>
                        <div class="table-responsive">
                          <table class="table table-sm">
                            <tr>
                              <th>Total</th>
                              <td>
                              <?php
                              $totalparent = 0;
                              $filter = ['Schools_id'=>$_SESSION["loggeduser_school_id"]];
                              $query = new MongoDB\Driver\Query($filter);
                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
                              foreach ($cursor as $document)
                              {
                                $totalparent = $totalparent+ 1;
                              }
                              echo $totalparent;
                              ?>
                              </td>
                            </tr>
                            <tr>
                              <th>Active</th>
                              <td>
                              <?php
                              $totalparent = 0;
                              $filter = ['Schools_id'=>$_SESSION["loggeduser_school_id"], 'ParentStatus'=>'ACTIVE'];
                              $query = new MongoDB\Driver\Query($filter);
                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
                              foreach ($cursor as $document)
                              {
                                $totalparent = $totalparent + 1;
                              }
                              echo $totalparent;
                              ?>
                              </td>
                            </tr>
                            <tr>
                              <th>Inactive</th>
                              <td>
                              <?php
                              $totalparent = 0;
                              $filter = ['Schools_id'=>$_SESSION["loggeduser_school_id"], 'ParentStatus'=>'INACTIVE'];
                              $query = new MongoDB\Driver\Query($filter);
                              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Parents',$query);
                              foreach ($cursor as $document)
                              {
                                $totalparent = $totalparent + 1;
                              }
                              echo $totalparent;
                              ?>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <div class="box">
                        <strong>Remarks</strong>
                        <div class="table-responsive">
                          <table class="table table-sm">
                            <thead>
                              <tr>
                                <th>School</th>
                                <th>Subject</th>
                                <th>Students</th>
                                <th>Status</th>
                              </tr>
                            </thead>
                            <tbody class="bg-light">
                              <tr>
                                <td>No data</td>
                                <td>No data</td>
                                <td>No data</td>
                                <td>No data</td>
                              </tr>
                            </tbody>
                          </table>
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
  <!-- end::latest summary -->
</div>
<?php include ('view/pages/modal-studentlist.php'); 