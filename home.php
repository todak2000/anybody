<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="css/any.css">
	<link rel="icon" type="image/png" href="img/favicon.png" />
    <title>Anybody Home</title>
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
		<div class="top">
			<!-- <div class="button pull-right"><button class="signIn btn">Login</button><button class="signUp btn">Sign Up</button></div> -->
			<div class="button pull-right hidden-xs hidden-sm">
				<!-- <a href="#"><img src="img/signin1.svg" style="margin-right:-5px;"></a>
				<a href="#"><img src="img/singup1.svg" style="margin-left:-5px;"></a> -->
				<a href="signout.php"><div style="width: 100px; text-align: center; justify-content: center;"><i class="fa fa-power-off" style="font-size:30px; color:#008ef5"></i><br> Sign Out</div></a>
			</div>
			<div class="button pull-left hidden-xs hidden-sm">
					<h2 style="">
                        <span style="color:f#232323; font-size:14px;">Welcome,</span>
                    <span style="color:#008ef5;font-size:24px; font-weight:bolder;"><?php echo $name;?>!</span></h2>
				</div>
			<div class="button hidden-md hidden-lg" align="center" >
					<a href="#"><img src="img/signin11.svg" style="margin-right:-20px;"></a>
					<a href="#"><img src="img/singup11.svg" style="margin-left:-20px;"></a>
				</div>
			</div>
		
		
		<div class="middle">
				<!-- <div class="button pull-right"><button class="signIn btn">Login</button><button class="signUp btn">Sign Up</button></div> -->
				<div align="center" class=" anybody hidden-xs hidden-sm" style="padding-top: 5%"><img src="img/any.svg"></div>
				<div align="center" class=" anybody hidden-md hidden-lg"><img src="img/any_small.svg"></div>
				<!-- <div align="center" class=" search hidden-xs hidden-sm"><input class="inp" type="text" placeholder="Search for anybody"><a href="#"><button class=" search_button"></button></a></div> -->
				<form method="GET" action="personalizedsearch.php"><div align="center" class=" search hidden-xs hidden-sm"><input class="inp" name="searchQuery"required type="text" placeholder="Search for anybody"><a href="#"><button class=" search_button" type="submit" name="submit"></button></a></div></form>
                <div align="center" class=" search hidden-md hidden-lg"><input class="inp"  type="text" placeholder="Search for anybody" required></div>
                
				
				<?php

				
				$query2 = "SELECT search_query,image_url FROM searching WHERE user_id='".$id."' GROUP BY search_query ORDER BY id DESC LIMIT 0,5";
				
$result2 = mysqli_query($con,$query2) or die(mysqli_error());
$rows2 = mysqli_num_rows($result2);
if($rows2>0){

    echo"<div class='middle' style='height:70%;'>
            <div class='flex-container' style='justify-content: center; margin-left:0;'>
                   
            ";
    while ($row2 = mysqli_fetch_assoc($result2))
    
    {
        
         $name222    = $row2['search_query'];
        $image222 = $row2['image_url'];
        

         echo "
		 <div>     
         <div class='inner'><img src='".$image222."' style='border-radius: 50%;padding:10px;' width='100' height='100'>
         </div>
         	<p>";
             echo ucwords($name222);
             echo"</p> </div>"; 

      
    
}

echo"
</div>                  


";
    }
	?>
                <!-- <div class="flex-container" style="justify-content: center; margin-left:0;">
                    <div><div class="inner"><a href="#"><img src="img/dummy1.png" style="border-radius: 50%;padding:10px;" width="100" height="100"></a></div><a href="#"><p>Ndukwe Ebenezer</p></a></div>
                    <div><div class="inner"><a href="#"><img src="img/dummy2.png" style="border-radius: 50%;padding:10px;" width="100" height="100"></a></div><a href="#"><p>Chioma Chinedu</p></a></div>
                    <div><div class="inner"><a href="#"><img src="img/dummy1.png" style="border-radius: 50%;padding:10px;" width="100" height="100"></a></div><a href="#"><p>Lai Mohammed</p></a></div>
                    <div><div class="inner"><a href="#"><img src="img/dummy1.png" style="border-radius: 50%;padding:10px;" width="100" height="100"></a></div><a href="#"><p>Femi Fani-Kayode</p></a></div>
                    <div><div class="inner"><a href="#"><img src="img/dummy2.png" style="border-radius: 50%;padding:10px;" width="100" height="100"></a></div><a href="#"><p>Nafisat Abdul-hamid</p></a></div> -->
                  <!-- </div>
                  <div class="flex-container" style="justify-content: center;margin-left:0;">
                    <div><a href="#"><img src="more.svg"></a></div>
                    
                  </div> -->
			<!-- </div> -->
			<div class="flex-container" style="justify-content: center;margin-left:0; min-height:57%;">
                    <div><a href="moresearch.php"><img src="more.svg"></a></div>
                    
                  </div>
			<div class="bottom" style="width:97%; position: fixed;">
				<!-- <div class="button pull-right"><button class="signIn btn">Login</button><button class="signUp btn">Sign Up</button></div> -->
				<div>
					<p class="pull-left hidden-xs hidden-sm">Anybody | iVO Thinking &copy;2018</p>
					<p class=" hidden-md hidden-lg" style="text-align:center;">Anybody | iVO Thinking &copy;2018</p>
					<ul class=" about hidden-xs hidden-sm">
						<li>About</li>
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
						</ul>
				</div>
			</div>
	</div>
</body>

</html>