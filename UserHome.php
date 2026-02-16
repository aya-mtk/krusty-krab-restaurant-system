<!--Homepage logged in-->

<?php
    session_start();
    require_once('dbconnect.php');
    if (!isset($_SESSION['user'])) {
		header("Location: logout.php");
    }

    $userData = $db->users->findOne( array('_id'=>$_SESSION['user']));
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Hompage</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<!--	<link href='https://fonts.googleapis.com/css?family=Rubik Wet Paint' rel='stylesheet'>-->

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style(1).css">
	<link rel="stylesheet" href="neon.css">
	<link rel="stylesheet" href="slideshow.css">
	<style>
		iframe {
		  border: none;
		  width: 500px; /* set the width and height to match the chatbot container */
		  height: 600px;
		  position: absolute; /* use fixed positioning so the iframe stays in place */
		  bottom: -10px;
		  right: 7px;
		  z-index: 999; /* make sure the iframe is above other elements */
		}
	</style>
</head>
<body  onmouseover="play()" onmousemove="play()" onmouseenter="play()" onmouseout="play">
    
<!-- header section starts  -->

<header  onmouseover="play()" onmousemove="play()" onmouseenter="play()" onmouseout="play" onmouseout="play">
	<div class="wrapper">
	<h1><a href="#" class="logo"><img src="icons/krab1.jpg" style="width: 70px; height: 70px; vertical-align: middle; position: fixed; top: 0;" alt="">The .. The Krusty Krab</a></h1>
	</div>
    <div id="menu-bar" class="fas fa-bars"></div>
	
    <nav class="navbar">
        <a href="#">home</a>
        <a href="UserMenuPage.php">menu</a>
        <a href="About.html"  target="_blank">About</a>
        <a href="ReservationPage.php">Reservation</a>
        <a href="adminReview.php">Review</a>
        <a href="mainOrderPage.html">order</a>
		<a href="logout.php">Logout</a>
		<a href="UserProfile.php"><img width="20px" height="20px" style="width: 50px; height: 50px; vertical-align: middle; position: fixed; top: 8px;" src="images/mrkrabsmirky.webp"></a>
    </nav>

</header>

<!-- header section ends -->

<!-- home section starts  -->
<iframe src="http://127.0.0.1:5000/" frameborder="0"></iframe>

<section class="home" id="home" onmouseover="play()" onmousemove="play()" onmouseenter="play()" onmouseout="play">
	
    <div class="content">
		<h3  onmouseover="play()" onmousemove="play()" onmouseenter="play()" onmouseout="play" style="padding-top: 50px;"><a href="#"  onmouseover="play()" onmousemove="play()" onmouseenter="play()" onmouseout="play" class="neon-button">Krusty Krab</a></h3>
        <p style="color: darkgrey;">Home of Sea Food!</p>
		
		<p><img  onmouseover="play()" onmousemove="play()" onmouseenter="play()" onmouseout="play" src="icons/momentum.png" style="width: 200px; height: 200px; cursor: pointer;"></p>
		<p>Where all the happiness begins..</p>
        <a href="mainOrderPage.html" class="btn">order now</a>
    </div>

    <div class="image"  onmouseover="play()" onmousemove="play()" onmouseenter="play()" onmouseout="play">
		<div class="slideshow-container">
			
			<div class="mySlides fade">
			  <img onload="play()" src="images/restaurant.jpg">
			</div>

			<div class="mySlides fade">
			  <img src="images/restaurant3.jpg">
			</div>	

			<div class="mySlides fade">
			  <img src="images/restaurant4.jpg">
			</div>	
			
			<div class="mySlides fade">
			  <img src="images/restaurant5.jpg">
			</div>	
			
		</div>
	</div>
	<br>
	<div style="text-align:center">
	  <span class="dot"></span> 
	  <span class="dot"></span> 
	  <span class="dot"></span> 
	  <span class="dot"></span> 
	</div>

	<audio id="myAudio" loop>
	  <source src="canwe.mp3" type="audio/ogg">
	  Your browser does not support the audio element.
	</audio>
	
</section>

<!-- home section ends -->

<!-- footer section  -->

<section class="footer"  onmouseover="play()" onmousemove="play()" onmouseenter="play()" onmouseout="play">

    <div class="share">
        <a href="#" class="btn">facebook</a>
        <a href="#" class="btn">twitter</a>
        <a href="#" class="btn">instagram</a>
        <a href="#" class="btn">pinterest</a>
        <a href="#" class="btn">linkedin</a>
    </div>
	
</section>

<!-- scroll top button  -->
<a href="#home" class="fas fa-angle-up" id="scroll-top"></a>

<!-- loader  -->
<div class="loader-container">
    <img src="images/fishoader1.gif" alt="">
</div>

-->

<!-- custom js file link  -->
<script src="script.js"></script>
<script src="js.js"></script>
<script>
	var audio = document.getElementById("myAudio");
	function play() { 
		audio.play();
		audio.volume=0.1;
	}	
</script>

</body>
</html>