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
                        <div class="col-lg-5 fs-3 col-12 mb-sm-2">Create Designation</div>
                        <div class="col-lg-3 col-6 mb-sm-2">
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
                        <div class="col-lg-4 text-end col-6">
                            <div class="btn" data-bs-toggle="modal" data-bs-target="#department-creation-Modal">Create
                                Designation</div>
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
                                            <th>DESIGNATION</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody id="user-list">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>

    <!-- department-creation-Modal -->
    <div class="modal fade" id="department-creation-Modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Department</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <form id="cre_dept" method="post">
                            <div class="col-lg-12 mb-4">
                                <?php
                                $sql = "SELECT * FROM department";
                                $result = mysqli_query($conn, $sql);
                                ?>
                                <select class="form-select p-3" id="dept" name="dept"
                                    aria-label="Default select example">
                                    <option selected>Select Department</option>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>

                                        <option value="<?php echo $row['dept']; ?>"><?php echo $row['dept']; ?></option>

                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="design" name="design" placeholder="">
                                    <label for="dept">Enter Department Name</label>
                                </div>
                            </div>
                            <div id="message"></div>
                            <div class="col-lg-12 text-center">
                                <input type="submit" name="submit" class="btn" id="submit">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Edit Designation Modal -->
    <div class="modal fade" id="editDesignationModal" tabindex="-1" aria-labelledby="editDesignationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDesignationModalLabel">Edit Designation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editDesignationForm">
                        <input type="hidden" id="editId">
                        <div class="mb-3">
                            <label for="editDept" class="form-label">Department</label>
                            <input type="text" class="form-control" id="editDept" name="dept" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDesign" class="form-label">Designation</label>
                            <input type="text" class="form-control" id="editDesign" name="design" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveEditBtn">Save changes</button>
                </div>
            </div>
        </div>
    </div>






    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: '../data_get/data_design.php',
                method: 'GET',
                success: function (response) {
                    $('#user-list').html(response);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#dept, #design").on("input", function () {
                fetchData();
            });
            $('#submit').hide();

            function fetchData() {
                var dept = $("#dept").val();
                var design = $("#design").val();
                if (dept.trim() !== '') {
                    $.ajax({
                        url: "../data_get/designation.php",
                        type: "POST",
                        data: {
                            dept: dept,
                            design: design
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 'success') {
                                $('#message').text(response.message).css('color', 'red');
                                $('#submit').hide();
                            } else if (response.status === 'error') {
                                $('#message').text(response.message).css('color', 'green');
                                $('#submit').show();
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#cre_dept').on('submit', function (event) {
                event.preventDefault();
                var dept = $('#dept').val();
                var design = $("#design").val();
                $.ajax({
                    url: '../data_insert/create_design.php',
                    type: 'POST',
                    data: {
                        dept: dept,
                        design: design
                    },
                    success: function (response) {
                        displayToast('Success', 'New Designation Created Successfully.');
                        $('#department-creation-Modal').hide();
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    },
                    error: function (xhr, status, error) {
                        displayToast('Error', 'Failed to create department.');
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
            $(document).ready(function () {
                // Edit button click event
                $('.edit-btn').on('click', function () {
                    // Get the current row's data
                    var id = $(this).data('id');
                    var dept = $(this).closest('tr').find('td:eq(1)').text();
                    var design = $(this).data('design');

                    // Populate the modal fields with the data
                    $('#editId').val(id);
                    $('#editDept').val(dept);
                    $('#editDesign').val(design);

                    // Show the modal
                    $('#editDesignationModal').modal('show');
                });


            });

        });


    </script>


<script>
    $(document).ready(function() {
    // Capture the click event of the edit button
    $(document).on('click', '.edit-btn', function() {
        // Get the row's data
        var id = $(this).data('id');
        var dept = $(this).closest('tr').find('td:eq(1)').text();
        var design = $(this).data('design');
        
        // Set the data into the modal fields
        $('#editId').val(id);
        $('#editDept').val(dept);
        $('#editDesign').val(design);

        // Show the modal
        $('#editDesignationModal').modal('show');
    });

    // Save button click event inside modal
    $('#saveEditBtn').on('click', function() {
        var id = $('#editId').val();
        var dept = $('#editDept').val();
        var design = $('#editDesign').val();

        // Perform AJAX request to update the designation
        $.ajax({
            url: '../data_update/update_designation.php', // Endpoint for updating
            method: 'POST',
            data: {
                id: id,
                dept: dept,
                design: design
            },
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status == 'success') {
                    alert('Designation updated successfully!');
                    location.reload(); // Reload the page to see changes
                } else {
                    alert('Error updating designation.');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});

</script>

<script>
    $(document).ready(function() {
    // Capture the click event of the delete button
    $(document).on('click', '.delete-btn', function() {
        // Get the row's ID
        var id = $(this).data('id');
        
        // Confirm delete action
        if (confirm('Are you sure you want to delete this designation?')) {
            // Perform AJAX request to delete the designation
            $.ajax({
                url: '../data_delete/delete_designation.php', // Endpoint for deleting
                method: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status == 'success') {
                        alert('Designation deleted successfully!');
                        location.reload(); // Reload the page to see changes
                    } else {
                        alert('Error deleting designation.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });
});

</script>
</body>

</html>