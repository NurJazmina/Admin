<?php
$target_dir = "/var/www/html/smartschool.gongetz.com/image/upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {  
    echo "File uploaded successfully!";  
} else{  
    echo "Sorry, file not uploaded, please try again!";  
}  

$bulk = new MongoBinData(['ordered' => TRUE]);
$bulk->insert(["photo" => file_get_contents($target_file)]);
$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
try
{
  $result =$GoNGetzDatabase->executeBulkWrite('GoNGetzSmartSchool.User_Image', $bulk, $writeConcern);
}
catch (MongoDB\Driver\Exception\BulkWriteException $e)
{
  $result = $e->getWriteResult();
  // Check if the write concern could not be fulfilled
  if ($writeConcernError = $result->getWriteConcernError())
  {
      printf("%s (%d): %s\n",
          $writeConcernError->getMessage(),
          $writeConcernError->getCode(),
          var_export($writeConcernError->getInfo(), true)
      );
  }
  // Check if any write operations did not complete at all
  foreach ($result->getWriteErrors() as $writeError)
  {
      printf("Operation#%d: %s (%d)\n",
          $writeError->getIndex(),
          $writeError->getMessage(),
          $writeError->getCode()
      );
  }
}
catch (MongoDB\Driver\Exception\Exception $e)
{
  printf("Other error: %s\n", $e->getMessage());
  exit;
}
printf("Matched: %d\n", $result->getMatchedCount());
printf("Updated  %d document(s)\n", $result->getModifiedCount());

?>