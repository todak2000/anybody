<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="css/signup.css">
	<link rel="icon" type="image/png" href="img/favicon.png" />
    <title>Anybody</title>
    <style>
         @import url('https://fonts.googleapis.com/css?family=Open+Sans|Open+Sans+Condensed:700');
    </style>
   
    
</head>

<body  class="boddy">
<?php
			require('auth/anybodyapp.php');
		    // If form submitted, insert values into the database.
		    if (isset($_POST['email'])){
				$fullname = stripslashes($_REQUEST['usrnm']); // removes backslashes
				$fullname = mysqli_real_escape_string($con,$fullname); //escapes special characters in a string
				
				$email = stripslashes($_REQUEST['email']);
				$email = mysqli_real_escape_string($con,$email);

				$password = stripslashes($_REQUEST['psw']);
				$password = mysqli_real_escape_string($con,$password);


		        $query = "INSERT into `users` (fullname,email,password) VALUES ('$fullname','$email','".md5($password)."')";
				$result = mysqli_query($con,$query);
				var_dump($result);
		        if($result){
		            echo "<div align='center' class='form' style='margin-top: 0;color:#ccc; width: 400px;position:fixed; top: 30%; left: 35%;'><h3 style='color:#ccc;'> <span style='font-size:80px; color:#FFC655'>&#9786;</span><br>You are registered successfully.</h3><br/>Click here to <a style='color:#979b1b;' href='signin.php'>Login</a></div>";
                   //eader("Location: signin.php");
		        }
		    }else{
		?>
	<div class="contain">
		<div class="left col-md-6 col-sm-12 col-xs-12" style="margin:auto;">
            <div class="sign">
                <a href="index.html"><img src="img/anywhite.svg"></a>
                <p class="h1">Welcome Back!</p>
               <div style="width:270px; margin: auto"align="center"> <p class="p" >To keep connected with us please login with your personal Info</p></div>
               <a href="signin.php">  <button class="btn bot">SIGN IN</button></a>
            </div>

        </div>
        <div class="right col-md-6 col-sm-12 col-xs-12">
            <div class="signin">
                    <p class="h1a">Hi!</p><p class="h1a" style="margin-bottom:20px;">Create Account</p>
                    <div style="width: 100px; height:70px; margin:auto"><div class="span" style="float: left;"><i class="fa fa-facebook"></i></div><div class="span" style="float: right;"><i class="fa fa-google"></i></div></div>
                    <div style="width:270px; margin: auto; margin-bottom:20px;"align="center"> <p class="pa" >Or use your email for registration</p></div>

                    <form id="form" style=" width: 360px; margin:auto;" method="post" action="">
                            <div class="input-container">
                                    <i class="fa fa-user-o icon"></i>
                                    <input class="input-field" type="text" placeholder="Name" name="usrnm">
                                  </div>
                                
                                  <div class="input-container">
                                    <i class="fa fa-envelope-o icon"></i>
                                    <input class="input-field" type="text" placeholder="Email" name="email">
                                  </div>
                                  
                                  <div class="input-container">
                                    <i class="fa fa-lock icon"></i>
                                    <input class="input-field" type="password" placeholder="Password" name="psw">
                                  </div>
                                  <!-- <div class="input-container">
                                        <i class="fa fa-phone icon"></i>
                                        <input class="input-field" type="text" placeholder="Phone Number" name="phone">
                                      </div> -->
                                      <button class="btn bota">SIGN UP</button>
                    </form>
            </div>                
        </div>
    </div>
    <?php } ?>
    <!-- <script src="js/jquery.js"></script>
    <script src="js/signup.js"></script> -->
</body>

</html>