<?php
// view-pass-detail.php
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
    <?php
    $pass_id = intval($_GET['id']);
    $ret = mysqli_query($conn, "select * from passes where id='$pass_id'");
    $cnt = 1;
    while ($row = mysqli_fetch_array($ret)) {
    ?>
    <h1 class="h3 mb-4 text-gray-800">View Pass #<?php echo $row['pass_number']; ?></h1>
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4" id="printableArea">
                <div class="card-header py-3 text-center">
                    <h4 class="m-0 font-weight-bold text-primary">Gate Pass Details</h4>
                    <p class="mb-0 text-muted">Gate Pass Management System</p>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Pass Number</th>
                            <td><?php echo $row['pass_number']; ?></td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td><?php echo $row['category']; ?></td>
                        </tr>
                        <tr>
                            <th>Full Name</th>
                            <td><?php echo $row['full_name']; ?></td>
                        </tr>
                         <tr>
                            <th>Contact Number</th>
                            <td><?php echo $row['contact_number']; ?></td>
                        </tr>
                        <tr>
                            <th>Email Address</th>
                            <td><?php echo $row['email']; ?></td>
                        </tr>
                         <tr>
                            <th>Identity Type</th>
                            <td><?php echo $row['identity_type']; ?></td>
                        </tr>
                        <tr>
                            <th>Identity Card Number</th>
                            <td><?php echo $row['identity_card_no']; ?></td>
                        </tr>
                        <tr>
                            <th>From Date</th>
                            <td><?php echo date('d-M-Y', strtotime($row['from_date'])); ?></td>
                        </tr>
                        <tr>
                            <th>To Date</th>
                            <td><?php echo date('d-M-Y', strtotime($row['to_date'])); ?></td>
                        </tr>
                        <tr>
                            <th>Reason for Pass</th>
                            <td><?php echo $row['reason']; ?></td>
                        </tr>
                         <tr>
                            <th>Pass Creation Date</th>
                            <td><?php echo date('d-M-Y h:i A', strtotime($row['pass_creation_date'])); ?></td>
                        </tr>
                    </table>
                    <div class="text-center mt-4 print-hide">
                        <p class="text-muted"><i>This is an official gate pass. Please carry this with valid ID proof.</i></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
             <button class="btn btn-primary btn-lg w-100 mb-3" onclick="printPass()">
                 <i class="fa fa-print"></i> Print Pass
             </button>
             <a href="manage-passes.php" class="btn btn-secondary btn-lg w-100">
                 <i class="fa fa-arrow-left"></i> Back to Manage Passes
             </a>
        </div>
    </div>
    <?php } ?>
</div>

<style>
@media print {
    .sidebar, .print-hide, .btn, header, nav {
        display: none !important;
    }
    .main-content {
        padding: 0 !important;
        margin: 0 !important;
    }
    #printableArea {
        box-shadow: none !important;
        border: 2px solid #000 !important;
    }
    .card-header {
        background-color: #f8f9fa !important;
        border-bottom: 2px solid #000 !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    body {
        background: white !important;
    }
    .table-bordered {
        border: 1px solid #000 !important;
    }
    .table-bordered th, .table-bordered td {
        border: 1px solid #000 !important;
        padding: 8px !important;
    }
}
</style>

<?php include 'includes/footer.php'; ?>