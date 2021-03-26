<?php  

  $varConsumerIDNo = $_GET['txtConsumerIDNo'];
  $varConsumerIDNoChild = $_GET['txtConsumerIDNoChild'];
    
  $filter = ['ConsumerIDNo'=>$varConsumerIDNoChild];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzBackEnd->executeQuery('GoNGetz.Consumer',$query);

  foreach ($cursor as $document) 
  {
    $_idchild = strval($document->_id);
    $ConsumerFNameChild = $document->ConsumerFName;
    $ConsumerLNameChild = $document->ConsumerLName;
    
    $filter0 = ['Consumer_id'=>$_idchild];
    $query0 = new MongoDB\Driver\Query($filter0);
    $cursor0 = $GoNGetzBackEnd->executeQuery('GoNGetzSmartSchool.Students',$query0);

    foreach ($cursor0 as $document0) 
    {
      $studentid = strval($document0->_id);
    }
  }  
  
  $filter1 = ['ConsumerIDNo'=>$varConsumerIDNo];
  $query1 = new MongoDB\Driver\Query($filter1);
  $cursor1 = $GoNGetzBackEnd->executeQuery('GoNGetz.Consumer',$query1);

  foreach ($cursor1 as $document1) 
  {
    $_idparent = strval($document1->_id);
    $ConsumerFName = $document1->ConsumerFName;
    $ConsumerLName = $document1->ConsumerLName;
    
    $filter2 = ['ConsumerID'=>$_idparent];
    $query2 = new MongoDB\Driver\Query($filter2);
    $cursor2 = $GoNGetzBackEnd->executeQuery('GoNGetzSmartSchool.Parents',$query2);

    foreach ($cursor2 as $document2) 
    {
      $parentid = strval($document2->_id);
    }
  }  
          
?>
<html>
  
<head>
 <style>
h2 {text-align: center;}
</style>
  
<style type="text/css">
   input {font-weight:bold;}
</style>
</head>
  
<body>
<br><br><br><br>
<h2>PLEASE CONFIRM BEFORE PROCEED</h2>
<form id="submiteditparent" name="submiteditparent" action="index.php?page=parentlist" method="post">
  <div class="modal-dialog modal-lg modal-dialog-centered">
  <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditParentModalLabel">Edit Parent</h5>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Parent Name</label>
            <div class="col-sm-10">
              <input   value="<?php echo  $ConsumerFName." ".$ConsumerLName; ?>" disabled>
              <input type="hidden" name="txtparentid" value="<?php echo $parentid; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Child Name</label>
            <div class="col-sm-10">
              <input  value="<?php echo $ConsumerFNameChild." ".$ConsumerLNameChild; ?>" disabled><br>
              <input type="hidden" name="txtstudentid" value="<?php echo $studentid; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="staticStaffNo" class="col-sm-2 col-form-label">Group</label>
            <div class="col-sm-10">
              <input   value="VIP" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label for="staticStaff" class="col-sm-2 col-form-label">Relation</label>
            <div class="col-sm-10">
              <select class="form-control" id="txtrelation" name="txtrelation" >
                <option value="FATHER">FATHER</option>
                <option value="MOTHER">MOTHER</option>
                <option value="GUARDIAN">GUARDIAN</option>
                <option value="RELATIVE">RELATVE</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button  onclick="index.php?page=parentlist" class="btn btn-secondary" >Close</button>
          <button type="submit" class="btn btn-secondary" name="submiteditparent">Confirm</button>
        </div>
      </div>
  </div>
</form> 
