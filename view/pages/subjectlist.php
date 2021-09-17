<?php
$_SESSION["title"] = "Subject";
include 'view/partials/_subheader/subheader-v1.php';
include ('model/subjectlist.php'); 
?>
<div class="text-dark-50 text-center mt-5"><h1>Subjects</h1></div>
<div class="card">
  <div class="card-body">
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
          $filter = ['School_id'=>$_SESSION["loggeduser_school_id"]];
          $query = new MongoDB\Driver\Query($filter);
          $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
        }
        else
        {
          $sort = ($_GET['level']);
          $filter = ['School_id'=>$_SESSION["loggeduser_school_id"],'Class_category'=>$sort];
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
            <button class="btn" data-bs-toggle="modal" data-bs-target="#edit_subject" data-bs-whatever="<?= $subject_id; ?>">
              <i class="flaticon2-edit icon-md text-hover-success"></i>
            </button>
            <button class="btn" data-bs-toggle="modal" data-bs-target="#delete_subject" data-bs-whatever="<?= $subject_id; ?>">
              <i class="flaticon2-trash icon-md text-hover-success"></i>
            </button>
          </td>
          </tr>
          <?php
        }
        ?>
        <tr class="bg-white">
          <td colspan="3">
            <button class="btn" data-bs-toggle="modal" data-bs-target="#add_subject">
            <i class="flaticon2-plus-1 icon-md text-hover-success"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<?php include ('view/pages/modal-subjectlist.php'); ?>

