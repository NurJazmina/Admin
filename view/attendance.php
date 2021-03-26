<!DOCTYPE html>
<html>
<head>
<title>Font Awesome Icons</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  

<style>
  table th {
   text-align: center; 
}


.table {
  text-align: center;
  width: 50%;
  max-width: 100%;
  margin: auto;
}


</style>
</head>
  
  <body>
  <?php
  $id = new \MongoDB\BSON\ObjectId(strval($_SESSION["loggeduser_id"]));
  $filter = ['_id'=>$id];
  $query = new MongoDB\Driver\Query($filter);
  $cursor = $GoNGetzBackEnd->executeQuery('GoNGetz.Consumer',$query);

  foreach ($cursor as $document)
  {
    $ConsumerFName = ($document->ConsumerFName);
    $ConsumerLName = ($document->ConsumerLName);
  
    
  ?>   
<div class="myDiv" style="color:#696969;text-align:center">
      <br><br><br><h1>Attendance Student</h1>
</div>
<br>
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
  </body>
</html>
<?php
  }
    ?>

  
  
