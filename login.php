<?php
include('db_connect.php');
session_start(); 
$output = array('error' => 'true','message'=>'registered'); 
$form_data = json_decode(file_get_contents("php://input"));
if (empty($form_data->username) || empty($form_data->password)) 
{
  $output = array('error' => 'false','message'=>'Username or Password is invalid');
}
else
{
$username=trim($form_data->username);
$password=trim($form_data->password);
$query = mysqli_query($connect,"select * from profile where username = '$username' AND password='$password'");
$rows = mysqli_num_rows($query);
if ($rows == 1) 
{
  $_SESSION['user_name']=$username; 
} 
else 
{
  $output = array('error' => 'false','message'=>'Username or Password is invalid');
}
mysqli_close($connect); 
}
echo json_encode($output);
?>