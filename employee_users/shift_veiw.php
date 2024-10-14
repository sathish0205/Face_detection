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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        .table{
            border: 1px solid var(--my-grey);
        }
        
        .table-row th{
            text-align: center;
            font-size: var(--th-fonts) !important;
            padding: 20px !important;
            white-space: nowrap;
        }
        .table-row td{
            text-align: center;
            padding: 15px !important;
            font-size: var(--td-fonts);
        }
        .capture{
            color: var(--my-blue) !important;
            background-color: var(--my-grey);
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <?php include 'exnavbar.php'; ?>
            <?php include 'exside.php'; ?>
            <input type="text" name="empl_id" id="empl_id" value="<?php echo $empl_id ?>" >
            <div class="col-lg-2"></div>
            <div class="col-lg-10 right-side-section" >
            <div id="toast-container" class="toast-container p-1"></div>

                <section class="m-4">
                <div class="row mb-3">
                    <div class="col-lg-2 col-12 fs-3 text-black mb-sm-2"><a href="ex-shift-allocation.php"><i class="bi bi-arrow-left mt-5" style="color:#063554; padding: 5px; border-radius: 10px;"></i></a> View</div>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-2 col-6 mb-sm-3">
                        <div class="form-floating ">
                            <input type="Date" class="form-control pt-4" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword" class="">Select Date</label>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6 mb-sm-3">
                        <select class="form-select p-3" aria-label="Default select example" id="department-filter">
                            <option value="">All Shifts</option>
                            <option value="1">Shift-A</option>
                            <option value="2">Shift-GL</option>
                            <option value="3">Shift-B</option>
                            <option value="4">Shift-C</option>
                        </select>
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
                    <div class="col-lg-2 col-6 mb-sm-3">
                        <div class="input-group">
                            <input type="text" class="form-control p-3" placeholder="Search Name">
                            <div class="input-group-text"><i class="fa-solid fa-search p-2"></i></div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-4 col-1 mb-sm-3"></div>
                    <div class="col-lg-3 col-6 mb-sm-3">
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
                    <div class="col-lg-2 text-end">
                        <div class="btn rounded-2 text-white" style="background-color: #063554;"><i class="fa-solid fa-file-export pe-2"></i>Export</div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                        <div class="table-responsive">
            <div class="form-check form-switch">
                <input class="form-check-input ms-auto fs-5" style="color: #063554;" type="checkbox" role="switch" id="flexSwitchCheckDefault">
            </div>
            <div id="users-list" style="display: none;"></div>
            <div id="users-list1"></div>
        </div>
                    </div>
                    <div class="col-lg-12 text-center mt-5">
                        <div class="btn"><i class="fa-solid fa-angle-left"></i> Prev </div>
                        <div class="btn ms-2">Next <i class="fa-solid fa-angle-right"></i></div>
                    </div>
                </div>
                </section>
            </div>
        </div>
    </div>


   
    <!-- Shift Allocate Modal -->
    <div class="modal fade" id="shift-allocate-modal-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-custom" >
                    <h3 class="modal-title" id="exampleModalLabel">
                         Allocate Shift
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: #ffffff;"></button>
                </div>
                <div class="modal-body">
                    <form id="shift_allocation">
                        <div id="shift_edit"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="shift_allc">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.getElementById('flexSwitchCheckDefault');
        const employeeTable1 = document.getElementById('users-list');
        const employeeTable2 = document.getElementById('users-list1');

        function toggleTables() {
            if (checkbox.checked) {
                employeeTable1.style.display = 'none';
                employeeTable2.style.display = 'block';
            } else {
                employeeTable1.style.display = 'block';
                employeeTable2.style.display = 'none';
            }
        }

        checkbox.addEventListener('change', toggleTables);

        // Set the initial state
        toggleTables();
    });
</script>

<script>
$(document).ready(function() {
    var today = new Date();
    
    today.setDate(today.getDate() + 1);
    var nextDate = today.toISOString().split('T')[0];
    $('#start_date').attr('min', nextDate);
    $('#end_date').attr('min', nextDate);
});

$(document).ready(function() {
    var empl_id = $('#empl_id').val().trim();
    console.log(empl_id);
    $.ajax({
        url: '../data_get/shift_alloction1.php',
        method: 'GET',
        data: {
            empl_id: empl_id
        },
        success: function(response) {
            // console.log(response);
            $('#users-list').html(response);
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error: ' + status + ' ' + error);
        }
    });

    var empl_id = $('#empl_id').val().trim();
    console.log(empl_id);
    $.ajax({
        url: '../data_get/shift_alloction2.php',
        method: 'GET',
        data: {
            empl_id: empl_id
        },
        success: function(response) {
            // console.log(response);
            $('#users-list1').html(response);
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error: ' + status + ' ' + error);
        }
    });

    $(document).ready(function() {
    $('#shift-allocate-modal-Modal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var empl_id = button.data('differ');
        var start_date = button.data('start');
        var end_date = button.data('end');


        $.ajax({
            url: '../data_get/shift_allc_edit.php',
            method: 'POST',
            data: {
                empl_id: empl_id,
                start_date: start_date,
                end_date: end_date
            },
            success: function(response) {
                $('#shift_edit').html(response);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' ' + error);
            }
        });
    });
});




    $('#shift_allc').click(function() { 
        var selectedIds = [];
        $('input[name="select_id[]"]:checked').each(function() { 
            var emplid = $(this).val();
            selectedIds.push(emplid);
        });

        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var shift = $('#shift').val();

        $.ajax({
            url: '../data_insert/shift_allocation.php',
            type: 'POST',
            data: {
                start_date: start_date,
                end_date: end_date,
                shift: shift,
                selectedIds: selectedIds
            },
            success: function(response) {
                displayToast('Success', 'Shift Allocated Succesfully.');
                console.log(response);
                $('#shift-allocate-modal-Modal').hide();
                setTimeout(function() {
                    location.reload();
                }, 3000);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' ' + error);
            }
        });
    });

    function displayToast(title, message) {
        var toastHtml = '<div class="toast" style="margin-left: 330% !important; margin-top: -10% !important;" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="me-auto">' + title + '</strong><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button></div><div class="toast-body">' + message + '</div></div>';
        $('.toast-container').append(toastHtml);
        var toastElement = $('.toast').last();
        toastElement.toast('show');
        setTimeout(function() {
            toastElement.toast('hide');
        }, 3000);
    }
});
</script>
</html>