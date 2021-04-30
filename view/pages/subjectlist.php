<?php
$_SESSION["title"] = "Subject";
?>
<?php include 'view/partials/_subheader/subheader-v1.php'; ?>

<?php include ('model/subjectlist.php'); ?>
<div class="myDiv" style="color:#696969;text-align:center">
<br><br><br><h1>Subjects</h1>
</div>
<br>
<div class="table-responsive">
<table class="table table-bordered table-sm" style="background-color:#ffffff; text-align:center;">
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
</div>
<?php include ('view/pages/modal-subjectlist.php'); ?>

