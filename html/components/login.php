<?php

session_start();

	include("connection.php");
	include("validate.php");


	if($_SERVER['REQUEST_METHOD'] == "POST"){
		//something was posted
		$username = $_POST['username'];
		$password = $_POST['password'];

		if(!empty($username) && !empty($password)){

			//read from database
			$query = "select * from users where username = '$username'";
			$result = mysqli_query($con, $query);

			if($result){
				if($result && mysqli_num_rows($result) > 0){

                    $user_data = mysqli_fetch_assoc($result);
                    

					// After successful login
                    if ($user_data['password'] === $password) {
                        $_SESSION['users_id'] = $user_data['users_id'];
                        $_SESSION['user_type'] = $user_data['user_type'];
                        if ($user_data['user_type'] === 'Admin') {
                            header("Location: admin.php");
                            exit;
                        } elseif ($user_data['user_type'] === 'Cashier') {
                            header("Location: cashier.php");
                            exit;
                        } elseif ($user_data['user_type'] === 'Manager') {
                            header("Location: dashboard.php");
                            exit;
                        } elseif ($user_data['user_type'] === 'Cashier') {
                            header("Location: cashier.php");
                            exit;
                        }
                    }
				}
			}

            echo '<div class="section bg-primary text-dark section-lg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10">
                        <div class="alert alert-danger shadow-soft" role="alert">
                            <span class="alert-inner--text">Wrong username or password.</span>
                        </div>
                    </div>
                </div>';
		}else{
			echo '<div class="section bg-primary text-dark section-lg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10">
                        <div class="alert alert-danger shadow-soft" role="alert">
                            <span class="alert-inner--text">Wrong username or password.</span>
                        </div>
                    </div>
                </div>';
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Fontawesome -->
<link type="text/css" href="../../vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

<!-- Pixel CSS -->
<link type="text/css" href="../../css/neumorphism.css" rel="stylesheet">
</head>

<body>
    <header class="header-global">
        
    
    <div class="container">
        
        
        <!-- Title -->
        <div class="row">
            <div class="col text-center">
                <h2 class="h5 mb-7"></h2>
            </div>
        </div>
        <!-- End of title-->
        <div class="row justify-content-md-around">
            <div class="col-12 col-md-6 col-lg-5 mb-5 mb-lg-0">
                <div class="card bg-primary shadow-soft border-light p-4">
                    <div class="card-header text-center pb-0">
                        <h2 class="h4">Sign in</h2>
                        <span>Login here using your username and password</span>   
                    </div>
                    <div class="card-body">
                        <form method = "post" class="mt-4">
                            <!-- Form -->
                            <div class="form-group">
                                <label>Username</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><span class="fas fa-user"></span></span>
                                    </div>
                                    <input class="form-control" id="username" name="username" placeholder="Username" type="text">

                                </div>
                            </div>
                            <!-- End of Form -->
                            <div class="form-group">
                                <!-- Form -->
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><span class="fas fa-unlock-alt"></span></span>
                                        </div>
                                        <input class="form-control" id="password" name="password" placeholder="Password" type="password" aria-label="Password" required>
                                    </div>
                                </div>
                                <!-- End of Form -->
                                <div class="d-block d-sm-flex justify-content-between align-items-center mb-4">
                                     
                                </div>
                            </div>
                            <button class="btn btn-block btn-primary">Sign in</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>                              
</body>

</html>