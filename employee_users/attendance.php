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

        table {
            border: 2px solid var(--my-grey);
        }

        .table-row th {

            text-align: center;
            font-size: var(--th-fonts) !important;
            padding: 20px !important;
            width: 100% !important;
            white-space: nowrap;

        }

        .table-row td {
            text-align: center;
            padding: 15px !important;
            font-size: var(--td-fonts);
            white-space: nowrap !important;
            text-overflow: ellipsis !important;
            max-width: 200px !important;
            text-overflow: ellipsis !important;
            overflow: hidden;
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
                            <input type="date" class="form-control" id="date_filter" placeholder="Select date">
                            <label for="floatingInput">Date</label>
                            </div>

                        </div>
                        <div class="col-lg-2 col-6">
                           
                        </div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-2 text-lg-end col-12 text-sm-center">
                            <button type="button" class="btn rounded-2 text-white p-2" style="background-color: #063554;padding: 14px 60px !important;" onclick="exportToExcel('employee_table')">
        <i class="fa-solid fa-file-export pe-2"></i>Export
    </button>

                        </div>
                    </div>
                    <div class="row mb-4 mt-2">
                        <div class="col-lg-3 col-12 mb-sm-3">
                            <select class="form-select p-3" aria-label="Default select example" id="type_filter">
                                <option value="">Employee Type</option>
                                <option value="external">External</option>
                                <option value="internal">Internal</option>
                            </select>
                        </div>
                        <!-- <div class="col-lg-2 col-6">
                            <select class="form-select p-3" aria-label="Default select example" id="department-filter">
                                <option value="">Regular View</option>
                                <option value="1">Overtime View</option>
                            </select>
                        </div> -->
                        <div class="col-lg-2 col-6">
                            <select class="form-select p-3" aria-label="Default select example" id="department_filter">
                                <option value="">All Department</option>
                                <?php 
                                $sql = "SELECT * FROM department";
                                $result = mysqli_query($conn, $sql);
                                if($result){
                                    while($row = mysqli_fetch_assoc($result)){
                                        $dept = $row['dept'];
                                        ?>
                                        <option value="<?php echo $dept; ?>"><?php echo $dept; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>



                        <div class="col-lg-2 col-6 mb-sm-3">
                            <select class="form-select p-3" aria-label="Default select example" id="shift_filter">
                                <option value="">All Shifts</option>
                                <?php 
                                $sql1 = "SELECT * FROM shift_creations GROUP BY shift_name";
                                $result1 = mysqli_query($conn, $sql1);
                                if($result1){
                                    while($row1 = mysqli_fetch_assoc($result1)){
                                        $shift_name = $row1['shift_name'];
                                        ?>
                                        <option value="<?php echo $shift_name; ?>"><?php echo $shift_name; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="form-floating">
                                <select class="form-select" id="limit_filter" aria-label="Floating label select example">
                                    <option value="50">50</option>
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
    <div class="form-check form-switch">
        <input class="form-check-input ms-auto fs-5" style="color: #063554;" type="checkbox" role="switch" id="flexSwitchCheckDefault">
    </div>
    <div class="col-12">
        <div class="table-responsive employee-list mt-5">
            <div id="employee_table"></div>
        </div>
    </div>      
    <div class="col-12">
        <div class="table-responsive employee-list mt-5">
            <div id="employee_table2"></div>
        </div>
    </div>      
    <div class="col-lg-12 text-center mt-5">
        <button class="btn btn-prev"><i class="fa-solid fa-angle-left"></i> Previous</button>
        <button class="btn btn-next ms-3">Next <i class="fa-solid fa-angle-right"></i></button>
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
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.getElementById('flexSwitchCheckDefault');
        const employeeTable1 = document.getElementById('employee_table').parentElement.parentElement;
        const employeeTable2 = document.getElementById('employee_table2').parentElement.parentElement;

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

        toggleTables();
    });
</script>


<script>
$(document).ready(function() {
    let currentPage = 1;
    let totalPages = 1;

    function loadTable(searchQuery = '', typeFilter = '', department = '', shift = '', date = '', limit = '50', page = 1) {
        $.ajax({
            url: '../data_get/attendance20.php',
            type: 'post',
            data: {
                search: searchQuery,
                typefilter: typeFilter,
                department: department,
                shift: shift,
                date: date,
                limit: limit,
                page: page
            },
            success: function(response) {
                $('#employee_table').html(response);
                // Assume the response includes a totalPages value for updating pagination
                totalPages = response.totalPages;
                currentPage = page;
            }
        });
    }

    function getFilters() {
        return {
            searchQuery: $('#searchInput').val(),
            typeFilter: $('#type_filter').val(),
            department: $('#department_filter').val(),
            shift: $('#shift_filter').val(),
            date: $('#date_filter').val(),
            limit: $('#limit_filter').val()
        };
    }

    $('.btn-prev').on('click', function() {
        if (currentPage > 1) {
            var filters = getFilters();
            loadTable(filters.searchQuery, filters.typeFilter, filters.department, filters.shift, filters.date, filters.limit, currentPage - 1);
        }
    });

    $('.btn-next').on('click', function() {
        if (currentPage < totalPages) {
            var filters = getFilters();
            loadTable(filters.searchQuery, filters.typeFilter, filters.department, filters.shift, filters.date, filters.limit, currentPage + 1);
        }
    });

    $('#shift_filter').on('change', function() {
        var filters = getFilters();
        loadTable(filters.searchQuery, filters.typeFilter, filters.department, filters.shift, filters.date, filters.limit);
    });

    $('#department_filter').on('change', function() {
        var filters = getFilters();
        loadTable(filters.searchQuery, filters.typeFilter, filters.department, filters.shift, filters.date, filters.limit);
    });

    $('#type_filter').on('change', function() {
        var filters = getFilters();
        loadTable(filters.searchQuery, filters.typeFilter, filters.department, filters.shift, filters.date, filters.limit);
    });

    $('#searchInput').on('input', function() {
        var filters = getFilters();
        loadTable(filters.searchQuery, filters.typeFilter, filters.department, filters.shift, filters.date, filters.limit);
    });

    $('#date_filter').on('change', function() {
        var filters = getFilters();
        loadTable(filters.searchQuery, filters.typeFilter, filters.department, filters.shift, filters.date, filters.limit);
    });

    $('#limit_filter').on('change', function() {
        var filters = getFilters();
        loadTable(filters.searchQuery, filters.typeFilter, filters.department, filters.shift, filters.date, filters.limit);
    });

    loadTable();

    setInterval(function() {
        var filters = getFilters();
        loadTable(filters.searchQuery, filters.typeFilter, filters.department, filters.shift, filters.date, filters.limit);
    }, 5000);
});
</script>
<script>
$(document).ready(function() {
    let currentPage = 1;
    let totalPages = 1;

    function loadTable(searchQuery = '', typeFilter = '', department = '', shift = '', date = '', limit = '50', page = 1) {
        $.ajax({
            url: '../data_get/attendance6.php',
            type: 'post',
            data: {
                search: searchQuery,
                typefilter: typeFilter,
                department: department,
                shift: shift,
                date: date,
                limit: limit,
                page: page
            },
            success: function(response) {
                $('#employee_table2').html(response);
                // Assume the response includes a totalPages value for updating pagination
                totalPages = response.totalPages;
                currentPage = page;
            }
        });
    }

    function getFilters() {
        return {
            searchQuery: $('#searchInput').val(),
            typeFilter: $('#type_filter').val(),
            department: $('#department_filter').val(),
            shift: $('#shift_filter').val(),
            date: $('#date_filter').val(),
            limit: $('#limit_filter').val()
        };
    }

    $('.btn-prev').on('click', function() {
        if (currentPage > 1) {
            var filters = getFilters();
            loadTable(filters.searchQuery, filters.typeFilter, filters.department, filters.shift, filters.date, filters.limit, currentPage - 1);
        }
    });

    $('.btn-next').on('click', function() {
        if (currentPage < totalPages) {
            var filters = getFilters();
            loadTable(filters.searchQuery, filters.typeFilter, filters.department, filters.shift, filters.date, filters.limit, currentPage + 1);
        }
    });

    $('#shift_filter').on('change', function() {
        var filters = getFilters();
        loadTable(filters.searchQuery, filters.typeFilter, filters.department, filters.shift, filters.date, filters.limit);
    });

    $('#department_filter').on('change', function() {
        var filters = getFilters();
        loadTable(filters.searchQuery, filters.typeFilter, filters.department, filters.shift, filters.date, filters.limit);
    });

    $('#type_filter').on('change', function() {
        var filters = getFilters();
        loadTable(filters.searchQuery, filters.typeFilter, filters.department, filters.shift, filters.date, filters.limit);
    });

    $('#searchInput').on('input', function() {
        var filters = getFilters();
        loadTable(filters.searchQuery, filters.typeFilter, filters.department, filters.shift, filters.date, filters.limit);
    });

    $('#date_filter').on('change', function() {
        var filters = getFilters();
        loadTable(filters.searchQuery, filters.typeFilter, filters.department, filters.shift, filters.date, filters.limit);
    });

    $('#limit_filter').on('change', function() {
        var filters = getFilters();
        loadTable(filters.searchQuery, filters.typeFilter, filters.department, filters.shift, filters.date, filters.limit);
    });

    loadTable();

    setInterval(function() {
        var filters = getFilters();
        loadTable(filters.searchQuery, filters.typeFilter, filters.department, filters.shift, filters.date, filters.limit);
    }, 5000);
});
</script>
<script>
    function exportToExcel(tableId) {
        let today = new Date();
        let dd = String(today.getDate()).padStart(2, '0');
        let mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        let yyyy = today.getFullYear();

        let formattedDate = yyyy + '-' + mm + '-' + dd;

        let fileName = 'LAIRA_attendance_' + formattedDate + '.xls';

        let tab_text = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
        tab_text += '<head><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">';
        tab_text += '<xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>';
        tab_text += '<x:Name>Sheet1</x:Name>';
        tab_text += '<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>';
        tab_text += '</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>';
       
        let table = document.getElementById(tableId);
       
        let clonedTable = table.cloneNode(true);
       
        let profileColumnIndex = 0;
        let rows = clonedTable.getElementsByTagName('tr');
       
        for (let row of rows) {
            if (row.cells.length > profileColumnIndex) {
                row.removeChild(row.cells[profileColumnIndex]);
            }
        }
       
        tab_text += clonedTable.outerHTML;
        tab_text += '</body></html>';
       
        let data_type = 'data:application/vnd.ms-excel';
        let ua = window.navigator.userAgent;
        let msie = ua.indexOf('MSIE ');
        let edge = ua.indexOf('Edge/');
       
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