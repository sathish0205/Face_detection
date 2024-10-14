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
        .capture {
            color: var(--my-blue) !important;
            background-color: var(--my-grey);
        }
        .form-check-input:checked {
            background-color: #063554;
            border-color: #063554;
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
                        <div class="col-lg-12 fs-3 text-black col-12 mb-sm-3">Attendance</div>
                        <!-- <div class="col-lg-1"></div> -->


                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-6">
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control p-3" placeholder="Search Name/Employee id">
                            <div class="input-group-text"><i class="fa-solid fa-search p-2"></i></div>
                        </div> 
                        </div>


                        <div class="col-lg-2 col-6 mb-sm-3">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="date_filter" placeholder="name@example.com">
                                <label for="floatingInput">Start Date</label>
                            </div>

                        </div>
                        <!-- <div class="col-lg-2 col-6">
                            <div class="form-floating">
                                <input type="Date" class="form-control" id="" placeholder="Password">
                                <label for="floatingPassword">End Date</label>
                            </div>
                        </div> -->
                        <div class="col-lg-2"></div>
                        <div class="col-lg-2 text-lg-end col-12 text-sm-center">
                            <button type="button" class="btn rounded-2 text-white p-2" style="background-color: #063554;padding: 14px 60px !important;" onclick="exportToExcel('employee_table')">
        <i class="fa-solid fa-file-export pe-2"></i>Export
    </button>

                        </div>
                    </div>
                    <!-- <div class="row mb-4 mt-2">
                        <div class="col-lg-3 col-12 mb-sm-3">
                            <select class="form-select p-3" aria-label="Default select example" id="department-filter">
                                <option value="">Employee Type</option>
                                <option value="1">External</option>
                                <option value="2">Internal</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-6">
                            <select class="form-select p-3" aria-label="Default select example" id="department-filter">
                                <option value="">Regular View</option>
                                <option value="1">Overtime View</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-6">
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
                            <select class="form-select p-3" aria-label="Default select example" id="department-filter">
                                <option value="">All Shifts</option>
                                <option value="1">Shift-A</option>
                                <option value="2">Shift-GL</option>
                                <option value="3">Shift-B</option>
                                <option value="4">Shift-C</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-6">
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

                    </div> -->
                 
                    <div class="row">
   
    <div class="col-12">
        <div class="table-responsive employee-list mt-5">
            <div id="employee_table"></div>
        </div>
    </div>      
   
    </div>      
    <div class="col-lg-12 text-center mt-5">
        <div class="btn"><i class="fa-solid fa-angle-left"></i> Prev</div>
        <div class="btn ms-3">Next <i class="fa-solid fa-angle-right"></i></div>
    </div>
</div>

                </section>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  


    <script>
$(document).ready(function() {
    function loadTable(searchQuery = '', date = '') {
        $.ajax({
            url: '../data_get/history.php',
            type: 'post',
            data: {
                search: searchQuery,
                date : date
            },
            success: function(response) {
                $('#employee_table').html(response);
            }
        });
    }

    $('#date_filter').on('input', function() {
        var date = $(this).val();
        var searchQuery = $('#searchInput').val();

        loadTable(searchQuery,date);
    });

    $('#searchInput').on('input', function() {
        var searchQuery = $(this).val();
        var date = $('#date_filter').val();
        loadTable(searchQuery,date);
    });

    loadTable();

    // Auto refresh every 5 seconds
    setInterval(function() {
        var searchQuery = $('#searchInput').val();
        var date = $('#date_filter').val();

        loadTable(searchQuery,date);
    }, 5000);
});
    </script>


<script>
    function exportToExcel(tableId) {
        let tab_text = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
        tab_text += '<head><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">';
        tab_text += '<xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>';
        tab_text += '<x:Name>Sheet1</x:Name>';
        tab_text += '<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>';
        tab_text += '</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>';
        
        let table = document.getElementById(tableId);
        
        let clonedTable = table.cloneNode(true);
        
        let profileColumnIndex = 1; 
        let rows = clonedTable.getElementsByTagName('tr');
        
        for (let row of rows) {
            row.removeChild(row.cells[profileColumnIndex]);
        }
        
        tab_text += clonedTable.outerHTML;
        tab_text += '</body></html>';
        
        let data_type = 'data:application/vnd.ms-excel';
        let ua = window.navigator.userAgent;
        let msie = ua.indexOf('MSIE ');
        let edge = ua.indexOf('Edge/');
        let fileName = 'exported_table.xls';
        
        let blob = new Blob([tab_text], { type: data_type });
        
        if (msie > 0 || edge > 0) {
            window.navigator.msSaveBlob(blob, fileName);
        } else {
            let elem = window.document.createElement('a');
            elem.href = window.URL.createObjectURL(blob);
            elem.download = fileName;
            document.body.appendChild(elem);
            elem.click();
            document.body.removeChild(elem);
        }
    }
</script>


</body>

</html>