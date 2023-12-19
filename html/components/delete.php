<?php
    
	include("connection.php");

	if (isset($_POST['delete'])) {
        $userid = $_POST['users_id'];
       

        $deletequery = "DELETE from users where users_id = '$userid'";
        $query = mysqli_query($con, $deletequery) or die (mysqli_error($con));
        header("location: dashboard.php");
    }

    if (isset($_POST['delete1'])) {
        $userid = $_POST['supply_id'];
       

        $deletequery = "DELETE from supplies where supply_id = '$userid'";
        $query = mysqli_query($con, $deletequery) or die (mysqli_error($con));
        header("location: dashboard.php");
    }

    
?>
