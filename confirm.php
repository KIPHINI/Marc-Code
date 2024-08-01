<?php


include("database.php");

$username = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn,$query);

if(mysqli_num_rows($result) == 1)
{
    header ('location: update.php');
}
else
{header ('location: login.php');}

?>
