<?php

function check_login($con)
{

	if(isset($_SESSION['users_id']))
	{

		$id = $_SESSION['users_id'];
		$query = "select * from users where users_id = '$id' and user_type = 'Admin' || user_type = 'Cashier'" ;

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;

		}
	}

	//redirect to login
	header("Location: login.php");
	die;

}



?>