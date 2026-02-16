<?php
    session_start();
    require_once('dbconnect.php');
    if (!isset($_SESSION['admin'])) {
        header("Location: logout.php");
    }

//functions
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

if(isset($_GET['message'])){
	$message = $_GET['message'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>menu</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<link href='https://fonts.googleapis.com/css?family=Rubik Wet Paint' rel='stylesheet'>
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src = "https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style(1).css">
    <link rel="stylesheet" href="neon.css">
	<link rel="stylesheet" href="slideshow.css">

    <style>
        .Container_box {
            height: 470px;
            border: 5px solid black;
			background: rgba(0,0,0,0.5) url(images/picture12.jpeg);
			background-blend-mode: overlay;
        }

        .Add_Category {
            display: none;
        }

        .Update_Category {
            display: none;
        }

        .Add_Dish {
            display: none;
        }

        .Update_Dish {
            display: none;
        }

        .selection {
            height: 65px;
			border: 4px solid;
			border-image: linear-gradient(120deg, #FF6B6B 0%, #E87C6C 25%, #DB8E6B 50%, #CFA06A 75%, #C3B46A 100%) 1;
        }

        form {
            max-height: 400px;
        }

        label {
           font-family: papyrus; 
           font-size: 20px;
           display: block;
           color: white;
           font-weight: bold;
           padding: 20px;
		   padding-bottom: 10px;
        }

        input, select, textarea {
            margin: 0px 20px;
            background-color: transparent;
            border: 2px solid black;
            padding: 5px;
        }

        option {
            background-color:#111;
            color: white; 
            font-family:  "Palatino Linotype"; 
        }

        input[type="submit"] {
			margin-top: 20px;
            margin-left: 20px;
            padding: 3px 10px;
            display: block;
			background: linear-gradient(120deg, #FF6B6B 0%, #E87C6C 25%, #DB8E6B 50%, #CFA06A 75%, #C3B46A 100%);

			color: white;
			font-size: 18px;
			font-family: Papyrus;
			font-weight: bolder;
			cursor: pointer;
		}
        ::placeholder { 
            color: darkgray;
            opacity: 0.2;
            font-family: Papyrus;
            padding: 3px 10px;
        }

        ul {
            list-style-type: none;
        }

        li {
            float:left;
            color: white;
			color: #FFA500;
            text-align: center;
            font-weight: bold;
            margin: 15px 60px;
            cursor: pointer;
            font-size: 20px;
            font-family: Algerian;
        }

        li:hover {
/*            color: crimson;*/
			color: #C8705E;

            font-family: Algerian;
        }
		
		.error {
			font-size: 30px;
			font-family: 'Rubik Wet Paint';
			color: transparent;
			-webkit-text-stroke-width: 1px;
			-webkit-text-stroke-color: #FFF;
			background: rgba(0,0,0,0.4) url(images/picture10.jpeg);
			background-position: center;
			background-blend-mode: overlay;
			margin-bottom: 10px;
			padding: 10px;
			text-align: center;
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
        <a href="AdminHome.php">home</a>
        <a href="#">menu</a>
        <a href="adminReservation.php">Reservation</a>
        <a href="adminReview.php">Review</a>
		<a href="logout.php">Logout</a>
		<a href="AdminProfile.php"><img width="20px" height="20px" style="width: 50px; height: 50px; vertical-align: middle; position: fixed; top: 8px;" src="images/mrkrabsmoneybag.webp"></a>
    </nav>

</header>


<!-- speciality section starts  -->

<section class="speciality" id="speciality">

    <h1 class="heading" style="margin-top: -10px; color:#111;"> our <span style="color:#111;">speciality</span> </h1>
	<?php 
			if (isset($_GET['message'])) { ?>
				<p class="error" id="errorMsg"><?php echo $message; ?></p>
			<?php } ?>
    <div class="selection">
        <ul>
            <li onclick="display('Add_Category',['Update_Category','Add_Dish','Update_Dish'])">Add Category</li>

            <li onclick="display('Update_Category',['Add_Category','Add_Dish','Update_Dish'])">Update Category</li>
                
            <li onclick="display('Add_Dish',['Add_Category','Update_Category','Update_Dish'])">Add Dish</li>

            <li onclick="display('Update_Dish',['Update_Category','Add_Dish','Add_Category'])">Update Dish</li>
        </ul>
    </div>

    <div class="Container_box">
<!--Add Category-->
        <div class="Add_Category" id="Add_Category">
            <form method="post" action="modify_menu.php">
                <label for="add_Category_Name">Insert Category Name:</label>
                <input type="text" name="add_Category_Name">
                
                <label for="add_Category_Icon">Insert Category icon:</label>
                <input type="file" name="add_Category_Icon">

                <label for="add_Category_Image">Insert Category image:</label>
                <input type="file" name="add_Category_Image">
				
				<label for="add_Category_Quote">Select Category Quote:</label>
				<select name="add_Category_Quote">
				  <option value=""> ---Choose Quote---</option>
				  <option value="Shrimps are: low in calories, high in protein">Low in calories, High in protein</option>
				  <option value="Japan is NOT the birthplace of sushi">Japan is NOT the birthplace of sushi</option>
				  <option value="Steak Pairs Extremely Well with Both Wine and Beer!">Steak Pairs Extremely Well with Both Wine and Beer!</option>
				  <option value="Have you tried our Combo RiceNWine?">Have you tried our Combo RiceNWine?</option>
				  <option value="Make sure to check our various salad dishes..">Check our various salad dishes..</option>
				  <option value="Don't forget to leave us a review!">Don't forget to leave us a review!</option>
				  <option value="Our Ingredients are all fresh!">Our Ingredients are all fresh!</option>
				  <option value="Pizza is not a 'trend' it's a way of life!">Pizza is not a 'trend' it's a way of life!</option>
				  <option value="Start Your meal with appetizers!">Start Your meal with appetizers!</option>
				  <option value="Time for Dessert!">Time for Dessert!</option>
				  <option value="Know any Pasta Addict?">Know any Pasta Addict?</option>
				  <option value="Show your family You Truly love them">Show your family You Truly love them</option>
				  <option value="Can't wait to Dip'n">Can't wait to Dip'n</option>
				  <option value="Check the prizes inside each happy meal">Check the prizes inside each happy meal</option>
				  <option value="Our Wine is sublime.">Our Wine is sublime.</option>
				</select>

				
                <input type="submit" value="Add Category"/>
            </form>
        </div>
<!--Update Category-->
        <div class="Update_Category" id="Update_Category">
            <form method="post" action="modify_menu.php">
                <div style="display: flex">
                    <div style="display: block">
                        <label for="old_Category_Name">Select Category to update:</label>
                        <select id = "myCategoryList" name="old_Category_Name" required>  
                            <option value=""> ---Choose Category--- </option>  
                            <?php
                                $Categories = get_Categories($db);
                                foreach($Categories as $category) {
                                    echo '<option value="'.$category['Category_Name'].'">'.$category['Category_Name'].'</option>';
                                }
                            ?>  
                        </select>  
                    </div>
                    <div style="display: block">
                        <label for="update_Category_Name">Update Category Name:</label>
                        <input type="text" name="update_Category_Name" placeholder="New Category Name">
                    </div>
                </div>
                <br><br>
                <div style="display: flex;">
                    <div style="display: block">
                        <label for="update_Category_Icon">Update Category icon:</label>
                        <input type="file" name="update_Category_Icon">
                    </div>
                    <div style="display: block">
                        <label for="update_Category_Image">Update Category image:</label>
                        <input type="file" name="update_Category_Image">
                    </div>
                </div>
				<label for="update_Category_Quote">Update Category Quote:</label>
				<select name="update_Category_Quote">
				  <option value=""> ---Choose Quote---</option>
				  <option value="Shrimps are: low in calories, high in protein">Low in calories, High in protein</option>
				  <option value="Japan is NOT the birthplace of sushi">Japan is NOT the birthplace of sushi</option>
				  <option value="Steak Pairs Extremely Well with Both Wine and Beer!">Steak Pairs Extremely Well with Both Wine and Beer!</option>
				  <option value="Have you tried our Combo RiceNWine?">Have you tried our Combo RiceNWine?</option>
				  <option value="Make sure to check our various salad dishes..">Check our various salad dishes..</option>
				  <option value="Don't forget to leave us a review!">Don't forget to leave us a review!</option>
				  <option value="Our Ingredients are all fresh!">Our Ingredients are all fresh!</option>
				  <option value="Pizza is not a 'trend' it's a way of life!">Pizza is not a 'trend' it's a way of life!</option>
				  <option value="Start Your meal with appetizers!">Start Your meal with appetizers!</option>
				  <option value="This meal ain't over until dessert is finished.">This meal ain't over until dessert is finished.</option>
				  <option value="Know any Pasta Addict?">Know any Pasta Addict?</option>
				  <option value="Show your family You Truly love them">Show your family You Truly love them</option>
				  <option value="Can't wait to Dip'n">Can't wait to Dip'n</option>
				  <option value="Check the prizes inside each happy meal">Check the prizes inside each happy meal</option>
				  <option value="Our Wine is sublime.">Our Wine is sublime.</option>
				</select>
                <br><br><br><br>
                <div style="display: flex">
                    <input type="submit" name="update_Category_Submit" value="Update Category"/>
                    <input type="submit" name="delete_Category_Submit" value="Delete Category"/>
                </div>
            </form>
        </div>
<!--Add Dish-->
        <div class="Add_Dish" id="Add_Dish">
        <form method="post" action="modify_menu.php">
                <div style="display: flex">
                    <div style="display: block">
                        <label for="Dish_Category_Name">Select Dish Category:</label>
                        <select id = "myCategoryList" name="Dish_Category_Name" required>    
                            <option value=""> ---Choose Category--- </option> 
                            <?php
                                $Categories = get_Categories($db);
                                foreach($Categories as $category) {
                                    echo '<option value="'.$category['Category_Name'].'">'.$category['Category_Name'].'</option>';
                                }
                            ?> 
                        </select>  
                    </div>
                    <div style="display: block">
                        <label for="add_Dish_Name">Insert Dish Name:</label>
                        <input type="text" name="add_Dish_Name" required>
                    </div>
                    <div style="display: block">
                        <label for="add_Dish_Price">Insert Dish Price:</label>
                        <input type="text" name="add_Dish_Price" required>
                    </div>
                </div>
                <br><br>
                <div style="display: flex;">
                    <div style="display: block">
                        <label for="add_Dish_Ing">Insert Dish Ingredients:</label>
                        
                        <textarea rows="2" cols="25" name="add_Dish_Ing" required></textarea>
                    </div>
                    <div style="display: block">
                        <label for="add_Dish_Chef">Insert Dish Chef:</label>
                        <input type="text" name="add_Dish_Chef" required>
                    </div>
                    <div style="display: block">
                        <label for="add_Dish_Image">Insert Dish Image:</label>
                        <input type="file" name="add_Dish_Image" required>
                    </div>
                </div>
                <br><br><br><br>
                <div style="display: flex">
                    <input type="submit" name="add_Dish_Submit" value="Add Dish"/>
                </div>
            </form>
        </div>
<!--Update Dish-->        
         <div class="Update_Dish" id="Update_Dish">
            <form method="post" action="modify_menu.php">
                <div style="display: flex">
                    <div style="display: block">
                        <label for="old_Dish_Name">Old Dish Name:</label>
                        <select id = "myList" name="old_Dish_Name" required>  
                            <option value=""> ---Choose dish--- </option> 
                            <?php
                                $Dishes = get_Dishes($db);
                                foreach($Dishes as $Dish) {
                                    echo '<option value="'.$Dish['Dish_Name'].'">'.$Dish['Dish_Name'].'</option>';
                                }
                            ?>  
                        </select>  
                   </div>
                   <div style="display: block">
                        <label for="update_Dish_Name">Update Dish Name:</label>
                        <input type="text" name="update_Dish_Name" placeholder="New Dish Name">
                    </div>
                    <div style="display: block">
                        <label for="update_Category_Name">Choose New Category:</label>
                        <select id = "myCategoryList" name="update_Category_Name">  
                            <option value=""> ---Choose Category--- </option>  
                            <?php
                                $Categories = get_Categories($db);
                                foreach($Categories as $category) {
                                    echo '<option value="'.$category['Category_Name'].'">'.$category['Category_Name'].'</option>';
                                }
                            ?>  
                        </select>  
                    </div>
                </div>
                <br><br>
                <div style="display: flex;">
                    <div style="display: block">
                        <label for="update_Dish_Price">Update Dish Price:</label>
                        <input type="text" name="update_Dish_Price" placeholder="New Dish Price">
                    </div>
                    <div style="display: block">
                        <label for="update_Dish_Ing">Update Ingredients:</label>
                        <textarea rows="2" cols="25" name="update_Dish_Ing"></textarea>
                    </div>
                    <div style="display: block">
                        <label for="update_Dish_Chef">Update Dish Chef:</label>
                        <input type="text" name="update_Dish_Chef" placeholder="New Dish Chef">
                    </div>
                    <div style="display: block">
                        <label for="update_Dish_Image">Update Dish image:</label>
                        <input type="file" name="update_Dish_Image">
                    </div>
                </div>
                <br><br><br><br>
                <div style="display: flex">
                    <input type="submit" name="update_Dish_Submit" value="Update Dish"/>
                    <input type="submit" name="delete_Dish_Submit" value="Delete Dish"/>
                </div>
            </form>           

        </div> 
    </div>
   
</section>

<!-- speciality section ends -->

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
<a href="#" class="fas fa-angle-up" id="scroll-top"></a>

<!-- loader  --
<div class="loader-container">
    <img src="images/jumpRope.gif" alt="">
</div>


<!-- custom js file link  -->
<script src="script.js"></script>
<script src="js.js"></script>
<script>
    function display(id, ids){
        document.getElementById(id).style.display = "block";

        document.getElementById(ids[0]).style.display = "none";
        document.getElementById(ids[1]).style.display = "none";
        document.getElementById(ids[2]).style.display = "none";
    }
	<?php
	if (isset($_GET['message'])) { ?>
	  setTimeout(function() {
		history.replaceState(null, '', 'http://localhost/backend/AdminMenuPage.php');
		$('#errorMsg').hide();
	  }, 5000);
		<?php } ?>
</script>

</body>
</html>