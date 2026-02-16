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

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>menu</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style(1).css">
    <link rel="stylesheet" href="neon.css">
	<link rel="stylesheet" href="slideshow.css">
    <link rel="stylesheet" href="mystyle.css">

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
        <a href="mainOrderPage.html">menu</a>
        <a href="About.html"  target="_blank">About</a>
        <a href="Reservation.html">Reservation</a>
        <a href="phpReview.php">Review</a>
        <a href="mainOrderPage.html">order</a>
		<a href="logout.php">Logout</a>
		<a href="UserProfile.php"><img width="20px" height="20px" style="width: 50px; height: 50px; vertical-align: middle; position: fixed; top: 8px;" src="images/mrkrabsmirky.webp"></a>
    </nav>

</header>

<section class="popular" id="popular">
    <h1 class="heading" style="margin-top: -10px;"> our <span>speciality</span> </h1>
    <section class="sectionC">
        <div class="grid">
            <?php
                if($_GET['catname']!=""){
                    $Catname=$_GET['catname'];
                    //echo '<script>alert("hi: '.$Catname.'")</script>';
                    $Dishes = get_Dishes($db);
                    foreach($Dishes as $Dish) {
                        if($Dish['Dish_Category_Name']==$Catname){
                            echo '
                                <figure>
                                    <img src="backendImages/'.$Dish['Dish_Image'].'"/>
                                    <figcaption>'.$Dish['Dish_Name'].'<p><strong>Chief '.$Dish['Dish_Chef'].'</strong></p>
                                        <p><strong>Price: </strong>'.$Dish['Dish_Price'].'$</p>
                                        <p><strong>Ingredients: </strong>'.$Dish['Dish_Ing'].'</p>
                                    </figcaption>
                                </figure>';
                        }
                    }
                }
            ?>          
        </div>
    </section>
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
    function DisplayDishes(CategoryName){
        //sendData(CategoryName);
        alert("hi");
        document.getElementById("speciality").style.display="none";
        document.getElementById("popular").style.display="block";
    }
    function DisplayCategories(){
        document.getElementById("popular").style.display="none";
        document.getElementById("speciality").style.display="block";
    }


</script>

</body>
</html>
