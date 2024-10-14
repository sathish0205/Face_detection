<?php
include('../db/db.php');

// Check if all required POST parameters are set
if (isset($_POST['password'], $_POST['password1'], $_POST['empl_email'])) {
    // Assign POST values to variables
    $password = $_POST['password'];
    $password1 = $_POST['password1'];
    $empl_email = $_POST['empl_email'];

    $password = mysqli_real_escape_string($conn, $password);
    $password1 = mysqli_real_escape_string($conn, $password1);
    $empl_email = mysqli_real_escape_string($conn, $empl_email);

    if ($password == $password1) {
        // Passwords match
        $response = [
            'status' => 'success',
            'message' => 'Password Matched. You clicked the Submit button.',
            'empl_email' => $empl_email  
        ];
    } else {
        // Passwords do not match
        $response = [
            'status' => 'error',
            'message' => 'Passwords do not match.'
        ];
    }
} else {
    // Not all POST parameters were received
    $response = [
        'status' => 'error',
        'message' => 'Data not received.'
    ];
}

// Output the JSON response
echo json_encode($response);

// Close the database connection
mysqli_close($conn);
?>
