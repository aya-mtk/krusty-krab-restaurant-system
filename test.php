if(isset($_POST['add_Category_Name'])){
        $categoryName = $_POST['add_Category_Name'];
        $categoryicon = $_POST['add_Category_Icon'];
        $categoryimage = $_POST['add_Category_Image'];
        $result = $db->Categories->findOne(array('Category_Name'=>$categoryName));
		
        if(!$result){
            $result = $db->Categories->insertOne(array('Category_Name'=>$categoryName,'Category_Icon'=>$categoryicon,'Category_Image'=>$categoryimage));
            $result = $db->Categories->findOne(array('Category_Name'=>$categoryName,'Category_Icon'=>$categoryicon,'Category_Image'=>$categoryimage));
            header('Location: AdminMenuPage.php');
        }
        else{
            echo '<script>alert("Already a Category!")</script>';
        }
    }