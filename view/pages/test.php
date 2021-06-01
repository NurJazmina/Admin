<?php
          $filter = ['Class_id'=>$varclassid];
          $query = new MongoDB\Driver\Query($filter);
          $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.ClassroomSubjectRel',$query);
          foreach ($cursor as $document)
          {
            $Class_id = strval($document->Class_id);
            $Teacher_id = strval($document->Teacher_id);
            ?>
            <div class="form-group row">
              <label for="staticStaffNo" class="col-sm-2 col-form-label"><?php echo $SubjectName; ?></label>
              <div class="col-sm-10">
                <select class="form-select" id="sltteacherclass" name="txtclassname">
  
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="staticStaffNo" class="col-sm-2 col-form-label"><?php echo $ConsumerFName; ?></label>
              <div class="col-sm-10">
                <select class="form-select" id="sltteacherclass" name="txtclassname">
  
                </select>
              </div>
            </div>
            <?php
          }
          ?>