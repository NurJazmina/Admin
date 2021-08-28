<?php
$_SESSION["title"] = "Subject";
include 'view/partials/_subheader/subheader-v1.php';
include ('model/subjectlist.php'); 
?>
<div class="text-dark-50 text-center mt-5">
  <h1>Subjects</h1>
</div>
<div class="row">
  <div class="col-2"></div>
  <div class="col-8">
    <div class="text-right">
      <button class="btn btn-success font-weight-bolder btn-sm" data-bs-toggle="dropdown">Sort by &nbsp;&nbsp;<i class="fas fa-sort"></i></button>
      <ul class="dropdown-menu">
        <li class="dropdown-item"><a href="index.php?page=subjectlist">All</a></li>
        <li class="dropdown-item"><a href="index.php?page=subjectlist&level=1">category 1</a></li>
        <li class="dropdown-item"><a href="index.php?page=subjectlist&level=2">category 2</a></li>
        <li class="dropdown-item"><a href="index.php?page=subjectlist&level=3">category 3</a></li>
        <li class="dropdown-item"><a href="index.php?page=subjectlist&level=4">category 4</a></li>
        <li class="dropdown-item"><a href="index.php?page=subjectlist&level=5">category 5</a></li>
        <li class="dropdown-item"><a href="index.php?page=subjectlist&level=6">category 6</a></li>
      </ul>
    </div>
    <table class="table table-bordered table-sm text-center bg-white">
      <tbody>
        <tr class="bg-success text-white">
          <td>List</td>
          <td>Subject</td>
          <td>Update</td>
        </tr>
        <?php
        $calc = 0;
        if (!isset($_GET['level']) && empty($_GET['level']))
        {
          $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"]];
          $query = new MongoDB\Driver\Query($filter);
          $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
        }
        else
        {
          $sort = ($_GET['level']);
          $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Class_category'=>$sort];
          $query = new MongoDB\Driver\Query($filter);
          $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
        }

        foreach ($cursor as $document)
        {
          $calc = $calc + 1;
          $subject_id = strval($document->_id);
          $Subject_name = $document->SubjectName;
          ?>
          <tr class="bg-white">
          <td><?= $calc; ?></td>
          <td><a href="index.php?page=subjectdetail&id=<?= $subject_id; ?>"><?= $Subject_name; ?></a></td>
          <td>
            <button class="btn btn-hover-success btn-sm" data-bs-toggle="modal" data-bs-target="#edit_subject" data-bs-whatever="<?= $subject_id; ?>">
              <i class="fa fa-edit icon-md"></i>
            </button>
            <button class="btn btn-hover-success btn-sm" data-bs-toggle="modal" data-bs-target="#delete_subject" data-bs-whatever="<?= $subject_id; ?>">
              <i class="fas fa-trash icon-md"></i>
            </button>
          </td>
          </tr>
          <?php
        }
        ?>
        <tr class="bg-white">
          <td>Add</td>
          <td colspan="2">
            <button class="btn btn-hover-success btn-sm" data-bs-toggle="modal" data-bs-target="#add_subject">
            <i class="fas fa-plus icon-md"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-2"></div>
</div>
<?php include ('view/pages/modal-subjectlist.php'); ?>

