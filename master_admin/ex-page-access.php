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
            <div class="col-lg-2"></div>
            <div class="col-lg-10 right-side-section">
                <section class="m-4">
                    <div class="row mb-4">
                        <div class="col-lg-8 col-7 fs-3 text-black">Page Access</div>
                        <div class="col-lg-4 col-5">
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
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive ">
                                <table class="table table-bordered  table-hover">
                                    <thead>
                                        <tr class="table-row">
                                            <th>S.No</th>
                                            <th>DEPARTMENT</th>
                                            <th>DESIGNATION</th>
                                            <th class="text-center">PAGE ACCESS</th>
                                        </tr>
                                    </thead>
                                    <tbody id="user-list">
                                    </tbody>
                                   
                                </table>
                            </div>

                        </div>
                        <div class="col-lg-12 d-flex justify-content-center">
                            <div class="btn"><i class="fa-solid fa-angle-left"></i> Prev</div>
                            <div class="btn ms-3">Next <i class="fa-solid fa-angle-right"></i></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="pageAccessModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Page Permission</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="page_access">
                    <div class="row">
                        <div class="col-lg-2">
                            <input type="text" id="design_dept" name="design_dept" class="form-control">
                        </div>
                        <div class="col-lg-2">
                            <input type="text" id="dept_design" name="dept_design" class="form-control">
                        </div>
                    </div>
                    <div class="row p-4">
                        <div class="col-lg-6">
                            <div class="form-check mb-4">
                                <input class="form-check-input border-primary" type="checkbox" value="1" id="dash_board_page" name="dash_board_page">
                                <label class="form-check-label" for="dash_board_page">
                                    Dashboard Page
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input border-primary" type="checkbox" value="1" id="add_empl_page" name="add_empl_page">
                                <label class="form-check-label" for="add_empl_page">
                                    Add Employee Page
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input border-primary" type="checkbox" value="1" id="shift_alloc_page" name="shift_alloc_page">
                                <label class="form-check-label" for="shift_alloc_page">
                                    Shift Allocation Page
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input border-primary" type="checkbox" value="1" id="atten_page" name="atten_page">
                                <label class="form-check-label" for="atten_page">
                                    Attendance Page
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input border-primary" type="checkbox" value="1" id="mon_atten_page" name="mon_atten_page">
                                <label class="form-check-label" for="mon_atten_page">
                                    Monthly Attendance Page
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-check mb-4">
                                <input class="form-check-input border-primary" type="checkbox" value="1" id="late_atten_page" name="late_atten_page">
                                <label class="form-check-label" for="late_atten_page">
                                    Late Attendees Page
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input border-primary" type="checkbox" value="1" id="visitor_page" name="visitor_page">
                                <label class="form-check-label" for="visitor_page">
                                    Visitor Page
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input border-primary" type="checkbox" value="1" id="settings_page" name="settings_page">
                                <label class="form-check-label" for="settings_page">
                                    Setting Page
                                </label>
                            </div>
                        </div>
                    </div>
                    <div id="message"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $("#design_dept, #dept_design, input[type='checkbox']").on("change", function() {
            fetchData();
        });

        function fetchData() {
            var design_dept = $("#design_dept").val();
            var dept_design = $("#dept_design").val();
            var dash_board_page = $("#dash_board_page").prop('checked') ? 1 : 0;
            var add_empl_page = $("#add_empl_page").prop('checked') ? 1 : 0;
            var shift_alloc_page = $("#shift_alloc_page").prop('checked') ? 1 : 0;
            var atten_page = $("#atten_page").prop('checked') ? 1 : 0;
            var mon_atten_page = $("#mon_atten_page").prop('checked') ? 1 : 0;
            var late_atten_page = $("#late_atten_page").prop('checked') ? 1 : 0;
            var visitor_page = $("#visitor_page").prop('checked') ? 1 : 0;
            var settings_page = $("#settings_page").prop('checked') ? 1 : 0;

            if (design_dept.trim() !== '' && dept_design.trim() !== '') {
                $.ajax({
                    url: "../data_update/page_access.php",
                    type: "POST",
                    data: {
                        design_dept: design_dept,
                        dept_design: dept_design,
                        dash_board_page: dash_board_page,
                        add_empl_page: add_empl_page,
                        shift_alloc_page: shift_alloc_page,
                        atten_page: atten_page,
                        mon_atten_page: mon_atten_page,
                        late_atten_page: late_atten_page,
                        visitor_page: visitor_page,
                        settings_page: settings_page
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.status === 'success') {
                            $('#message').text(response.message).css('color', 'green');
                        } else {
                            $('#message').text(response.message).css('color', 'red');
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
        $.ajax({
            url: '../data_get/page_access.php',
            method: 'GET',
            success: function(response) {
                $('#user-list').html(response);
            }
        });
    });
    $('#pageAccessModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var dept = button.data('dept');
            var design = button.data('design');
            var modal = $(this);
            modal.find('#design_dept').val(design);
            modal.find('#dept_design').val(dept);

            // Fetch and set checkbox values via AJAX
            $.ajax({
                url: '../data_get/fetch_permissions.php',
                type: 'POST',
                data: {
                    design_dept: design,
                    dept_design: dept
                },
                dataType: 'json',
                success: function(response) {
                    $('#dash_board_page').prop('checked', response.dash_board_page == 1);
                    $('#add_empl_page').prop('checked', response.add_empl_page == 1);
                    $('#shift_alloc_page').prop('checked', response.shift_alloc_page == 1);
                    $('#atten_page').prop('checked', response.atten_page == 1);
                    $('#mon_atten_page').prop('checked', response.mon_atten_page == 1);
                    $('#late_atten_page').prop('checked', response.late_atten_page == 1);
                    $('#visitor_page').prop('checked', response.visitor_page == 1);
                    $('#settings_page').prop('checked', response.settings_page == 1);


                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
 </script>
</body>

</html>