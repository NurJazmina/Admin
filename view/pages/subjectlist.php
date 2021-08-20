<?php
$_SESSION["title"] = "Subject";
include 'view/partials/_subheader/subheader-v1.php';
include ('model/subjectlist.php'); 
?>
<h1 class="myDiv" style="color:#696969;text-align:center">Subjects</h1>
<br>
<div class="table-responsive">
<table class="table table-bordered table-sm" style="background-color:#ffffff; text-align:center;">
  <thead class="table-light">
    <!-- sorting -->
    <button class="btn btn-success font-weight-bolder btn-sm" type="button" data-bs-toggle="dropdown">Sort by <i class="fas fa-sort"></i></button>
    <ul class="dropdown-menu">
      <li class="dropdown-item"><a href="index.php?page=subjectlist" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">All</a></li>
      <li class="dropdown-item"><a href="index.php?page=subjectlist&level=<?php echo "1"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 1</a></li>
      <li class="dropdown-item"><a href="index.php?page=subjectlist&level=<?php echo "2"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 2</a></li>
      <li class="dropdown-item"><a href="index.php?page=subjectlist&level=<?php echo "3"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 3</a></li>
      <li class="dropdown-item"><a href="index.php?page=subjectlist&level=<?php echo "4"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 4</a></li>
      <li class="dropdown-item"><a href="index.php?page=subjectlist&level=<?php echo "5"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 5</a></li>
      <li class="dropdown-item"><a href="index.php?page=subjectlist&level=<?php echo "6"; ?>" tabindex="-1" data-type="alpha" style="color:#076d79; text-decoration: none;">category 6</a></li>
    </ul>
  </thead>
  <tbody>
    <tr>
      <th scope="row" class="table-secondary">List</th>
      <td class="table-secondary">Subject</td>
      <td class="table-secondary">Update</td>
    </tr>
    <?php
    if (!isset($_GET['level']) && empty($_GET['level']))
    {
      $calc = 0;
      $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"]];
      $query = new MongoDB\Driver\Query($filter);
      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
    }
    else
    {
      $calc = 0;
      $sort = ($_GET['level']);
      $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"],'Class_category'=>$sort];
      $query = new MongoDB\Driver\Query($filter);
      $cursor =$GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
    }
      foreach ($cursor as $document)
      {
        $calc = $calc + 1;
        $subjectid = strval($document->_id);
        $SubjectName = strval($document->SubjectName);
        ?>
        <tr>
        <th scope="row"><?php echo $calc; ?></th>
        <td><a href="index.php?page=subjectdetail&id=<?php echo $subjectid ; ?>" style="color:#076d79; text-decoration: none;"><?php echo $SubjectName; ?></a></td>
        <td>
          <button style="font-size:10px" type="button" class="btn btn-light btn-hover-success" data-bs-toggle="modal" data-bs-target="#EditSubjectModal" data-bs-whatever="<?php echo $subjectid; ?>">
            <i class="fa fa-edit" style="font-size:15px"></i>
          </button>
          <button style="font-size:10px" type="button" class="btn btn-light btn-hover-success" data-bs-toggle="modal" data-bs-target="#DeleteSubjectModal" data-bs-whatever="<?php echo $subjectid; ?>">
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
        <button style="font-size:10px" type="button"  class="btn btn-light btn-hover-success" data-bs-toggle="modal" data-bs-target="#AddSubjectModal">
         <i class="fas fa-plus" style="font-size:15px"></i>
        </button>
      </td>
    </tr>
  </tbody>
</table>
</div>
<?php include ('view/pages/modal-subjectlist.php'); ?>

