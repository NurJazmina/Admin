<?php
    //$document = array( 
	//"image_data" => new MongoDB\BSON\Binary(file_get_contents($path_to_image_file), 
    //MongoDB\BSON\Binary::TYPE_GENERIC) 
    //); 
    include ('model/upload.php');
    $filter = [NULL];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.testing',$query);
    foreach ($cursor as $document)
    {
      $testing_id = strval($document->_id);
      $Date = strval($document->Date);
      $Image = strval($document->Image);
      ?>
      <div class="card">
        <div class="card-header">
        <?php
        echo $testing_id."<br>";
        ?>
        </div>
        <div class="card-body">
        <?php
        echo $Date."<br>";
        echo $Image
        ?>
        </div>
      </div>
      <?php
    }
    ?>
    <form id="AddImage" name="AddImage" action="index.php?page=upload" method="post" enctype="multipart/form-data">
    <div id="AddDepartmentModal" tabindex="-1" aria-labelledby="AddDepartmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="AddDepartmentModalLabel">Add Image</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="form-group row">
                <label for="staticStaffNo" class="col-sm-2 col-form-label">File name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="staticStaffNo" name="txtimage" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticStaffNo" class="col-sm-2 col-form-label">Choose a file</label>
                <div class="col-sm-10">
                    <input type="file" name="file">
                    <button type="submit" class="btn btn-secondary" name="txtupload">Upload</button>
                   <!-- <input type="text" class="form-control" id="staticStaffNo" name="txtimage" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"> -->
                </div>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" name="AddImage">Save changes</button>
            </div>
        </div>
    </div>
    </div>
    </form>
    <?php
?>














