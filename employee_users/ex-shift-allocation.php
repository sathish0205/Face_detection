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

        .table {
            border: 1px solid var(--my-grey);
        }

        .table-row th {
            text-align: center;
            font-size: var(--th-fonts) !important;
            padding: 20px !important;
            white-space: nowrap;
        }

        .table-row td {
            text-align: center;
            padding: 15px !important;
            font-size: var(--td-fonts);
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
            <input type="text" name="empl_id" id="empl_id" value="<?php echo $empl_id ?>">
            <div class="col-lg-2"></div>
            <div class="col-lg-10 right-side-section">
                <div id="toast-container" class="toast-container p-1"></div>

                <section class="m-4">
                    <div class="row mb-3">
                        <div class="col-lg-2 col-12 fs-3 text-black mb-sm-2">Shift Allocation</div>
                        <div class="col-lg-2">
                        </div>
                        <!-- <div class="col-lg-2 col-6 mb-sm-3">
                        <div class="form-floating ">
                            <input type="Date" class="form-control pt-4" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword" class="">Select Date</label>
                        </div>
                    </div> -->
                        <!-- <div class="col-lg-2 col-6 mb-sm-3">
                        <select class="form-select p-3" aria-label="Default select example" id="department-filter">
                            <option value="">All Shifts</option>
                            <option value="1">Shift-A</option>
                            <option value="2">Shift-GL</option>
                            <option value="3">Shift-B</option>
                            <option value="4">Shift-C</option>
                        </select>
                    </div> -->
                        <!-- <div class="col-lg-2 col-6 mb-sm-3">
                        <select class="form-select p-3" aria-label="Default select example" id="department-filter">
                            <option value="">All Department</option>
                            <option value="1">Human Resources</option>
                            <option value="2">Finance and Accounting</option>
                            <option value="3">Sales And Marketing</option>
                            <option value="4">Quality Control</option>
                            <option value="5">Production</option>
                            <option value="6">Security</option>
                        </select>
                    </div> -->

                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3 col-5 mb-sm-3">
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#shift-allocate-modal-Modal">Allocate / Edit</button>
                        </div>

                        <div class="col-lg-4 col-6 mb-sm-3">
                            <div class="input-group">
                                <input type="text" id="search" class="form-control p-3" placeholder="Search Name">
                                <div class="input-group-text"><i class="fa-solid fa-search p-2"></i></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6 mb-sm-3">
                            <div class="form-floating">
                            <select class="form-select" id="pagecount" aria-label="Page Count Selector">
                                <option value="50">50</option>
                                <option value="1">100</option>
                                <option value="200">200</option>
                                <option value="500">500</option>
                                <option value="1000">1000</option>
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

                                <div id="users-list">
                                </div>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center mt-5">
                        <div class="btn" id="prevPage"><i class="fa-solid fa-angle-left"></i> Prev</div>
                        <div class="btn ms-2" id="nextPage">Next <i class="fa-solid fa-angle-right"></i></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>



    <!-- Shift Allocate Modal -->
    <div class="modal fade" id="shift-allocate-modal-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-custom">
                    <h3 class="modal-title" id="exampleModalLabel">
                        Allocate Shift
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: #ffffff;"></button>
                </div>
                <div class="modal-body">
                    <form id="shift_allocation">
                        <!-- Start Date -->
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date:</label>
                            <input type="date" class="form-control" id="start_date">
                        </div>
                        <!-- End Date -->
                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date:</label>
                            <input type="date" class="form-control" id="end_date">
                        </div>
                        <!-- Select Shift -->
                        <div class="mb-3">
                            <label for="shiftSelect" class="form-label">Select Shift:</label>
                            <select class="form-select form-select-custom " id="shift">
                                <option>Select Shift</option>
                                <?php
                                $sql = "SELECT * FROM shift_creations GROUP BY shift_name";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $shift_name = $row['shift_name'];
                                ?>
                                    <option value="<?php echo $shift_name; ?>"><?php echo $shift_name; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
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
    $(document).ready(function() {
        var today = new Date();

        today.setDate(today.getDate() + 1);
        var nextDate = today.toISOString().split('T')[0];
        $('#start_date').attr('min', nextDate);
        $('#end_date').attr('min', nextDate);
    });

    $(document).ready(function() {
    var pageCount = $('#pagecount').val(); // Get the initial page count value
    var currentPage = 1; // Start from the first page

    function fetchUsers(search, pageCount, page) {
        $.ajax({
            url: '../data_get/shift_alloction11.php',
            method: 'GET',
            data: {
                empl_id: $('#empl_id').val().trim(),
                search: search,
                pageCount: pageCount,
                page: page
            },
            success: function(response) {
                $('#users-list').html(response);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' ' + error);
            }
        });
    }

    // Initial fetch
    fetchUsers('', pageCount, currentPage);

    // Search input
    $('#search').on('input', function() {
        var search = $(this).val().trim();
        fetchUsers(search, pageCount, currentPage);
    });

    // Page count change
    $('#pagecount').on('change', function() {
        pageCount = $(this).val();
        fetchUsers($('#search').val().trim(), pageCount, currentPage);
    });

    // Previous page
    $('#prevPage').on('click', function() {
        if (currentPage > 1) {
            currentPage--;
            fetchUsers($('#search').val().trim(), pageCount, currentPage);
        }
    });

    // Next page
    $('#nextPage').on('click', function() {
        currentPage++;
        fetchUsers($('#search').val().trim(), pageCount, currentPage);
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