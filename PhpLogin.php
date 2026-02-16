<?php 
    session_start();
    require_once('dbconnect.php');
     if(isset($_SESSION['user'])){
         header('Location: UserHome.php');
     }
	 if(isset($_SESSION['admin'])){
		header('Location: AdminHome.php');
	}
	
	if(isset($_GET['error'])){
		$message = $_GET['error'];
	}

	$acceptable_error_messages = array("Incorrect email or password", "Too many login attempts. Please try again later.","Account locked. Please try again later");

	if(isset($_GET['error'])) {
	  $error_message = $_GET['error'];
	  if(!in_array($error_message, $acceptable_error_messages)) {
		$error_message = "An error occurred. Please try again later.";
	  }
	}


?>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login In</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style(1).css">
	<link rel="stylesheet" href="neon.css">
	<link rel="stylesheet" href="slideshow.css">
	
	<style>
		.error {
				width: 500px;
				height: 40px;
				margin: 0px 0px;
				margin-top: -70px;
				background: rgba(255,255,255,0.6);
				font-size: 18px;
				padding: 8px 20px;
/*				color: white;*/
				position: absolute;
			}

		form label {
			font-family: Algerian;
		  	display: flex;
			margin-top: 20px;
		  	font-size: 28px; 
			mix-blend-mode: color-dodge;
			color: rgba(255,255,255,0.6);
			font-weight: bold;
			text-shadow: 2px 2px 15px white;
		}
		
		form {
			width: 400px;
			padding-left: 100px;
			padding-top: 40px;
		}
		
		form input {
		  	width: 100%;
		    padding: 7px;
		  	border: 1px solid #b6acbf;
		  	border-radius: 6px;
		  	outline: none;
			background-color: rgba(0,0,0,0.1);
			font-family: Papyrus;
			color: white;
		}
		
		input[type="submit"] {
			width: 70%;
			height: 35px;
			margin-top: 20px;
			border: none;
			background: linear-gradient(120deg, #b6acbf 0%, #232035 20%,#f34c56 80%);
			color: rgba(255,255,255,0.6);
			font-size: 18px;
			font-family: Papyrus;
			font-weight: bolder;
			mix-blend-mode: difference;
			cursor: pointer;
		}
		
		::placeholder {
			color: white;
			font-weight: bolder;
		}
		
		section img {
			float: left;
			width: 500px;
			height: 332px;
			margin-top: 40px;
			position: absolute;
			z-index: -1;
			overflow: hidden;
			opacity: 0.8;
			border-radius: 8px;
			border: 2px solid rgba(50,0,0,1);
			box-shadow: 0px 0px 50px 50px white;
			box-shadow: 0px 0px 50px 50px rgba(0,0,0,1);
			
		}
		
		.log {
			font-size: 50px;
			font-family: Papyrus;
			margin-top: 50px;
			justify-content: center;
		}
		
		.big {
			align-content: center;
			justify-content: center;
			padding: 10px 50px;
			text-shadow: 5px 5px #f24d55;
			max-width: 500px;
		}
		
		.log::before {
			  content: "";
			  background: linear-gradient(120deg, #c1363a 10%, #1f1b32 70%);
			  position: absolute;
			  height: 100%;
			  width: 100%;
			  z-index: -1;
			  filter: blur(100px);
			}
		
		.small {
			font-size: 15px;
			text-shadow: 2px 2px 15px white;
			margin-top: 10px;
		}
		
		mark {
			background: linear-gradient(120deg, #b6acbf 0%, #232035 20%,#f34c56 80%);
			mix-blend-mode: difference;
			color: #b6acbf;
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
        <a href="homepage.html">home</a>
        <a href="loginPage.html">menu</a>
        <a href="About.html"  target="_blank">About</a>
        <a href="Reservation.html">Reservation</a>
        <a href="guestreview.html">review</a>
        <a href="loginPage.html">order</a>
    </nav>

</header>

<!-- header section ends -->

<!-- home section starts  -->

<section class="home" id="home">

    <div class="content">
		
		<?php 
			if (isset($_GET['error'])) { ?>
				<p class="error" id="errorMsg"><?php echo $error_message; ?></p>
				<?php } ?>
		
		<form action="submit_login.php" method="post">
			
			<label for="email">Email</label>
				<input type="email" name="email" placeholder="John.Smith@outlook.com" required/>
        	
			<label for="password">Password</label>
				<div style="display: flex;">
					<input name="password" autocomplete="current-password" type="password" placeholder="Password" id="password" required> <i class="far fa-eye" id="togglePassword" style="padding-left: 7px; margin-right: -30px; margin-top: 12px; color: white; cursor: pointer;"></i>
				</div>

        	<input type="submit" value="Submit" />
			
      	</form>
	</div>
		<img src="images/purple.jpg">	
	
	<div class="log">
		<center>
			<p class="big"><mark>Wanna Order?</mark></p>
			<p class="big">Make sure you're logged in!</p>
			<p class="small">
				<span style="mix-blend-mode: luminosity;">Don't have an account? </span><a href="phpSignup.php" style="color: #1f1b32;">Sign Up Here</a>
			</p>
		</center>
	</div>
	
</section>

<!-- home section ends -->

<!-- footer section  -->

<section class="footer">

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
    <img src="images/burgerbomb.gif" alt="">
</div>-->


<!-- custom js file link  -->
<script src="script.js"></script>
<script src="js.js"></script>

<script>
	const togglePassword = document.querySelector('#togglePassword');

	  togglePassword.addEventListener('click', function (e) {
		// toggle the type attribute
		const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
		password.setAttribute('type', type);
		// toggle the eye slash icon
		this.classList.toggle('fa-eye-slash');
	});

</script>

</body>
</html>

