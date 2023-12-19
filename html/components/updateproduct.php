<?php
    
    include("connection.php");
    error_reporting(E_ALL ^ E_NOTICE);

	if (isset($_POST['updateproduct'])) {
        $product_id = $_POST['product_id'];
        $name = $_POST['name'];
        $small_price = $_POST['small_price'];
        $medium_price = $_POST['medium_price'];
        $large_price = $_POST['large_price'];
        $fileName_old = $_POST['fileToUpload_old'];
        $fileName_new = $_FILES["fileToUpload"]["name"]; 

        if($fileName_new !=''){
            $update_fileName = $fileName_new;
            if(file_exists("uploads/".$_FILES["fileToUpload"]["name"])){
                echo "Sorry, file already exists.";
            }
        } else {
            $update_fileName = $fileName_old;
            
        }
        $updateProduct = "UPDATE `products` SET `name` = '$name', `small_price` = '$small_price', `medium_price` = '$medium_price', `large_price` = '$large_price', `image` = '$update_fileName' WHERE `product_id` = '$product_id'";
        $query = mysqli_query($con, $updateProduct) or die (mysqli_error($con));
            
            if($query){
                if($_FILES["fileToUpload"]["name"] !=''){
                    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "uploads/" . basename($_FILES["fileToUpload"]["name"]));
                    unlink("uploads/".$fileName_old);
                }
                header("location: dashboard.php");
            } else {
                
            }

       
  }


    if(isset($_POST['deleteProduct'])){
        $product_id = $_POST['product_id'];
        $image = $_POST['image'];

        $deleteQuery = "DELETE FROM products where product_id = '$product_id'";
        $delete_query_run = mysqli_query($con, $deleteQuery) or die (mysqli_error($con));

        if($delete_query_run){
            unlink("uploads/".$image);
            header("location: dashboard.php");   
        } else{

        }
    }

    
?>

