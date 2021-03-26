<?php
$filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'StaffLevel'=>'1'];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
$totalstaff = 0;

foreach ($cursor as $document)
{
  $totalstaff = $totalstaff + 1;
}
$_SESSION["totalstaff"] = $totalstaff;
?>

<?php
$filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'StaffLevel'=>'0'];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
$totalteacher= 0;

foreach ($cursor as $document)
{
  $totalteacher= $totalteacher + 1;
}
$_SESSION["totalteacher"] = $totalteacher;
?>

<?php
$filter = ['Schools_id' => $_SESSION["loggeduser_schoolID"]];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Students',$query);
$totalstudent = 0;

foreach ($cursor as $document)
{
 $varStudentsSchoolId = strval($document->Schools_id);
 $totalstudent = $totalstudent+ 1;
}
$_SESSION["totalstudent"] = $totalstudent;
?>

<?php
$filter = ['Schools_id'=>$_SESSION["loggeduser_schoolID"]];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ParentStudentRel',$query);
$totalparent = 0;

foreach ($cursor as $document)
{
 $ParentID = array($document->ParentID);

}
$_SESSION["totalparent"] = $totalparent;
?>

<?php
$filter = ['_id'=>new \MongoDB\BSON\ObjectId($_SESSION["loggeduser_schoolID"])];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Schools',$query);

foreach ($cursor as $document)
{
 $SchoolsPhoneNo =($document->SchoolsPhoneNo);
}
?>
<br><br>
<div class="myDiv" style="color:#404040;text-align:center">
  <br><h1 style="color:#404040;">About Us</h1>
</div>
<br>
  <table class="table table-bordered">
    <thead class="table-light">
    </thead>
    <tbody>
      <tr>
        <th scope="row" class="table-secondary">School Name</th>
        <td class="table-secondary"><?php echo $_SESSION["loggeduser_schoolName"] ?> </td>
      </tr>
      <tr>
      <th scope="row">School Phone</th>
      <td><?php print_r($SchoolsPhoneNo); ?></td>
      </tr>
      <tr>
        <th scope="row">School address</th>
        <td><?php echo $_SESSION["loggeduser_schoolsAddress"] ?></td>
      </tr>
      <tr>
        <th scope="row">School Email</th>
      <td><?php echo $_SESSION["loggeduser_SchoolsEmail"] ?></td>
      </tr>
      <tr>
        <th scope="row">Update</th>
        <td>
          <button type="button"  class="btn btn-success" data-bs-toggle="modal" data-bs-target="#EditSchoolModal" data-bs-whatever="<?php echo $varStudentsSchoolId; ?>">
           <i class="fa fa-edit" style="font-size:20px"></i>
          </button>
        </td>
      </tr>
    </tbody>
  </table>
<?php include ('view/modal-editschool.php'); ?>
<script>
  var EditSchoolModal = document.getElementById('EditSchoolModal')
  EditSchoolModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = EditSchoolModal.querySelector('.modal-title')
  var modalBodyInput = EditSchoolModal.querySelector('.modal-body input')
  modalBodyInput.value = recipient
  })
</script>
