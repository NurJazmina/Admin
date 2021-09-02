<?php
$_SESSION["title"] = "Department";
include 'view/partials/_subheader/subheader-v1.php'; 
include ('model/departmentlist.php'); 
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>
$(document).ready(function() {

    var calc = $("#calc").val();
    var q = [];
    for (let count = 1; count <= calc; count++) {

      q[count] = $("#DepartmentName2").val();
      $("#submit").click(function() {
        $.post("model/submit.php", {
          DepartmentName: q[count]
        },
        function(data, status){
            $("#test1").html(data);
            $("#test2").html(data);
        },
        );
      });
    }
});
</script>
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
                  <input type="hidden" id="DepartmentName<?= $calc; ?>" value="<?= $DepartmentName; ?>">
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
            <input type="hidden" id="calc" value="<?= $calc; ?>">
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
