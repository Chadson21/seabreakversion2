<?php

function getUserDetails($con){

	if(isset($_SESSION['users_id'])){

		$id = $_SESSION['users_id'];
		$query = "SELECT * FROM `users` WHERE users_id = '$id'";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0){

			$user_details = mysqli_fetch_assoc($result);
			return $user_details;
		}
	}

	//redirect to login
	header("Location: login.php");
	die;

}

?>