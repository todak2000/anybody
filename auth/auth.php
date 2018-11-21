
<?php
session_start();
if(!isset($_SESSION["email"])){
header("Location: signup.php");
exit(); }

if(isset($_SESSION['email']))
    {
        $email=$_SESSION['email'] ;
    }
?>
