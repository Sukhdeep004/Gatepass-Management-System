<?php
// reports.php
session_start();
include('db.php');
// Check if user is logged in
if (!isset($_SESSION['admin_id']) || strlen($_SESSION['admin_id']) == 0) {
    header("location:logout.php");
    exit;
}

$report_type = isset($_POST['report_type']) ? $_POST['report_type'] : '';
$from_date = isset($_POST['from_date']) ? $_POST['from_date'] : '';
$to_date = isset($_POST['to_date']) ? $_POST['to_date'] : '';
$results = null;
$report_title = '';

if(isset($_POST['generate_report'])) {
    switch($report_type) {
        case 'daily':
            $query = "SELECT * FROM passes WHERE DATE(pass_creation_date) = CURDATE() ORDER BY pass_creation_date DESC";
            $report_title = "Daily Report - " . date('d-M-Y');
            break;
        case 'monthly':
            $query = "SELECT * FROM passes WHERE MONTH(pass_creation_date) = MONTH(CURDATE()) AND YEAR(pass_creation_date) = YEAR(CURDATE()) ORDER BY pass_creation_date DESC";
            $report_title = "Monthly Report - " . date('F Y');
            break;
        case 'yearly':
            $query = "SELECT * FROM passes WHERE YEAR(pass_creation_date) = YEAR(CURDATE()) ORDER BY pass_creation_date DESC";
            $report_title = "Yearly Report - " . date('Y');
            break;
        case 'custom':
            if($from_date && $to_date) {
                $query = "SELECT * FROM passes WHERE DATE(pass_creation_date) BETWEEN '$from_date' AND '$to_date' ORDER BY pass_creation_date DESC";
                $report_title = "Custom Report - " . date('d-M-Y', strtotime($from_date)) . " to " . date('d-M-Y', strtotime($to_date));
            }
            break;
    }
    
    if(isset($query)) {
        $results = mysqli_query($conn, $query);
    }
}
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Generate Reports</h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Report Options</h6>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="report_type" class="form-label">Select Report Type</label>
                            <select class="form-select" name="report_type" id="report_type" required onchange="toggleDateFields()">
                                <option value="">Choose Report Type</option>
                                <option value="daily" <?php echo ($report_type == 'daily') ? 'selected' : ''; ?>>Daily Report</option>
                                <option value="monthly" <?php echo ($report_type == 'monthly') ? 'selected' : ''; ?>>Monthly Report</option>
                                <option value="yearly" <?php echo ($report_type == 'yearly') ? 'selected' : ''; ?>>Yearly Report</option>
                                <option value="custom" <?php echo ($report_type == 'custom') ? 'selected' : ''; ?>>Custom Date Range</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3" id="from_date_field" style="display: <?php echo ($report_type == 'custom') ? 'block' : 'none'; ?>;">
                        <div class="mb-3">
                            <label for="from_date" class="form-label">From Date</label>
                            <input type="date" class="form-control" id="from_date" name="from_date" value="<?php echo $from_date; ?>">
                        </div>
                    </div>
                    <div class="col-md-3" id="to_date_field" style="display: <?php echo ($report_type == 'custom') ? 'block' : 'none'; ?>;">
                        <div class="mb-3">
                            <label for="to_date" class="form-label">To Date</label>
                            <input type="date" class="form-control" id="to_date" name="to_date" value="<?php echo $to_date; ?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" name="generate_report" class="btn btn-primary w-100">
                                <i class="fa fa-file-alt"></i> Generate
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php if($results && mysqli_num_rows($results) > 0): ?>
    <div class="card shadow mb-4" id="reportArea">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $report_title; ?></h6>
            <button class="btn btn-success btn-sm" onclick="printReport()">
                <i class="fa fa-print"></i> Print Report
            </button>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>Total Records:</strong> <?php echo mysqli_num_rows($results); ?>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Pass Number</th>
                            <th>Full Name</th>
                            <th>Category</th>
                            <th>Contact Number</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Creation Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $cnt = 1;
                        while ($row = mysqli_fetch_array($results)) {
                    ?>
                        <tr>
                            <td><?php echo $cnt;?></td>
                            <td><?php echo $row['pass_number'];?></td>
                            <td><?php echo $row['full_name'];?></td>
                            <td><?php echo $row['category'];?></td>
                            <td><?php echo $row['contact_number'];?></td>
                            <td><?php echo date('d-M-Y', strtotime($row['from_date']));?></td>
                            <td><?php echo date('d-M-Y', strtotime($row['to_date']));?></td>
                            <td><?php echo date('d-M-Y h:i A', strtotime($row['pass_creation_date']));?></td>
                        </tr>
                    <?php 
                        $cnt++;
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php elseif($results && mysqli_num_rows($results) == 0): ?>
    <div class="alert alert-info">
        <i class="fa fa-info-circle"></i> No records found for the selected criteria.
    </div>
    <?php endif; ?>
</div>

<script>
function toggleDateFields() {
    var reportType = document.getElementById('report_type').value;
    var fromDateField = document.getElementById('from_date_field');
    var toDateField = document.getElementById('to_date_field');
    
    if(reportType === 'custom') {
        fromDateField.style.display = 'block';
        toDateField.style.display = 'block';
        document.getElementById('from_date').required = true;
        document.getElementById('to_date').required = true;
    } else {
        fromDateField.style.display = 'none';
        toDateField.style.display = 'none';
        document.getElementById('from_date').required = false;
        document.getElementById('to_date').required = false;
    }
}

function printReport() {
    var printContent = document.getElementById('reportArea').innerHTML;
    var originalContent = document.body.innerHTML;
    document.body.innerHTML = '<div style="padding: 20px;">' + printContent + '</div>';
    window.print();
    document.body.innerHTML = originalContent;
    location.reload();
}
</script>

<style>
@media print {
    .sidebar, .btn, header, nav, .card-header button {
        display: none !important;
    }
    .main-content {
        padding: 0 !important;
    }
    body {
        background: white !important;
    }
}
</style>

<?php include 'includes/footer.php'; ?>