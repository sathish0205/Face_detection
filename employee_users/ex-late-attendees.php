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

        .employee-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }

        .employee-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: calc(33.333% - 20px);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            transition: transform 0.3s;
        }

        .employee-card:hover {
            transform: translateY(-10px);
        }

        .employee-card img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .employee-list {
            display: block;
        }

        .employee-grid {
            display: none;
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
                        <div class="col-lg-3 col-12 fs-3 text-black">Late Attendees</div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-2 col-6">
                            <select class="form-select p-3" id="select-view" aria-label="Default select example" onchange="toggleView()">
                                <option value="">List View</option>
                                <option value="grid">Grid View</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-6 mb-sm-3">
                        <input type="date" class="form-control p-3" id="date-filter">
                        </div>
                        <div class="col-lg-2 col-6">
                        <select class="form-select p-3" aria-label="Default select example" id="department-filter">
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
                        <div class="col-lg-2 text-end col-6">
                        <button type="button" class="btn rounded-2 text-white p-2" style="background-color: #063554;padding: 14px 60px !important;" onclick="exportToExcel('employee_table')">
        <i class="fa-solid fa-file-export pe-2"></i>Export
    </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <!-- Table View (List View) -->
                            <div class="table-responsive employee-list">
                            <div id="employee_table"></div>

                            </div>
                            <!-- Employee Cards (Grid View) -->
                            <div class="employee-container employee-grid">
                                <div class="employee-card">
                                    <img src="../assets/images/faces/face7.jpg" alt="Employee Image">
                                    <div class="employee-details">
                                        <div class="name" style="color:#430A5D">Bala</div>
                                        <div class="login-time" style="color:#810CA8">Login Time: 9:00 AM</div>
                                        <div class="department" style="color:#4E9F3D">Department: IT</div>
                                        <div class="email" style="color:#1597BB">Email: Bala.doe@example.com</div>
                                        <div class="phone" style="color:#03506F">Phone: (123) 456-7890</div>
                                    </div>
                                </div>
                                <div class="employee-card">
                                    <img src="../assets/images/faces/face8.jpg" alt="Employee Image">
                                    <div class="employee-details">
                                        <div class="name" style="color:#430A5D">Surya</div>
                                        <div class="login-time" style="color:#810CA8">Login Time: 9:15 AM</div>
                                        <div class="department" style="color:#4E9F3D">Department: HR</div>
                                        <div class="email" style="color:#1597BB">Email: surya.smith@example.com</div>
                                        <div class="phone" style="color:#03506F">Phone: (987) 654-3210</div>
                                    </div>
                                </div>
                                <div class="employee-card">
                                    <img src="../assets/images/faces/face4.jpg" alt="Employee Image">
                                    <div class="employee-details">
                                        <div class="name" style="color:#430A5D">Sakthi</div>
                                        <div class="login-time" style="color:#810CA8">Login Time: 9:30 AM</div>
                                        <div class="department" style="color:#4E9F3D">Department: Marketing</div>
                                        <div class="email" style="color:#1597BB">Email: Sakthi.johnson@example.com</div>
                                        <div class="phone" style="color:#03506F">Phone: (555) 123-4567</div>
                                    </div>
                                </div>
                                <div class="employee-card">
                                    <img src="../assets/images/faces/face6.jpg" alt="Employee Image">
                                    <div class="employee-details">
                                        <div class="name" style="color:#430A5D">Prakash</div>
                                        <div class="login-time" style="color:#810CA8">Login Time: 9:00 AM</div>
                                        <div class="department" style="color:#4E9F3D">Department: IT</div>
                                        <div class="email" style="color:#1597BB">Email: prakash.doe@example.com</div>
                                        <div class="phone" style="color:#03506F">Phone: (123) 456-7890</div>
                                    </div>
                                </div>
                                <div class="employee-card">
                                    <img src="../assets/images/faces/face5.jpg" alt="Employee Image">
                                    <div class="employee-details">
                                        <div class="name" style="color:#430A5D">Vishnu</div>
                                        <div class="login-time" style="color:#810CA8">Login Time: 9:15 AM</div>
                                        <div class="department" style="color:#4E9F3D">Department: HR</div>
                                        <div class="email" style="color:#1597BB">Email: vishnu.smith@example.com</div>
                                        <div class="phone" style="color:#03506F">Phone: (987) 654-3210</div>
                                    </div>
                                </div>
                                <div class="employee-card">
                                    <img src="../assets/images/faces/face1.jpg" alt="Employee Image">
                                    <div class="employee-details">
                                        <div class="name" style="color:#430A5D">Rohit</div>
                                        <div class="login-time" style="color:#810CA8">Login Time: 9:30 AM</div>
                                        <div class="department" style="color:#4E9F3D">Department: Marketing</div>
                                        <div class="email" style="color:#1597BB">Email: Rohit.johnson@example.com</div>
                                        <div class="phone" style="color:#03506F">Phone: (555) 123-4567</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center mt-3">
                            <div class="btn"><i class="fa-solid fa-angle-left"></i> Prev</div>
                            <div class="btn ms-4">Next <i class="fa-solid fa-angle-right"></i></div>
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
        function loadTable(department = '', date = '') {
            $.ajax({
                url: '../data_get/late_atten1.php',
                type: 'post',
                data: {
                    date: date,
                    department: department
                },
                success: function(response) {
                    // console.log(response);
                    $('#employee_table').html(response);
                }
            });
        }

        loadTable();

        function getFilters() {
            return {
                department: $('#department-filter').val(),
                date: $('#date-filter').val(),
            };
        }

        $('#department_filter').on('change', function() {
            var filters = getFilters();
            loadTable(filters.department, filters.date);
        });

        $('#date_filter').on('change', function() {
            var filters = getFilters();
            loadTable(filters.department, filters.date);
        });

        setInterval(function() {
            var filters = getFilters();
            loadTable(filters.department, filters.date);
        }, 5000);
    });
</script>


    <script>
        function toggleView() {
            var view = document.getElementById('select-view').value;
            var listView = document.querySelector('.employee-list');
            var gridView = document.querySelector('.employee-grid');

            if (view === 'list') {
                listView.style.display = 'block';
                gridView.style.display = 'none';
            } else if (view === 'grid') {
                listView.style.display = 'none';
                gridView.style.display = 'flex';
            } else {
                listView.style.display = 'block';
                gridView.style.display = 'none';
            }
        }

        // Initialize view on page load
        window.onload = toggleView;
    </script>

<script>
    function exportToExcel(tableId) {
        // Get today's date
        let today = new Date();
        let dd = String(today.getDate()).padStart(2, '0');
        let mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        let yyyy = today.getFullYear();

        // Format date as YYYY-MM-DD
        let formattedDate = yyyy + '-' + mm + '-' + dd;

        let fileName = 'LAIRA_late_attendance_' + formattedDate + '.xls';

        let tab_text = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
        tab_text += '<head><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">';
        tab_text += '<xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>';
        tab_text += '<x:Name>Sheet1</x:Name>';
        tab_text += '<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>';
        tab_text += '</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>';
       
        let table = document.getElementById(tableId);
       
        let clonedTable = table.cloneNode(true);
       
        let profileColumnIndex = 0; // Change this to 0 to remove the first column
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
<script>
    function exportToExcel(tableId) {
        // Get today's date
        let today = new Date();
        let dd = String(today.getDate()).padStart(2, '0');
        let mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        let yyyy = today.getFullYear();

        // Format date as YYYY-MM-DD
        let formattedDate = yyyy + '-' + mm + '-' + dd;

        let fileName = 'LAIRA_late_attendance_' + formattedDate + '.xls';

        let tab_text = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
        tab_text += '<head><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">';
        tab_text += '<xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>';
        tab_text += '<x:Name>Sheet1</x:Name>';
        tab_text += '<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>';
        tab_text += '</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>';
       
        let table = document.getElementById(tableId);
       
        let clonedTable = table.cloneNode(true);
       
        let profileColumnIndex = 0; // Change this to 0 to remove the first column
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
