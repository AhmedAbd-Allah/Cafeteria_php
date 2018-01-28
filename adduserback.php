<!DOCTYPE html>
<html>
<head>
	<title>
	</title>
</head>
<body>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'connection.php';
include 'user_class.php';

function check($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {
      $name = check($_POST["username"]);
      
      $email = check($_POST["email"]);
      $Room_no = check($_POST["Room_no"]);
      $Pass = check($_POST["password"]);
      $encrypted_pass = md5($Pass);

      $confpassword = check($_POST["confpassword"]);
      $encrypted_conf = md5($confpassword);

      $Ext = check($_POST["Ext"]); 

      $empty_cells = array();
      foreach ($_POST as $key => $value) 
        {
           if (empty($value)) 
              {
                array_push($empty_cells, $key);
              }
        }


if ($encrypted_conf==$encrypted_pass)
{
   $user = new user();
        $user->addUser($name,$email,$encrypted_pass,$Room_no,$Ext,'');
        header("Location: adduser.php");
}
  
  elseif ($encrypted_conf!=$encrypted_pass) 
  {
    $pass_error= "password doesn't match the confirmation";
    header("Location: adduser.php?sended=$pass_error");
  }





}



?>

</body>
</html>