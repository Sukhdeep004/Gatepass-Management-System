<?php
// delete-pass.php
session_start();
include('db.php');

// Ensure user is logged in
if (!isset($_SESSION['admin_id']) || strlen($_SESSION['admin_id']) == 0) {
    header("location:logout.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    if ($stmt = mysqli_prepare($conn, "DELETE FROM passes WHERE id = ?")) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        $ok = mysqli_stmt_execute($stmt);
        $affected = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);

        if ($ok && $affected > 0) {
            echo "<script>alert('Pass deleted successfully.'); window.location='manage-passes.php';</script>";
        } else {
            echo "<script>alert('Delete failed: record not found or database error.'); window.location='manage-passes.php';</script>";
        }
        exit();
    } else {
        echo "<script>alert('Database error: could not prepare statement.'); window.location='manage-passes.php';</script>";
        exit();
    }
} else {
    header("Location: manage-passes.php");
    exit();
}
?>
