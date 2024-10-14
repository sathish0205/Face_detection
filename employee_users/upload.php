<?php
include('../db/db.php'); // Include your database connection

$prefix = 'LAE'; // Define your prefix

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the JSON data from the request body
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['data'])) {
        foreach ($data['data'] as $row) {
            // Extract individual columns from the row
            list($name, $email, $type, $gender, $department, $designation, $qualification, $aadhar, $bloodGroup, $contactNo, $address) = $row;

            // Sanitize and escape values to prevent SQL injection
            $name = $conn->real_escape_string($name);
            $email = $conn->real_escape_string($email);
            $type = $conn->real_escape_string($type);
            $gender = $conn->real_escape_string($gender);
            $department = $conn->real_escape_string($department);
            $designation = $conn->real_escape_string($designation);
            $qualification = $conn->real_escape_string($qualification);
            $aadhar = $conn->real_escape_string($aadhar);
            $bloodGroup = $conn->real_escape_string($bloodGroup);
            $contactNo = $conn->real_escape_string($contactNo);
            $address = $conn->real_escape_string($address);

            // Check if the email already exists
            $sql1 = "SELECT empl_id FROM employeesusers WHERE empl_email = '$email'";
            $result1 = $conn->query($sql1);

            if ($result1->num_rows > 0) {
                // Email already exists, skip or handle accordingly
                continue; // Skip inserting this record
            }

            // Get the latest empl_id with the prefix
            $sql2 = "SELECT empl_id FROM employeesusers WHERE empl_id LIKE '$prefix%'";
            $result2 = $conn->query($sql2);
            $newId = null;

            if ($result2->num_rows > 0) {
                $latestId = '';
                while ($row = $result2->fetch_assoc()) {
                    $currentId = $row['empl_id'];
                    $currentNumericPart = intval(substr($currentId, strlen($prefix))); // Extract the numeric part
                    if ($currentNumericPart > $newId) {
                        $newId = $currentNumericPart; // Find the highest numeric part
                    }
                }
                $newId++; // Increment to get the new ID
            } else {
                $newId = 1; // Start from 1 if no records exist
            }

            // Create the new empl_id with prefix
            $newIdFormatted = $prefix . str_pad($newId, 3, '0', STR_PAD_LEFT);

            // Prepare the SQL query to insert data (use the new ID)
            $sql = "INSERT INTO employeesusers (empl_id, empl_name, empl_email, empl_type, empl_gender, empl_department, empl_designation, empl_qual, aadhar_no, blood_group, contact_no, perm_address) 
                    VALUES ('$newIdFormatted', '$name', '$email', '$type', '$gender', '$department', '$designation', '$qualification', '$aadhar', '$bloodGroup', '$contactNo', '$address')";

            // Execute the SQL query
            if (!$conn->query($sql)) {
                // Output error message and terminate the script if insertion fails
                echo json_encode(["status" => "error", "message" => "Database error: " . $conn->error]);
                $conn->close();
                exit;
            }
        }

        // Close the database connection after all rows have been processed
        $conn->close();

        // Return a success message if all records were inserted successfully
        echo json_encode(["status" => "success"]);
    } else {
        // Return an error if no data was found in the request
        echo json_encode(["status" => "error", "message" => "No data found"]);
    }
}
?>
