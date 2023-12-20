<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include("connection.php");
include("validate.php");
include("userdetails.php");
  
    // Set cache-control headers to prevent caching
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

	
	$user_data = check_login($con);
    $user_details = getUserDetails($con);
    $users = getUsers($con);

    if (!empty($user_details['emp_name'])) {
        $_SESSION['userName'] = $user_details['emp_name']; // Store the user's name in a session
    } else {
        // Handle the case where the user's name is empty
        echo "User's name is empty.";
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
        </div>
    </div>
</nav>
<!-- END OF NAV BAR -->


<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.pagination a.page-link').forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.stopPropagation();
                loadPage(this.getAttribute('href').split('=')[1]);
            });
        });
    });

    function loadPage(page) {
        // Your existing AJAX logic here
        loadModalContent(page);
    }
</script>

               
<script>
    let selectedSize = "small";

    // Create an empty shopping cart array
    let shoppingCart = [];

    // Function to update the price based on the selected size
    function updatePrice(size) {
        selectedSize = size;
        const priceElement = document.querySelector(`input[name="size"][value=${size}]`);
        const price = parseFloat(priceElement.getAttribute(`data-${size}-price`));

        if (!isNaN(price)) {
            const cartItem = shoppingCart.find(item => item.name === productName && item.size === selectedSize);
            if (cartItem) {
                cartItem.price = price;
            }
        }

        updateCartDisplay();
    }

    function payOrder() {
    console.log("Pay Order Button Clicked");

    const customerName = document.getElementById("customerName").value;
    const moneyPaid = parseFloat(document.getElementById("moneyPaid").value);
    const cashierName = document.getElementById("cashierName").value;

    const cartData = {
        customerName: customerName,
        moneyPaid: moneyPaid,
        cashierName: cashierName,
        cartItems: shoppingCart
    };
   
    $.ajax({
        url: 'process_order.php',
        type: 'POST',
        data: { cartData: JSON.stringify(cartData) },
        success: function(response) {
            if (response === "success") {
                // Redirect to cashier.php after successful order processing
                window.location.href = 'cashier.php';
            } else {
                // Handle other cases if needed
                console.log("Order processing failed:", response);
            }
        },
        error: function(xhr, status, error) {
            // Handle AJAX errors if any
            console.error("AJAX error:", error);
        }
    });
}
function storeCartData() {
    const cartDataInput = document.getElementById('cartData');
    cartDataInput.value = JSON.stringify(shoppingCart);
}

    // Function to update the displayed price for a specific product
    function updateProductPrice(productId, size) {
        console.log(`updateProductPrice called with productId: ${productId}, size: ${size}`);

        // Retrieve the selected price based on both productId and size from the data attributes
        const priceElement = document.querySelector(`input[name="size"][value="${size}"][data-product-id="${productId}"]`);

        if (priceElement) {
            const price = parseFloat(priceElement.getAttribute(`data-${size}-price`));
            console.log(`data-${size}-price:`, priceElement.getAttribute(`data-${size}-price`));

            // Update the displayed price for the specific product
            const productPriceElement = document.getElementById(`product-price-${productId}`);
            console.log(`Updating price for product ${productId} to ₱${price.toFixed(2)}`);
            productPriceElement.textContent = `₱${price.toFixed(2)}`;
        } else {
            console.log(`No matching price element found for productId: ${productId}, size: ${size}`);
        }
    }

    // Event listener for radio button change
    const sizeRadioButtons = document.querySelectorAll('input[name="size"]');
    sizeRadioButtons.forEach(radioButton => {
        radioButton.addEventListener("change", function () {
            const selectedSize = this.value;
            const priceElement = document.querySelector(`input[name="size"][value="${selectedSize}"]`);
            const price = parseFloat(priceElement.getAttribute(`data-${selectedSize}-price`));

            if (!isNaN(price)) {
                // Update the displayed price on the product card
                updateProductPrice(price);
            }
        });
    });

    function addToCart(productName, price) {
        const priceElement = document.querySelector(`input[name="size"]:checked`);
        if (priceElement) {
            selectedSize = priceElement.value;
            const price = parseFloat(priceElement.getAttribute(`data-${selectedSize}-price`));

            if (!isNaN(price)) {
                // Check if an item with the same name and size already exists in the cart
                const existingItem = shoppingCart.find(item => item.name === productName && item.size === selectedSize);

                if (existingItem) {
                    // If it exists, increment the quantity
                    existingItem.quantity += 1;
                } else {
                    // If it doesn't exist, add it with quantity 1 and selected size
                    const item = {
                        name: productName,
                        price: price, // Use the price based on the selected size
                        size: selectedSize,
                        quantity: 1,
                    };
                    shoppingCart.push(item);
                }
            }
        }

        // Update the cart display with animation
        updateCartDisplay();
    }
    
    function addToCart1(productName, price) {
        const existingItem = shoppingCart.find(item => item.name === productName);
        if (existingItem) {
                    // If it exists, increment the quantity
                    existingItem.quantity += 1;
        } else { 
            const item = {
                        name: productName,
                        price: price, 
                        quantity: 1,
                    };
                    shoppingCart.push(item);
        }
        // Update the cart display with animation
        updateCartDisplay();
    }
  

    // Function to remove a product from the cart by index
    function removeFromCart(index) {
        shoppingCart.splice(index, 1); // Remove the item at the specified index

        // Update the cart display
        updateCartDisplay();
    }

    // Function to calculate and return the total price of all items in the cart
    function calculateTotal() {
        let total = 0;
        shoppingCart.forEach(item => {
            total += item.price * item.quantity;
        });
        return total;
    }

    // Function to update the cart display
    function updateCartDisplay() {
        const cartItemCount = shoppingCart.length;
        const total = calculateTotal();

        // Update the cart count in the button
        const cartButton = document.getElementById("cart-button");
        cartButton.innerHTML = `Order <span class="badge badge-pill badge-success">${cartItemCount}</span>`;

        // Get a reference to the cart contents table body
        const cartTableBody = document.getElementById("cart-contents");

        // Clear previous table rows
        cartTableBody.innerHTML = "";

        // Iterate through the shoppingCart array and add rows to the table
        shoppingCart.forEach((item, index) => {
        const cartItemRow = document.createElement("tr");
    
        const itemName = item.size ? `${item.name} (${item.size})` : item.name;

        cartItemRow.innerHTML = `
        <td>${itemName}</td>
        <td>
            <input type="number" min="1" value="${item.quantity}" onchange="updateQuantity(${index}, this.value)" style="width: 50px; padding: 5px;">
        </td>
        <td>₱${(item.price * item.quantity).toFixed(2)}</td>
        <td>
            <button class="btn btn-sm btn-danger" onclick="removeFromCart(${index})">Remove</button>
        </td>
        `;

        // Append the row to the table
        cartTableBody.appendChild(cartItemRow);
        });

        // Display the total price
        const totalContainer = document.getElementById("cart-total");
        totalContainer.textContent = `Total: ₱${total.toFixed(2)}`;

        // Get references to relevant elements
        const moneyPaidInput = document.getElementById("moneyPaid");
        const changeElement = document.getElementById("change");

        // Calculate and display the change
        moneyPaidInput.addEventListener("input", function () {
            const moneyPaid = parseFloat(moneyPaidInput.value);

            if (isNaN(moneyPaid)) {
                changeElement.textContent = ""; // Clear the change if the input is not a valid number
            } else {
                const change = moneyPaid - total;

                if (change >= 0) {
                    // Display the change
                    changeElement.textContent = `Change: ₱${change.toFixed(2)}`;
                } else {
                    changeElement.textContent = "Insufficient payment";
                }
            }
        });
    }
    function generateInvoicePDF(transactionNumber, empName, tableNumber, products, price, moneyPaid, customerChange, orderDate) {
    // Create a new jsPDF instance with custom width and height
    const doc = new jsPDF({
        unit: 'mm',
        format: [80, 200],
    });

    // Set the title
    doc.setFontSize(8);
    doc.text('Invoice', 10, 10);

    // Add transaction details
    doc.setFontSize(6);
    doc.text(`Transaction Number: ${transactionNumber}`, 10, 15);
    doc.text(`Employee: ${empName}`, 10, 20);
    doc.text(`Table Number: ${tableNumber}`, 10, 25);

    // Add product details if products are available
    doc.setFontSize(6);
    let yOffset = 30;

    if (Array.isArray(products) && products.length > 0) {
        products.forEach(product => {
            const productName = product.product_name;
            const quantity = product.quantity;

            doc.text(`Product: ${productName}`, 10, yOffset);
            doc.text(`Quantity: ${quantity}`, 10, yOffset + 5);

            yOffset += 10;
        });
    } else {
        doc.text('No products ordered', 10, yOffset);
        yOffset += 10;
    }

    // Add financial details
    doc.setFontSize(6);
    doc.text(`Total Price: ${price}`, 10, yOffset);
    doc.text(`Money Paid: ${moneyPaid}`, 10, yOffset + 5);
    doc.text(`Change: ${customerChange}`, 10, yOffset + 10);
    doc.text(`Order Date: ${orderDate}`, 10, yOffset + 15);

    // Save the document
    const pdfBlob = doc.output('blob');

    // Create a Blob URL for the PDF content
    const pdfDataUri = URL.createObjectURL(pdfBlob);

    // Open the PDF in a new tab
    const pdfWindow = window.open();
    pdfWindow.document.open();
    pdfWindow.document.write('<iframe width="100%" height="100%" src="' + pdfDataUri + '"></iframe>');
    pdfWindow.document.close();
}
generateInvoicePDF(
                    <?php echo json_encode($transactionNumber); ?>,
                    <?php echo json_encode($empName); ?>,
                    <?php echo json_encode($tableNumber); ?>,
                    <?php echo json_encode($productsArray); ?>,
                    <?php echo json_encode($totalPrice); ?>,
                    <?php echo json_encode($moneyPaid); ?>,
                    <?php echo json_encode($customerChange); ?>,
                    <?php echo json_encode($orderDate); ?>
                );

    // Function to generate and download the PDF invoice
    function generateInvoice() {
            // Get the customer's name from the input field
            const customerNameInput = document.getElementById('customerName');
            const customerName = customerNameInput.value;

            // Get the money paid from the input field
            const moneyPaidInput = document.getElementById('moneyPaid');
            const moneyPaid = parseFloat(moneyPaidInput.value);

            // Call the generateInvoicePDF function
            generateInvoicePDF(customerName, shoppingCart, moneyPaid);

            // Clear the customer name and money paid input fields
            customerNameInput.value = '';
            moneyPaidInput.value = '';

           
        
}

</script>
<div class="container">
    <div class="row">
        <div class="col-12 p-3">
            <!-- Tab -->
            <div class="nav-wrapper position-relative">
                <ul class="nav nav-pills nav-pill-circle mb-3" id="tab-34" role="tablist">
                    <li class="nav-item mr-3 mr-md-0">
                        <a class="nav-link text-sm-center active" aria-label="first navigation tab" id="tab-link-example-13" data-toggle="tab" href="#link-example-13" role="tab" aria-controls="link-example-13" aria-selected="true">
                            <span class="nav-link-icon icon-info d-block"><i class="fa-solid fa-mug-saucer"></i></span>
                        </a>
                    </li>
                    <li class="nav-item mr-3 mr-md-0">
                        <a class="nav-link text-sm-center" aria-label="second navigation tab" id="tab-link-example-14" data-toggle="tab" href="#link-example-14" role="tab" aria-controls="link-example-14" aria-selected="false">
                            <span class="nav-link-icon icon-success d-block"><i class="fa-solid fa-pizza-slice"></i></span>
                        </a>
                    </li>
                    <li class="nav-item mr-3 mr-md-0">
                        <a class="nav-link text-sm-center" aria-label="second navigation tab" id="tab-link-example-15" data-toggle="tab" href="#link-example-15" role="tab" aria-controls="link-example-15" aria-selected="false">
                            <span class="nav-link-icon icon-success d-block"><i class="fas fa-print"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End of Tab Nav -->
            <!-- Tab Content -->
            <button id="cart-button" class="btn btn-primary p-2 mb-3" data-toggle="modal" data-target="#cartModal">
                Order <span class="badge badge-pill badge-success">0</span>   
            </button>
            <!-- Cart Modal -->
            <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px;">
                                    <div class="modal-content" style="height: 85vh;">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="cartModalLabel" style="font-weight: bold; font-size: 30px;">Order</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="max-height: 60vh; overflow-y: auto;">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="cart-contents">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="mr-auto">
                                                <!-- Cart Total -->
                                                <div id="cart-total" style="font-weight: bold; font-size: 18px;"></div>

                                                <!-- Display Change -->
                                                <div id="change" style="font-weight: bold; font-size: 18px;"></div>
                                            </div>

                                            <div>
                                                <!-- Table number Input Field -->
                                                <div class="form-group">
                                                    <label for="customerName">Table no:</label>
                                                    <input type="text" class="form-control" id="customerName" placeholder="Enter table number">
                                                </div>

                                                <div class="form-group">
                                                    <input type="hidden" name= "cashierName" id="cashierName" value="<?php echo $user_data['emp_name']?>">
                                                </div>

                                                <!-- Money Paid Input Field -->
                                                <div class="form-group">
                                                    <label for="moneyPaid">Money Paid:</label>
                                                    <input type="text" class="form-control" id="moneyPaid" placeholder="Enter the amount paid">
                                                </div>

                                                <!-- Checkout Button -->
                                                
                                                <form id="orderForm" method="post" action="process_order.php">
                                                    <input type="hidden" name="cartData" id="cartData" value="">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary" onclick="payOrder()">Pay Order</button>
                                                    <button type="button" class="btn btn-primary" onclick="generateInvoice()">Generate Invoice</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            <div class="card shadow-inset bg-primary border-light p-2 rounded">
                <div class="card-body p-2 ml-0">
                    <div class="tab-content" id="tabcontentexample-5">
                        <div class="tab-pane fade show active" id="link-example-13" role="tabpanel" aria-labelledby="tab-link-example-13">
                            <!-- Cart Button -->
                            <div class="row">
                                <?php
                                $query1 = mysqli_query($con, "SELECT * FROM `products`") or die(mysqli_error());
                                while ($fetch2 = mysqli_fetch_array($query1)) {
                                    $product = $fetch2['product_id'];
                                    ?>
                                    <div class="col-6 col-md-4 col-lg-3 mb-3 text-center">
                                        <div class="card bg-primary shadow-soft border-light">
                                            <img src="uploads/<?php echo $fetch2['image']; ?>" class="card-img-top" alt="image" style="width: 100%; height: 250px;">
                                            <div class="card-footer border-top border-light p-3">
                                                <span class="h6 mb-0 text-gray"><?php echo $fetch2['name']; ?></span>
                                                <div id="size-selection" class="mt-3">
                                                    <!-- Add radio buttons with onclick attribute to trigger price update -->
                                                    <?php if (!empty($fetch2['small_price'])) { ?>
                                                        <!-- Small size radio button -->
                                                        <label>
                                                            <input type="radio" name="size" value="Small" data-product-id="<?php echo $fetch2['product_id']; ?>" data-small-price="<?php echo $fetch2['small_price']; ?>"
                                                                   onclick="updateProductPrice('<?php echo $fetch2['product_id']; ?>', 'Small')">
                                                            Small
                                                        </label>
                                                    <?php } ?>

                                                    <?php if (!empty($fetch2['medium_price'])) { ?>
                                                        <!-- Medium size radio button -->
                                                        <label>
                                                            <input type="radio" name="size" value="Medium" data-product-id="<?php echo $fetch2['product_id']; ?>" data-medium-price="<?php echo $fetch2['medium_price']; ?>"
                                                                   onclick="updateProductPrice('<?php echo $fetch2['product_id']; ?>', 'Medium')">
                                                            Medium
                                                        </label>
                                                    <?php } ?>

                                                    <?php if (!empty($fetch2['large_price'])) { ?>
                                                        <!-- Large size radio button -->
                                                        <label>
                                                            <input type="radio" name="size" value="Large" data-product-id="<?php echo $fetch2['product_id']; ?>" data-large-price="<?php echo $fetch2['large_price']; ?>"
                                                                   onclick="updateProductPrice('<?php echo $fetch2['product_id']; ?>', 'Large')">
                                                            Large
                                                        </label>
                                                    <?php } ?>
                                                </div>
                                                <!-- Display the updated product price here -->
                                                <div class="d-flex justify-content-between align-items-center mt-3">
                                                    <!-- Add to cart button here -->
                                                    <div id="product-price-<?php echo $fetch2['product_id'];?>" class="mt-2"></div>
                                                    <a class="btn btn-xs btn-primary"  onclick="addToCart('<?php echo $fetch2['name']; ?>', <?php echo $fetch2['small_price']; ?>)">
                                                         Add to Order
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                           
                        </div>
                        <div class="tab-pane fade" id="link-example-14" role="tabpanel" aria-labelledby="tab-link-example-14">
                            <div class="row">
                                <?php
                                $query1 = mysqli_query($con, "SELECT * FROM `foods`") or die(mysqli_error());
                                while ($fetch2 = mysqli_fetch_array($query1)) {
                                    $product = $fetch2['food_id'];
                                ?>
                                    <div class="col-6 col-md-4 col-lg-3 mb-3 text-center">
                                        <div class="card bg-primary shadow-soft border-light">
                                            <img src="uploads/<?php echo $fetch2['image']; ?>" class="card-img-top" alt="image" style="width: 100%; height: 250px;">
                                            <div class="card-footer border-top border-light p-3">
                                                <span class="h6 mb-0 text-gray"><?php echo $fetch2['food_name']; ?></span>
                                                <!-- Display the updated product price here -->
                                                <div class="d-flex justify-content-between align-items-end mt-3">
                                                    <span class="h6 mb-0 text-gray">₱<?php echo $fetch2['price']; ?></span>
                                                    <!-- Add to cart button here -->
                                                    <a class="btn btn-xs btn-primary" onclick="addToCart1('<?php echo $fetch2['food_name']; ?>', <?php echo $fetch2['price']; ?>)">
                                                        Add to Order
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <div class="tab-pane fade" id="link-example-14" role="tabpanel" aria-labelledby="tab-link-example-14">
                        <div class="row">
                            <?php
                            $query1 = mysqli_query($con, "SELECT * FROM `foods`") or die(mysqli_error());
                            while ($fetch2 = mysqli_fetch_array($query1)) {
                                $product = $fetch2['food_id'];
                            ?>
                                <div class="col-6 col-md-4 col-lg-3 mb-3 text-center">
                                    <div class="card bg-primary shadow-soft border-light">
                                        <img src="uploads/<?php echo $fetch2['image']; ?>" class="card-img-top" alt="image" style="width: 100%; height: 250px;">
                                        <div class="card-footer border-top border-light p-3">
                                            <span class="h6 mb-0 text-gray"><?php echo $fetch2['food_name']; ?></span>
                                            <!-- Display the updated product price here -->
                                            <div class="d-flex justify-content-between align-items-end mt-3">
                                                <span class="h6 mb-0 text-gray">₱<?php echo $fetch2['price']; ?></span>
                                                <!-- Add to cart button here -->
                                                <a class="btn btn-xs btn-primary" onclick="addToCart1('<?php echo $fetch2['food_name']; ?>', <?php echo $fetch2['price']; ?>)">
                                                    Add to Order
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="link-example-15" role="tabpanel" aria-labelledby="tab-link-example-15">
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
                    <th scope="col">Action</th>
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
                    <td>
<button class="btn btn-sm btn-primary" onclick="generateInvoicePDF(
    '<?php echo $fetch['transaction_number']?>',
    '<?php echo $fetch['emp_name']?>',
    '<?php echo $fetch['table_number']?>',
    <?php echo json_encode($productsArray); ?>,
    '<?php echo $fetch['SUM(price)']?>',
    '<?php echo $fetch['money_paid']?>',
    '<?php echo $fetch['customer_change']?>',
    '<?php echo $fetch['order_date']?>')">Print</button>

                    </td>
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

                    </div>
                </div>
            <!-- End of Tab Content -->
        </div>
    </div>
</div>



    <!-- Core -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
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