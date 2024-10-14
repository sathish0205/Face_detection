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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

        .settings-icons button i {
            color: var(--my-blue);
            box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
            cursor: pointer;
        }

        button {
            border: none;
            background-color: transparent;
        }

        .active {
            background-image: radial-gradient( circle 976px at 51.2% 51%,  rgba(11,27,103,1) 0%, rgba(16,66,157,1) 0%, rgba(11,27,103,1) 17.3%, rgba(11,27,103,1) 58.8%, rgba(11,27,103,1) 71.4%, rgba(16,66,157,1) 100.2%, rgba(187,187,187,1) 100.2% );
            color: white !important;
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
                <section class="m-4 mt-5">
                    <div class="row mb-4">
                        <div class="col-lg-5 fs-3 col-12 mb-sm-2">Add Camera</div>
                        <div class="col-lg-3 col-6 mb-sm-2"></div>
                        <!--    <div class="form-floating">
                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                    <option value="">50</option>
                                    <option value="1">100</option>
                                    <option value="2">200</option>
                                    <option value="3">500</option>
                                    <option value="4">1000</option>
                                </select>
                                <label for="floatingSelect">Records Per Page</label>
                            </div>
                        </div> -->
                        <div class="col-lg-4 text-end col-6">
                            <div class="btn" data-bs-toggle="modal" data-bs-target="#department-creation-Modal">Add Camera</div>
                        </div>
                    </div>
                    <!-- <div class="row">
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
                    </div> -->

                </section>
            </div>
        </div>
    </div>

    <div class="modal fade" id="department-creation-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Department</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <form id="cre_dept" method="post">

                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="camera_name" name="camera_name" placeholder="">
                                    <label for="dept">Enter Department Name</label>
                                </div>
                            </div>
                            <div id="message"></div>
                            <div class="col-lg-12 mb-4">

                                <select class="form-select p-3" id="camera_type" name="camera_type" aria-label="Default select example">
                                    <option selected>Select Camera</option>
                                    <option value="1">Entry Camera</option>
                                    <option value="2">Exit Camera</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="ip_address" name="ip_address" placeholder="">
                                    <label for="dept">Camera ip address</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="camera_ip" name="camera_ip" placeholder="">
                                    <label for="dept">Camera ip Username</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="camera_ip_password" name="camera_ip_password" placeholder="">
                                    <label for="dept">Camera ip password</label>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <input type="submit" name="submit" class="btn" id="submit">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-3">
    <div class="col-lg-12 settings-icons d-flex justify-content-around p-5">
    <div class="camera_list" id="camera_list">

    </div>
    </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(document).ready(function() {
            $.ajax({
                url: '../data_get/camera_list.php',
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    $('#camera_list').html(response);
                }
            });
        });
    </script>

    <script>
 $(document).ready(function() {
    $("#camera_name").on("input", function() {
        fetchData();
    });
    $('#submit').hide();

    function fetchData() {
        var camera_name = $("#camera_name").val();
        if (camera_name.trim() !== '') {
            $.ajax({
                url: "../data_get/add_camera.php",
                type: "POST",
                data: {
                    camera_name: camera_name
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        $('#message').text(response.message).css('color', 'red');
                        $('#submit').hide();
                    } else if (response.status === 'error') {
                        $('#message').text(response.message).css('color', 'green');
                        $('#submit').show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        } else {
            $('#message').text('Please enter a camera name.').css('color', 'red');
            $('#submit').hide();
        }
    }
});

    </script>
    <script>
        $(document).ready(function() {
            $('#cre_dept').on('submit', function(event) {
                event.preventDefault();
                var camera_name = $('#camera_name').val();
                var camera_type = $("#camera_type").val();
                var ip_address = $("#ip_address").val();
                var camera_ip = $("#camera_ip").val();
                var camera_ip_password = $("#camera_ip_password").val();

                $.ajax({
                    url: '../data_insert/add_camera.php',
                    type: 'POST',
                    data: {
                        camera_name: camera_name,
                        camera_type: camera_type,
                        ip_address: ip_address,
                        camera_ip: camera_ip,
                        camera_ip_password: camera_ip_password,
                    },
                    success: function(response) {
                        displayToast('Success', 'Adding Camera Successfully.');
                        $('#department-creation-Modal').hide();
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    },
                    error: function(xhr, status, error) {
                        displayToast('Error', 'Failed to create department.');
                    }
                });
            });

            function displayToast(title, message) {
                var toastHtml = '<div class="toast" style="margin-left: 330% !important; margin-top: -10% !important;" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header button"><strong class="me-auto">' + title + '</strong><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">' + message + '</div></div>';
                $('.toast-container').append(toastHtml);
                var toastElement = $('.toast').last();
                toastElement.toast('show');
                setTimeout(function() {
                    toastElement.toast('hide');
                }, 3000);
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            // Initialize Bootstrap tooltips
            $('[title]').tooltip();

            // Toggle active class on icons
            $('.icon').click(function () {
                $('.icon').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
</body>

</html>