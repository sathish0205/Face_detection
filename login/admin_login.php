<?php
include('../db/db.php');
session_start();

if (isset($_POST['admin_email']) && isset($_POST['password'])) {
    $admin_email = $_POST['admin_email'];
    $password = base64_encode($_POST['password']);

    $admin_email = mysqli_real_escape_string($conn, $admin_email);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM admin_users WHERE admin_email = '$admin_email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $_SESSION['admin_email'] = $admin_email;
            echo json_encode(['status' => 'success', 'redirect' => '../master_admin/ex-dashboard.php']);
           } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
        }
        mysqli_free_result($result);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Query execution failed']);
    }

    mysqli_close($conn);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Data not received']);
}
?>
