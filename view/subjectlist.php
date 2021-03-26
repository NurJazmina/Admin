<!--Add school subject-->
<?php
if (isset($_POST['AddSubjectFormSubmit']))
{
  $varschoolID = strval($_SESSION["loggeduser_schoolID"]);
  $varsubject = $_POST['txtsubject'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->insert(['School_id'=>$varschoolID,'SubjectName'=> $varsubject]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result=$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.SchoolsSubject', $bulk, $writeConcern);
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
  printf("Matched: %d\n", $result->getMatchedCount());
  printf("Updated  %d document(s)\n", $result->getModifiedCount());
}
?>
<!--Edit school subject-->
<?php
if (isset($_POST['EditSubjectFormSubmit']))
{
  $varsubjectid = $_POST['txtsubjectid'];
  $varsubjectname = $_POST['txtsubjectname'];
  $bulk = new MongoDB\Driver\BulkWrite(['ordered' => TRUE]);
  $bulk->update(['_id' => new \MongoDB\BSON\ObjectID($varsubjectid)],
                ['$set' => ['SubjectName'=>$varsubjectname]]
               );
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result=$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.SchoolsSubject', $bulk, $writeConcern);
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
  printf("Matched: %d\n", $result->getMatchedCount());
  printf("Updated  %d document(s)\n", $result->getModifiedCount());
}
?>
<!--delete school subject-->
<?php
if (isset($_POST['DeleteSubjectFormSubmit']))
{
  $varsubjectid = $_POST['txtsubjectid'];
  $bulk = new MongoDB\Driver\BulkWrite;
  $bulk->delete(['_id'=>new \MongoDB\BSON\ObjectID($varsubjectid)], ['limit' => 1]);
  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
  try
  {
    $result=$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.SchoolsSubject', $bulk, $writeConcern);
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
  printf("Matched: %d\n", $result->getMatchedCount());
  printf("Deleted  %d document(s)\n", $result->getModifiedCount());
}
?>
<body>
<div class="myDiv" style="color:#696969;text-align:center">
<br><br><br><h1>Subjects</h1>
</div>
<br>
<table class="table table-bordered">
  <thead class="table-light">
  </thead>
  <tbody>
    <tr>
      <th scope="row" class="table-secondary">List</th>
      <td class="table-secondary">Subject</td>
      <td class="table-secondary">Update</td>
    </tr>
    <?php
    $calc = 0;
    $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"]];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
    foreach ($cursor as $document)
    {
      $calc = $calc + 1;
      $subjectid = strval($document->_id);
      $SubjectName = strval($document->SubjectName);
    ?>
    <tr>
    <th scope="row"><?php echo $calc; ?></th>
    <td><?php echo $SubjectName; ?></td>
    <td>
      <button style="font-size:10px" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#EditSubjectModal" data-bs-whatever="<?php echo $subjectid; ?>">
        <i class="fa fa-edit" style="font-size:15px"></i>
      </button>
      <button style="font-size:10px" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteSubjectModal" data-bs-whatever="<?php echo $subjectid; ?>">
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
        <button style="font-size:10px" type="button"  class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AddSubjectModal">
         <i class="fas fa-plus" style="font-size:15px"></i>
        </button>
      </td>
    </tr>
  </tbody>
</table>
</body>
<?php include ('view/modal-addsubject.php'); ?>
<?php include ('view/modal-editsubject.php'); ?>
<?php include ('view/modal-deletesubject.php'); ?>
<script>
  var AddSubjectModal = document.getElementById('AddSubjectModal')
  AddSubjectModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = AddSubjectModal.querySelector('.modal-title')
  var modalBodyInput = AddSubjectModal.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>
<script>
  var EditSubjectModal = document.getElementById('EditSubjectModal')
  EditSubjectModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = EditSubjectModal.querySelector('.modal-title')
  var modalBodyInput = EditSubjectModal.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>
<script>
  var DeleteSubjectModal = document.getElementById('DeleteSubjectModal')
  DeleteSubjectModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = DeleteSubjectModal.querySelector('.modal-title')
  var modalBodyInput = DeleteSubjectModal.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>
