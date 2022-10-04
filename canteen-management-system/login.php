<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$uemail = $_POST['uemail'];
$upassword = $_POST['upassword'];

if (!empty($uemail) || !empty($upassword) )
{

  $host = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "user";

  $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

  if (mysqli_connect_error())
  {
  die('Connect Error ('. mysqli_connect_errno() .') '. mysqli_connect_error());
  }
  else
  {
    $query = "SELECT * FROM login WHERE uemail = '". mysqli_real_escape_string($conn,$uemail) ."' AND upassword = '". mysqli_real_escape_string($conn,$upassword) ."'" ;
    $result = mysqli_query($conn,$query);

    if (mysqli_num_rows($result) == 1) 
    {
        echo "Login Successful"; //Pass, do something
        header("Location:menu1.html");
    } 
    else 
    {
        echo "Please enter valid entries"; //Fail
    }
  }
} 
else 
{
 echo "All field are required";
 die();
}