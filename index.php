<?php
session_start();
require_once 'config/database.php';
require_once 'includes/auth.php';

// Check if user is logged in
if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

// Include header
include 'includes/header.php';
?>

<div class="dashboard-container">
    <div class="sidebar">
        <?php include 'includes/sidebar.php'; ?>
    </div>
    
    <div class="main-content">
        <div class="dashboard-stats">
            <div class="stat-card">
                <h3>Total Cars</h3>
                <p><?php echo getTotalCars(); ?></p>
            </div>
            <div class="stat-card">
                <h3>Total Clients</h3>
                <p><?php echo getTotalClients(); ?></p>
            </div>
            <div class="stat-card">
                <h3>Cars on Rent</h3>
                <p><?php echo getCarsOnRent(); ?></p>
            </div>
            <div class="stat-card">
                <h3>Available Cars</h3>
                <p><?php echo getAvailableCars(); ?></p>
            </div>
            <div class="stat-card">
                <h3>Total Drivers</h3>
                <p><?php echo getTotalDrivers(); ?></p>
            </div>
            <div class="stat-card">
                <h3>Profit/Loss</h3>
                <p><?php echo getProfitLoss(); ?></p>
            </div>
        </div>
        
        <div class="recent-activities">
            <h2>Recent Activities</h2>
            <?php include 'includes/recent_activities.php'; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>