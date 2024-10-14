<?php
include('../db/db.php');
session_start();

if (isset($_POST['empl_id']) && isset($_POST['password'])) {
    $empl_id = $_POST['empl_id'];
    $password = base64_encode($_POST['password']);

    $empl_id = mysqli_real_escape_string($conn, $empl_id);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM employeesusers WHERE empl_id = '$empl_id' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $_SESSION['empl_id'] = $empl_id;
            echo json_encode(['status' => 'success', 'redirect' => './employee_users/ex-user-pannel.php']);
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
// if ($result) {
//     if (mysqli_num_rows($result) > 0) {
//         $row = mysqli_fetch_assoc($result);
//         $dept = $row['empl_department'];
//         if ($dept == 'humanresources') {
//             echo json_encode(['status' => 'success', 'redirect' => 'ex-setting.php']);
//         } elseif ($dept == 'production') {
//             echo json_encode(['status' => 'success', 'redirect' => 'ex-attendance.php']);
//         }
//     } else {
//         echo json_encode(['status' => 'error', 'message' => 'Invalid credentials']);
//     }
//     mysqli_free_result($result);
// } else {
//     echo json_encode(['status' => 'error', 'message' => 'Query execution failed']);
// }

// mysqli_close($conn);
// } else {
// echo json_encode(['status' => 'error', 'message' => 'Data not received']);
// }

?>

