<?php
session_start();
include('../db/db.php');

if (!isset($_SESSION['empl_id'])) {
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'links.php'; ?>
    <link rel="stylesheet" href="../assets/css/ex.css">
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

        .btn1 {
            background-color: var(--my-blue) !important;
            color: var(--my-white) !important;
            padding: 10px 20px !important;
        }
        table{
            border: 2px solid var(--my-grey);
        }

        .table-row th {
            text-align: center;
            font-size: var(--th-fonts) !important;
            padding: 20px !important;
            white-space: nowrap;
            background-color:var(--my-grey) !important;
        }

        .table-row td {
            text-align: center;
            padding: 15px !important;
            font-size: var(--td-fonts);
            white-space: nowrap;
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
            <div class="col-lg-10 right-side-section" >
                <section class="m-4">
                    <div class="row mb-2">
                        <div class="col-lg-2 fs-3 text-black mb-sm-3">Monthly Attendance</div>
                        <div class="col-lg-2 col-6">
                            <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="start_date">
                                <label for="start_date">Start Date</label>
                            </div>
                        </div>
                        <div class="col-lg-2 col-6 mb-sm-3">
                            <div class="form-floating">
                            <input type="date" class="form-control" id="end_date">
                                <label for="end_date">End Date</label>
                            </div>
                        </div>
                        <div class="col-lg-2 col-6 mb-sm-3">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                    <option selected>All</option>
                                    <option value="1">Internal</option>
                                    <option value="2">External</option>
                                </select>
                                <label for="floatingSelect">Employee Type</label>
                            </div>
                        </div>
                        <div class="col-lg-2 col-6 mb-sm-3">
                            <select class="form-select p-3" aria-label="Default select example" id="department-filter">
                                <option value="">All Department</option>
                                <option value="1">Human Resources</option>
                                <option value="2">Finance and Accounting</option>
                                <option value="3">Sales And Marketing</option>
                                <option value="4">Quality Control</option>
                                <option value="5">Production</option>
                                <option value="6">Security</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-6">
                            <div class="input-group">
                                <input type="text" class="form-control p-3" placeholder="Search Name">
                                <div class="input-group-text"><i class="fa-solid fa-search p-2"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-7"></div>
                        <div class="col-lg-3 col-12 mb-sm-3">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                    <option value="">50</option>
                                    <option value="1">100</option>
                                    <option value="2">200</option>
                                    <option value="3">500</option>
                                    <option value="4">1000</option>
                                </select>
                                <label for="floatingSelect">Records Per Page</label>
                            </div>
                        </div>
                        <div class="col-lg-2 text-end col-12">
                            <div class="btn rounded-2 text-white " ><i class="fa-solid fa-file-export pe-2"></i>Export</div>
                        </div>
                    </div>
                    <!-- Responsive Table -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <div id="users-list"></div>
                              
                            </div>
                        </div>
                        <div class="col-lg-12 text-center mt-5">
                            <div class="btn"><i class="fa-solid fa-angle-left"></i> Prev</div>
                            <div class="btn ms-4">Next <i class="fa-solid fa-angle-right"></i></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
$(document).ready(function() {

    function fetchUsers(search, pageCount, page) {
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        console.log(start_date);
        console.log(end_date);
        $.ajax({
            url: '../data_get/monthly_attendance.php',
            method: 'GET',
            data: { start_date: start_date, end_date: end_date },
            success: function(response) {
                $('#users-list').html(response); 
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' ' + error);
            }
        });
    }
    $('#start_date, #end_date').change(function() {
        fetchUsers();
    });

    fetchUsers();
});
</script>

</body>

</html>