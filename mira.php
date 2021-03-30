<div class="tab-content" id="v-pills-tabContent">
                          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="box">
                            <form name="AdddepartmentRemarkFormSubmit" action="model/adddepartmentremark.php" method="POST">
                              <div class="row">
                                <div class="col">
                                  <textarea class="form-control" name="txtdepartmentRemark" rows="3"></textarea>
                                  <div class="row">
                                    <div class="col text-right">
                                      <button type="submit" class="btn btn-primary" name="AdddepartmentRemarkFormSubmit">Add remark</button>
                                    </div>
                                  </div>
                                  </div>
                              </div>
                            </form>
                          </div>
                          <div class="box">
                            <strong></strong>
                            <br>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="active-tab" data-bs-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true">Active</a>
                              </li>
                              <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">Pending</a>
                              </li>
                              <li class="nav-item" role="presentation">
                                <a class="nav-link" id="completed-tab" data-bs-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">Completed</a>
                              </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                              <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                                <div class="table-responsive">
                                  <table class="table table-striped table-sm ">
                                    <thead>
                                      <tr>
                                        <th>Date</th>
                                        <th>Details</th>
                                        <th>Staff</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $filter = ['department_id'=>$_SESSION["departmentremarkid"], 'departmentRemarksStatus'=>'ACTIVE'];
                                      $option = ['sort' => ['_id' => -1],'limit'=>10];
                                      $query = new MongoDB\Driver\Query($filter,$option);
                                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query);
                                      foreach ($cursor as $document)
                                      {
                                        $remarkid = ($document->_id);
                                        $departmentremark = ($document->departmentRemarksDetails);
                                        $departmentremarkdate = (($document->departmentRemarksDate));
                                        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($departmentremarkdate));
                                        $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        $departmentremarkstaffid = ($document->departmentRemarksStaff_id);
                                        ?>
                                        <tr>
                                          <td><?php print_r($datetime->format('r'));?></td>
                                          <td><?php echo $departmentremark; ?></td>
                                          <td>
                                        <?php
                                        $varstaffid = new \MongoDB\BSON\ObjectId($departmentremarkstaffid);
                                        $filter1 = ['_id'=>$varstaffid];
                                        $query1 = new MongoDB\Driver\Query($filter1);
                                        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);
                                        foreach ($cursor1 as $document1)
                                        {
                                          $ConsumerFName = ($document1->ConsumerFName);
                                        }
                                        echo $ConsumerFName;
                                        ?>
                                        </td>
                                        <?php
                                        $varstaffid = strval($_SESSION["loggeduser_id"]);
                                        $filter = ['ConsumerID'=>$varstaffid];
                                        $query = new MongoDB\Driver\Query($filter);
                                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                                        foreach ($cursor as $document)
                                        {
                                          ?>
                                          <td>
                                            <button  type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#Updatedepartmentremark" data-bs-whatever="<?php echo $remarkid; ?>">
                                              <i class="fas fa-exchange-alt"></i>
                                            </button>
                                          </td>
                                          <?php
                                        }
                                        ?>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                                <div class="table-responsive">
                                  <table class="table table-striped table-sm ">
                                    <thead>
                                      <tr>
                                        <th>Date</th>
                                        <th>Details</th>
                                        <th>Staff</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $filter = ['department_id'=>$_SESSION["departmentid"], 'departmentRemarksStatus'=>'PENDING'];
                                      $option = ['sort' => ['_id' => -1],'limit'=>10];
                                      $query = new MongoDB\Driver\Query($filter,$option);
                                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query);
                                      foreach ($cursor as $document)
                                      {
                                        $remarkid = ($document->_id);
                                        $departmentremark = ($document->departmentRemarksDetails);
                                        $departmentremarkdate = (($document->departmentRemarksDate));
                                        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($departmentremarkdate));
                                        $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        $departmentremarkstaffid = ($document->departmentRemarksStaff_id);
                                        ?>
                                        <tr>
                                          <td><?php print_r($datetime->format('r'));?></td>
                                          <td><?php echo $departmentremark; ?></td>
                                          <td>
                                        <?php
                                        $varstaffid = new \MongoDB\BSON\ObjectId($departmentremarkstaffid);
                                        $filter1 = ['_id'=>$varstaffid];
                                        $query1 = new MongoDB\Driver\Query($filter1);
                                        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);
                                        foreach ($cursor1 as $document1)
                                        {
                                          $ConsumerFName = ($document1->ConsumerFName);
                                        }
                                        echo $ConsumerFName;
                                        ?>
                                        </td>
                                        <?php
                                        $varstaffid = strval($_SESSION["loggeduser_id"]);
                                        $filter = ['ConsumerID'=>$varstaffid];
                                        $query = new MongoDB\Driver\Query($filter);
                                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                                        foreach ($cursor as $document)
                                        {
                                          ?>
                                          <td>
                                            <button  type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#Updatedepartmentremark" data-bs-whatever="<?php echo $remarkid; ?>">
                                              <i class="fas fa-exchange-alt"></i>
                                            </button>
                                          </td>
                                          <?php
                                        }
                                        ?>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                      </tbody>
                                    </table>
                                </div>
                              </div>
                              <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                                <div class="table-responsive">
                                  <table class="table table-striped table-sm ">
                                    <thead>
                                      <tr>
                                        <th>Date</th>
                                        <th>Details</th>
                                        <th>Staff</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $filter = ['department_id'=>$_SESSION["departmentid"], 'departmentRemarksStatus'=>'COMPLETED'];
                                      $option = ['sort' => ['_id' => -1],'limit'=>10];
                                      $query = new MongoDB\Driver\Query($filter,$option);
                                      $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.DepartmentRemarks',$query);
                                      foreach ($cursor as $document)
                                      {
                                        $remarkid = ($document->_id);
                                        $departmentremark = ($document->departmentRemarksDetails);
                                        $departmentremarkdate = (($document->departmentRemarksDate));
                                        $utcdatetime = new MongoDB\BSON\UTCDateTime(strval($departmentremarkdate));
                                        $datetime = $utcdatetime->toDateTime()->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                                        $departmentremarkstaffid = ($document->departmentRemarksStaff_id);
                                        ?>
                                        <tr>
                                          <td><?php print_r($datetime->format('r'));?></td>
                                          <td><?php echo $departmentremark; ?></td>
                                          <td>
                                        <?php
                                        $varstaffid = new \MongoDB\BSON\ObjectId($departmentremarkstaffid);
                                        $filter1 = ['_id'=>$varstaffid];
                                        $query1 = new MongoDB\Driver\Query($filter1);
                                        $cursor1 = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query1);
                                        foreach ($cursor1 as $document1)
                                        {
                                          $ConsumerFName = ($document1->ConsumerFName);
                                        }
                                        echo $ConsumerFName;
                                        ?>
                                        </td>
                                        <?php
                                        $varstaffid = strval($_SESSION["loggeduser_id"]);
                                        $filter = ['ConsumerID'=>$varstaffid];
                                        $query = new MongoDB\Driver\Query($filter);
                                        $cursor = $GoNGetzDatabase->executeQuery('GoNGetzSmartSchool.Staff',$query);
                                        foreach ($cursor as $document)
                                        {
                                          ?>
                                          <td>
                                            <button  type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#Updatedepartmentremark" data-bs-whatever="<?php echo $remarkid; ?>">
                                              <i class="fas fa-exchange-alt"></i>
                                            </button>
                                          </td>
                                          <?php
                                        }
                                        ?>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                      </tbody>
                                    </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>