<?php
// add-pass.php
session_start();
include('db.php');
// Check if user is logged in
if (!isset($_SESSION['admin_id']) || strlen($_SESSION['admin_id']) == 0) {
    header("location:logout.php");
    exit;
}

$message = '';
if(isset($_POST['submit'])) {
    $category = $_POST['category'];
    $fullname = $_POST['fullname'];
    $contactno = $_POST['contactno'];
    $email = $_POST['email'];
    $idtype = $_POST['idtype'];
    $idcardno = $_POST['idcardno'];
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $reason = $_POST['reason'];
    $passnumber = mt_rand(100000000, 999999999);
    
    $sql = "INSERT INTO passes(pass_number, category, full_name, contact_number, email, identity_type, identity_card_no, from_date, to_date, reason) VALUES ('$passnumber', '$category', '$fullname', '$contactno', '$email', '$idtype', '$idcardno', '$fromdate', '$todate', '$reason')";
    
    $query = mysqli_query($conn, $sql);

    if($query) {
        $message = "<div class='alert alert-success'>Pass added successfully. Pass number is <strong>$passnumber</strong></div>";
    } else {
        $message = "<div class='alert alert-danger'>Something went wrong. Please try again.</div>";
    }
}
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Add Pass</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">New Gate Pass Details</h6>
        </div>
        <div class="card-body">
            <?php echo $message; ?>
            <form method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                         <div class="mb-3">
                            <label for="contactno" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="contactno" name="contactno" required pattern="[0-9]{10}">
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                    </div>
                    <div class="col-md-6">
                         <div class="mb-3">
                            <label for="idtype" class="form-label">Identity Type</label>
                            <select class="form-select" name="idtype" required>
                                <option value="">Choose Identity Type</option>
                                <option value="Voter Card">Voter Card</option>
                                <option value="PAN Card">PAN Card</option>
                                <option value="Aadhar Card">Aadhar Card</option>
                                <option value="Driving License">Driving License</option>
                                <option value="Passport">Passport</option>
                            </select>
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="idcardno" class="form-label">Identity Card Number</label>
                            <input type="text" class="form-control" id="idcardno" name="idcardno" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                         <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" name="category" required>
                                <option value="">Choose Category</option>
                                <option value="Visitor">Visitor</option>
                                <option value="Employee">Employee</option>
                                <option value="Student">Student</option>
                                <option value="Vendor">Vendor</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="fromdate" class="form-label">From Date</label>
                            <input type="date" class="form-control" id="fromdate" name="fromdate" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                         <div class="mb-3">
                            <label for="todate" class="form-label">To Date</label>
                            <input type="date" class="form-control" id="todate" name="todate" required>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="reason" class="form-label">Reason</label>
                    <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Create Pass</button>
                <button type="reset" class="btn btn-warning">Clear</button>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>