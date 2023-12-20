<?php




$period = $_GET['period'];
include("connection.php");
// Define start and end dates based on the selected period
if ($period == 'daily') {
    $start = date('Y-m-d');
    $end = date('Y-m-d');
} elseif ($period == 'weekly') {
    $start = date('Y-m-d', strtotime('last Monday'));
    $end = date('Y-m-d', strtotime('next Sunday'));
} elseif ($period == 'monthly') {
    $start = date('Y-m-01');
    $end = date('Y-m-t');
}

// Fetch data from the table for the specified period
$query  = "SELECT transaction_number, table_number, product_name, price, money_paid, customer_change, order_date, emp_name FROM orders WHERE order_date BETWEEN '$start' AND '$end'";
$result = $con->query($query);

// Create HTML table
$tableHTML = "<table class='table table-responsive'>";
$tableHTML .= "<thead><tr><th>Transaction Number</th><th>Table Number</th><th>Product Name
</th><th>Price</th><th>Money</th><th>Change</th><th>Date</th><th>Employee</th></tr></thead>";

while ($row = $result->fetch_assoc()) {

    $tableHTML .= "<tbody>";
    $tableHTML .= "<tr>";
    $tableHTML .= "<td>{$row['transaction_number']}</td>";
    $tableHTML .= "<td>{$row['table_number']}</td>";
    $tableHTML .= "<td>{$row['product_name']}</td>";
    $tableHTML .= "<td>{$row['price']}</td>"; 
    $tableHTML .= "<td>{$row['money_paid']}</td>"; 
    $tableHTML .= "<td>{$row['customer_change']}</td>"; 
    $tableHTML .= "<td>{$row['order_date']}</td>"; 
    $tableHTML .= "<td>{$row['emp_name']}</td>"; 
    $tableHTML .= "</tr>";
    $tableHTML .= "</tbody>";
}

$tableHTML .= "</table>";

// Send the HTML table as JSON response
header('Content-Type: application/json');
echo json_encode(['tableHTML' => $tableHTML]);

// Close the connection
$con->close();
?>