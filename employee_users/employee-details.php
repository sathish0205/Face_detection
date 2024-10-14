<?php
session_start();
include('../db/db.php');

if (!isset($_SESSION['empl_id'])) {
    header('Location: ../index.php');
    exit;
}
$empl_id = $_SESSION['empl_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../links/links.php'; ?>
    <link rel="stylesheet" href="../assets/css/ex.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <style>
        *::-webkit-scrollbar {
            width: 10px;
            height: 5px;
        }

        *::-webkit-scrollbar-track {
            background-color: #ebebeb;
            -webkit-border-radius: 10px;
            border-radius: 10px;
        }

        *::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: #063554;
        }

        .btn {
            background-color: var(--my-blue) !important;
            color: var(--my-white) !important;
            padding: 10px 20px !important;
        }

        .table-row th {
            text-align: center;
            font-size: var(--th-fonts) !important;
            padding: 20px !important;
        }

        .table-row td {
            text-align: center;
            padding: 20px !important;
        }

        .capture {
            color: var(--my-blue) !important;
            background-color: var(--my-grey);
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <?php include 'exnavbar.php'; ?>
            <?php include 'exside.php'; ?>
            <div class="col-lg-2"></div>
            <div class="col-lg-10 right-side-section">
                <section class="m-4">
                    <div class="row ">
                      <form id="insertData">
                      <div class="col-lg-12">
                        <?php
                        if(isset($_GET['employee_id'])){
                            
                        } 
                        ?>
    <h1 class="fs-3 mb-5 mt-4"><a href="ex-add-employee.php"><i class="bi bi-arrow-left mt-5" style="color:#063554; padding: 5px; border-radius: 10px;"></i></a>  Details</h1>
    <form id="employeeForm">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-floating mb-5">
                    <input type="text" class="form-control" id="empl_name" name="empl_name" placeholder="">
                    <label for="empl_name">Employee Name</label>
                </div>

                <div class="form-floating mb-5">
                    <select class="form-select" id="empl_type" name="empl_type" aria-label="Default select example">
                        <option value="internal">Internal</option>
                        <option value="external">External</option>
                    </select>
                    <label for="empl_type">Employee Type</label>
                </div>

                <div class="form-floating mb-5" id="externalEmployeeField" style="display: none;">
                    <input type="text" class="form-control" id="vendor_name" name="vendor_name" placeholder="">
                    <label for="vendor_name">Vendor Name</label>
                </div>

                <div class="form-floating mb-5">
                    <input type="text" class="form-control" id="empl_gender" name="empl_gender" placeholder="">
                    <label for="empl_gender">Gender</label>
                </div>
                <div class="form-floating mb-5">
                    <input type="text" class="form-control" id="empl_id" name="empl_id" readonly placeholder="">
                    <label for="empl_id">Employee ID</label>
                </div>
                <div class="form-floating mb-5">
                    <select class="form-select mb-4 p-3" id="empl_department" name="empl_department" aria-label="Floating label select example">
                        <option selected>Select Department</option>
                        <?php
                        $sql1 = "SELECT * FROM department";
                        $result = mysqli_query($conn, $sql1);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $dept = $row['dept'];
                                echo '<option value="' . $dept . '">' . $dept . '</option>';
                            }
                        } else {
                            echo '<option>No Department</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-floating mb-5">
                    <input type="email" class="form-control" id="empl_designation" name="empl_designation" placeholder="">
                    <label for="empl_designation">Designation</label>
                </div>
                <div class="form-floating mb-5">
                    <input type="email" class="form-control" id="empl_email" name="empl_email" placeholder="">
                    <label for="empl_email">Email</label>
                </div>
                <div class="form-floating mb-5">
                    <input type="date" class="form-control" id="date_of_join" name="date_of_join" placeholder="">
                    <label for="date_of_join">Date of Joining</label>
                </div>
                <div class="form-floating mb-5">
                    <input type="text" class="form-control" id="empl_qual" name="empl_qual" placeholder="">
                    <label for="empl_qual">Qualification</label>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-floating mb-5">
                    <input type="text" class="form-control" id="aadhar_no" name="aadhar_no" placeholder="">
                    <label for="aadhar_no">Aadhar No.</label>
                </div>
                <div class="form-floating mb-5">
                    <input type="text" class="form-control" id="blood_group" name="blood_group" placeholder="">
                    <label for="blood_group">Blood Group</label>
                </div>
                <div class="form-floating mb-5">
                    <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="">
                    <label for="contact_no">Contact No.</label>
                </div>
                <div class="form-floating mb-5">
                    <input type="text" class="form-control" id="emer_contact_no" name="emer_contact_no" placeholder="">
                    <label for="emer_contact_no">Emergency Contact No.</label>
                </div>
                <div class="mb-5">
                    <textarea class="form-control" rows="5" id="temp_address" name="temp_address" placeholder="Temporary Address"></textarea>
                </div>
                <div class="mb-5">
                    <textarea class="form-control" rows="6" id="perm_address" name="perm_address" placeholder="Permanent Address"></textarea>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="text-center">
                <button type="button" class="btn" style="padding: 12px 45px !important;" id="updateEmployee">Create</button>
            </div>
        </div>
    </form>
</div>
                </section>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#empl_department").on("change", function() {
                fetchData1();
            });


            function fetchData1() {
                var empl_dept = $("#empl_department").val().trim();
                if (empl_dept !== '') {
                    $.ajax({
                        url: "../data_get/employee_design.php",
                        type: "GET",
                        data: {
                            empl_dept: empl_dept
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                $('#empl_designation').empty();
                                $.each(response.message, function(key, value) {
                                    $('#empl_designation').append('<option value="' + value + '">' + value + '</option>');
                                });
                            } else if (response.status === 'error') {
                                $('#empl_designation').empty().append('<option>No Designation Data Found</option>');
                            } else {
                                console.error(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            var urlParams = new URLSearchParams(window.location.search);
            var employee_id = urlParams.get('employee_id');

            console.log(employee_id);

            $.ajax({
                url: "../data_get/empl_details.php",
                type: "POST",
                data: {
                    employee_id: employee_id
                },
                dataType: "json",
                success: function(response) {
                    if (response.status === 'success') {
                        $('#id').val(response.id);
                        $('#empl_name').val(response.empl_name);
                        $('#profile_name').val(response.empl_name);
                        $('#empl_type').val(response.empl_type);
                        $('#vendor_name').val(response.vendor_name);
                        $('#empl_gender').val(response.empl_gender);
                        $('#empl_id').val(response.empl_id);
                        $('#empl_department').val(response.empl_department);
                        $('#empl_designation').val(response.empl_designation);
                        $('#empl_email').val(response.empl_email);
                        $('#date_of_join').val(response.date_of_join);
                        $('#empl_qual').val(response.empl_qual);
                        $('#aadhar_no').val(response.aadhar_no);
                        $('#blood_group').val(response.blood_group);
                        $('#contact_no').val(response.contact_no);
                        $('#emer_contact_no').val(response.emer_contact_no);
                        $('#temp_address').val(response.temp_address);
                        $('#perm_address').val(response.perm_address);
                        

                        if (response.empl_type === "external") {
                            $('#externalEmployeeField').show();
                        } else {
                            $('#externalEmployeeField').hide();
                        }
                    } else {
                        console.error("Error: " + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

            $('#empl_type').change(function() {
                if ($(this).val() == "external") {
                    $('#externalEmployeeField').show();
                } else {
                    $('#externalEmployeeField').hide();
                }
            });
        });
    </script>
 <script>
$(document).ready(function() {
    $('#updateEmployee').click(function() {
        var empl_name = $('#empl_name').val();
        var empl_email = $('#empl_email').val();
        var empl_type = $('#empl_type').val();
        var empl_gender = $('#empl_gender').val();
        var empl_department = $('#empl_department').val();
        var empl_designation = $('#empl_designation').val();
        var empl_id = $('#empl_id').val();
        var vendor_name = $('#vendor_name').val();
        var date_of_join = $('#date_of_join').val();
        var empl_qual = $('#empl_qual').val();
        var aadhar_no = $('#aadhar_no').val();
        var blood_group = $('#blood_group').val();
        var contact_no = $('#contact_no').val();
        var emer_contact_no = $('#emer_contact_no').val();
        var temp_address = $('#temp_address').val();
        var perm_address = $('#perm_address').val();

        $.ajax({
            url: '../data_update/update_employee.php',
            type: 'POST',
            data: {
                empl_name: empl_name,
                empl_email: empl_email,
                empl_type: empl_type,
                empl_gender: empl_gender,
                empl_department: empl_department,
                empl_designation: empl_designation,
                empl_id: empl_id,
                vendor_name: vendor_name,
                date_of_join: date_of_join,
                empl_qual: empl_qual,
                aadhar_no: aadhar_no,
                blood_group: blood_group,
                contact_no: contact_no,
                emer_contact_no: emer_contact_no,
                temp_address: temp_address,
                perm_address: perm_address
            },
            success: function(response) {
                console.log(response); // Log the raw response for debugging
                try {
                    var result = JSON.parse(response);
                    if (result.status === 'success') {
                        displayToast('Success', 'New record created successfully.');
                        $('#Add-employee').hide();
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    } else {
                        displayToast('Error', result.message);
                    }
                } catch (e) {
                    displayToast('Error', 'Failed to parse JSON response.');
                }
            },
            error: function() {
                displayToast('Error', 'Failed to update the record.');
            }
        });
    });

    function displayToast(title, message) {
        var toastHtml = '<div class="toast" style="position: fixed; top: 20px; right: 20px; z-index: 1050;" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="me-auto">' + title + '</strong><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">' + message + '</div></div>';
        $('.toast-container').append(toastHtml);
        var toastElement = $('.toast').last();
        toastElement.toast('show');
        setTimeout(function() {
            toastElement.toast('hide');
        }, 3000);
    }
});


</script>

</body>

</html>