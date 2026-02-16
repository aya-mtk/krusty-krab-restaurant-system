<?php
session_start();
require_once('dbconnect.php');

function get_Reviews($db){
    $result = $db->Reviews->find(array());
    $recent_Reviews = iterator_to_array($result);
    return $recent_Reviews;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style(1).css">
	<link rel="stylesheet" href="neon.css">
	<link rel="stylesheet" href="slideshow.css">
	<link rel= "stylesheet" href = "gallerystyle.css" >
    <link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet">
    <script src ="galleryscript.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/imask/3.4.0/imask.min.js'></script>
    <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
	<style>
		input[type=submit] {
			background-color: purple; 
			border: 2px black; 
			padding: 2px; 
			font-family: papyrus;
		}
		
		input[type=submit]:hover{
			border: 1px solid darkgoldenrod;
			cursor: pointer;
			font-weight: bold;
		}
		
		textarea {
			background-color: transparent; 
			border: 2px solid purple; 
			padding: 2px; 
			font-family: papyrus; 
		}
		
	</style>
</head>
<body>
    
<!-- header section starts  -->

<header>
	<div class="wrapper">
	<h1><a href="#" class="logo"><img src="icons/krab1.jpg" style="width: 70px; height: 70px; vertical-align: middle; position: fixed; top: 0;" alt="">The .. The Krusty Krab</a></h1>
	</div>
    <div id="menu-bar" class="fas fa-bars"></div>
	
    <nav class="navbar">
        <a href="UserHome.php">home</a>
        <a href="UserMenuPage.php">menu</a>
        <a href="About.html"  target="_blank">About</a>
        <a href="Reservation.html">Reservation</a>
        <a href="#">Review</a>
        <a href="mainOrderPage.html">order</a>
    </nav>

</header>

<!-- header section ends -->
	
<section>
	<h1 class="heading" style="margin-top:60px;"> We Serve <span> <em>Love,</em> </span> not <span> <em>Food</em> </span> </h1>
	<div class="demo">
	  <div class="demo__gallery">
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
		<div class="demo__placeholder"></div>
	  </div>  
	</div>
</section>
<!-- review section starts  -->

<section class="review" id="review">

	<h1 class="heading"> Our Customers <span> <em>Adequate</em> </span>Reviews </h1>

    <div class="box-container">

            <?php
                $Reviews = get_Reviews($db);
                foreach($Reviews as $Review) {
                    echo 
                        '<div class="box">
                            <img src="images/happy.png" alt="" class="pp"> 
                        <h3>'.$Review['username'].'</h3>
                        <p style="font-size: 16px;">'.$Review['body'].'</p>
                        <p style="font-size: 10px;">Date: '.$Review['Date'].'<p>
                        </div>';    
                }
            ?>  
            
    <div class="box">
            <form action="submit_review.php" method="post">
                <fieldset>
                    <label for="body"><h3>Enter Review:</h3></label>
                    <textarea name="body" rows="4" cols="30"></textarea><br>
                </fieldset>
                <br>
                <input type="submit" value="submit"/>
            </form>
        </div>
        
    </div>

</section>

<!-- review section ends -->

<!-- footer section  -->

<section class="footer"  >

    <div class="share">
        <a href="#" class="btn">facebook</a>
        <a href="#" class="btn">twitter</a>
        <a href="#" class="btn">instagram</a>
        <a href="#" class="btn">pinterest</a>
        <a href="#" class="btn">linkedin</a>
    </div>

</section>

<!-- scroll top button  -->
<a href="#" class="fas fa-angle-up" id="scroll-top"></a>

<!-- loader  --
<div class="loader-container">
    <img src="images/fishoader1.gif" alt="">
</div>


<!-- custom js file link  -->
<script src="script.js"></script>
<script src="js.js"></script>
<script src ="galleryscript.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/imask/3.4.0/imask.min.js'></script>
<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>

</body>
</html>