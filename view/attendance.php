
<?php
$id = new \MongoDB\BSON\ObjectId(strval($_SESSION["loggeduser_id"]));
$filter = ['_id'=>$id];
$query = new MongoDB\Driver\Query($filter);
$cursor = $GoNGetzDatabase->executeQuery('GoNGetz.Consumer',$query);

foreach ($cursor as $document)
{
$ConsumerFName = ($document->ConsumerFName);
$ConsumerLName = ($document->ConsumerLName);
?>   
<div class="myDiv" style="color:#696969;text-align:center"><br><br><br><h1>Attendance Student</h1></div><br>
<table class="table table-bordered">
  <thead class="table-light">
  </thead>
  <tbody>
    <tr>
      <th scope="row" class="table-secondary">Name</th>
      <td class="table-secondary"><?php echo $ConsumerFName; echo " "; echo $ConsumerLName;?> </td>
    </tr>
    <tr>
    <th scope="row">Date</th>
    <td><?php ?></td>
    </tr>
  </tbody>
</table>
<?php
}
?>

  
  
