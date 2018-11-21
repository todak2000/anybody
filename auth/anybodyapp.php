<?php


$con = mysqli_connect("us-cdbr-iron-east-01.cleardb.net","b5fa4cd1369827","2e0336cb","heroku_c04bc5b15b58b00");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>