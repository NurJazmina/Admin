<?php
include ('model/testing.php');


$filter = ['school_id'=>'abc'];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetz.testing',$query);

foreach ($cursor as $document)
{
    $varid = $document->_id;
    $varschool_id = $document->school_id;
    $vartotalparent = $document->totalparent;
    $vartotalstudent = $document->totalstudent;
    $vartotalstaff = $document->totalstaff;

}
?>
<br><br>
<div class="row">
    <div class="col">
        <div class="card-header" style="text-align:center;">
        
        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#addparent" data-bs-whatever="<?php echo $varid; ?>">
        <i class="fas fa-plus"></i>Add parent
        </button>

        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#addstudent" data-bs-whatever="<?php echo $varid; ?>">
        <i class="fas fa-plus"></i>Add student
        </button>

        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#addstaff" data-bs-whatever="<?php echo $varid; ?>">
        <i class="fas fa-plus"></i>Add staff
        </button>

        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col">
        <div class="card-header">
            School id : <?php echo $varschool_id; ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
    <?php
        for ($i=0; $i<$vartotalstaff; $i++)
        {
            $varstaff_id = $document->staff[$i]->consumer_id;
            $varstaff_name = $document->staff[$i]->consumerfname;
            //echo $varstudent_id;
            ?>
                <div class="card-header">
                    staff <?php echo $i; ?>
                    <br>
                    consumer id : <?php echo $varstaff_id; ?>
                    <br>
                    consumer name : <?php echo $varstaff_name; ?>
                    <br><br>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editstaff" data-bs-whatever="<?php echo $i; ?>">
                        <i class="fa fa-edit"></i> Edit staff
                    </button>
                </div>
            <?php
        }
    ?>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card-header">
            Total Staff : <?php echo $vartotalstaff; ?>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="col">
    <?php
        for ($i=0; $i<$vartotalparent; $i++)
        {
            $varparent_id = $document->parent[$i]->consumer_id;
            $varparent_name = $document->parent[$i]->consumerfname;
            //echo $varstudent_id;
            ?>
                <div class="card-header">
                    Parent <?php echo $i; ?>
                    <br>
                    consumer id : <?php echo $varparent_id; ?>
                    <br>
                    consumer name : <?php echo $varparent_name; ?>
                    <br><br>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editparent" data-bs-whatever="<?php echo $i; ?>">
                        <i class="fa fa-edit"></i> Edit parent
                    </button>
                </div>
            <?php
        }
    ?>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card-header">
            Total Parent : <?php echo $vartotalparent; ?>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col">
    <?php
        for ($i=0; $i<$vartotalstudent; $i++)
        {
            $varstudent_id = $document->student[$i]->consumer_id;
            $varstudent_name = $document->student[$i]->consumerfname;
            //echo $varstudent_id;
            ?>
                <div class="card-header">
                    student <?php echo $i; ?>
                    <br>
                    consumer id : <?php echo $varstudent_id; ?>
                    <br>
                    consumer name : <?php echo $varstudent_name; ?>
                    <br><br>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editstudent" data-bs-whatever="<?php echo $varid; ?>">
                        <i class="fa fa-edit"></i> Edit student
                    </button>
                </div>
            <?php
        }
    ?>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card-header">
            Total Student : <?php echo $vartotalstudent; ?>
        </div>
    </div>
</div>
<br>

<?php include ('view/pages/modal-testing.php'); ?>

<script>
    var addparent = document.getElementById('addparent')
    addparent.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalTitle = addparent.querySelector('.modal-title')
    var modalBodyInput = addparent.querySelector('.modal-body input')
    modalBodyInput.value = recipient
    })

    var addstudent = document.getElementById('addstudent')
    addstudent.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalTitle = addstudent.querySelector('.modal-title')
    var modalBodyInput = addstudent.querySelector('.modal-body input')
    modalBodyInput.value = recipient
    })

    var addstaff= document.getElementById('addstaff')
    addstaff.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalTitle = addstaff.querySelector('.modal-title')
    var modalBodyInput = addstaff.querySelector('.modal-body input')
    modalBodyInput.value = recipient
    })

    var editparent = document.getElementById('editparent')
    editparent.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalTitle = editparent.querySelector('.modal-title')
    var modalBodyInput = editparent.querySelector('.modal-body input')
    modalBodyInput.value = recipient
    })

    var editstudent = document.getElementById('editstudent')
    editstudent.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalTitle = editstudent.querySelector('.modal-title')
    var modalBodyInput = editstudent.querySelector('.modal-body input')
    modalBodyInput.value = recipient
    })

    var editstaff = document.getElementById('editstaff')
    editstaff.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalTitle = editstaff.querySelector('.modal-title')
    var modalBodyInput = editstaff.querySelector('.modal-body input')
    modalBodyInput.value = recipient
    })
</script>