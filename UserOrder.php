  <?php
    session_start();
    require_once('dbconnect.php');
    if (!isset($_SESSION['user'])) {
        header("Location: logout.php");
    }

    $userData = $db->users->findOne( array('_id'=>$_SESSION['user']));

    function get_Categories($db){
        $result = $db->Categories->find(array());
        $recent_Categories = iterator_to_array($result);
        return $recent_Categories;
    }

    function get_Dishes($db){
        $result = $db->Dishes->find(array());
        $recent_Dishes = iterator_to_array($result);
        return $recent_Dishes;
    }
           
?>
<html> 
	<head>
		<title>FOOD ORDER FORM</title>
		<link rel="stylesheet" type="text/css" href="orderstyle.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href='https://fonts.googleapis.com/css?family=Rubik Wet Paint' rel='stylesheet'>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<style>
			h3 {
				font-family: 'Algerian';
				text-align: center;
				padding: 20px;
				padding-bottom: 30px;
			}
			
			input[type=text] {
			  width: 50%;
			  margin-bottom: 20px;
			  padding: 13px;
			  border: 1px solid #ccc;
			  border-radius: 3px;
			  mix-blend-mode: difference;
				font-size: 16px;
			}

			label {
			 font-size: 20px;
			  margin-bottom: 10px;
			  display: block;
			}
			
			.py {
				margin: 200px;
				border-style: none!important;
				text-align: center;
			}
			
			#payment {
				width: 1400px;
/*				height: 2150px;*/
				padding: 100px;
				border-style: none!important;
				margin-top: 0px;
				padding: auto;
				text-align: center;
				display: none;
				padding-top: 0px;
			}
			
			.btn {
				display: block;
				width: 150px;
				height: 60px;
				background: rgba(0,0,0,0.7) url(images/purple.jpg);
				background-blend-mode: color-dodge;
				color: white;
				font-family: 'Algerian';
				margin: auto;
			}
			
			.btn2 {
				display: block;
				width: 220px;
				height: 80px;
				background: rgba(0,0,0,0.7) url(images/picture3.jpeg);
				background-blend-mode: overlay;
				background-position: center;
				background-size: cover;
				color: black;
				font-family: 'Rubik Wet Paint';
				color: transparent;
				-webkit-text-stroke-width: 1px;
				-webkit-text-stroke-color: #FFF;
				margin: auto;
				padding: 1px 2px;
				font-size: 30px;
				font-weight: bolder;
				margin-top: 30px;
				letter-spacing: 2px;
			}
			
			.btn2:hover {
				background-blend-mode: normal;
			}
			
			.l {
				font-family: 'Algerian';
				font-size: 30px;
				padding-left: 7px;
			}
			
			div {
				border-style: none;
				margin: auto;
				padding-top: 0px;
			}
			
		</style>
	</head>
	
	<body>
		<iframe src="header.html"></iframe>
		<form name="tblform" id="form1" action="OrderSubmit.php" method="POST">
			<table width="80%">
				<?php 
					$Categories = get_Categories($db);
					foreach($Categories as $category) {
						if($category['Category_Name'] != "Breakfast"){
						echo '<tr style="background-color: '.$category['color'].';">
							<th rowspan="10" style="background-color: black;">
								<img style = "object-fit:cover; width: 350px; height: 250px;border: solid 2px  '.$category['color'].';" src="BackendImages/'.$category['Category_Image'].'">
							</th>
							<th>'.$category['Category_Name'].'</th>
							<th>Price</th>
							<th>Quantity</th> 
						</tr>';
						$Dishes = get_Dishes($db);
                    	foreach($Dishes as $Dish) {
							if($Dish['Dish_Category_Name']==$category['Category_Name']){
								echo '<tr> 
									<td><input type="hidden" name="Dishname:'.$Dish['Dish_Name'].'" value="'.$Dish['Dish_Name'].'">'.$Dish['Dish_Name'].'</td> 
									<td><input type="hidden" name="Dishprice:'.$Dish['Dish_Name'].'" value='.$Dish['Dish_Price'].'>'.$Dish['Dish_Price'].'$</td>
									<td><input type="number" value="0" min="0" max="20" name="DishQ:'.$Dish['Dish_Name'].'"></td>
								</tr >';
							}
						}
							echo '<tr style="column-span: all"></tr>';
							echo '<tr style="column-span: all"></tr>';
							echo '<tr style="column-span: all"></tr>';
							echo '<tr style="column-span: all"></tr>';
							echo '<tr style="column-span: all"></tr>';
							echo '<tr style="column-span: all"></tr>';
							echo '<tr style="column-span: all"></tr>';
							echo '<tr style="column-span: all"></tr>';
							echo '<tr style="column-span: all"></tr>';
							echo '<tr style="column-span: all"></tr>';
						}
					}

					echo '<tr>
							<td></td> 
							<td><input type="submit" class="button" id="submitBtn" value="Create Bill" onclick="createBill()"></td>
							<td><input type="reset" class="button" value="Clear"></td>
						</tr>';
				?>
			</table>
		</form>	
		
		<div id="Bill">
			
		</div>
		<main>
		</main>
		<section id="payment">
			<form id="infoform" action="OrderSubmit.php" class="pay" method="post">
				<h3>Delivery Address</h3>
				<label for="fname"><i class="fa fa-user"></i> Full Name</label>
				<input type="text" id="fname" name="firstname" placeholder="John M. Doe" required>
				<label for="email"><i class="fa fa-envelope"></i> Email</label>
				<input type="text" id="email" name="email" placeholder="john@example.com" required>
				<label for="phone"><i class="fa fa-phone"></i> Phone</label>
				<input type="text" id="phone" name="phone" required>
				<label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
				<input type="text" id="adr" name="address" placeholder="542 W. 15th Street" required>
				<label for="city"><i class="fa fa-institution"></i> City</label>
				<input type="text" id="city" name="city" placeholder="New York" required>
				
				<br>
				<br>
				<label form="payment" class="fa fa-money"><span class="l">Payment Method</span></label>
				
				<br>
				
				<span class="rd">
					<input type="radio" id="cash" name="payment" value="cash" checked>
					<label for="cash">Cash on Delivery</label>
				</span>
				<span class="rd2">
					<input type="radio" id="creditcard" name="payment" value="creditcard">
					<label for="creditcard">Credit Card</label>
				</span>
					
				<div id="creditcard-form" style="display:none">
					<label for="fname" class="l">Accepted Cards</label>
					<i class="fa fa-cc-visa" style="color:navy;"></i>
					<i class="fa fa-cc-amex" style="color:blue;"></i>
					<i class="fa fa-cc-mastercard" style="color:red;"></i>
					<i class="fa fa-cc-discover" style="color:orange;"></i>
					<br>
					<br>
					<iframe id="my-iframe" src="creditcard.html" style="width: 100%; height: 100%; border-style: none;"></iframe>
				</div>

				<input type="submit" value="Checkout" id="finalSubmit" class="btn2">
			</form>
		<script>
			const form1 = document.querySelector('form[name="tblform"]');
			 
			const submitBtn = document.querySelector('#submitBtn');
			
			submitBtn.addEventListener('click', function(event) {
				event.preventDefault(); // prevent form submission

				  // Prevent the form from being submitted in the traditional way
				  
			  	
				createBill()
			});
			
			function createBill() {
				const form2 = document.getElementById('infoform');
				var main = document.querySelector("main"); // Get the main element
				main.style.display = "block"; // Set the display property to "block"

			  // Get all the rows in the table
			  var rows = document.querySelectorAll("table tr");

			  // Loop through each row and get the dish name and price
			  var dishes = [];
			  var sum = 0;
			  for (var i = 0; i < rows.length; i++) {
				var row = rows[i];
				var inputs = row.getElementsByTagName("input");
				if (inputs.length == 3) {
				  var name = inputs[0].value;
				  var price = inputs[1].value;
				  var quantity = inputs[2].value;
				  var total = price * quantity;
				  sum += total;
				  dishes.push({ name: name, price: price, quantity: quantity, total: total });
				}
			  }
				
			  if (dishes.length > 0) {
				  
				var dishes2 = [];
				
				for (var i = 0; i < dishes.length; i++) {
					var dish1 = dishes[i];
					if (dish1.quantity > 0) {
					  dishes2.push({ name: dish1.name, quantity: dish1.quantity});
					}
				}
				dishes2.push({total: sum})
				  
				if(dishes2.length > 0){
			   		var dishesJson = JSON.stringify(dishes2);
					var myinput = document.createElement('input');
					myinput.type = 'hidden';
					myinput.name = 'dishes';
					myinput.value = dishesJson;
					form2.appendChild(myinput);
				}
			  var html = "<table class=\"t1\">";
			  html += "<tr><th class=\"th1\">Dish name</th><th class=\"th1\">Price</th><th class=\"th1\">Quantity</th><th class=\"th1\">Total</th></tr>";
			  for (var i = 0; i < dishes.length; i++) {
				var dish = dishes[i];
				if (dish.quantity > 0) {
				  html +=
					"<tr class=\"tr1\"><td class=\"td1\">" +
					dish.name +
					"</td><td class=\"td1\">" +
					dish.price +
					"$</td><td class=\"td1\">" +
					dish.quantity +
					"</td><td class=\"td1\">" +
					dish.total +
					"$</td></tr>";
				}
			  }
			  // Add a row to display the sum
			  html += "<tr class=\"tr2\"><td class=\"td1\" colspan='2'><strong>Total</strong></td><td class=\"td1\" colspan='5'><strong>" + sum + "$</strong></td></tr>";
			  html += "</table>";

			  var billSection = document.createElement("section"); // Create a new section element
			  billSection.id = "BillSection"; // Set the ID of the new section element to "BillSection"
			  billSection.innerHTML = "<h2 class=\"b\">Your Bill</h2>" + html; // Set the HTML content of the new section element

			  var main = document.querySelector("main"); // Get the main element
			  var existingBillSection = document.querySelector("#BillSection"); // Check if a bill section already exists
			  if (existingBillSection) {
				main.replaceChild(billSection, existingBillSection); // Replace the existing bill section
			  } else {
				main.appendChild(billSection); // Append the new bill section
			  }

			  // Scroll to the new section element
			  billSection.scrollIntoView({ behavior: "smooth" });

			  // Create the button element
			  var submitBtn = document.createElement("button");
			  submitBtn.id = "bttn";
			  submitBtn.innerHTML = "Submit Order";
				
			  // Create the button element
			  var returnBtn = document.createElement("button");
			  returnBtn.id = "bttn";
			  returnBtn.innerHTML = "Return to Menu";

			  var csh = document.querySelector("#payment");
				
			  if(sum>0){
				  // Add an event listener to the button that submits the form
				  submitBtn.addEventListener("click", function () {
					// var form = document.querySelector('#tblform');
	//				form.submit();
					csh.style.display = 'block';
					csh.scrollIntoView({ behavior: 'smooth' });

				  });
			  }
			   returnBtn.addEventListener("click", function () {
				  // smooth return to top of current page
				  const scrollToTop = () => {
					const position = window.pageYOffset;
					if (position > 0) {
					  window.scrollTo(0, position - 80);
					  window.requestAnimationFrame(scrollToTop);
					}
				  };
				  scrollToTop();
				});

				
			  // Add the button to the new section element
			  billSection.appendChild(submitBtn);
			  billSection.appendChild(returnBtn);
			  
			
				
				const creditcardRadio = document.getElementById('creditcard');
				const cashRadio = document.getElementById('cash');
				const creditcardForm = document.getElementById('creditcard-form');

				creditcardRadio.addEventListener('change', function() {
					if (this.checked) {
						creditcardForm.style.display = 'block';
					} 

					else {
						creditcardForm.style.display = 'none';
					}
				});
				
				cashRadio.addEventListener('change', function() {
					if (this.checked) {
						creditcardForm.style.display = 'none';
					} 

					else {
						creditcardForm.style.display = 'block';
					}
				});
				    
				  const iframe = document.getElementById('my-iframe');
				  const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
				  const iframeForm = iframeDoc.getElementById('cardform');

//				  const form1 = document.getElementById('form1');
				 
				  const submitButton = document.getElementById('finalSubmit');

				  submitButton.addEventListener('click', e => {
					e.preventDefault(); // prevent the default form submission
					form2.submit();
					iframeForm.submit(); // submit the form inside the iframe
				  });
			  }
			}
			</script>	
		</section>
	</body>
</html >