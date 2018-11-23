<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/any.css">
    <link rel="icon" type="image/png" href="img/favicon.png" />
    <title>Anybody Search Results</title>
    <style>
         @import url('https://fonts.googleapis.com/css?family=Open+Sans|Open+Sans+Condensed:700');
    </style>
   
    
</head>

<body>
	<div class="contain">
		<div class="top" style="border-bottom: 1px solid #ccc; height:20%;">
			<!-- <div class="button pull-right"><button class="signIn btn">Login</button><button class="signUp btn">Sign Up</button></div> -->
			<div class="button pull-left hidden-xs hidden-sm">
                <a href="#"><img src="img/any_small.svg" style="margin-right:-5px;"></a><br>
                <div style="padding-left:100px; margin-top:20px;">
                <form method="GET" action="searchresult.php"><div align="center" class=" search hidden-xs hidden-sm"><input class="inp" name="searchQuery" type="text" placeholder="Search for anybody"><a href="#"><button class=" search_button" type="submit" name="submit"></button></a></div></form>
                </div>
            </div>
            <div class="button pull-right hidden-xs hidden-sm">
				<a href="signin.php"><img src="img/signin1.svg" style="margin-right:-5px;"></a>
				<a href="signup.php"><img src="img/singup1.svg" style="margin-left:-5px;"></a>
			</div>
			                

		</div>
		<!-- php starts here -->
		<?php

$in = strtolower($_GET['searchQuery']);

$input = trim($in);

$query=str_replace(" ","+", $_GET['searchQuery']);


//The API URL for getting the information 
//$url= "https://www.googleapis.com/customsearch/v1?key=AIzaSyB5WOpV4_-J6QK2XbldcQ-BVgJl6FotTTo&cx=009130427976801447388:idrpxx1qx8c&q=".$query."&fields=items(title,snippet,pagemap/cse_image)" ;
// $url= "https://www.googleapis.com/customsearch/v1?key=AIzaSyD777ZEvs4UqMZ7kxAv-w98TK1E4hdGoII&cx=018412839258995437894:fgnrg7qhlqy&q=".$query."&fields=items(title,snippet,pagemap/cse_image)" ;
$url= "https://www.googleapis.com/customsearch/v1?key=AIzaSyATF24vZ97D7lbdQ1zPuxfJcGvJDQhLh0A&cx=009130427976801447388:athkuwtwhli&q=".$query."&fields=items(title,snippet,pagemap/cse_image)" ;

//using CURL to encode the url 
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL,$url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
$result = curl_exec($curl); //curl result is out

//To Calculate the weight of the searches across the returned json from the server
$sum=0; 
//To store the sources of the search
//$myArray=[];
//$myArrayTitle =[];

$urlImgArray=[];
//$mySourceArray = [];
$inputArray = [];
$titleArray = [];
$urlTitle =[];
$titleArray1 = [];
$urlTitle1 =[];
$imageUrl;
$newTit = [];
$resultArray=[];

//opening of result from the CURL call
if(!empty($result)) {
    $jsonResult = json_decode($result, true);
    $resultArray= $jsonResult['items'];
    if ($resultArray==NULL){
        echo ('Daily limit exceeded. Please try again tomorrow');
        exit;
    }else{
            
            $arrlength = count($resultArray); //getting the total number of results in the array
            // print_r($resultArray);

//Checking for the number of input with space as the delimiter
                if (strpos($input, ' ')){
                $splitr= explode(" ",$input);//if there is space, then split it into an array
                $inputArray[0] = $splitr[1];
                $inputArray[1] = $splitr[0];
                $input1 = implode(' ', $inputArray); // to cater for the reversed search, combine the array the other way
               
//Loop through the array of results gotten and extract the following: TITLE,SNIPPET AND IMAGE
                for($x = 0; $x < $arrlength; $x++) {
                    $title=strtolower($resultArray[$x]['title']);
                    $snippet=strtolower($resultArray[$x]['snippet']);

                    $image=(!empty($resultArray[$x]['pagemap']));
    
                    $titleCount = (substr_count($title, $input)); //counting the occurence of the input in the title
                        if ($titleCount==0)
                        $titleCount = (substr_count($title, $input1)); //counting the occurence of the reversed input in the title
                    $snippetCount =(substr_count($snippet, $input)); //counting the occurence of the input in the snippet
                        if ($snippetCount==0)
                        $snippetCount = (substr_count($snippet, $input1)); //counting the occurence of the reversed input in the snippet
                        

                    //Getting multiple results: getting the source link and the source while maintaining the search query as the title
                    if (($titleCount!=0)&&($snippetCount!=0)&&($image)){
                        $imageUrl =  $resultArray[$x]['pagemap']['cse_image'][0]['src'];
                        if  (strpos($title, '·')) {
                            $newTit= explode(' · ', $title);
                            array_push($titleArray, $newTit[1]);
                            }elseif  (strpos($title, '|')) {
                            $newTit= explode(' | ', $title);
                            array_push($titleArray, $newTit[1]);
                            }elseif  (strpos($title, '-')) {
                                $newTit= explode(' - ', $title);
                                array_push($titleArray, $newTit[1]) ;
                            }elseif  (strpos($title, '•')) {
                                $newTit= explode(' • ', $title);
                                array_push($titleArray, $newTit[1]) ;
                            }
                       
                        array_push($urlTitle, $imageUrl);
                 

                    }

                    //to get the exact searching terms
                    if ((preg_match("~\b$input1\b~",$title))&&($snippetCount!=0)&&($image)){
                        if  (strpos($title, '·')) {
                            $newTit= explode(' · ', $title);
                            array_push($titleArray1, $newTit[1]);
                            }elseif  (strpos($title, '|')) {
                            $newTit= explode(' | ', $title);
                            array_push($titleArray1, $newTit[1]);
                            }elseif  (strpos($title, '-')) {
                                $newTit= explode(' - ', $title);
                                array_push($titleArray1, $newTit[1]) ;
                            }elseif  (strpos($title, '•')) {
                                $newTit= explode(' • ', $title);
                                array_push($titleArray1, $newTit[1]) ;
                            }
                        
                        array_push($urlTitle1, $imageUrl);

                    }
                    

                    $titleCount1 = (substr_count($title, $splitr[0]));
                    $titleCount2 = (substr_count($title, $splitr[1])); 
                    $snippetCount1 =(substr_count($snippet, $splitr[0]));
                    $snippetCount2 =(substr_count($snippet, $splitr[1]));
                    

                if (($titleCount!=0)&&($snippetCount!=0)){
                    $sum = $sum + 1.00;
                    }elseif(($titleCount==0)&&($snippetCount!=0)){
                        $sum =$sum + 0.30;
                    }elseif(($titleCount!=0)&&($snippetCount==0)){
                        $sum =$sum + 0.70;
                    }elseif (($titleCount1!=0)&&($snippetCount1!=0)){
                        $sum = $sum + 0.50;
                    }elseif(($titleCount1==0)&&($snippetCount1!=0)){
                        $sum =$sum + 0.15;
                    }elseif(($titleCount1!=0)&&($snippetCount1==0)){
                        $sum =$sum + 0.35;
                    }elseif (($titleCount2!=0)&&($snippetCount2!=0)){
                        $sum = $sum + 0.50;
                    }elseif(($titleCount2==0)&&($snippetCount2!=0)){
                        $sum =$sum + 0.15;
                    }elseif(($titleCount2!=0)&&($snippetCount2==0)){
                        $sum =$sum + 0.35;
                    }elseif (($titleCount1==0)&&($snippetCount1==0)){
                        $sum = $sum + 0.00;
                    }elseif (($titleCount2==0)&&($snippetCount2==0)){
                        $sum = $sum + 0.00;
                    }elseif (($titleCount==0)&&($snippetCount==0)){
                        $sum = $sum + 0.00;
                    }
        }
    
         $divisorCounter = count($titleArray);
         if ($divisorCounter<=3){
             //if the return array is less than or equal to 3
            echo"<div class='middle' style='height:75%;'>
            <h3 style='margin-left:100px;'>$divisorCounter Search Results:</h3>
            <div class='flex-container'>
                    <div>
            ";
             foreach( $titleArray as $title1 => $source ) {
                echo "
                
                        <div class='innera col-md-6'><a href='#'><img src='$urlTitle[$title1]' style='border-radius: 50%;' width='120' height='120'></a>
                        </div>
                        <div class='col-md-6' style='font-family: Open Sans; width:250px; text-align: left; padding-left:15px;'>
                            <a href='#'><h2 style='font-size:1.1em; font-weight: bolder;line-height: 25px;'>";
                            echo ucwords($_GET['searchQuery']);
                            echo"</h2></a>
                            <h4 style='font-size:0.8em; font-weight: bold; color:#0288D1;line-height: 20px;'>";
                            if ($divisorCounter!=0) {
                                echo($percent= round((($sum*10)/$divisorCounter), 2) .'% Occurence');
                            }
                            else{echo 'Not Found! Try again later. Thank you for using ANYBODY';}
                            echo"</h4>
                            <h6 style='font-size:0.6em; font-style: italic; color:#009688;line-height: 18px;'>Percentage validity Search</h6>
                            <h4 style='font-size:0.8em; font-weight: bold;line-height: 18px;color:#4a4a4a;'>";
                            echo ucwords($source); echo"</h4>
                            
                        </div>
                    
                "; 
            }
            echo"</div>
                    
                </div>
                
            </div>";
         }else{
            //if the search result is greater than 3
            $divisorCounter1 = count($titleArray1);
        echo"<div class='middle' style='height:75%;'>
        <h3 style='margin-left:100px;'>$divisorCounter1 Search Results:</h3>
        <div class='flex-container'>
                <div>
        ";
         foreach( $titleArray1 as $title2 => $source ) {
            echo "
            
                    <div class='innera col-md-6'><a href='#'><img src='$urlTitle1[$title2]' style='border-radius: 50%;' width='120' height='120'></a>
                    </div>
                    <div class='col-md-6' style='font-family: Open Sans; width:250px; text-align: left; padding-left:15px;'>
                        <a href='#'><h2 style='font-size:1.1em; font-weight: bolder;line-height: 25px;'>";
                        echo ucwords($_GET['searchQuery']);
                        echo"</h2></a>
                        <h4 style='font-size:0.8em; font-weight: bold; color:#0288D1;line-height: 20px;'>";
                        if ($divisorCounter1!=0) {
                            echo($percent=round((($sum*10)/$divisorCounter1)) .'% Occurence');
                        }
                        else{echo 'Not Found! Try again later. Thank you for using ANYBODY';}
                        echo"</h4>
                        <h6 style='font-size:0.6em; font-style: italic; color:#009688;line-height: 18px;'>Percentage validity Search</h6>
                        <h4 style='font-size:0.8em; font-weight: bold;line-height: 18px;color:#4a4a4a;'>";
                        echo ucwords($source); echo"</h4>
                        
                    </div>
                
                    "; 

        }
       
        echo"</div>
                
            </div>
            
        </div>";
         }
         

    }else{
        //if it is a single word search
        $arrlength = count($resultArray);
        for($x = 0; $x < $arrlength; $x++) {
            $title=strtolower($resultArray[$x]['title']);
            $snippet=strtolower($resultArray[$x]['snippet']);
            $snippetCount =(substr_count($snippet, $input));
            $image=(!empty($resultArray[$x]['pagemap']));
            
        
            $titleCount = (substr_count($title, $input)); //counting the occurence of the title
            if (($titleCount!=0)&&($snippetCount!=0)&&($image)){
                $imageUrl =  $resultArray[$x]['pagemap']['cse_image'][0]['src'];
                if  (strpos($title, '·')) {
                    $newTit= explode(' · ', $title);
                    array_push($titleArray, $newTit[1]);
                    }elseif  (strpos($title, '|')) {
                    $newTit= explode(' | ', $title);
                    array_push($titleArray, $newTit[1]);
                    }elseif  (strpos($title, '-')) {
                        $newTit= explode(' - ', $title);
                        array_push($titleArray, $newTit[1]) ;
                    }elseif  (strpos($title, '•')) {
                        $newTit= explode(' • ', $title);
                        array_push($titleArray, $newTit[1]) ;
                    }
              
                array_push($urlTitle, $imageUrl);
          

            }

            //to get the exact searching terms
            if ((preg_match("~\b$input\b~",$title))&&($snippetCount!=0)&&($image)){
                if  (strpos($title, '·')) {
                    $newTit= explode(' · ', $title);
                    array_push($titleArray1, $newTit[1]);
                    }elseif  (strpos($title, '|')) {
                    $newTit= explode(' | ', $title);
                    array_push($titleArray1, $newTit[1]);
                    }elseif  (strpos($title, '-')) {
                        $newTit= explode(' - ', $title);
                        array_push($titleArray1, $newTit[1]) ;
                    }elseif  (strpos($title, '•')) {
                        $newTit= explode(' • ', $title);
                        array_push($titleArray1, $newTit[1]) ;
                    }
                
                array_push($urlTitle1, $imageUrl);
           
            }
            
   
            if (($titleCount!=0)&&($snippetCount!=0)){
                $sum = $sum + 1.00;
                }elseif(($titleCount==0)&&($snippetCount!=0)){
                    $sum =$sum + 0.30;
                }elseif(($titleCount!=0)&&($snippetCount==0)){
                    $sum =$sum + 0.70;
                }elseif (($titleCount==0)&&($snippetCount==0)){
                    $sum = $sum + 0.00;
                }
                
                  

            
    }

    $divisorCounter = count($titleArray);
         
        //  var_dump($divisorCounter);
         if ($divisorCounter<=3){
             //if the return array is less than or equal to 3
            echo"<div class='middle' style='height:75%;'>
            <h3 style='margin-left:100px; margin-right:100px;'>$divisorCounter Search Results:</h3>
            <div class='flex-container'>
                    <div>
            ";
             foreach( $titleArray as $title1 => $source ) {
                echo "
                
                        <div class='innera col-md-6'><a href='#'><img src='$urlTitle[$title1]' style='border-radius: 50%;' width='120' height='120'></a>
                        </div>
                        <div class='col-md-6' style='font-family: Open Sans; width:250px; text-align: left; padding-left:15px;'>
                            <a href='#'><h2 style='font-size:1.1em; font-weight: bolder;line-height: 25px;'>";
                            echo ucwords($_GET['searchQuery']);
                            echo"</h2></a>
                            <h4 style='font-size:0.8em; font-weight: bold; color:#0288D1;line-height: 20px;'>";
                            if ($divisorCounter!=0) {
                                echo($percent= round((($sum*10)/$divisorCounter), 2) .'% Occurence');
                            }
                            else{echo 'Not Found! Try again later. Thank you for using ANYBODY';}
                            echo"</h4>
                            <h6 style='font-size:0.6em; font-style: italic; color:#009688;line-height: 18px;'>Percentage validity Search</h6>
                            <h4 style='font-size:0.8em; font-weight: bold;line-height: 18px;color:#4a4a4a;'>";
                            echo ucwords($source); echo"</h4>
                            
                        </div>
                    
                "; 
            }
            echo"</div>
                    
                </div>
                
            </div>";
         }else{
            //if the search result is greater than 3
            $divisorCounter1 = count($titleArray1);
        echo"<div class='middle' style='height:75%;'>
        <h3 style='margin-left:100px;'>$divisorCounter1 Search Results:</h3>
        <div class='flex-container'>
                <div>
        ";
         foreach( $titleArray1 as $title2 => $source ) {
            echo "
            
                    <div class='innera col-md-6'><a href='#'><img src='$urlTitle1[$title2]' style='border-radius: 50%;' width='120' height='120'></a>
                    </div>
                    <div class='col-md-6' style='font-family: Open Sans; width:250px; text-align: left; padding-left:15px;'>
                        <a href='#'><h2 style='font-size:1.1em; font-weight: bolder;line-height: 25px;'>";
                        echo ucwords($_GET['searchQuery']);
                        echo"</h2></a>
                        <h4 style='font-size:0.8em; font-weight: bold; color:#0288D1;line-height: 20px;'>";
                        if ($divisorCounter1!=0) {
                            echo($percent=round((($sum*10)/$divisorCounter1)) .'% Occurence');
                        }
                        else{echo 'Not Found! Try again later. Thank you for using ANYBODY';}
                        echo"</h4>
                        <h6 style='font-size:0.6em; font-style: italic; color:#009688;line-height: 18px;'>Percentage validity Search</h6>
                        <h4 style='font-size:0.8em; font-weight: bold;line-height: 18px;color:#4a4a4a;'>";
                        echo ucwords($source); echo"</h4>
                        
                    </div>
                
                    "; 

        }
       
        echo"</div>
                
            </div>
            
        </div>";
         }
 }
    }
} else {
    echo "Data not fetched.";
    curl_close($curl);
    exit;
}
   ?>
		<div class="bottom" style="height:5%;">
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