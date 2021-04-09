<?php include ('model/schooledit.php'); ?>
<br><br>
<div class="myDiv" style="color:#404040;text-align:center">
  <br><h1 style="color:#404040;">About Us</h1>
</div>
<br>
<div class="table-responsive">
  <table class="table table-bordered table-sm">
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
</div>
<?php include ('view/modal-editschool.php'); ?>
