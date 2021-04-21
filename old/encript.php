<?php
/**
 * In this case, we want to increase the default cost for BCRYPT to 12.
 * Note that we also switched to BCRYPT, which will always be 60 characters.
 */
$options = [
    'cost' => 4,
];
$password_hash = password_hash("zaq12wsx", PASSWORD_DEFAULT, $options);
echo "password: " . $password_hash . "<br>";
if (password_verify("zaq12wsx", $password_hash)) 
{
  echo "Password is valid";
} 
else 
{
  echo "Password is invalid";
}
?>