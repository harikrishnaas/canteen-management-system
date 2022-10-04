<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];

if (!empty($name) || !empty($email) || !empty($mobile)  || !empty($password) || !empty($cpassword) )
{

  $host = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "user";

  $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

  if (mysqli_connect_error())
  {
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
  }
  else
  {
    $SELECT = "SELECT email From register Where email = ? Limit 1";
    $INSERT = "INSERT INTO register(name ,email ,mobile ,password, cpassword )values(?,?,?,?,?)";
    $INSERT1 = "INSERT INTO login (uemail, upassword) values (?,?)";

    $stmt = $conn->prepare($SELECT);
     $stmt->bind_param('s', $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;


    if ($rnum==0) 
    {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param('sssss', $name, $email, $mobile, $password, $cpassword);
      $stmt->execute();
      echo "Registered successfully!";
      $stmt->close();
      $stmt = $conn->prepare($INSERT1);
      $stmt->bind_param('ss', $email, $password);
      $stmt->execute();
    }
    else 
    {
      echo "Someone already register using this email";
    }
     $stmt->close();
     $conn->close();
  }
} 
else 
{
 echo "All field are required";
 die();
}

?>