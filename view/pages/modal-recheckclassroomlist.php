<?php  
if (isset($_POST['Addclass'])) 
{
  $school_id = $_SESSION["loggeduser_schoolID"];
  $consumer_id = $_POST['consumer_id'];
  $class_category = $_POST['class_category'];
    
  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($consumer_id)];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
  foreach ($cursor as $document) 
  {
    $StaffLevel = 1;
    $count = 0;
    $end = 1;

    $consumer_id = strval($document->_id);
    $ConsumerGroup_id = $document->ConsumerGroup_id;

    $filter = ['SchoolID'=>$school_id, 'ConsumerID'=> $consumer_id, 'StaffLevel'=>'0'];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
    foreach ($cursor as $document2) 
    {
      $count++;
      $StaffLevel = strval($document2->StaffLevel);
      $ConsumerFName = $document->ConsumerFName;
      $ConsumerIDNo = $document->ConsumerIDNo;
      ?>
      <div class="text-dark-50 text-center m-10">
        <h1>PLEASE CONFIRM BEFORE PROCEED</h1>
      </div>
      <form id="submitaddclass" name="submitaddclass" action="index.php?page=classroomlist" method="post">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Class</h5>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Teacher Name</label>
                  <div class="col-sm-10">
                  <input class="form-control" value="<?=  $ConsumerFName; ?>" disabled>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Teacher ID</label>
                  <div class="col-sm-10">
                  <input class="form-control" value="<?= $ConsumerIDNo; ?>" disabled>
                  </div>
              </div> 
              <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Class Category</label>
                  <div class="col-sm-10">
                  <input class="form-control" value="<?= $class_category; ?>" disabled>
                  <input type="hidden" name="class_category" value="<?=  $class_category; ?>">
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Class Name</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control" name="class_name" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="consumer_id" value="<?= $consumer_id; ?>">
              <button onclick="index.php?page=classroomlist" class="btn btn-light btn-sm">Close</button>
              <button type="submit" class="btn btn-success btn-sm" name="submitaddclass">Confirm</button>
            </div>
          </div>
        </div>
      </form>
      <?php
    if ($count == $end) break;    
    }
    if ($ConsumerGroup_id !== '601b4cfd97728c027c01f187' || $StaffLevel == '1' )
    {
      ?>
      <div class="text-dark-50 text-center m-10" role="alert">
        <h1>AUTHORIZED PERSONNEL ONLY</h1>
      </div>
      <form id="submitstaff" name="submitstaff" action="index.php?page=classroomlist" method="post">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Teacher</h5>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">MyKad</label>
                <div class="col-sm-10">
                <input   value="<?=  $ConsumerIDNo; ?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                <input value="UNAUTHORIZED" disabled>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button  onclick="index.php?page=classroomlist" class="btn btn-light btn-sm">Close</button>
            </div>
          </div>
        </div>
      </form>
      <?php
    }
  }
}


if (isset($_POST['Editclass']))
{
  $class_id = $_POST['class_id'];
  $number = $_POST['number'];
  $class_category = $_POST['class_category'];

  $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'ClassID'=>$class_id];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
  foreach ($cursor as $document)
  {
    $ConsumerID = $document->ConsumerID;

    $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
    foreach ($cursor as $document1)
    {
      $ConsumerFName = $document1->ConsumerFName;
    }
  }
  ?>
  <div class="text-dark-50 text-center m-10">
    <h1>PLEASE CONFIRM BEFORE PROCEED</h1>
  </div>
  <form id="submiteditclass" name="submiteditclass" action="index.php?page=classroomlist" method="post">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Class</h5>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Teacher Name</label>
            <div class="col-sm-10">
              <input class="form-control" value="<?= $ConsumerFName; ?>" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Class Category</label>
            <div class="col-sm-10">
              <input class="form-control" value="<?= $class_category; ?>" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Class Name</label>
            <div class="col-sm-10">
              <select class="form-control" name="class_name">
              <?php
              $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'ClassCategory'=>$class_category];
              $query = new MongoDB\Driver\Query($filter);
              $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Classrooms',$query);
              foreach ($cursor as $document)
              {
                $class_id = strval($document->_id);
                $ClassName = $document->ClassName;
                ?>
                <option value="<?=  $class_id; ?>"><?= $ClassName; ?></option>
                <?php
              }
              ?>
              </select>
            </div>
          </div>    
          <?php
          for ($x = 1; $x <= $number; $x++)
          {
            ?>  
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Teacher</label>
              <div class="col-sm-10">
                <select class="form-control" name="teacher<?= $x; ?>">
                <?php
                $filter = ['SchoolID'=>$_SESSION["loggeduser_schoolID"], 'StaffLevel'=>'0'];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                foreach ($cursor as $document1)
                {
                  $staff_id = strval($document1->_id); 
                  $ConsumerID = $document1->ConsumerID; 

                  $filter = ['_id'=>new \MongoDB\BSON\ObjectId($ConsumerID)];
                  $query = new MongoDB\Driver\Query($filter);   
                  $cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);
                  foreach ($cursor as $document2)
                  {
                    $ConsumerFName = $document2->ConsumerFName;
                    $ConsumerLName = $document2->ConsumerLName;
                    ?>
                    <option value="<?= $staff_id; ?>"><?php echo $ConsumerFName." ".$ConsumerLName; ?></option>
                    <?php
                  }
                }
                ?>
                </select>
              </div>
              <label class="col-sm-2 col-form-label">subject</label>
              <div class="col-sm-10">
                <select class="form-control" name="subject<?= $x; ?>">
                <?php
                $filter = ['School_id'=>$_SESSION["loggeduser_schoolID"], 'Class_category'=>$class_category];
                $query = new MongoDB\Driver\Query($filter);
                $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.SchoolsSubject',$query);
                foreach ($cursor as $document)
                {
                  $subject_id = strval($document->_id);
                  $SubjectName = $document->SubjectName;
                  ?>
                  <option value="<?= $subject_id; ?>"><?= $SubjectName; ?></option>
                  <?php
                }
                ?>
                </select>
              </div>
            </div>
            <?php
          }
          ?>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="number" value="<?= $number; ?>">
          <input type="hidden" name="class_category" value="<?= $class_category; ?>">
          <input type="hidden" name="class_id" value="<?= $class_id; ?>">
          <button onclick="index.php?page=classroomlist" class="btn btn-light btn-sm">Close</button>
          <button type="submit" class="btn btn-success btn-sm" name="submiteditclass">Confirm</button>
        </div>
      </div>
    </div>
  </form>
  <?php
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    var max_fields = 15;
    var wrapper = $(".container1");
    var add_button = $(".add_form_field");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append('<div class="form-group row"><label class="col-sm-2 col-form-label">Teacher</label><div class="col-sm-10"><input type="text" class="form-control" name="teacher[]"></div><label class="col-sm-2 col-form-label">subject</label><div class="col-sm-10"><input type="text" class="form-control" name="subject[]"></div><a href="#" class="delete"> Delete</a></div>'); //add input box
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});
</script>