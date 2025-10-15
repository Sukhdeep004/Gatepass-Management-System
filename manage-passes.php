<?php
// manage-passes.php
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
    <h1 class="h3 mb-4 text-gray-800">Manage Passes</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Gate Passes</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Pass Number</th>
                            <th>Full Name</th>
                            <th>Contact Number</th>
                            <th>Creation Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $ret = mysqli_query($conn, "select * from passes");
                        $cnt = 1;
                        while ($row = mysqli_fetch_array($ret)) {
                    ?>
                        <tr>
                            <td><?php echo $cnt;?></td>
                            <td><?php echo $row['pass_number'];?></td>
                            <td><?php echo $row['full_name'];?></td>
                            <td><?php echo $row['contact_number'];?></td>
                            <td><?php echo date('d-M-Y h:i A', strtotime($row['pass_creation_date']));?></td>
                            <td>
                                <a href="view-pass-detail.php?id=<?php echo $row['id'];?>" class="btn btn-primary btn-sm">View</a>
                                <a href="edit-pass-detail.php?id=<?php echo $row['id'];?>" class="btn btn-info btn-sm">Edit</a>
                                <a href="delete-pass.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this pass?');">Delete</a>
                            </td>
                        </tr>
                    <?php 
                        $cnt = $cnt+1;
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>