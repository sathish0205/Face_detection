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
    <?php include '../links/ex.links.php'; ?>
    <link rel="stylesheet" href="../assets/css/ex.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* *::-webkit-scrollbar {
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
        } */

        .btn {
            background-color: var(--my-blue) !important;
            color: var(--my-white) !important;
            padding: 10px 20px !important;
        }

        table {
            border: 2px solid var(--my-grey);
        }

        .table-row th {
            text-align: center;
            padding: 15px;
            font-size: var(--th-fonts);
            border: 1px solid var(--my-grey);
            /* Add border to cells */
        }

        .table-row td {
            text-align: center;
            padding: 15px;
            font-size: var(--td-fonts);
            white-space: nowrap;
            border: 1px solid var(--my-grey);
            background-color: var(--my-grey) !important;
            /* Add border to cells */
        }

        .table-row td:hover {
            background-color: var(--my-white) !important;
        }


        .table-row th:first-child {
            padding: 15px;
            /* Adjust padding for S.No column */
        }
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
                        <div class="col-lg-4 fs-3 text-black col-12 mb-sm-3">Admin Creation</div>
                        <div class="col-lg-4 col-6 mb-sm-2">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect"
                                    aria-label="Floating label select example">
                                    <option value="">50</option>
                                    <option value="1">100</option>
                                    <option value="2">200</option>
                                    <option value="3">500</option>
                                    <option value="4">1000</option>
                                </select>
                                <label for="floatingSelect">Records Per Page</label>
                            </div>
                        </div>
                        <div class="col-lg-3 text-end col-6">
                            <div class="btn" data-bs-toggle="modal" data-bs-target="#crate-admin-Modal">Add Admin</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive ">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr class="table-row">
                                            <th>S.No</th>
                                            <th>NAME</th>
                                            <th>EMAIL</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody id="users-list">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center mt-5">
                            <div class="btn"><i class="fa-solid fa-angle-left"></i> Prev</div>
                            <div class="btn ms-3">Next <i class="fa-solid fa-angle-right"></i> </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


    <!--add admin  Modal -->
    <div class="modal fade" id="crate-admin-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Admin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insertData">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="admin_name" name="admin_name"
                                        placeholder="name@example.com">
                                    <label for="admin_name">Name</label>
                                </div>
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="admin_email" name="admin_email"
                                        placeholder="Password">
                                    <label for="admin_email">Email</label>
                                </div>
                                <div id="ad_email"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="createEmployee">Create</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-admin-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Admin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editData">
                        <div class="row">
                            <input type="hidden" name="edit_admin_id" id="edit_admin_id">
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="edit_admin_name" name="edit_admin_name"
                                        placeholder="name@example.com">
                                    <label for="edit_admin_name">Name</label>
                                </div>
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="edit_admin_email"
                                        name="edit_admin_email" placeholder="Password">
                                    <label for="edit_admin_email">Email</label>
                                </div>
                                <div id="ad_email"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="editEmployee">Edit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-admin-Modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Admin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editData">
                        <div class="row">
                            <input type="hidden" name="delete_admin_id" id="delete_admin_id">

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                    <button type="button" class="btn btn-primary" id="deleteEmployee">Delete</button>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(document).ready(function () {
        $("#admin_email").on("input", function () {
            fetchData();
        });

        function fetchData() {
            var admin_email = $("#admin_email").val().trim(); // Trim the input
            if (admin_email !== '') {
                $.ajax({
                    url: "../data_get/admin_email.php",
                    type: "POST",
                    data: {
                        admin_email: admin_email
                    },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                        if (response.status === 'success') {
                            $('#ad_email').text(response.message).css('color', 'green');
                        } else if (response.status === 'error') {
                            $('#ad_email').text(response.message).css('color', 'red');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.statusText); // Corrected to xhr.statusText for error details
                    }
                });
            }
        }
    });
</script>

<script>
    $(document).ready(function () {
        $.ajax({
            url: '../data_get/admin_data.php',
            method: 'GET',
            success: function (response) {
                $('#users-list').html(response);
            }
        });
    });

    $('#edit-admin-Modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var adminName = button.data('admin_name');
        var adminEmail = button.data('admin_email');
        var adminid = button.data('admin_id');

        console.log(adminName);
        console.log(adminEmail);
        console.log(adminid); 

        $('#edit_admin_name').val(adminName);
        $('#edit_admin_email').val(adminEmail);
        $('#edit_admin_id').val(adminid);

    });

    $('#delete-admin-Modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var adminid = button.data('admin_id');

        console.log(adminid);

        $('#delete_admin_id').val(adminid);

    });
</script>
<script>
    $(document).ready(function () {
        $('#createEmployee').click(function () {
            var admin_name = $('#admin_name').val();
            var admin_email = $('#admin_email').val();

            $.ajax({
                url: '../data_insert/insert_admin.php',
                type: 'POST',
                data: {
                    admin_name: admin_name,
                    admin_email: admin_email
                },
                success: function (response) {
                    displayToast('Success', 'New record created successfully.');
                    $('#Add-employee').hide();
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                }
            });
        });

        function displayToast(title, message) {
            var toastHtml = '<div class="toast" style="margin-left: 330% !important; margin-top: -10% !important;" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header button"><strong class="me-auto">' + title + '</strong><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">' + message + '</div></div>';
            $('.toast-container').append(toastHtml);
            var toastElement = $('.toast').last();
            toastElement.toast('show');
            setTimeout(function () {
                toastElement.toast('hide');
            }, 3000);
        }
    });
</script>

<script>
    $(document).ready(function () {
        $('#editEmployee').click(function () {
            var edit_admin_name = $('#edit_admin_name').val();
            var edit_admin_email = $('#edit_admin_email').val();
            var edit_admin_id = $('#edit_admin_id').val();

            $.ajax({
                url: '../data_update/update_admin.php',
                type: 'POST',
                data: {
                    edit_admin_name: edit_admin_name,
                    edit_admin_email: edit_admin_email,
                    edit_admin_id: edit_admin_id
                },
                success: function (response) {
                    displayToast('Success', 'Record Updated successfully.');
                    $('#Add-employee').hide();
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                }
            });
        });

        function displayToast(title, message) {
            var toastHtml = '<div class="toast" style="margin-left: 330% !important; margin-top: -10% !important;" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header button"><strong class="me-auto">' + title + '</strong><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">' + message + '</div></div>';
            $('.toast-container').append(toastHtml);
            var toastElement = $('.toast').last();
            toastElement.toast('show');
            setTimeout(function () {
                toastElement.toast('hide');
            }, 3000);
        }
    });
</script>

<script>
    $(document).ready(function () {
        $('#deleteEmployee').click(function () {
            var delete_admin_id = $('#delete_admin_id').val();

            $.ajax({
                url: '../data_delete/delete_admin.php',
                type: 'POST',
                data: {
                    delete_admin_id: delete_admin_id
                },
                success: function (response) {
                    if (response.trim() === 'success') {
                        displayToast('Success', 'Deleted successfully.');
                        $('#Add-employee').hide();
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    } else {
                        displayToast('Error', response);
                    }
                },
                error: function () {
                    displayToast('Error', 'An error occurred while processing your request.');
                }
            });
        });


        function displayToast(title, message) {
            var toastHtml = '<div class="toast" style="margin-left: 330% !important; margin-top: -10% !important;" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header button"><strong class="me-auto">' + title + '</strong><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">' + message + '</div></div>';
            $('.toast-container').append(toastHtml);
            var toastElement = $('.toast').last();
            toastElement.toast('show');
            setTimeout(function () {
                toastElement.toast('hide');
            }, 3000);
        }
    });
</script>

</html>