<?php
include("connection.php");
error_reporting(E_ALL ^ E_NOTICE);

// Fetch individual products for the transaction
$transactionNumber = $_GET['transactionNumber'];
$productsQuery = mysqli_query($con, "SELECT product_name, quantity FROM orders WHERE transaction_number = '$transactionNumber'");
$productsArray = array();

while ($product = mysqli_fetch_assoc($productsQuery)) {
    $productsArray[] = $product;
}

// Other transaction details
$empName = $_GET['empName'];
$tableNumber = $_GET['tableNumber'];
$totalPrice = $_GET['totalPrice'];
$moneyPaid = $_GET['moneyPaid'];
$customerChange = $_GET['customerChange'];
$orderDate = $_GET['orderDate'];

// Set response header for PDF
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="invoice.pdf"');

// Output the PDF content
?>
<html><body>
<h1>Invoice</h1>
<p>Transaction Number: <?php echo $transactionNumber; ?></p>
<p>Employee: <?php echo $empName; ?></p>
<p>Table Number: <?php echo $tableNumber; ?></p>

<?php
// Add product details if products are available
foreach ($productsArray as $product) {
    $productName = $product['product_name'];
    $quantity = $product['quantity'];

    echo "<p>Product: $productName, Quantity: $quantity</p>";
}

echo "<p>Total Price: $totalPrice</p>";
echo "<p>Money Paid: $moneyPaid</p>";
echo "<p>Change: $customerChange</p>";
echo "<p>Order Date: $orderDate</p>";
?>
</body></html>

