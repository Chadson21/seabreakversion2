<?php
    
	include("connection.php");
  error_reporting(E_ALL ^ E_NOTICE);
	if (isset($_POST['add']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['user_type'])) {
        $userid = $_POST['users_id'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $usertype = $_POST['user_type'];

        $addquery = "INSERT INTO `users` (`users_id`, `emp_name`, `username`, `password`, `user_type`) VALUES (NULL, '$name', '$username', '$password', '$usertype')";
        $query = mysqli_query($con, $addquery) or die (mysqli_error($con));
        header("location: dashboard.php");
  }

    
?>

