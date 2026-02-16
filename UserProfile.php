<?php
    session_start();
    require_once('dbconnect.php');
    if (!isset($_SESSION['user'])) {
        header("Location: logout.php");
    }
    $userData = $db->users->findOne( array('_id'=>$_SESSION['user']));

	$acceptable_error_messages = array("Password changed","Weak Password");

	if(isset($_GET['message'])) {
	  $error_message = $_GET['message'];
	  if(!in_array($error_message, $acceptable_error_messages)) {
		$error_message = "Nice Try";
	  }
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style(1).css">

	<link rel="stylesheet" href="slideshow.css">
	
	<style>

		form label {
			font-family: Algerian;
		  	display: flex;
			margin-top: 20px;
		  	font-size: 28px; 
			mix-blend-mode: difference;
			color: white;
		}
		
		form {
			width: 400px;
			padding-left: 100px;
			padding-top: 40px;
		}
		
		form input {
		  	width: 100%;
		    padding: 7px;
		  	border: 1px solid #1F51FF;
		  	border-radius: 6px;
		  	outline: none;
			mix-blend-mode: color-burn;
			font-family: Papyrus;
		}
		
		input[type="submit"] {
			width: 70%;
			height: 35px;
			margin-top: 20px;
			border: none;
			background: linear-gradient(120deg, #49c1a2 0%, #1F51FF 100%);
			color: white;
			font-size: 18px;
			font-family: Papyrus;
			font-weight: bolder;
			cursor: pointer;
		}
		
		::placeholder {
			color: black;
			font-weight: bolder;
		}
		
		video {
			float: left;
			width: 500px;
			height: 888.89px;
			margin-top: 40px;
			position: absolute;
			z-index: -1;
			background-blend-mode: screen;
			overflow: hidden;
			
		}
		
		.sign {
			font-size: 50px;
			font-family: Papyrus;
			margin-right: 70px;
			margin-top: 50px;
			justify-content: center;
		}
		
		.sign p {
			align-content: center;
			justify-content: center;
			padding: 10px 0px;
		}
		
		.sign img {
			width: 332px;
			height: 332px;
			z-index: -1;
			position: absolute;
			margin-left: -90px;
			margin-top: -90px;
		}
		
		.sign::before {
			  content: "";
			  background: linear-gradient(120deg, #Bf953f 0%, #AA771C 100%);
			  position: absolute;
			  height: 100%;
			  width: 100%;
			  z-index: -1;
			  filter: blur(100px);
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
        <a href="UserHome.php">home</a>
        <a href="UserMenuPage.php">menu</a>
        <a href="About.html"  target="_blank">About</a>
        <a href="ReservationPage.php">Reservation</a>
        <a href="phpReview.php">Review</a>
        <a href="mainOrderPage.html">order</a>
		<a href="logout.php">Logout</a>
		<a href="UserProfile.php"><img width="20px" height="20px" style="width: 50px; height: 50px; vertical-align: middle; position: fixed; top: 8px;" src="images/mrkrabsmirky.webp"></a>
    </nav>

</header>

<!-- header section ends -->

<section class="home" id="home">

    <div class="content">
		
		<div style="display: flex;">
		
		<form action="userpass.php" method="post">
			<label for="password">New Password</label>
			
			<div style="display: flex;">
				<input name="password" autocomplete="current-password" type="password" placeholder="Password" id="password" required> 
				<i class="far fa-eye" id="togglePassword" style="padding-left: 7px; margin-right: -30px; margin-top: 12px; color: darkblue; cursor: pointer;"></i>
			</div>
			
			<label>Confirm Password</label>
			<div style="display: flex;">
				<input name="password" autocomplete="current-password" type="password" placeholder="Confirm Password" id="confirm_password"/> 
			</div>
			
        	<input type="submit" value="Submit" name="submit"/>
      	</form>

			<div style="display: grid; height:100px;">
				<i class="fa fa-volume-up fa-3x" onclick="disableMute()" style="mix-blend-mode: difference; color: #FFF; padding-left: 50px; margin-top: 150px; margin-right: -30px; cursor: pointer;"></i>
				
				<i class="fa fa-volume-mute fa-3x" onclick="enableMute()" style="mix-blend-mode: difference; color: #FFF; padding-left: 60px; margin-top: 20px; margin-right: -20px; cursor: pointer;"></i>
			</div>

		
		</div>
	
	</div>
		<video id="music" autoplay loop muted>
        	<source src="images/glass.mp4" type="video/mp4">
        </video>	
	
	<div class="sign">
		<center>
            <?php 
			if (isset($_GET['message'])) { ?>
				<p class="error" id="errorMsg"><?php echo $error_message; ?></p>
			<?php 
									   } else { ?>
            <p>Welcome</p>
			<p><?php echo $userData['fname']." ".$userData['lname']; ?></p>
			<?php } ?>
		</center>
	</div>
	
</section>

	<p style="color:#111;">.</p>
	<p style="color:#111;">.</p>
	
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

<!-- loader  --
<div class="loader-container">
    <img src="images/fishoader1.gif" alt="">
</div>


<!-- custom js file link  -->
<script src="script.js"></script>
<script src="js.js"></script>
<script>
	var audio = document.getElementById("myAudio");
	function play() { 
		audio.play();
		audio.volume=0.1;
	}	
	var eye =  document.getElementById("togglePassword");
	eye.addEventListener("click",myFunction);
	
	var password = document.getElementById("password");
   var confirm_password = document.getElementById("confirm_password");

	function validatePassword(){
	  if(password.value != confirm_password.value) {
		  
		confirm_password.setCustomValidity("Passwords Don't Match");
	  } else {
		confirm_password.setCustomValidity('');
	  }
	}

	password.onchange = validatePassword;
	confirm_password.onkeyup = validatePassword;
	
	const togglePassword = document.querySelector('#togglePassword');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});

	function myFunction() {
	  var x = document.getElementById("confirm_password");
	  if (x.type === "password") {
		x.type = "text";
	  } else {
		x.type = "password";
	  }
		
	}
	
	var vid = document.getElementById("music");

	function disableMute() { 
		vid.muted = false;
		//vid.volume=0.1;
	} 
	
	function enableMute() { 
  		vid.muted = true;
	}
	
</script>

</body>
</html>