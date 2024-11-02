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
    <h2>Cars Management</h2>
    <div class="actions">
        <a href="add.php" class="btn btn-primary">Add New Car</a>
        <a href="types.php" class="btn btn-secondary">Manage Car Types</a>
    </div>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Model</th>
                <th>Type</th>
                <th>License Plate</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT c.*, ct.name as type_name 
                     FROM cars c 
                     LEFT JOIN car_types ct ON c.type_id = ct.id";
            $result = $conn->query($query);
            
            while ($car = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$car['id']}</td>";
                echo "<td>{$car['model']}</td>";
                echo "<td>{$car['type_name']}</td>";
                echo "<td>{$car['license_plate']}</td>";
                echo "<td>{$car['status']}</td>";
                echo "<td>
                        <a href='edit.php?id={$car['id']}' class='btn btn-sm btn-primary'>Edit</a>
                        <a href='delete.php?id={$car['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include '../../includes/footer.php'; ?>