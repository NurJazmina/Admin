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
    <td><a href="index.php?page=departmentdetail&id=<?php echo $departmentid ; ?>" style="color:#076d79; text-decoration: none;"><?php echo $DepartmentName; ?></a></td>
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
