<?php
session_start();
include('../db/db.php');

if (!isset($_SESSION['admin_email'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Bootstrap CSS -->
    <?php include '../links/ex.links.php'; ?>
    <link rel="stylesheet" href="../assets/css/ex.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

        table {
            border: 2px solid var(--my-grey);
        }

        .table-row td {
            text-align: center;
            padding: 15px;
            font-size: var(--td-fonts);
            white-space: nowrap;
            border: 1px solid var(--my-grey);
            background-color: var(--my-grey) !important;
        }

        .table-row td:hover {
            background-color: var(--my-white);
        }

        .table-row th {
            text-align: center;
            padding: 15px;
            font-size: var(--th-fonts);
            white-space: nowrap;
            border: 1px solid var(--my-grey);
        }

        .table-row th:first-child {
            padding: 15px;
        }

        /* Additional custom styles if any */
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include 'exnavbar.php'; ?>
            <?php include 'exside.php'; ?>
            <div class="col-lg-2"></div>
            <div class="col-lg-10 right-side-section">
                <div id="toast-container" class="toast-container p-1"></div>
                <section class="m-4">
                    <div class="row mb-4">
                        <div class="col-lg-5 fs-3 col-12 mb-sm-2">Create Department</div>
                        <div class="col-lg-3 col-6 mb-sm-2">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect" aria-label="Records Per Page">
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                    <option value="500">500</option>
                                    <option value="1000">1000</option>
                                </select>
                                <label for="floatingSelect">Records Per Page</label>
                            </div>
                        </div>
                        <div class="col-lg-4 text-end col-6">
                            <button class="btn" data-bs-toggle="modal"
                                data-bs-target="#department-creation-Modal">Create Department</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr class="table-row">
                                            <th>S.No</th>
                                            <th>DEPARTMENT</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody id="user-list">
                                        <!-- Dynamic content will be loaded here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
<!-- Department Creation Modal -->
<div class="modal fade" id="department-creation-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Department</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="cre_dept" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="dept" name="dept" placeholder="Enter Department Name" required>
                        <label for="dept">Enter Department Name</label>
                    </div>
                    <div id="message"></div>
                    <div class="text-center">
                        <input type="submit" name="submit" class="btn" id="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Department Modal -->
<div class="modal fade" id="edit-department-modal" tabindex="-1" aria-labelledby="editDepartmentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editDepartmentLabel">Edit Department</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editDeptForm">
                    <input type="hidden" name="edit_dept_id" id="edit_dept_id">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="edit_dept_name" name="edit_dept_name" placeholder="Department Name" required>
                        <label for="edit_dept_name">Department Name</label>
                    </div>
                    <div id="dept_name_error" class="text-danger"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="editDepartmentBtn">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Department Modal -->
<div class="modal fade" id="delete-department-modal" tabindex="-1" aria-labelledby="deleteDepartmentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteDepartmentLabel">Delete Department</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this department?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Fetch departments on page load
        $.ajax({
            url: '../data_get/dept_data.php',
            method: 'GET',
            success: function (response) {
                $('#user-list').html(response);
            }
        });

        // Form submission for creating department
        $('#cre_dept').on('submit', function (event) {
            event.preventDefault();
            var dept = $('#dept').val();

            $.ajax({
                url: '../data_insert/create_dept.php',
                type: 'POST',
                data: { dept: dept },
                success: function (response) {
                    displayToast('Success', 'New Department Created Successfully.');
                    $('#department-creation-Modal').modal('hide');
                    setTimeout(() => location.reload(), 3000);
                },
                error: function () {
                    displayToast('Error', 'Failed to create department.');
                }
            });
        });

        // Display toast notifications
        function displayToast(title, message) {
            var toastHtml = `<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <strong class="me-auto">${title}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">${message}</div>
                        </div>`;
            $('.toast-container').append(toastHtml);
            var toastElement = $('.toast').last();
            toastElement.toast('show');
            setTimeout(() => toastElement.toast('hide'), 3000);
        }

        // Populate edit modal with department data
        $(document).on('click', '.edit-btn', function () {
            const deptId = $(this).data('dept_id');
            const deptName = $(this).data('dep_name');
            $('#edit_dept_id').val(deptId);
            $('#edit_dept_name').val(deptName);
        });

        // Handle the update button click
        $('#editDepartmentBtn').on('click', function () {
            const deptId = $('#edit_dept_id').val();
            const deptName = $('#edit_dept_name').val();

            if (deptName.trim() === "") {
                $('#dept_name_error').text('Please enter a department name.');
                return;
            } else {
                $('#dept_name_error').text('');
            }

            $.ajax({
                url: '../data_update/update_dept.php',
                type: 'POST',
                data: {
                    id: deptId,
                    dept: deptName
                },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        displayToast('Success', 'Update Successfully.');
                        $('#edit-department-modal').modal('hide');
                        location.reload();
                    } else {
                        displayToast('Error', response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX error:", xhr.responseText);
                    displayToast('Error', 'An unexpected error occurred. Please try again.');
                }
            });
        });

        let deptIdToDelete; // Variable to store the ID of the department to delete

        // Event listener for delete button
        $(document).on('click', '.delete-btn', function () {
            deptIdToDelete = $(this).data('dept_id'); // Corrected variable name
            $('#delete-department-modal').modal('show');
        });

        // Confirm deletion
        $('#confirmDeleteBtn').on('click', function () {
            $.ajax({
                url: '../data_delete/delete_dept.php', // Check this URL
                type: 'POST',
                data: {
                    dept_id: deptIdToDelete // Corrected variable name
                },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        displayToast('Deleted Successfully.');                        
                        $('#delete-department-modal').modal('hide');
                        location.reload();
                    } else {
                        displayToast('Error', response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX error:", xhr.responseText);
                    displayToast('Error', 'An unexpected error occurred. Please try again.');
                }
            });
        });
    });
</script>



</body>

</html>