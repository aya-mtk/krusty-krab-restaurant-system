<?php
    session_start();
    require_once('dbconnect.php');
    if (!isset($_SESSION['admin'])) {
        header("Location: logout.php");
    }

    //$AdminData = $db->admin->findOne( array('_id'=>$_SESSION['admin']));

//Add_Category
    if(isset($_POST['add_Category_Name'])){
        $categoryName = $_POST['add_Category_Name'];
        $categoryicon = $_POST['add_Category_Icon'];
        $categoryimage = $_POST['add_Category_Image'];
        $categoryquote = $_POST['add_Category_Quote'];
        $result = $db->Categories->findOne(array('Category_Name'=>$categoryName));
		
        if(!$result){
            $result = $db->Categories->insertOne(array('Category_Name'=>$categoryName,'Category_Icon'=>$categoryicon,'Category_Image'=>$categoryimage, 'Category_Quote'=>$categoryquote));
            $result = $db->Categories->findOne(array('Category_Name'=>$categoryName,'Category_Icon'=>$categoryicon,'Category_Image'=>$categoryimage, 'Category_Quote'=>$categoryquote));
            header('Location: AdminMenuPage.php?message=Category successfully inserted');
        }
        else{
            header('Location: AdminMenuPage.php?message=Category already exists');
        }
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

//Update Categories
    if(isset($_POST['old_Category_Name'])){
        $categoryName = $_POST['old_Category_Name'];
        if(isset($_POST['update_Category_Submit'])){

			if($_POST['update_Category_Icon'] != ""){
				$categoryicon = $_POST['update_Category_Icon'];
				$updateResult = $db->Categories->updateOne([ 'Category_Name' => $categoryName], [ '$set' => [ 'Category_Icon' => $categoryicon]]);
			}
			if($_POST['update_Category_Image'] != ""){
				$categoryimage = $_POST['update_Category_Image'];
				$updateResult = $db->Categories->updateOne([ 'Category_Name' => $categoryName], [ '$set' => [ 'Category_Image' => $categoryimage]]);
			}
			if($_POST['update_Category_Quote'] != ""){
				$categoryquote = $_POST['update_Category_Quote'];
				$updateResult = $db->Categories->updateOne([ 'Category_Name' => $categoryName], [ '$set' => [ 'Category_Quote' => $categoryquote]]);
			}
			if($_POST['update_Category_Name'] != ""){
				$updatedCategoryName = $_POST['update_Category_Name'];
				$result = $db->Categories->findOne(array('Category_Name' => $updatedCategoryName));
				if(!$result){
					$updateResult = $db->Categories->updateOne([ 'Category_Name' => $categoryName], [ '$set' => [ 'Category_Name' => $updatedCategoryName]]);
					$updateResult2 = $db->Dishes->updateOne([ 'Dish_Category_Name' => $categoryName], [ '$set' => [ 'Dish_Category_Name' => $updatedCategoryName]]);
				}
				else {
					header('Location: AdminMenuPage.php?message=Category already exists');
				}
			}
			header('Location: AdminMenuPage.php?message=Category successfully updated');
		}
        
        if(isset($_POST['delete_Category_Submit'])){
            $Dishes = get_Dishes($db);
            foreach($Dishes as $Dish) {
                $updateResult = $db->Dishes->deleteOne([ 'Dish_Category_Name' => $categoryName]);
            }
            $updateResult = $db->Categories->deleteOne([ 'Category_Name' => $categoryName]);
            header('Location: AdminMenuPage.php?message=Category successfully deleted');
        } 
    }

//Add_Dish:
    if(isset($_POST['Dish_Category_Name']) && isset($_POST['add_Dish_Name']) && isset($_POST['add_Dish_Price']) && isset($_POST['add_Dish_Ing']) && isset($_POST['add_Dish_Chef']) && isset($_POST['add_Dish_Image'])) {
        $Category_Name = $_POST['Dish_Category_Name'];
        $Dish_Name = $_POST['add_Dish_Name'];
        $Dish_Price = $_POST['add_Dish_Price'];
        $Dish_Ing = $_POST['add_Dish_Ing'];
        $Dish_Chef = $_POST['add_Dish_Chef'];
        $Dish_Image = $_POST['add_Dish_Image'];

        $result = $db->Dishes->findOne(array('Dish_Name'=>$Dish_Name));

        if(!$result) {
            $result = $db->Dishes->insertOne(array('Dish_Category_Name'=>$Category_Name,'Dish_Name'=>$Dish_Name,'Dish_Price'=>$Dish_Price,'Dish_Ing'=>$Dish_Ing,'Dish_Chef'=>$Dish_Chef,'Dish_Image'=>$Dish_Image));
            $result = $db->Dishes->findOne(array('Dish_Category_Name'=>$Category_Name,'Dish_Name'=>$Dish_Name,'Dish_Price'=>$Dish_Price,'Dish_Ing'=>$Dish_Ing,'Dish_Chef'=>$Dish_Chef,'Dish_Image'=>$Dish_Image));
            header('Location: AdminMenuPage.php?message=Dish successfully added');
        }
        else {
            header('Location: AdminMenuPage.php?message=Dish already exists');
        }
    }

//Update Dish
if(isset($_POST['old_Dish_Name'])){
    $Dish_Name = $_POST['old_Dish_Name'];
    if(isset($_POST['update_Dish_Submit'])){
        
		if($_POST['update_Category_Name'] != ""){
			$categoryName = $_POST['update_Category_Name'];
			$updateResult = $db->Dishes->updateOne([ 'Dish_Name' => $Dish_Name], [ '$set' => [ 'Dish_Category_Name' => $categoryName]]);
		}

		if($_POST['update_Dish_Price'] != ""){
			$Dishprice = $_POST['update_Dish_Price'];
			$updateResult = $db->Dishes->updateOne(['Dish_Name' => $Dish_Name], [ '$set' => [ 'Dish_Price' => $Dishprice]]);
		}

		if($_POST['update_Dish_Ing'] != ""){
			$DishIng = $_POST['update_Dish_Ing'];
			$updateResult = $db->Dishes->updateOne(['Dish_Name' => $Dish_Name], [ '$set' => [ 'Dish_Ing' => $DishIng]]);
		}

		if($_POST['update_Dish_Chef'] != ""){
			$Dishchef = $_POST['update_Dish_Chef'];
			$updateResult = $db->Dishes->updateOne(['Dish_Name' => $Dish_Name], [ '$set' => [ 'Dish_Chef' => $Dishchef]]);
		}

		if($_POST['update_Dish_Image'] != ""){
			$Dishimage = $_POST['update_Dish_Image'];
			$updateResult = $db->Dishes->updateOne(['Dish_Name' => $Dish_Name], [ '$set' => [ 'Dish_Image' => $Dishimage]]);
		}
		if($_POST['update_Dish_Name'] != ""){
            $updatedDishName = $_POST['update_Dish_Name'];
            $result = $db->Dishes->findOne(array('Dish_Name' => $updatedDishName));
            if(!$result){
                $updateResult = $db->Dishes->updateOne([ 'Dish_Name' => $Dish_Name], [ '$set' => [ 'Dish_Name' => $updatedDishName]]);
                if($_POST['update_Category_Name'] != ""){
                    $categoryName = $_POST['update_Category_Name'];
                    $updateResult = $db->Dishes->updateOne([ 'Dish_Name' => $updatedDishName], [ '$set' => [ 'Dish_Category_Name' => $categoryName]]);
                    header('Location: AdminMenuPage.php');
                }   
			}
            else {
                header('Location: AdminMenuPage.php?message=Dish already exists');
            }
        }
		header('Location: AdminMenuPage.php?message=Dish successfully updated');  
	}    
} 
if(isset($_POST['delete_Dish_Submit'])){
		$updateResult = $db->Dishes->deleteOne([ 'Dish_Name' => $Dish_Name]);
		header('Location: AdminMenuPage.php?message=Dish successfully deleted');
} 

?>