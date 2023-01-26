<?php
   $host = "localhost";
   $username  = "root";
   $passwd = "";
   $dbname = "handy_manong";

   //Creating a connection
   $con = mysqli_connect($host, $username, $passwd, $dbname);

   if($con){
   
   }else{
      print("Connection Failed ");
   }
?>