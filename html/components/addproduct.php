<?php
  error_reporting(E_ALL ^ E_NOTICE);
	include("connection.php");

    


   

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 1000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $small_price = $_POST['small_price'];
    $medium_price = $_POST['medium_price'];
    $large_price = $_POST['large_price'];
    $fileName = $_FILES["fileToUpload"]["name"]; 
    $productadd = "INSERT INTO `products` (`product_id`, `name`, `small_price`, `medium_price`, `large_price`, `image`) VALUES (NULL, '$name', '$small_price', '$medium_price', '$large_price', '$fileName')";
    $query = mysqli_query($con, $productadd) or die (mysqli_error($con));
    header("location: dashboard.php");
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>