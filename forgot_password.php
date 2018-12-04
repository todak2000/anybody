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

<body style="overflow-y: hidden;">
<?php
			
		?>
	<div class="contain">
        <div class="righta col-md-12 col-sm-12 col-xs-12">
            <div class="forgot">
            <img src="anybody_logo_blue.svg" align="center" width="150">
                    <p class="h1a" style="margin-bottom: 20px; font-size:22px;">Forgot Password?</p>
                   

                    <form class="form_login" style=" margin:auto;" method="post" action="">
                                  <div class="input-container">
                                    <i class="fa fa-envelope-o icon"></i>
                                    <input class="input-field" type="text" placeholder="Enter your Email" name="email">
                                  </div>
                                  <div class="input-container">
                                    <i class="fa fa-lock icon"></i>
                                    <input class="input-field" type="password" placeholder="Enter New Password" name="psw">
                                  </div>
                                
                                <button class="btn bota" name="reset" style="margin-top:20px;">Reset</button>
                    </form>
                    <!-- <a href="signin" class="btn botaa pull-left hidd" >Sign in</a> <a href="signup" class="btn botaa pull-right hidd" style="left:70%;">Sign up</a>  -->
                    <a href="signup" class="hidd pull-left hidden-md hidden-lg" id="leftie" style=" text-decoration: underline; color:#676767; margin-left:5px;">Sign Up</a>
                    <a href="signin" id="rightie" class=" pull-right hidd hidden-md hidden-lg">Sign in</a> 
            </div>                
        </div>
    </div>
    <?php
    require('auth/anybodyapp.php');
    session_start();
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['reset'])){
        
        $email = stripslashes($_REQUEST['email']); // removes backslashes
        $email = mysqli_real_escape_string($con,$email); //escapes special characters in a string
        $Npassword = stripslashes($_REQUEST['psw']);
        $Npassword = mysqli_real_escape_string($con, $Npassword);
        
    //Checking is user existing in the database or not
        //$query = "SELECT * FROM `users` WHERE email='$email' AND password='".md5($password)."'";
        
        $query = "SELECT * FROM `users` WHERE email='$email' ";

        $result = mysqli_query($con,$query) or die(mysqli_error());
        $rows = mysqli_num_rows($result);
    
        if($rows==1){
            $_SESSION['email'] = $email;
            $update= "UPDATE users SET password='$Npassword' where email='$email'";
            echo "<div align='center' class='form1' ><span style='color:#979b1b; font-size:20px;' class='closea1 btn  pull-right'>X</span><br><h3 style='color:#fff;'><i class='fa fa-check' style='color:green;margin-left:15%; font-size:100px;'></i><br>Password changed successfully.</h3><br/><a href='signin' class='btn botaa pull-right' style='background-color: #eae2e2cc;'>Sign in</a></div>";

                }else{
                    echo "<div align='center' class='formaa'><span style='color:#979b1b; font-size:20px;' class='closea btn  pull-right'>X</span><br><h3 style='color:#fff;'> <i class='fa fa-times' class='img' style='color:red; margin-left:15%; font-size:100px;'></i><br>Sorry, that email does not exist</h3><br/><a href='signup' class='btn botaa pull-right' style='background-color: #eae2e2cc;'>Sign up</a></div>";

                                }
    }else{
} ?>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script>
   $(document).ready(function(){
    $('.closea').click(function(){
      $('.formaa').hide();
    });
    $('.closea1').click(function(){
      $('.form1').hide();
    });

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

</body>

</html>