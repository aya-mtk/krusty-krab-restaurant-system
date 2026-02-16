<html>
	<head>
		<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src = "https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>
		<script src = "Slideshow2.js"></script>
		<link rel = "stylesheet" href = "Slideshow1.css">
		<link rel = "stylesheet" href = "Slideshow.css">
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

			body{
			  background:#111;
			}
			iframe {
				width: 100%;
				height: 12%;
				position: absolute;
				z-index: 2;
			}

		</style>
	</head>

	<body>
		<iframe src="header.html"></iframe>
		
		<main class="main-content" onmouseover="play()" onmousemove="play()" onmouseenter="play()" onmouseout="play">
		  <section class="slideshow" onmouseover="play()" onmousemove="play()" onmouseenter="play()" onmouseout="play">
			<div class="slideshow-inner"> 
			  <div class="slides">
				<div class="slide is-active ">
				  <div class="slide-content">
					<div class="caption">
					  <div class="title" onmouseover="play()" onmousemove="play()" onmouseenter="play()" onmouseout="play"> Reserve your Table!</div>
					  <div class="text">
						<p>Never miss your chance to eat with the diving sharks!</p>
					  </div> 
					  <a href="ReservationOrder.php?theme=table.jpg" class="btn">
						<span class="btn-inner" onmouseover="play()" onmousemove="play()" onmouseenter="play()" onmouseout="play">LEARN MORE</span>
					  </a>
					</div>
				  </div>
				  <div class="image-container" onmouseover="play()" onmousemove="play()" onmouseenter="play()" onmouseout="play" > 
					<img src = "images/pic21.webp" alt="" class="image" />
				  </div>
				</div>
				<div class="slide">
				  <div class="slide-content">
					<div class="caption">
					  <div class="title">Book your Wedding!</div>
					  <div class="text">
						<p>Make it a day of heaven.. Make it a realm of blue passion</p>
					  </div> 
					  <a href="ReservationOrder.php?theme=Wedding.jpeg" class="btn">
						<span class="btn-inner">LEARN MORE</span>
					  </a>

					</div>
				  </div>
				  <div class="image-container" onmouseover="play()" onmousemove="play()" onmouseenter="play()" onmouseout="play">
					<img src= "images/pic34.jpg" alt="" class="image" />
				  </div>
				</div>
				<div class="slide">
				  <div class="slide-content">
					<div class="caption">
					  <div class="title">Celebrate your birthday!</div>
					  <div class="text">
						<p>Happy Birthday to you.. Happy Birthday to you..</p>
					  </div> 
					  <a href="ReservationOrder.php?theme=Birthday.jpeg" class="btn">
						<span class="btn-inner">LEARN MORE</span>
					  </a>
					</div>
				  </div>
				  <div class="image-container" onmouseover="play()" onmousemove="play()" onmouseenter="play()" onmouseout="play">
					<img src= "images/cake3.jpeg" alt="" class="image" />
				  </div>
				</div>
				<div class="slide">
				  <div class="slide-content">
					<div class="caption">
					  <div class="title">Spooky Season</div>
					  <div class="text">
						<p>Keep the candy.. I'll take your breath.</p>
					  </div> 
					  <a href="ReservationOrder.php?theme=Halloween.jpg" class="btn">
						<span class="btn-inner">LEARN MORE</span>
					  </a>
					</div>
				  </div>
				  <div class="image-container" onmouseover="play()" onmousemove="play()" onmouseenter="play()" onmouseout="play"> 
					<img src= "images/spooky1.jpg" alt="" class="image" />
				  </div>
				</div>
				  <div class="slide">
				  <div class="slide-content">
					<div class="caption">
					  <div class="title">Christmas Eve</div>
					  <div class="text">
						<p>Hymn your own lullaby</p>
					  </div> 
					  <a href="ReservationOrder.php?theme=Christmas.webp" class="btn">
						<span class="btn-inner">LEARN MORE</span>
					  </a>
					</div>
				  </div>
				  <div class="image-container" onmouseover="play()" onmousemove="play()" onmouseenter="play()" onmouseout="play">
					<img src= "images/chris5.jpeg" alt="" class="image" />
				  </div>
				</div>
			  </div>
			  <div class="pagination">
				<div class="item is-active"> 
				  <span class="icon">1</span>
				</div>
				<div class="item">
				  <span class="icon">2</span>
				</div>
				<div class="item">
				  <span class="icon">3</span>
				</div>
				<div class="item">
				  <span class="icon">4</span>
				</div><div class="item">
				  <span class="icon">5</span>
				</div>
			  </div>
			  <div class="arrows">
				<div class="arrow prev">
				  <span class="svg svg-arrow-left">
					<svg version="1.1" id="svg4-Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="14px" height="26px" viewBox="0 0 14 26" enable-background="new 0 0 14 26" xml:space="preserve"> <path d="M13,26c-0.256,0-0.512-0.098-0.707-0.293l-12-12c-0.391-0.391-0.391-1.023,0-1.414l12-12c0.391-0.391,1.023-0.391,1.414,0s0.391,1.023,0,1.414L2.414,13l11.293,11.293c0.391,0.391,0.391,1.023,0,1.414C13.512,25.902,13.256,26,13,26z"/> </svg>
					<span class="alt sr-only"></span>
				  </span>
				</div>
				<div class="arrow next">
				  <span class="svg svg-arrow-right">
					<svg version="1.1" id="svg5-Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="14px" height="26px" viewBox="0 0 14 26" enable-background="new 0 0 14 26" xml:space="preserve"> <path d="M1,0c0.256,0,0.512,0.098,0.707,0.293l12,12c0.391,0.391,0.391,1.023,0,1.414l-12,12c-0.391,0.391-1.023,0.391-1.414,0s-0.391-1.023,0-1.414L11.586,13L0.293,1.707c-0.391-0.391-0.391-1.023,0-1.414C0.488,0.098,0.744,0,1,0z"/> </svg>
					<span class="alt sr-only"></span>
				  </span>
				</div>
			  </div>
			</div> 
		  </section>
		</main>
		
		<!-- scroll top button  -->
		<a href="#home" class="fas fa-angle-up" id="scroll-top"></a>


		<audio id="myAudio" muted autoplay loop>
		  <source src="Spooky%20Season.mp3" type="audio/ogg">
		  Your browser does not support the audio element.
		</audio>
		
		<script>
			var audio = document.getElementById("myAudio");
			function play() {
				audio.muted= false;
				audio.play();
				audio.volume=0.3;
			}
		</script>
	</body>

</html>