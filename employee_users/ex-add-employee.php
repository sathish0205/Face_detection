<?php
session_start();
include('../db/db.php');

// if (!isset($_SESSION['empl_id'])) {
//     header('Location: ../index.php');
//     exit;
// }
// $empl_id = $_SESSION['empl_id'];
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
            display: flex;
            align-items: center;
            justify-content: center;

            color: var(--my-blue) !important;
            background-color: var(--my-grey);
        }

        #videoElement {
            display: none;
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        #capturedImage {
            display: none;
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <?php include 'exnavbar.php'; ?>
            <?php include 'exside.php'; ?>


            <div class="col-lg-2"></div>
            <div class="col-lg-10 right-side-section">
                <div id="toast-container" class="toast-container p-1"></div>
                <section class="m-4">
                    <div class="row mb-4">
                        <div class="col-lg-12 fs-3 text-black col-12 mb-sm-2">Employee Data</div>

                    </div>
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-6 mb-sm-2">
                            <div class="input-group mb-3">
                                <input type="search" class="form-control p-3" id="searchInput"
                                    placeholder="Enter Employee ID/Name">
                                <div class="input-group-text"><i class="fa-solid fa-search p-2"></i></div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-6 mb-3">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect"
                                    aria-label="Floating label select example">
                                    <option value="50">50</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                <label for="floatingSelect">Records Per Page</label>
                            </div>
                        </div>
                        <div class="col-lg-7 col-12 text-lg-end d-flex justify-content-lg-end align-items-center gap-3">
                            <form id="uploadForm" enctype="multipart/form-data" class="d-flex align-items-center">
                                <input type="file" id="fileInput" class="form-control me-2" name="importFile">
                                <button type="button" class="btn btn-primary" onclick="importfile1()">Import</button>
                            </form>
                            <div class="btn text-nowrap btn-primary d-inline-flex align-items-center"
                                data-bs-toggle="modal" data-bs-target="#Add-employee">
                                <i class="fa-solid fa-user-plus "></i> Add Employee
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive employee-list">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr class="table-row text-center">
                                            <th>S.NO</th>
                                            <th>PROFILE</th>
                                            <th>NAME</th>
                                            <th>EMAIL</th>
                                            <th>ID</th>
                                            <th>TYPE</th>
                                            <th>GENDER</th>
                                            <th>DEPARTMENT</th>
                                            <th>DESIGNATION</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody id="users-list">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center mt-3">
                            <div class=" col-lg-12 d-flex justify-content-center mt-sm-3 pagination">
                                <button class="btn btn-prev">Previous</button>
                                <button class="btn btn-next ms-3">Next</button>
                            </div>


                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="modal fade" id="Add-Profil-img-Modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Profile Image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-5 text--sm-center">


                            <i class="fa-solid fa-user fa-10x p-5 rounded-2 capture" id="usericon"
                                style="display: none;"></i>
                            <img src="" alt="Profile Image" height="250" style="border-radius: 20px;" class=""
                                id="profileImage">



                            <video id="videoElement" autoplay></video><br>
                            <img id="capturedImage" alt="Captured Image"><br>
                            <div class="ms-5">
                                <div class="btn mt-4 ms-1 mb-sm-5 me-sm-4" id="startCameraBtn"><i
                                        class="fa-solid fa-camera pe-3"></i>Start Camera</div>
                                <div class="btn mt-4 ms-1 mb-sm-5 me-sm-4" style="display: none;" id="takepicture"><i
                                        class="fa-solid fa-camera pe-3"></i>Take Picture</div>
                                <div class="btn mt-4 ms-1 mb-sm-5 me-sm-4" style="display: none;" id="retakepicture"><i
                                        class="fa-solid fa-camera pe-3"></i>ReTake Picture</div>
                            </div>
                        </div>

                        <div class="col-lg-6 text-center">
                            <i class="fa-solid fa-folder-open fa-10x p-5 rounded-2 capture "></i><br>
                            <input type="file" name="profile" class="form-control mt-4 p-3"
                                accept="image/png, image/gif, image/jpeg" />

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="saveImageButton">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="Add-employee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Employee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insertData">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" name="empl_name" id="employeeName"
                                        placeholder="">
                                    <label for="employeeName">Name</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="email" class="form-control" name="empl_email" id="employee_email"
                                        placeholder="">
                                    <label for="employee_email">Email</label>
                                </div>
                                <div id="empll_email"></div>

                                <div class="form-floating mb-4 mt-2">
                                    <select class="form-select" id="employeeType" name="empl_type"
                                        aria-label="Default select example">
                                        <option value="internal">Internal</option>
                                        <option value="external">External</option>
                                    </select>
                                    <label for="employeeType">Type</label>
                                </div>
                                <div class="form-floating mb-4" id="externalEmployeeField" style="display: none;">
                                    <input type="text" class="form-control" id="vendor_name" name="vendor_name"
                                        placeholder="">
                                    <label for="externalEmployeeId">Vendor Name</label>
                                </div>


                                <select class="form-select mb-4 p-3" id="employeeGender" name="empl_gender">
                                    <option selected>Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="others">Others</option>
                                </select>

                                <div class="form-floating mb-4">
                                    <?php
                                    include('../db/db.php');
                                    $prefix = 'LAE';

                                    $sql = "SELECT `empl_id` FROM `employeesusers` WHERE `empl_id` LIKE '$prefix%' ORDER BY `empl_id` DESC LIMIT 1";
                                    $result = mysqli_query($conn, $sql);

                                    if ($result && $result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                        $latestId = $row['empl_id'];
                                        $numericPart = intval(substr($latestId, strlen($prefix)));
                                        $newNumericPart = $numericPart + 1;

                                        $newId = $prefix . str_pad($newNumericPart, 3, '0', STR_PAD_LEFT);


                                        ?>
                                        <input type="text" class="form-control" id="employeeId" name="empl_id"
                                            value="<?php echo $newId; ?>" readonly>
                                        <?php
                                    } else {

                                        ?>
                                        <input type="text" class="form-control" id="employeeId" name="empl_id"
                                            value="<?php echo $prefix . '001'; ?>" readonly>
                                        <?php
                                    }
                                    ?>
                                    <label for="employeeId">Id</label>
                                </div>


                                <select class="form-select mb-4 p-3" id="employeeDepartment" name="empl_department"
                                    aria-label="Floating label select example">
                                    <option selected>Department</option>
                                    <?php
                                    $sql1 = "SELECT * FROM department";
                                    $result = mysqli_query($conn, $sql1);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $dept = $row['dept'];
                                            echo '<option value="' . $dept . '">' . $dept . '</option>';
                                        }
                                    } else {
                                        echo '<option>No Department</option>';
                                    }
                                    ?>
                                </select>




                                <select class="form-select mb-4 p-3" id="employeeDesignation" name="empl_designation"
                                    aria-label="Floating label select example">
                                    <option selected>Designation</option>
                                </select>

                                <select class="form-select mb-4 p-3" id="empl_report" name="empl_report"
                                    aria-label="Floating label select example">
                                    <option selected>Reporting Position</option>
                                </select>

                                <div class="row">
                                    <div class="col-lg-8">
                                        <select class="form-select mb-4 p-3" id="reporting_person"
                                            name="reporting_person" aria-label="Floating label select example">
                                            <option selected>Reporting Person</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <label id="no_of_teams" for=""></label>
                                        <div id="count_display"></div>
                                    </div>
                                </div>


                                <!-- <div class="form-floating mb-4" id="externalEmployeeField">
                                        <input type="text" class="form-control" id="reporting_person" name="reporting_person" placeholder="">
                                        <label for="externalEmployeeId">Reportin Person</label>
                                    </div> -->


                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="button" class="btn" style="padding: 12px 45px !important;"
                                    id="createEmployee">Create</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <script>
    function importfile1() {
        const fileInput = document.getElementById('fileInput');
        const file = fileInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const data = new Uint8Array(e.target.result);
                const workbook = XLSX.read(data, { type: 'array' });

                // Assuming the first sheet in the Excel file
                const worksheet = workbook.Sheets[workbook.SheetNames[0]];
                const jsonData = XLSX.utils.sheet_to_json(worksheet, { header: 1 });

                // Remove header row if present
                jsonData.shift();

                // Send the data to the server
                fetch('upload.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ data: jsonData })
                })
                .then(response => response.json())
                .then(jsonResult => {
                    console.log('Success:', jsonResult);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            };
            reader.readAsArrayBuffer(file);
        } else {
            console.error('No file selected');
        }
    }
</script>

    <script>
        $(document).ready(function () {
            $("#employeeDepartment, #empl_report").on("input", function () {
                fetchData2();
            });

            function fetchData2() {
                var empl_dept = $("#employeeDepartment").val().trim();
                var empl_report = $("#empl_report").val().trim();

                if (empl_dept !== '' && empl_report !== '') {
                    $.ajax({
                        url: "../data_get/employee_report.php",
                        type: "POST",
                        data: {
                            empl_dept: empl_dept,
                            empl_report: empl_report
                        },
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            if (response.status === 'success') {
                                $('#reporting_person').empty();
                                $('#reporting_person').append('<option value="">Reporting Person</option>');

                                response.empl_ids.forEach(function (empl_id) {
                                    var count = response.counts[empl_id] || 0;
                                    $('#reporting_person').append('<option value="' + empl_id + '" data-count="' + count + '">' + empl_id + '</option>');
                                });
                            } else { }
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            }

            $('#reporting_person').change(function () {
                var selectedOption = $(this).find('option:selected');
                var empl_id = selectedOption.val();
                var count = selectedOption.data('count');

                $('#count_display').html('<input type="text" readonly class="form-control" value="' + count + '">');
                $('#no_of_teams').html('Reporting with in ' + empl_id + ' count');
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#employee_email").on("input", function () {
                fetchData();
            });

            function fetchData() {
                var employee_email = $("#employee_email").val();
                if (employee_email.trim() !== '') {
                    $.ajax({
                        url: "../data_get/employee_email.php",
                        type: "POST",
                        data: {
                            employee_email: employee_email,
                        },
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            if (response.status === 'success') {
                                $('#empll_email').text(response.message).css('color', 'green');
                            } else if (response.status === 'error') {
                                $('#empll_email').text(response.message).css('color', 'red');
                                $('#createEmployee').hide();
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
            $("#employeeDepartment, #employeeDesignation").on("change", function () {
                fetchData1();
            });

            $('#createEmployee').hide();

            function fetchData1() {
                var empl_dept = $("#employeeDepartment").val().trim();
                var empl_design = $("#employeeDesignation").val().trim();
                if (empl_dept !== '') {
                    $.ajax({
                        url: "../data_get/empl_report_position.php",
                        type: "GET",
                        data: {
                            empl_dept: empl_dept,
                            empl_design: empl_design
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 'success') {
                                $('#empl_report').empty();
                                $('#empl_report').append('<option value="">Reporting Position</option>');
                                $.each(response.message, function (index, value) {
                                    var count = response.counts[value] || 0;
                                    $('#empl_report').append('<option value="' + value + '">' + count + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + value + '</option>');
                                });
                                $('#createEmployee').show();
                            } else if (response.status === 'error') {
                                $('#empl_report').empty().append('<option>No Designation Data Found</option>');
                                $('#createEmployee').hide();
                            } else {
                                console.error(response.message);
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
            $("#employeeDepartment").on("change", function () {
                fetchData1();
            });

            $('#createEmployee').hide();

            function fetchData1() {
                var empl_dept = $("#employeeDepartment").val().trim();
                if (empl_dept !== '') {
                    $.ajax({
                        url: "../data_get/employee_design.php",
                        type: "GET",
                        data: {
                            empl_dept: empl_dept
                        },
                        dataType: 'json',

                        success: function (response) {
                            if (response.status === 'success') {
                                $('#employeeDesignation').empty();
                                $('#employeeDesignation').append('<option value="">Designation</option>');
                                $.each(response.message, function (key, value) {
                                    $('#employeeDesignation').append('<option value="' + value + '">' + value + '</option>');
                                });
                                $('#createEmployee').show();
                            } else if (response.status === 'error') {
                                $('#employeeDesignation').empty().append('<option>No Designation Data Found</option>');
                                $('#createEmployee').hide();

                            } else {
                                console.error(response.message);
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
            let currentPage = 1;

            function fetchUsers(page = 1, records = 50, query = '') {
                $.ajax({
                    url: '../data_get/empl_data.php',
                    method: 'GET',
                    data: {
                        page: page,
                        records: records,
                        search: query
                    },
                    success: function (response) {
                        $('#users-list').html(response);
                        $('.btn-prev').data('current-page', page);
                        $('.btn-next').data('current-page', page);


                        currentPage = page;
                    }
                });
            }

            fetchUsers(currentPage, $('#floatingSelect').val());

            $('#searchInput').on('input', function () {
                var searchQuery = $(this).val();
                fetchUsers(1, $('#floatingSelect').val(), searchQuery);
            });

            $('.btn-prev').on('click', function () {
                if (currentPage > 1) {
                    fetchUsers(currentPage - 1, $('#floatingSelect').val(), $('#searchInput').val());
                }
            });

            $('.btn-next').on('click', function () {
                fetchUsers(currentPage + 1, $('#floatingSelect').val(), $('#searchInput').val());
            });

            $('#floatingSelect').on('change', function () {
                fetchUsers(1, $(this).val(), $('#searchInput').val());
            });

            $('#Add-Profil-img-Modal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var profilePath = button.data('profile_path');

                var modal = $(this);
                var imageElement = modal.find('#profileImage');
                var iconElement = modal.find('#usericon');

                if (profilePath) {
                    imageElement.attr('src', '../Profile_img/' + profilePath).show();
                    iconElement.hide();
                } else {
                    imageElement.hide();
                    iconElement.show();
                }
            });

        });
    </script>
    <script>
        let stream;
        let empl_id;

        // Fetch employee ID from data attribute of the link
        $(document).on('click', 'a[data-bs-target="#Add-Profil-img-Modal"]', function () {
            empl_id = $(this).data('id');
        });

        document.getElementById('startCameraBtn').addEventListener('click', function () {
            const userIcon = document.getElementById('usericon');
            const videoElement = document.getElementById('videoElement');
            const takepicture = document.getElementById('takepicture');
            const startCameraBtn = document.getElementById('startCameraBtn');
            const retake = document.getElementById('retakepicture');

            userIcon.style.display = 'none';
            videoElement.style.display = 'block';
            startCameraBtn.style.display = 'none';
            takepicture.style.display = 'block';

            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({
                    video: true
                }).then(function (s) {
                    stream = s;
                    videoElement.srcObject = stream;
                    videoElement.play();
                }).catch(function (err) {
                    console.log("An error occurred: " + err);
                });
            }
        });

        document.getElementById('takepicture').addEventListener('click', function () {
            const videoElement = document.getElementById('videoElement');
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            const capturedImage = document.getElementById('capturedImage');
            const takepicture = document.getElementById('takepicture');
            const retake = document.getElementById('retakepicture');

            canvas.width = videoElement.videoWidth;
            canvas.height = videoElement.videoHeight;
            context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

            const imgURL = canvas.toDataURL('image/png');
            capturedImage.src = imgURL;
            capturedImage.style.display = 'block';

            videoElement.style.display = 'none';
            takepicture.style.display = 'none';
            retake.style.display = 'block';

            // Stop the video stream when picture is taken
            stream.getTracks().forEach(track => track.stop());
        });

        document.getElementById('retakepicture').addEventListener('click', function () {
            const userIcon = document.getElementById('usericon');
            const videoElement = document.getElementById('videoElement');
            const capturedImage = document.getElementById('capturedImage');
            const takepicture = document.getElementById('takepicture');
            const retake = document.getElementById('retakepicture');
            const startCameraBtn = document.getElementById('startCameraBtn');

            capturedImage.style.display = 'none';
            videoElement.style.display = 'block';
            takepicture.style.display = 'block';
            retake.style.display = 'none';

            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({
                    video: true
                }).then(function (s) {
                    stream = s;
                    videoElement.srcObject = stream;
                    videoElement.play();
                }).catch(function (err) {
                    console.log("An error occurred: " + err);
                });
            }
        });

        document.getElementById('saveImageButton').addEventListener('click', function () {
            // Assuming you are using FormData to send the image to empl_data_save.php
            const capturedImage = document.getElementById('capturedImage');
            const canvas = document.createElement('canvas');
            canvas.width = capturedImage.naturalWidth;
            canvas.height = capturedImage.naturalHeight;
            const context = canvas.getContext('2d');
            context.drawImage(capturedImage, 0, 0);

            // Convert canvas to Blob
            canvas.toBlob(function (blob) {
                const formData = new FormData();
                formData.append('empl_id', empl_id);
                formData.append('image', blob, 'LAE' + empl_id + '.png');

                $.ajax({
                    url: '../data_save/empl_data_save.php',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log('Image saved successfully');
                        $('#Add-Profil-img-Modal').modal('hide');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error saving image:', error);
                    }
                });
            }, 'image/png');
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#employeeType').change(function () {
                if ($(this).val() == "external") {
                    $('#externalEmployeeField').show();
                } else {
                    $('#externalEmployeeField').hide();
                }
            });
        });
    </script>



    <script>
        $(document).ready(function () {
            $('#Add-employee').hide();
            $('#createEmployee').click(function () {
                var empl_name = $('#employeeName').val();
                var empl_email = $('#employee_email').val();
                var empl_type = $('#employeeType').val();
                var empl_gender = $('#employeeGender').val();
                var empl_department = $('#employeeDepartment').val();
                var empl_designation = $('#employeeDesignation').val();
                var empl_id = $('#employeeId').val();
                var vendor_name = $('#vendor_name').val();
                var reporting_person = $('#reporting_person').val();

                $.ajax({
                    url: '../data_insert/insert_employee.php',
                    type: 'POST',
                    data: {
                        empl_name: empl_name,
                        empl_email: empl_email,
                        empl_type: empl_type,
                        empl_gender: empl_gender,
                        empl_department: empl_department,
                        empl_designation: empl_designation,
                        empl_id: empl_id,
                        vendor_name: vendor_name,
                        reporting_person: reporting_person
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





</body>

</html>