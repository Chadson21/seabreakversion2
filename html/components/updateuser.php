<?php
    
	include("connection.php");

	if (isset($_POST['update']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['user_type'])) {
        $userid = $_POST['users_id'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $usertype = $_POST['user_type'];

        $updatequery = "UPDATE `users` SET `emp_name` = '$name', `username` = '$username', `password` = '$password', `user_type` = '$usertype' WHERE `users_id` = '$userid'";
        $query = mysqli_query($con, $updatequery) or die (mysqli_error($con));
        header("location: dashboard.php");
  }

    
?>

