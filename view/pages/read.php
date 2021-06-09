<?php
if (isset($_POST['myForm']))
{
  $first_name = strval($_SESSION["first_name"]);
  $last_name = $_POST['last_name'];

  echo "test";
  echo $first_name." ".$last_name;
}
echo "outside form";
?>