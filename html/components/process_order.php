<?php
session_start();
// Connect to your database (replace with your database credentials)
include("connection.php");
error_reporting(E_ALL ^ E_NOTICE);
// Retrieve cart data from the form
$cartData = json_decode($_POST['cartData'], true);

// Extract data
$customerName = mysqli_real_escape_string($con, $cartData['customerName']);
$moneyPaid = floatval($cartData['moneyPaid']);

$transactionNumber = generateTransactionNumber(); // Extract the transaction number
$cartItems = $cartData['cartItems'];
$cashier = mysqli_real_escape_string($con, $cartData['cashierName']);
// Insert cart data into the database

if (isset($_SESSION['userName'])) {
    $userName = $_SESSION['userName'];
    $totalPrice = 0;

    foreach ($cartItems as $cartItem) {
        $productName = mysqli_real_escape_string($con, $cartItem['name']);
        $size = mysqli_real_escape_string($con, $cartItem['size']);
        $quantity = intval($cartItem['quantity']);
        $price = floatval($cartItem['price'] * $quantity);

        $totalPrice += $price;

        // Get the current date and time
        $orderDate = date('Y-m-d');
    }

    // Calculate the overall change
    $overallChange = $moneyPaid - $totalPrice;

    foreach ($cartItems as $cartItem) {
        $productName = mysqli_real_escape_string($con, $cartItem['name']);
        $size = mysqli_real_escape_string($con, $cartItem['size']);
        $quantity = intval($cartItem['quantity']);
        $price = floatval($cartItem['price'] * $quantity);

        // Get the current date and time
        $orderDate = date('Y-m-d');

        $sql = "INSERT INTO orders (transaction_number, table_number, product_name, size, quantity, price, money_paid, `customer_change`, order_date, emp_name)
                VALUES ('$transactionNumber', '$customerName', '$productName', '$size', $quantity, $price, $moneyPaid, $overallChange, '$orderDate', '$userName')";

        if (mysqli_query($con, $sql)) {
            // Data inserted successfully
        } else {
            // Handle the error, you can log it or send an error response
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
            exit;
        }
    }
    echo "success";
    exit;
}

function generateTransactionNumber() {
    $dateTime = new DateTime();
    $timestamp = $dateTime->getTimestamp();
    $randomNumber = mt_rand(1000, 9999); // Generate a random 4-digit number
    return "SBRK-" . $timestamp . "-" . $randomNumber;
}

// Close the database connection
mysqli_close($con);

// Redirect to a thank-you page or display a success message
header("Location: cashier.php");
?>
