<?php
$_SESSION["title"] = "Department";
include 'view/partials/_subheader/subheader-v1.php'; 
include ('model/departmentlist.php'); 

if (isset($_GET['ERROR']) && !empty($_GET['ERROR']))
{
    ?>
    <!--begin::Alert Password Not Matching-->
    <div class="alert alert-custom alert-light-danger fade show mb-10" role="alert">
        <div class="alert-icon">
            <span class="svg-icon svg-icon-3x svg-icon-danger">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Info-circle.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                        <rect fill="#000000" x="11" y="10" width="2" height="7" rx="1" />
                        <rect fill="#000000" x="11" y="7" width="2" height="2" rx="1" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
        </div>
        <div class="alert-text font-weight-bold">The password confirmation does not match!</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    <i class="ki ki-close"></i>
                </span>
            </button>
        </div>
    </div>
    <!--end::Alert Password Not Matching-->
    <?php  
}
?>
<div class="text-dark-50 text-center">
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
            $filter = ['School_id'=>$_SESSION["loggeduser_school_id"]];
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
                  <button id="submit" type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete_department" data-bs-whatever="<?= $Department_id; ?>">
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
