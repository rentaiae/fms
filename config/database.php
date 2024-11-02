<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'fleet_management');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Database helper functions
function getTotalCars() {
    global $conn;
    $result = $conn->query("SELECT COUNT(*) as total FROM cars");
    $data = $result->fetch_assoc();
    return $data['total'];
}

function getTotalClients() {
    global $conn;
    $result = $conn->query("SELECT COUNT(*) as total FROM customers");
    $data = $result->fetch_assoc();
    return $data['total'];
}

function getCarsOnRent() {
    global $conn;
    $result = $conn->query("SELECT COUNT(*) as total FROM bookings WHERE status = 'active'");
    $data = $result->fetch_assoc();
    return $data['total'];
}

function getAvailableCars() {
    global $conn;
    return getTotalCars() - getCarsOnRent();
}

function getTotalDrivers() {
    global $conn;
    $result = $conn->query("SELECT COUNT(*) as total FROM drivers");
    $data = $result->fetch_assoc();
    return $data['total'];
}

function getProfitLoss() {
    global $conn;
    $result = $conn->query("SELECT SUM(amount) as income FROM bookings WHERE status = 'completed'");
    $income = $result->fetch_assoc()['income'];
    
    $result = $conn->query("SELECT SUM(amount) as expenses FROM expenses");
    $expenses = $result->fetch_assoc()['expenses'];
    
    return $income - $expenses;
}