<?php
session_start();
require_once '../../config/database.php';
require_once '../../includes/auth.php';

if (!isLoggedIn()) {
    header('Location: ../../login.php');
    exit();
}

include '../../includes/header.php';
?>

<div class="container">
    <h2>Bookings Management</h2>
    <div class="actions">
        <a href="create.php" class="btn btn-primary">Create New Booking</a>
    </div>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Car</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT b.*, c.name as customer_name, cr.model as car_model 
                     FROM bookings b 
                     LEFT JOIN customers c ON b.customer_id = c.id
                     LEFT JOIN cars cr ON b.car_id = cr.id";
            $result = $conn->query($query);
            
            while ($booking = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$booking['id']}</td>";
                echo "<td>{$booking['customer_name']}</td>";
                echo "<td>{$booking['car_model']}</td>";
                echo "<td>{$booking['start_date']}</td>";
                echo "<td>{$booking['end_date']}</td>";
                echo "<td>{$booking['status']}</td>";
                echo "<td>{$booking['amount']}</td>";
                echo "<td>
                        <a href='edit.php?id={$booking['id']}' class='btn btn-sm btn-primary'>Edit</a>
                        <a href='cancel.php?id={$booking['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'>Cancel</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include '../../includes/footer.php'; ?>