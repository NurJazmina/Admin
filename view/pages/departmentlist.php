<?php
$_SESSION["title"] = "Department";
include 'view/partials/_subheader/subheader-v1.php'; 
include ('model/departmentlist.php'); 
?>
<div class="text-dark-50 text-center m-5">
  <h1>Departments</h1>
</div>
<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <table class="table table-bordered table-sm text-center">
          <tbody>
            <tr class="bg-success text-white">
              <td>List</td>
              <td>Department</td>
              <td>Update</td>
            </tr>
            <?php
            $calc = 0;
            $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"]];
            $query = new MongoDB\Driver\Query($filter);
            $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsDepartment',$query);
            foreach ($cursor as $document)
            {
              $calc = $calc + 1;
              $Department_id = strval($document->_id);
              $DepartmentName = $document->DepartmentName;
              ?>
              <tr class="bg-white">
                <td><?= $calc; ?></td>
                <td><a href="index.php?page=departmentdetail&id=<?= $Department_id; ?>"><?= $DepartmentName; ?></a></td>
                <td>
                  <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#edit_department" data-bs-whatever="<?= $Department_id; ?>">
                    <i class="flaticon2-edit icon-md text-hover-success"></i>
                  </button>
                  <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete_department" data-bs-whatever="<?= $Department_id; ?>">
                    <i class="flaticon2-trash icon-md text-hover-success"></i>
                  </button>
                </td>
              </tr>
              <?php
            }
            ?>
            <tr class="bg-white">
              <td colspan="3">
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#add_department">
                <i class="flaticon2-plus-1 icon-md text-hover-success"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</div>
<?php include ('view/pages/modal-departmentlist.php'); ?>