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
                        <li><a class="dropdown-item" href="cashier.php">Cashier</a></li>
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



<div class="row border-light p-5">
    <div class="col-xl-2">
        <!-- Tab Nav -->
        <ul class="nav nav-pills nav-fill flex-column vertical-tab" id="tab12" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab-3" data-toggle="tab" href="#tab-14" role="tab" aria-controls="tab-14" aria-selected="true">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab-3" data-toggle="tab" href="#tab-15" role="tab" aria-controls="tab-15" aria-selected="false">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab-3" data-toggle="tab" href="#tab-16" role="tab" aria-controls="tab-16" aria-selected="false">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab-3" data-toggle="tab" href="#tab-17" role="tab" aria-controls="tab-17" aria-selected="false">Inventory</a>
            </li>
        </ul>
        <!-- End of Tab Nav -->
    </div>
    <div class="col-xl-9">
        <!-- Tab Content -->
        <div class="card shadow-inset bg-primary border-light p-1 rounded">
            <div class="card-body">
                <div class="tab-content" id="tabcontent">
                    <div class="tab-pane fade show active" id="tab-14" role="tabpanel" aria-labelledby="tab-14">

                    <div class="row">
                    <div class="col-12 col-sm-6 col-lg-3 mb-5 mb-lg-0 text-center">
        <div class="card bg-primary shadow-soft border-light p-2">
            <div class="card-body">
                <div class="icon icon-shape shadow-inset rounded mb-4">
                    <span class="fas fa-chart-line"></span>
                </div>
            </div>
            <div class="card-footer shadow-inset rounded">
                <span class="counter h1 d-block">172</span>
                <span class="h5">Sales</span>
            </div>
        </div>
    </div>
    


    <div class="col-12 col-sm-6 col-lg-3 mb-5 mb-lg-0 text-center">
        <div class="card bg-primary shadow-soft border-light p-2">
            <div class="card-body">
                <div class="icon icon-shape shadow-inset rounded mb-4">
                    <span class="fas fa-sticky-note"></span>
                </div>
            </div>
            <div class="card-footer shadow-inset rounded">
                <span class="counter h1 d-block">124</span>
                <span class="h5">Orders</span>
            </div>
        </div>
    </div>


    <div class="col-12 col-sm-6 col-lg-3 mb-5 mb-lg-0 text-center">
        <div class="card bg-primary shadow-soft border-light p-2">
            <div class="card-body">
                <div class="icon icon-shape shadow-inset rounded mb-4">
                    <span class="fas fa-users"></span>
                </div>
            </div>
            <div class="card-footer shadow-inset rounded">
                <span class="counter h1 d-block">52</span>
                <span class="h5">Customers</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3 mb-5 mb-lg-0 text-center">
        <div class="card bg-primary shadow-soft border-light p-2">
            <div class="card-body">
                <div class="icon icon-shape shadow-inset rounded mb-4">
                    <span class="fas fa-coffee"></span>
                </div>
            </div>
            <div class="card-footer shadow-inset rounded">
                <span class="counter h1 d-block">14</span>
                <span class="h5">Products</span>
            </div>
        </div>
    </div>
</div>
</div>


<div class="tab-pane fade" id="tab-15" role="tabpanel" aria-labelledby="tab-15">
<!-- ADD PRODUCT MODAL -->
<button type="button" class="btn btn-primary animate-up-2 ml-0  mb-3" data-toggle="modal" data-target="#modal-form2"> Beverages
<span class="ml-1"><span class="fas fa-plus"></span></span>
</button>

<button type="button" class="btn btn-primary animate-up-2 ml-2  mb-3" data-toggle="modal" data-target="#modal-form1"> Foods
<span class="ml-1"><span class="fas fa-plus"></span></span>
</button>

<div class="modal fade" id="modal-form2" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-primary shadow-soft border-light p-4">
                    <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="card-header text-center pb-0">
                        <h2 class="h4">ADD BEVERAGE</h2>
                    </div>
                    <div class="card-body">
                        <form action="addproduct.php" method="POST" enctype="multipart/form-data"  class="mt-4">
                            <div class="form-group">
                                <label for="exampleInputIcon3">Product Name</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><span class="fa-solid fa-coffee"></span></span>
                                    </div>
                                    <input class="form-control" id="name" name="name" type="text" aria-label="email adress" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputIcon3">Small Price</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><span class="fa-solid fa-s"></span></span>
                                    </div>
                                    <input class="form-control" id="small_price" name="small_price" type="text" aria-label="email adress">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputIcon3">Medium Price</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><span class="fa-solid fa-m"></span></span>
                                    </div>
                                    <input class="form-control" id="medium_price" name="medium_price" type="text" aria-label="email adress">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputIcon3">Large Price</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><span class="fa-solid fa-l"></span></span>
                                    </div>
                                    <input class="form-control" id="large_price" name="large_price" type="text" aria-label="email adress">
                                </div>
                            </div>
                          
                          
                            <label for="exampleInputIcon3">Upload Image</label>
                            <div class="custom-file mb-5">
                                <input type="file" name="fileToUpload" class="custom-file-input" id="customfile" required>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <button type="submit" name="submit" class="btn btn-block btn-primary">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-form1" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-primary shadow-soft border-light p-4">
                    <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="card-header text-center pb-0">
                        <h2 class="h4">ADD FOOD</h2>
                    </div>
                    <div class="card-body">
                        <form action="addfood.php" method="POST" enctype="multipart/form-data"  class="mt-4">
                            <div class="form-group">
                                <label for="exampleInputIcon3">Product Name</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><span class="fa-solid fa-coffee"></span></span>
                                    </div>
                                    <input class="form-control" id="name" name="name" type="text" aria-label="email adress" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputIcon3">Price</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><span class="fa-solid fa-s"></span></span>
                                    </div>
                                    <input class="form-control" id="price" name="price" type="text" aria-label="email adress">
                                </div>
                            </div>
                          
                            <label for="exampleInputIcon3">Upload Image</label>
                            <div class="custom-file mb-5">
                                <input type="file" name="fileToUpload" class="custom-file-input" id="customfile" required>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <button type="submit" name="submit1" class="btn btn-block btn-primary">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END OF ADD PRODUCT -->

<!-- DISPLAY THE PRODUCT -->


<div class="row">
<?php

    $query1 = mysqli_query($con, "SELECT * FROM `products`") or die(mysqli_error());
    while($fetch2 = mysqli_fetch_array($query1)){
        $product=$fetch2['product_id']; 
        
      
?>
    <div class="col-12 col-sm-6 col-lg-3 mb-3 text-center">
        <div class="card bg-primary shadow-soft border-light">
        <img src="uploads/<?php echo $fetch2['image']; ?>" width = "500px" height = "300px" alt ="image"> 
            <div class="card-footer border-top border-light p-4">
            <span class="h5 mb-0 text-gray"><?php echo $fetch2['name']; ?></span> 
                <div class="d-flex justify-content-between align-items-center mt-3">      
                <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#modal-form3<?php echo $product ?>">Edit</button>
                    <form action="updateproduct.php" method="POST">
                        <input type="hidden" name= "product_id" value="<?php echo $fetch2['product_id'];?>">
                        <input type="hidden" name= "image" value="<?php echo $fetch2['image'];?>">
                        <button class="btn btn-sm btn-primary text-danger" type="submit" name="deleteProduct"> Delete     
                        </button>
                    </form>
                </div>      
            </div>
        </div> 
    </div>


    
               
        
    <!-- EDIT MODAL OF PRODUCT -->
<div class="modal fade" id="modal-form3<?php echo $fetch2['product_id']?>" tabindex="-1" role="dialog" aria-labelledby="modal-form3" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-primary shadow-soft border-light p-4">
                    <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="card-header text-center pb-0">
                        <h2 class="h4">EDIT PRODUCT</h2>
                    </div>
                    <div class="card-body">
                        <form action="updateproduct.php" method="POST" enctype="multipart/form-data"  class="mt-4">
                            <div class="form-group">
                            <input type="hidden" name= "product_id" value="<?php echo $fetch2['product_id'];?>">
                                <label for="exampleInputIcon3">Product Name</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><span class="fa-solid fa-coffee"></span></span>
                                    </div>
                                    <input class="form-control" id="name" name="name" value="<?php echo $fetch2['name'];?>" type="text" aria-label="email adress" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputIcon3">Small Price</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><span class="fa-solid fa-s"></span></span>
                                    </div>
                                    <input class="form-control" id="small_price" name="small_price" value="<?php echo $fetch2['small_price'];?>"type="text" aria-label="email adress">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputIcon3">Medium Price</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><span class="fa-solid fa-m"></span></span>
                                    </div>
                                    <input class="form-control" id="medium_price" name="medium_price" value="<?php echo $fetch2['medium_price'];?>" type="text" aria-label="email adress">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputIcon3">Large Price</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><span class="fa-solid fa-l"></span></span>
                                    </div>
                                    <input class="form-control" id="large_price" name="large_price" value="<?php echo $fetch2['large_price'];?>" type="text" aria-label="email adress">
                                </div>
                            </div>
                          
                          
                            <label for="exampleInputIcon3">Upload Image</label>
                            <div class="custom-file mb-5">
                                <input type="file" name="fileToUpload" class="custom-file-input"id="customfile">
                                <input type="hidden" name="fileToUpload_old" class="custom-file-input" value="<?php echo $fetch2['image'];?>" id="customfile">
                                <label class="custom-file-label" for="customFile"><?php echo $fetch2['image'];?></label>
                            </div>
                            <button type="submit" name="updateproduct" class="btn btn-block btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL OF EDIT PRODUCT -->
<?php
    }
?>
</div>
</div>
<!-- END OF DISPLAY PRODUCT -->





                    <div class="tab-pane fade" id="tab-16" role="tabpanel" aria-labelledby="tab-16">
                    <div class="container-fluid">
        <table id="ordersTable" class="table shadow-soft rounded mt-30 mb-0">
            <thead>
                <tr>
                    <th scope="col">Transaction Number</th>
                    <th scope="col">Employee</th>
                    <th scope="col">Table Number</th>
                    <th scope="col">Price</th>
                    <th scope="col">Money Paid</th>
                    <th scope="col">Change</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($con, "SELECT transaction_number, emp_name, table_number, SUM(price), money_paid, customer_change, order_date FROM orders GROUP BY transaction_number ORDER BY orders_id DESC;
                ") or die(mysqli_error());
                while($fetch = mysqli_fetch_array($query)){
                    $user = $fetch['orders_id'];
                ?>
                <tr>
                    <td><?php echo $fetch['transaction_number']?></td>
                    <td><?php echo $fetch['emp_name']?></td>
                    <td><?php echo $fetch['table_number']?></td>
                    <td><?php echo $fetch['SUM(price)']?></td>
                    <td><?php echo $fetch['money_paid']?></td>
                    <td><?php echo $fetch['customer_change']?></td>
                    <td><?php echo $fetch['order_date']?></td>
                  
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        
        <!-- Pagination buttons -->
        <div id="pagination-container" class="mt-3">
            <button class="btn btn-primary" onclick="changePage(-1)">Previous</button>
            <button class="btn btn-primary" onclick="changePage(1)">Next</button>
        </div>
    </div>

    <script>
        var currentPage = 1;
        var rowsPerPage = 4;
        var ordersTable = document.getElementById("ordersTable").getElementsByTagName('tbody')[0].rows;

        function showPage(page) {
            var start = (page - 1) * rowsPerPage;
            var end = start + rowsPerPage;

            for (var i = 0; i < ordersTable.length; i++) {
                ordersTable[i].style.display = i >= start && i < end ? '' : 'none';
            }
        }

        function changePage(change) {
            currentPage += change;
            if (currentPage < 1) {
                currentPage = 1;
            } else if (currentPage > Math.ceil(ordersTable.length / rowsPerPage)) {
                currentPage = Math.ceil(ordersTable.length / rowsPerPage);
            }
            showPage(currentPage);
        }

        showPage(currentPage);
    </script>

                    </div>
                    <div class="tab-pane fade" id="tab-17" role="tabpanel" aria-labelledby="tab-17">
                        <button type="button" class="btn btn-primary animate-up-2 ml-0 mb-3" data-toggle="modal" data-target="#modal-form5">Add Item
                        <span class="ml-1"><span class="fas fa-plus"></span></span>
                            </button>
                        <div class="modal fade" id="modal-form5" tabindex="-1" role="dialog" aria-labelledby="modal-form5" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body p-0">
                                        <div class="card bg-primary shadow-soft border-light p-4">
                                            <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <div class="card-header text-center pb-0">
                                                <h2 class="h4">Add Item</h2>
                                            </div>
                                            <div class="card-body">
                                                <form action="addsupply.php" class="mt-4" method="POST">
                                                    <!-- Form -->
                                                    <div class="form-group">
                                                        <label for="exampleInputIcon3">Name</label>
                                                        <div class="input-group mb-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><span class="fas fa-box"></span></span>
                                                            </div>
                                                            <input class="form-control" name="name" id="name"  type="text" aria-label="email adress" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputIcon3">Quantity</label>
                                                        <div class="input-group mb-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><span class="fas fa-box-open"></span></span>
                                                            </div>
                                                            <input class="form-control" id="quantity" name="quantity"  type="text" aria-label="email adress" required>
                                                        </div>
                                                    </div>
                                                    <!-- End of Form -->
                                                    
                                                        
                                                    </div>
                                                    <button type="submit" name ="add" class="btn btn-block btn-primary">Add</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- TABLE -->
    <table class="table shadow-soft rounded ml-0 mr-3 mt-30 mb-0">
    <tr>
        <th class="border-0" scope="col">Name</th>
        <th class="border-0" scope="col">Quantity</th>

        <th class="border-0" scope="col">Action</th>
        <th class="border-0" scope="col">Delete</th>
    </tr>

    <?php
    $query = mysqli_query($con, "SELECT * FROM `supplies`") or die(mysqli_error());
    while($fetch = mysqli_fetch_array($query)){
        $user=$fetch['supply_id'];
        
    ?>
    
    <tr>
        
        <td><?php echo $fetch['name']?></td>
        <td><?php echo $fetch['quantity']?></td>
        <td><button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#modal-form7<?php echo $user?>">Edit</button>
        <td>
        <form action="delete.php" method="POST">
        <input type="hidden" name= "supply_id" value="<?php echo $fetch['supply_id'];?>">
                <button class="btn btn-sm btn-primary" type="submit" name="delete1"> Delete
                <span class="fas fa-trash" style="color: #bd1c00">
                </button>
        </td>
        </form>
        
            
        </td>
        
<!-- EDIT ACCOUNT MODAL -->
<div class="modal fade" id="modal-form7<?php echo $fetch['supply_id']?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
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
                        <form action="updatesupply.php" class="mt-4" method="POST">
                            <!-- Form -->
                            <div class="form-group">
                                <input type="hidden" name= "supply_id" value="<?php echo $fetch['supply_id'];?>">
                                <label for="exampleInputIcon3">Name</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><span class="fas fa-box"></span></span>
                                    </div>
                                    <input class="form-control" id="name"  name="name" value ="<?php echo $fetch['name'];?>" type="text" aria-label="email adress">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputIcon3">Quantity</label>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><span class="fas fa-box-open"></span></span>
                                    </div>
                                    <input class="form-control" id="quantity" name="quantity" value ="<?php echo $fetch['quantity'];?>" type="text" aria-label="email adress">
                                </div>
                            </div>
                            
                            <button type="submit" name="update1" class="btn btn-block btn-primary">Save</a></button>
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