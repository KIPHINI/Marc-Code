
<?php
     $servername="localhost";
         $username="root";
         $password="";
         $dbname="phpmyadmin";
         $conn= new mysqli($servername,$username,$password,$dbname);
   if($conn->connect_error==false)
{
     echo "connected succesfully";
}
   else {
      echo "something went wrong";
}
 ?>
 