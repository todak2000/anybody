<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="css/any.css">
	<link rel="icon" type="image/png" href="img/favicon.png" />
    <title>Anybody Search History</title>
    <style>
         @import url('https://fonts.googleapis.com/css?family=Open+Sans|Open+Sans+Condensed:700');
    </style>
   
    
</head>

<body style="overflow-x:hidden;">
<?php
            require('auth/auth.php');
            require('auth/anybodyapp.php');
            //Checking is user existing in the database or not
            $query = "SELECT * FROM `users` WHERE email='$email'";
            $result = mysqli_query($con,$query) or die(mysql_error());
            $rows = mysqli_num_rows($result);
            // var_dump($query);
            while ($row    = mysqli_fetch_array($result))
           
            {
                $id = $row['id'];
                $name     = $row['fullname'];
                $Email = $row['email'];

            }

            ?>
	<div class="contain">
    <div class="top" style="border-bottom: 1px solid #ccc; height:20%;">
			<!-- <div class="button pull-right"><button class="signIn btn">Login</button><button class="signUp btn">Sign Up</button></div> -->
			<div class="button pull-left hidden-xs hidden-sm small">
                <a href="home"><img src="img/any_small.svg" style="margin-right:-5px;"></a><br>
                <div style="padding-left:100px; margin-top:20px;">
                <form method="GET" action="personalizedsearch"><div align="center" class=" search hidden-xs hidden-sm"><input class="inp" required name="searchQuery" type="text" placeholder="Search for anybody"><a href="#"><button class=" search_button" type="submit" name="submit"></button></a></div></form>
                </div>
            </div>
            <div class="button pull-right hidden-xs hidden-sm">
                <h2 style="float:left">
                        <span style="color:f#232323; font-size:14px;">Welcome,</span>
                    <span style="color:#008ef5;font-size:24px; font-weight:bolder;"><?php echo $name;?>!</span>
                </h2>
                <a href="signout"><div style="width: 100px; text-align: center; justify-content: center; float:right"><i class="fa fa-power-off" style="font-size:30px; color:#008ef5"></i><br> Sign Out</div></a>
				<!-- <a href="signin.html"><img src="img/signin1.svg" style="margin-right:-5px;"></a>
				<a href="signup.html"><img src="img/singup1.svg" style="margin-left:-5px;"></a> -->
			</div>            
            <div class="button pull-right hidden-lg hidden-md">
				<a href="signout"><div style="width: 100px; text-align: center; justify-content: center; ">Sign Out  <i class="fa fa-power-off" style="font-size:20px; color:#008ef5"></i></div></a>
			</div>
			<div class="button pull-left hidden-lg hidden-md" style="padding-left:0;">
					<h2 style="">
                        <span style="color:f#232323; font-size:10px;">Welcome,</span>
                    <span style="color:#008ef5;font-size:14px; font-weight:bolder;"><?php echo $name;?>!</span></h2>
            </div>
            
            <div align="center" class=" anybody hidden-md hidden-lg" style="padding-top:15%; margin-bottom:0;"><a href="home"><img src="img/any_small.svg"></a></div>
				
				<form method="GET" action="personalizedsearch"><div class="input-container hidden-md hidden-lg" style="padding-left:5%;">
   
					<input class="input-field" type="text" placeholder="Search for anybody" required name="searchQuery">

					 <button type="submit" id="completed-task" class="icon">
						<!-- <img src="search_button.svg" style="padding-top:5px;" width="25" height="25"> -->
				  </button>
				  </div>		
				</form>
	</div>
	
				
				<?php

				
				$query2 = "SELECT DISTINCT search_query,image_url,percentages,source_name FROM searching WHERE user_id='".$id."'";
				
$result2 = mysqli_query($con,$query2) or die(mysqli_error());
$rows2 = mysqli_num_rows($result2);
if($rows2>0){
    ?>
    <div class='middle' style='height:75%; margin-bottom: 50px;'>
            <h3 style='margin-left:100px;'><?php echo $rows2;?> Search Results:</h3>
            <div class='flex-container'>
<?php
   
    while ($row2 = mysqli_fetch_assoc($result2))
    
    {
        
         $name222    = $row2['search_query'];
        $image222 = $row2['image_url'];
         $percent222    = $row2['percentages'];
         $source222 = $row2['source_name'];

         echo "
         <div>  
         <div class='innera col-md-6'><img src='".$image222."' style='border-radius: 50%;' width='120' height='120'>
         </div>
         <div class='col-md-6 texxt' style='font-family: Open Sans; width:250px; text-align: left; padding-left:15px;'>
             <h2 style='font-size:1.1em; font-weight: bolder;line-height: 25px;'>";
             echo ucwords($name222);
             echo"</h2>
             <h4 style='font-size:0.8em; font-weight: bold; color:#0288D1;line-height: 20px;'>";
             echo ($percent222.'% Occurence');
             echo"</h4>
             <h6 style='font-size:0.6em; font-style: italic; color:#009688;line-height: 18px;'>Percentage validity Search</h6>
             <h4 style='font-size:0.8em; font-weight: bold;line-height: 18px;color:#4a4a4a;'>";
             echo ucwords($source222); echo"</h4>
             
         </div></div>
     
 "; 

      
    
}
    ?>
    </div>

</div>
<?php }?>
            
        
        </div></div>  
		<div class="bottom">
				<!-- <div class="button pull-right"><button class="signIn btn">Login</button><button class="signUp btn">Sign Up</button></div> -->
				<div>
					<p class="pull-left hidden-xs hidden-sm">Anybody | iVO Thinking &copy;2018</p>
					<p class=" hidden-md hidden-lg" style="text-align:center;">Anybody | iVO Thinking &copy;2018</p>
					<ul class=" about hidden-xs hidden-sm">
						<!-- <li>About</li>
						<li>Privacy</li>
						<li>Terms</li>
						<li>Feedbacks</li>
					</ul>
					<ul class=" about hidden-md hidden-lg">
							<ul class=" about ">
							<li>About</li>
							<li>Privacy</li>
							<li>Terms</li>
							<li>Feedbacks</li>
						</ul> -->
				</div>
			</div>
	</div>
</body>

</html>