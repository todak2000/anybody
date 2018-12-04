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

	<div class="contain">
		<div class="left col-md-6 col-sm-12 col-xs-12" style="margin:auto;">
            <div class="sign">
                <a href="index"><img src="img/anywhite.svg"></a>
                <p class="h1">Welcome Back!</p>
               <div style="width:270px; margin: auto"align="center"> <p class="p" >To keep connected with us please login with your personal Info</p></div>
               <a href="signin">  <button class="btn bot">SIGN IN</button></a>
            </div>

        </div>
        <div class="flex-container col-md-6 col-sm-12 col-xs-12">
            <div class="signin">
            <img src="anybody_logo_blue.svg" align="center" width="150" class="hidden-md hidden-lg">
                    <p class="h1a">Hi!</p><p class="h1a" style="margin-bottom:20px;">Create Account</p>
                    <div  class="facie"><div class="span" style="float: left;"><i class="fa fa-facebook"></i></div><div class="span" style="float: right;"><i class="fa fa-google"></i></div></div>
                    <div style="width:270px; margin: auto; margin-bottom:20px;"align="center"> <p class="pa" >Or use your email for registration</p></div>

                    <form id="form" class="form_login" style="margin:auto;" method="post" action="">
                            <div class="input-container">
                                    <i class="fa fa-user-o icon"></i>
                                    <input id="name" class="input-field" type="text" placeholder="Name" name="usrnm">
                                  </div>
                                
                                  <div class="input-container">
                                    <i class="fa fa-envelope-o icon"></i>
                                    <input id="email" class="input-field" type="text" placeholder="Email" name="email">
                                  </div>
                                  
                                  <div class="input-container">
                                    <i class="fa fa-lock icon"></i>
                                    <input id="pass" class="input-field" type="password" placeholder="Password" name="psw">
                                  </div>
                                  <!-- <div class="input-container">
                                        <i class="fa fa-phone icon"></i>
                                        <input class="input-field" type="text" placeholder="Phone Number" name="phone">
                                      </div> -->
                                      <button class="btn bota" type="submit">SIGN UP</button><br><br>
                                    <!-- <p class="hidd pull-left"> Registered already ?</p><a href="signin" class="btn botaa pull-right hidd" style=" left:70%;">Sign in</a> -->

                                    <a href="forgot_password" class="hidd pull-left" id="leftie" style=" text-decoration: underline; color:#676767; margin-left:5px;">Forgot Password?</a>
                    <a href="signin" id="rightie" class=" pull-right hidd" style="left:55%;color:#676767;text-decoration: underline; ">Already a Member?</a> 
                    </form>
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

                if ( empty($fullname) OR empty($email)  OR empty($password) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  //  echo "<div align='center' class='forma' ><h3 style='color:#ccc;'> <img class='img' src='img/fail.png'><br>Failed registration due to INCOMPLETE details<br> Please Enter every details again!.</h3><br/> <span style='color:#979b1b; font-size:20px;' class='close btn'>X</span></div>";
                    //echo "<div align='center' class='formaa'><span style='color:#979b1b; font-size:20px;' class='closea btn  pull-right'>X</span><h3 style='color:#fff;'> <i class='fa fa-times' class='img' style='color:red; font-size:100px;'></i><br>Failed registration due to INCOMPLETE details<br> Please Enter every details again!.</h3><br/> <span style='color:#979b1b; font-size:20px;' class='close btn'>X</span></div>";
                    echo "<div align='center' class='formaa'><span style='color:#979b1b; font-size:20px;' class='closea btn  pull-right'>X</span><br><h3 style='color:#fff;'> <i class='fa fa-times' class='img' style='color:red; margin-left:15%; font-size:100px;'></i><br>Failed registration due to INCOMPLETE details</h3><br/><a href='signup' class='btn botaa pull-right' style='background-color: #eae2e2cc;'>Sign up</a></div>";


                }
            
                else{

                    $query = "SELECT * FROM users WHERE email='".$email."' ";
                    $result = mysqli_query($con,$query);
                    $rows = mysqli_num_rows($result);
            
                    if($rows>=1){
                        // echo" Error (400). Username or email already exists";
                       // echo "<div align='center' class='formaa'><h3 style='color:#ccc;'> <img class='img' src='img/fail.png'><br>Failed Registration because User Exist.</h3><br/><span style='color:#979b1b; font-size:20px;' class='closea btn  pull-right'>X</span></div>";
                       //echo "<div align='center' class='formaa'><h3 style='color:#fff;'> <i class='fa fa-times' class='img' style='color:red; font-size:100px;'></i><br>Failed Registration because User Exist.</h3><br/><span style='color:#979b1b; font-size:20px;' class='closea btn  pull-right'>X</span></div>";
                       echo "<div align='center' class='formaa'><span style='color:#979b1b; font-size:20px;' class='closea btn  pull-right'>X</span><br><h3 style='color:#fff;'> <i class='fa fa-times' class='img' style='color:red; margin-left:15%; font-size:100px;'></i><br>Failed Registration because User Exist.</h3><br/><a href='signup' class='btn botaa pull-right' style='background-color: #eae2e2cc;'>Sign up</a></div>";



                    } else{
                        $query = "INSERT into `users` (fullname,email,password) VALUES ('$fullname','$email','".md5($password)."')";
                        $result = mysqli_query($con,$query);
                        // var_dump($result);
                        if($result){
                             //echo "<div align='center' class='form1' ><h3 style='color:#ccc;'> <img class='img1' src='img/ok.png'><br>You are registered successfully.</h3><br/><a style='color:#979b1b;' class='btn btn-default pull-left' href='signin'>Login</a><span style='color:#979b1b; font-size:20px;' class='closea1 btn  pull-right'>X</span></div>";
                             //echo "<div align='center' class='form1' ><h3 style='color:#fff;'><i class='fa fa-check' style='color:green; font-size:100px;'></i><br>You are registered successfully.</h3><br/><a style='color:#979b1b;' class='btn btn-default pull-left' href='signin'>Login</a><span style='color:#979b1b; font-size:20px;' class='closea1 btn  pull-right'>X</span></div>";
                             echo "<div align='center' class='form1' ><span style='color:#979b1b; font-size:20px;' class='closea1 btn  pull-right'>X</span><br><h3 style='color:#fff;'><i class='fa fa-check' style='color:green;margin-left:15%; font-size:100px;'></i><br>You are registered successfully.</h3><br/><a href='signin' class='btn botaa pull-right' style='background-color: #eae2e2cc;'>Sign in</a></div>";

                             
                            // echo json_encode($mesg);
                        //eader("Location: signin.php");
                        }
                            }
                
               }

		    }else{
		?>
            </div>                
        </div>
    </div>
    <?php } ?>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/submit_login.js"></script>
    
</body>

</html>