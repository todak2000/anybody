<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="css/signup.css">
	<link rel="icon" type="image/png" href="img/favicon.png" />
    <title>Anybody Signin</title>
    <style>
         @import url('https://fonts.googleapis.com/css?family=Open+Sans|Open+Sans+Condensed:700');
    </style>
   
    
</head>

<body style="">
<?php
			
		?>
	<div class="contain">
		<div class="lefta col-md-6 col-sm-12 col-xs-12" style="margin:auto;">
            <!-- <img src="img/logo.svg" width="900px" height="900px" class="back"> -->
            <div class="signa">
                <a href="index"><img src="img/anywhite.svg"></a>
                <p class="h1">Hello, Friend</p>
               <div style="width:270px; margin: auto"align="center"> <p class="p" >Enter your personal details and start your journey with us</p></div>
               <a href="signup"> <button class="btn bot">SIGN UP</button></a>
            </div>

        </div>
        <div class=" col-md-6 col-sm-12 col-xs-12 flex-container">
           
            <div class="signina">
            <img src="anybody_logo_blue.svg" align="center" width="150" class="hidden-md hidden-lg">
                    <p class="h1a" style="margin-bottom: 20px;">Hi, Sign in</p>
                    <div style="width: 100px; height:70px; margin:auto"><div class="span" style="float: left;"><i class="fa fa-facebook"></i></div><div class="span" style="float: right;"><i class="fa fa-google"></i></div></div>
                    <div style="width:270px; margin: auto; margin-bottom:20px;"align="center"> <p class="pa" >Or use your email for registration</p></div>

                    <form class="form_login" style=" margin:auto;" method="post" action="">
                           
                                
                                  <div class="input-container">
                                    <i class="fa fa-envelope-o icon"></i>
                                    <input class="input-field" type="text" placeholder="Email" name="email">
                                  </div>
                                  
                                  <div class="input-container">
                                    <i class="fa fa-lock icon"></i>
                                    <input class="input-field" type="password" placeholder="Password" name="psw">
                                  </div>
                                 
                                <button class="btn bota" name="login" style="margin-top:20px;">SIGN IN</button>
                    </form>
                    <a href="forgot_password" class="hidd pull-left" id="leftie" style=" text-decoration: underline; color:#676767; margin-left:5px;">Forgot your password?</a>
                    <a href="signup" id="rightie" class=" pull-right hidd" style="left:70%;color:#676767;text-decoration: underline; ">Sign up</a> 
            </div>                
        </div>
    </div>
    <?php 
require('auth/anybodyapp.php');
session_start();
// If form submitted, insert values into the database.
if (isset($_REQUEST['login'])){
    
    $email = stripslashes($_REQUEST['email']); // removes backslashes
    $email = mysqli_real_escape_string($con,$email); //escapes special characters in a string
    $password = stripslashes($_REQUEST['psw']);
    $password = mysqli_real_escape_string($con, $password);
    
//Checking is user existing in the database or not
    //$query = "SELECT * FROM `users` WHERE email='$email' AND password='".md5($password)."'";
    
    $query = "SELECT * FROM `users` WHERE email='$email' ";

    $result = mysqli_query($con,$query) or die(mysqli_error());
    $rows = mysqli_num_rows($result);
    // var_dump($rows);
    if($rows==1){
        $_SESSION['email'] = $email;
       // var_dump($rows);
         //echo "<div align='center' class='form' style='margin-top: 0;color:#ccc; width: 400px;position:fixed; top: 30%; left: 35%;'><h3 style='color:#ccc;'> <span style='font-size:80px; color:#FFC655'>&#9785;</span><br>Login SUccessfully.</h3><br/>Click here to <a style='color:#979b1b;' href='index'>Home</a></div>";
         header("Location: home");// Redirect user to index.php
        }else{
            //echo "<div align='center' class='forma'><h3 style='color:#ccc;'><i class='fa fa-times' class='img' style='color:red; font-size:100px;'></i><br>Username/password is incorrect.</h3><br/>Click here to <a style='color:#979b1b;' href='signin'>Login</a></div>";
            echo "<div align='center' class='formaa'><span style='color:#979b1b; font-size:20px;' class='closea btn  pull-right'>X</span><br><h3 style='color:#fff;'> <i class='fa fa-times' class='img' style='color:red; margin-left:15%; font-size:100px;'></i><br>Username/password is incorrect.</h3><br/><a href='signup' class='btn botaa pull-right' style='background-color: #eae2e2cc;'>Sign up</a></div>";

            }
}else{
} ?>
   
</body>
<script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/submit_login.js"></script>

    <script>
        $(document).ready(function(){
        $('.input-field').focus(function() {
            $('#leftie').hide();
            $('#rightie').hide();
    
            });

            $(".input-field").focusout(function() {
                $('#leftie').show();
                $('#rightie').show();
            });
        
        })
    </script>
</html>