<?php
session_start();
include "server.php";

// Adding everything into Order_Items part of database
 $person_name = $_POST['person_name'];

$person_id = $conn->insert_id;

if (isset($_SESSION['id']))
    $conn->query("INSERT INTO Orders (person_id, status) VALUES ({$_SESSION['id']}, 'paid')");
else{
   $_SESSION['LogIn'] = false;
   header("Location: login.php"); 
}

$order_id = $conn->insert_id;

// Order Item Details to show
$food_id = (int)$_POST['food_id'];
$qty = (int)$_POST['qty'];
$price_each = (float)$_POST['price_each'];
$total_price = (float)$_POST['total_price'];

$conn->query("
    INSERT INTO Order_Items (order_id, food_id, quantity, price_each) VALUES ($order_id, $food_id, $qty, $price_each)
");

header("Location: history.php"); // Show Recent Items from this and recommendations after it
exit;
?>