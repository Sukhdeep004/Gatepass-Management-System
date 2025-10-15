<?php
// dashboard.php
session_start();
include('db.php');
// Check if user is logged in
if (!isset($_SESSION['admin_id']) || strlen($_SESSION['admin_id']) == 0) {
    header("location:logout.php");
    exit;
}
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="row">

        <!-- Total Passes Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Passes</div>
                            <?php 
                                $query = mysqli_query($conn, "SELECT id FROM passes");
                                $count_total_passes = mysqli_num_rows($query);
                            ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_total_passes; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-id-card-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Passes Created Today Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Passes Created Today</div>
                            <?php 
                                $query_today = mysqli_query($conn, "SELECT id FROM passes where date(pass_creation_date) = CURDATE()");
                                $count_today_passes = mysqli_num_rows($query_today);
                            ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_today_passes; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Passes in Last 7 Days Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Passes in Last 7 days</div>
                             <?php 
                                $query_week = mysqli_query($conn, "SELECT id FROM passes where date(pass_creation_date) >= DATE(NOW()) - INTERVAL 7 DAY");
                                $count_week_passes = mysqli_num_rows($query_week);
                            ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_week_passes; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-week fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>