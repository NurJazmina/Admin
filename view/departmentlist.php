<!--Add school department-->
<?php
if (isset($_POST['AddDepartmentFormSubmit']))
{
  $varschoolID = strval($_SESSION["loggeduser_schoolID"]);
  $vardepartment = $_POST['txtdepartment'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert(['School_id'=>$varschoolID,'DepartmentName'=> $vardepartment]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.SchoolsDepartment', $bulk, $writeConcern);
  }
  catch (MongoDB\Driver\Exception\BulkWriteException $e)
  {
    $result = $e->getWriteResult();
    // Check if the write concern could not be fulfilled
    if ($writeConcernError = $result->getWriteConcernError())
    {
        printf("%s (%d): %s\n",
            $writeConcernError->getMessage(),
            $writeConcernError->getCode(),
            var_export($writeConcernError->getInfo(), true)
        );
    }
    // Check if any write operations did not complete at all
    foreach ($result->getWriteErrors() as $writeError)
    {
        printf("Operation#%d: %s (%d)\n",
            $writeError->getIndex(),
            $writeError->getMessage(),
            $writeError->getCode()
        );
    }
  }
  catch (MongoDB\Driver\Exception\Exception $e)
  {
    printf("Other error: %s\n", $e->getMessage());
    exit;
  }
  //printf("Matched: %d\n", $result->getMatchedCount());
  //printf("Updated  %d document(s)\n", $result->getModifiedCount());
}
?>
<!--Edit school department -->
<?php
if (isset($_POST['EditDepartmentFormSubmit']))
{
  $varschoolID = strval($_SESSION["loggeduser_schoolID"]);
  $vardepartmentid = $_POST['txtdepartmentid'];
  $vardepartmentname = $_POST['txtdepartmentname'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['_id' => new \MongoDB\BSON\ObjectID($vardepartmentid)],
                ['$set' => ['DepartmentName'=>$vardepartmentname]]
               );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result = $GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.SchoolsDepartment', $bulk, $writeConcern);
  }
  catch (MongoDB\Driver\Exception\BulkWriteException $e)
  {
    $result = $e->getWriteResult();
    // Check if the write concern could not be fulfilled
    if ($writeConcernError = $result->getWriteConcernError())
    {
        printf("%s (%d): %s\n",
            $writeConcernError->getMessage(),
            $writeConcernError->getCode(),
            var_export($writeConcernError->getInfo(), true)
        );
    }

    // Check if any write operations did not complete at all
    foreach ($result->getWriteErrors() as $writeError)
    {
        printf("Operation#%d: %s (%d)\n",
            $writeError->getIndex(),
            $writeError->getMessage(),
            $writeError->getCode()
        );
    }
  }
  catch (MongoDB\Driver\Exception\Exception $e)
  {
    printf("Other error: %s\n", $e->getMessage());
    exit;
  }
    //printf("Matched: %d\n", $result->getMatchedCount());
    //printf("Updated  %d document(s)\n", $result->getModifiedCount());
}
?>
<!--Delete school department -->
<?php
if (isset($_POST['DeleteDepartmentFormSubmit']))
{
  $vardepartmentid = $_POST['txtdepartmentid'];
  $bulk = new MongoDB\Driver\BulkWrite;
  $bulk->delete(['_id'=>new \MongoDB\BSON\ObjectID($vardepartmentid)], ['limit' => 1]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.SchoolsDepartment', $bulk, $writeConcern);
  }
  catch (MongoDB\Driver\Exception\BulkWriteException $e)
  {
    $result = $e->getWriteResult();
    // Check if the write concern could not be fulfilled
    if ($writeConcernError = $result->getWriteConcernError())
    {
        printf("%s (%d): %s\n",
            $writeConcernError->getMessage(),
            $writeConcernError->getCode(),
            var_export($writeConcernError->getInfo(), true)
        );
    }
    // Check if any write operations did not complete at all
    foreach ($result->getWriteErrors() as $writeError)
    {
        printf("Operation#%d: %s (%d)\n",
            $writeError->getIndex(),
            $writeError->getMessage(),
            $writeError->getCode()
        );
    }
  }
  catch (MongoDB\Driver\Exception\Exception $e)
  {
    printf("Other error: %s\n", $e->getMessage());
    exit;
  }
//printf("Matched: %d\n", $result->getMatchedCount());
//printf("Deleted  %d document(s)\n", $result->getModifiedCount());
}
?>
<div class="myDiv" style="color:#696969;text-align:center"><br><br><br><h1>Departments</h1></div><br>
<div class="table-responsive">
<table class="table table-bordered table-sm">
  <thead class="table-light">
  </thead>
  <tbody>
    <tr>
      <th scope="row" class="table-secondary">List</th>
      <td class="table-secondary">Department</td>
      <td class="table-secondary">Update</td>
    </tr>
    <?php
    $calc = 0;
    $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"]];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
    foreach ($cursor as $document)
    {
      $calc = $calc + 1;
      $departmentid = strval($document->_id);
      $DepartmentName = strval($document->DepartmentName);
    ?>
    <tr>
    <th scope="row"><?php echo $calc; ?></th>
    <td><?php echo $DepartmentName; ?></td>
    <td>
      <button style="font-size:10px" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#EditDepartmentModal" data-bs-whatever="<?php echo $departmentid; ?>">
        <i class="fa fa-edit" style="font-size:15px"></i>
      </button>
      <button style="font-size:10px" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteDepartmentModal" data-bs-whatever="<?php echo $departmentid; ?>">
        <i class="fas fa-trash" style="font-size:15px"></i>
      </button>
    </td>
    </tr>
    <?php
    }
    ?>
    <tr>
      <th scope="row">Add</th>
      <td colspan="2">
        <button style="font-size:10px" type="button"  class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AddDepartmentModal">
         <i class="fas fa-plus" style="font-size:15px"></i>
        </button>
      </td>
    </tr>
  </tbody>
</table>
</div
<?php include ('view/modal-adddepartment.php'); ?>
<?php include ('view/modal-editdepartment.php'); ?>
<?php include ('view/modal-deletedepartment.php'); ?>
<script>
  var AddDepartmentModal = document.getElementById('AddDepartmentModal')
  AddDepartmentModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = AddDepartmentModal.querySelector('.modal-title')
  var modalBodyInput = AddDepartmentModal.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })

  var EditDepartmentModal = document.getElementById('EditDepartmentModal')
  EditDepartmentModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = EditDepartmentModal.querySelector('.modal-title')
  var modalBodyInput = EditDepartmentModal.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })

  var DeleteDepartmentModal = document.getElementById('DeleteDepartmentModal')
  DeleteDepartmentModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = DeleteDepartmentModal.querySelector('.modal-title')
  var modalBodyInput = DeleteDepartmentModal.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>
