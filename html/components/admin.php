<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
	include("connection.php");
	include("validate.php");
    include("userdetails.php");
    include("updateuser.php");
    include("adduser.php");
    include("delete.php");
    
    // Set cache-control headers to prevent caching
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");
	
	$user_data = check_login($con);
    $user_details = getUserDetails($con);
    $users = getUsers($con);

    if (!isset($_SESSION['users_id']) || $_SESSION['user_type'] !== 'Admin') {
        // Redirect to an unauthorized access page or another appropriate action
        header("Location: login.php");
        exit;
    }

    function getUsers($con){

        if(ISSET($_REQUEST['users_id'])){
    
            $user_id = $_REQUEST['users_id'];
            $query = "SELECT * FROM `users` WHERE users_id = '$user_id'";
    
            $result = mysqli_query($con,$query);
            if($result && mysqli_num_rows($result) > 0){
    
                $users = mysqli_fetch_assoc($result);
                return $users;
            }
        }
    }

    
        
       
            $query = mysqli_query($con, "SELECT * FROM `users`") or die(mysqli_error());
            $fetch1 = mysqli_fetch_array($query);

            $query1 = mysqli_query($con, "SELECT * FROM `products`") or die(mysqli_error());
            $fetch2 = mysqli_fetch_array($query1);
	
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<!-- Favicon -->
<link rel="apple-touch-icon" sizes="120x120" href="../../assets/img/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../../assets/img/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../../assets/img/favicon/favicon-16x16.png">
<link rel="manifest" href="../../assets/img/favicon/site.webmanifest">
<link rel="mask-icon" href="../../assets/img/favicon/safari-pinned-tab.svg" color="#ffffff">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">

<!-- Fontawesome -->
<link type="text/css" href="../../vendor/@fortawesome/fontawesome-free1/css/all.min.css" rel="stylesheet">

<!-- Pixel CSS -->
<link type="text/css" href="../../css/neumorphism.css" rel="stylesheet">

</head>

<body>

<!-- NAV BAR -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-light shadow-soft navbar-theme-primary mb-4">
    <div class="container position-relative">
        <a class="navbar-brand mr-lg-5">
            <strong class="mr-auto ml-2" style="font-size: 24px;">Sea Break</strong>
        </a>
        <div class="d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link" data-toggle="dropdown" role="button">
                        <i class="fas fa-angle-down nav-link-arrow"></i>
                        <strong class="mr-auto ml-2">Hello, <?php echo $user_details['emp_name']?></strong>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        
            <button class="navbar-toggler ml-2" type="button" data-toggle="collapse"
                data-target="#navbar-default-primary" aria-controls="navbar-default-primary"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</nav>
<!-- END OF NAV BAR -->






   
   

<!-- ADD ACCOUNT MODAL -->
<button type="button" class="btn btn-primary animate-up-2 ml-3 mt-50 mb-3" data-toggle="modal" data-target="#modal-form">Add User
<span class="ml-1"><span class="fas fa-plus"></span></span>
    </button>
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-primary shadow-soft border-light p-4">
                    <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="card-header text-center pb-0">
                        <h2 class="h4">Add User</h2>
                    </div>
                    <div class="card-body">
                        <form action="adduser.php" class="mt-4" method="POST">
                            <!-- Form -->
                            <div class="form-group">
                                <label for="exampleInputIcon3">Name</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><span class="fas fa-user"></span></span>
                                    </div>
                                    <input class="form-control" name="name" id="name"  type="text" aria-label="email adress" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputIcon3">Username</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><span class="fas fa-user-lock"></span></span>
                                    </div>
                                    <input class="form-control" id="username" name="username"  type="text" aria-label="email adress" required>
                                </div>
                            </div>
                            <!-- End of Form -->
                            <div class="form-group">
                                <!-- Form -->
                                <div class="form-group">
                                    <label for="exampleInputPassword6">Password</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><span class="fas fa-unlock-alt"></span></span>
                                        </div>
                                        <input class="form-control" id="password" name="password"  type="text" aria-label="Password" required>
                                    </div>
                                </div>
                                <!-- End of Form -->
                                <div class="form-group">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">User Type</label>
                                <select class="custom-select my-1 mr-sm-2" id="user_type" name="user_type" required>
                                    <option></option>
                                    <option value="Admin">Admin</option>
                                    <option value="Cashier">Cashier</option> 
                                    <option value="Manager">Manager</option> 
                                </select>
                            </div>
                                
                            </div>
                            <button type="submit" name ="add" class="btn btn-block btn-primary">Add User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END OF ADD ACCOUNT MODAL -->


    
    
    

<!-- TABLE -->
    <table class="table shadow-soft rounded ml-3 mr-3 mt-30 mb-0">
    <tr>
        <th class="border-0" scope="col">Name</th>
        <th class="border-0" scope="col">Username</th>
        <th class="border-0" scope="col">Password</th>
        <th class="border-0" scope="col">User Type</th>
        <th class="border-0" scope="col">Action</th>
        <th class="border-0" scope="col">Delete</th>
    </tr>

    <?php
    $query = mysqli_query($con, "SELECT * FROM `users`") or die(mysqli_error());
    while($fetch = mysqli_fetch_array($query)){
        $user=$fetch['users_id'];
        
    ?>
    
    <tr>
        
        <td><?php echo $fetch['emp_name']?></td>
        <td><?php echo $fetch['username']?></td>
        <td><?php echo $fetch['password']?></td>
        <td><?php echo $fetch['user_type']?></td>
        <td><button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#modal-form<?php echo $user?>">Edit</button>
        <td>
        <form action="delete.php" method="POST">
        <input type="hidden" name= "users_id" value="<?php echo $fetch['users_id'];?>">
                <button class="btn btn-sm btn-danger" type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this item?');"> Delete
                    <span class="fas fa-trash" style="color: #bd1c00">
                </button>
        </td>
        </form>
        
            
        </td>
        
<!-- EDIT ACCOUNT MODAL -->
<div class="modal fade" id="modal-form<?php echo $fetch['users_id']?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-primary shadow-soft border-light p-4">
                    <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    <div class="card-header text-center pb-0">
                        <h2 class="h5">Edit Account</h2>
                    </div>
                    <div class="card-body">
                        <form action="updateuser.php" class="mt-4" method="POST">
                            <!-- Form -->
                            <div class="form-group">
                                <input type="hidden" name= "users_id" value="<?php echo $fetch['users_id'];?>">
                                <label for="exampleInputIcon3">Name</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><span class="fas fa-user"></span></span>
                                    </div>
                                    <input class="form-control" id="name"  name="name" value ="<?php echo $fetch['emp_name'];?>" type="text" aria-label="email adress">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputIcon3">Username</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><span class="fas fa-user-lock"></span></span>
                                    </div>
                                    <input class="form-control" id="username" name="username" value ="<?php echo $fetch['username'];?>" type="text" aria-label="email adress">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputIcon3">Password</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><span class="fas fa-lock"></span></span>
                                    </div>
                                    <input class="form-control" id="password" name="password" value ="<?php echo $fetch['password'];?>" type="text" aria-label="email adress">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">User Type</label>
                                <select class="custom-select my-1 mr-sm-2" id="user_type" name="user_type" required>
                                    <option></option>
                                    <option value="Admin">Admin</option>
                                    <option value="Cashier">Cashier</option>
                                    <option value="Manager">Manager</option>
                                </select>
                            </div>
                            <button type="submit" name="update" class="btn btn-block btn-primary">Save</a></button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END OF EDIT ACCOUNT MODAL -->
    </tr>
    <?php
        }
    ?>
</table>
</div>
</div>








                   
                </div>
            </div>
        </div>
        <!-- End of Tab Content -->
    </div>
</div>
    <!-- Core -->
<script src="../../vendor/jquery/dist/jquery.min.js"></script>
<script src="../../vendor/popper.js/dist/umd/popper.min.js"></script>
<script src="../../vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../../vendor/headroom.js/dist/headroom.min.js"></script>

<!-- Vendor JS -->
<script src="../../vendor/onscreen/dist/on-screen.umd.min.js"></script>
<script src="../../vendor/nouislider/distribute/nouislider.min.js"></script>
<script src="../../vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="../../vendor/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="../../vendor/jarallax/dist/jarallax.min.js"></script>
<script src="../../vendor/jquery.counterup/jquery.counterup.min.js"></script>
<script src="../../vendor/jquery-countdown/dist/jquery.countdown.min.js"></script>
<script src="../../vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
<script src="../../vendor/prismjs/prism.js"></script>



<!-- Neumorphism JS -->
<script src="../../assets/js/neumorphism.js"></script>
</body>

</html>