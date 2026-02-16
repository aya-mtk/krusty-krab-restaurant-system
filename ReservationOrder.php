<?php
    session_start();
    require_once('dbconnect.php');
    if (!isset($_SESSION['user'])) {
        header("Location: logout.php");
    }

    $UserData = $db->users->findOne( array('_id'=>$_SESSION['user']));

	$id =$UserData['_id'];
	$acceptable_themes = array("Wedding.jpeg","table.jpg","Birthday.jpeg", "Halloween.jpg" , "Christmas.webp");
	
	$acceptable_error_messages = array("Reservation was successfully inserted","Error occurred while inserting reservation","Already Reserved, try with a different time!");

	if(isset($_GET['message'])){
		$message = $_GET['message'];
	  if(!in_array($message, $acceptable_error_messages)) {
		$message="An error occured, please try again later!";
	  }		
	}

	if(isset($_GET['theme'])){
		$theme = $_GET['theme'];
	  if(!in_array($theme, $acceptable_themes)) {
		$theme="table.jpg";
	  }		
	}
?>


<html>
	<head>
		<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src = "https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>
		<script src = "Slideshow2.js"></script>
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

		<!-- custom css file link  -->
		<link rel="stylesheet" href="style(1).css">
		<link rel="stylesheet" href="slideshow.css">
		<link rel="stylesheet" href="slideshow1.css">
		<style>
			body{
			  	background: #111 <?php  if(isset($_GET['theme'])){  ?>url(images/<?php echo $theme; ?>)<?php } ?>;
				background-position: center;
				<?php  if($theme=="table.jpg"){  ?>
					background-blend-mode: color-dodge;
				<?php } ?>
				background-repeat: no-repeat;
				background-size: cover;
			}

		<style>
			@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700&display=swap');

			:root{
			  --red:#ff3980;
			}

			*{
			  margin:0; padding:0;
			  box-sizing: border-box;
			  outline: none; border:none;
			  text-decoration: none;
			  text-transform: capitalize;
			}

			*::selection{
			  background:var(--red);
			  color:#fff;
			}

			html{
			  font-size: 62.5%;
			  overflow-x: hidden;
			  scroll-behavior: smooth;
			  scroll-padding-top: 6rem;  
			}

			iframe {
				width: 100%;
				height: 12%;
				position: absolute;
				z-index: 2;
			}
			
			.theme {
				width: 700px;
				height: 50px;
				margin: 80px 60px;
				margin bottom: 0px;
				background: rgba(255,255,255,0.6);
				font-size: 18px;
				padding: 8px 20px;
			}
			
			p {
				font-size: 18px;
				background: rgba(255,255,255,0.6);
				padding: auto;
/*				margin bottom: 0px;*/
			}
		</style>
	</head>

	<body>
		<iframe src="header.html"></iframe>
		<section>
			<?php 	
				if (isset($_GET['message'])) { ?>
					<p class="theme" id="errorMsg"><?php echo $message; ?></p>

				<?php } ?>
			<form <?php if (isset($_GET['message'])) { ?> style="margin-top:-50px;" <?php } ?>  action="ReservationSubmit.php?theme=<?php echo $theme; ?>" id="reservationForm" method="POST">
				
				<label for="fullname">Full Name</label>
				<input type="text" name="fullname" id="fullname" required>

				<label for="email">Email</label>
				<input type="email" name="email" id="email" required>

				<label for="phone">Telephone Number</label>
				<input type="tel" name="phone" id="phone" required>

				<label for="date">Date</label>
				<input type='date' name='date' id='date' required>

				<label for="startTime">Start Time</label>
				<input type="time" id="startTime" name="startTime" min="08:00" max="23:59" required>

				<label for="endTime">End Time</label>
				<input type="time" id="endTime" name="endTime" min="08:00" max="23:59" required>

				<label for="numGuests">No. of guests</label>
				<input type="number" name="numGuests" id="numGuests" min="1" required>

				<label for="comments">Special Requests</label>
				<textarea name="comments" id="comments" cols="50" rows="2"></textarea>

				<input type="submit" value="Confirm Reservation" id="submitReservation">
			</form>

		</section>
		<script>
		  // Get today's date
		  var today = new Date().toISOString().split('T')[0];

		  // Set the minimum date for the input field
		  document.getElementById("date").setAttribute("min", today);


		  function checkForm() {
			var startTime = document.getElementById("startTime").value;
			var endTime = document.getElementById("endTime").value;

			if (startTime >= endTime) {
			  alert("Start time must be earlier than end time.");
			  return false;
			}

			return true;
		  }

		  // Add an event listener to the form
		  document.getElementById("reservationForm").addEventListener("submit", function(event) {
			if (!checkForm()) {
			  event.preventDefault(); // prevent the form from submitting
			  alert("oops");
			}
		  });
			
			var fm = document.getElementById("reservationForm");
		  // Remove the message parameter from the URL and hide the theme message after 5 seconds
		<?php 
				
		if (isset($_GET['message'])) { ?>
		  setTimeout(function() {
			history.replaceState(null, '', 'http://localhost/backend/ReservationOrder.php?theme=<?php echo $theme; ?>');
			$('#errorMsg').hide();
			fm.style.marginTop = "80px";
		  }, 5000);
			<?php } ?>
		</script>

	</body>
</html>