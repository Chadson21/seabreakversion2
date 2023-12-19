<?php
    
	include("connection.php");

	if (isset($_POST['update1']) && isset($_POST['name'])) {
        $supply = $_POST['supply_id'];
        $name = $_POST['name'];
        $quantity = $_POST['quantity'];


        $updatequery = "UPDATE `supplies` SET `name` = '$name', `quantity` = '$quantity'  WHERE `supply_id` = '$supply'";
        $query = mysqli_query($con, $updatequery) or die (mysqli_error($con));
        header("location: dashboard.php");
  }

    
?>
