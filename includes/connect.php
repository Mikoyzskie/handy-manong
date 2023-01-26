<?php
   $host = "localhost";
   $username  = "root";
   $passwd = "";
   $dbname = "handy_manong";

   //Creating a connection
   $conn = mysqli_connect($host, $username, $passwd, $dbname);

   if($conn){
   
   }else{
      print("Connection Failed ");
   }
?>