<?php
    
	include("connection.php");
  error_reporting(E_ALL ^ E_NOTICE);
	if (isset($_POST['add']) && isset($_POST['name']) && isset($_POST['quantity'])) {
        $name = $_POST['name'];
        $quantity = $_POST['quantity'];


        $addquery = "INSERT INTO `supplies` (`supply_id`, `name`, `quantity`) VALUES (NULL, '$name', '$quantity')";
        $query = mysqli_query($con, $addquery) or die (mysqli_error($con));
        header("location: dashboard.php");
  }

    
?>
