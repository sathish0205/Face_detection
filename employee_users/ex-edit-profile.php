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
        
        .table-row th{
            text-align: center;
            font-size: var(--th-fonts) !important;
            padding: 20px !important;
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
            <div class="col-lg-2"></div>
            <div class="col-lg-10 right-side-section" >
                <section class="m-4">
                    <div class="row mb-4 ">
                        <div class="col-lg-6 fs-3 text-black col-12 mb-sm-3">Edit Profile</div>
                        <div class="col-lg-3 col-6">
                            <div class="input-group mb-2">
                                <input type="search" class="form-control p-3" id="floatingInput" placeholder="Enter Employee ID/ Name">
                                <div class="input-group-text"><i class="fa-solid fa-search p-2"></i></div>
                            </div>

                        </div>
                        <div class="col-lg-3 col-6 mb-sm-2">
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
                            <div class="table-responsive employee-list">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr class="table-row">
                                            <th>S.No</th>
                                            <th>EMPLOYEE NAME</th>
                                            <th>EMPLOYEE ID</th>
                                            <th>GENDER</th>
                                            <th>DEPARTMENT</th>
                                            <th>DESIGNATION</th>
                                            <th class="text-center">ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody class="late-emp-td">
                                        <tr class="table-row">
                                            <td>1</td>
                                            <td>sri Prasanth</td>
                                            <td class="emp-name">HR001</td>
                                            <td class="">Male</td>
                                            <td class="late-emp-time">HR</td>
                                            <td class="late-emp-dept">HR Manager</td>
                                            <td class="d-flex justify-content-center">
                                                <div class="dropdown ms-5">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-gears"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#" href="#" data-bs-toggle="modal" data-bs-target="#Add-Profil-img-Modal">Add profile Image</a></li>
                                                        <li><a class="dropdown-item" href="#">Add Data Set</a></li>
                                                        <li><a class="dropdown-item" href="employee-deatils.php">Add/Edit Employee Details</a></li>
                                                    </ul>
                                                    <div class="btn ms-2">View Details</div>
                                                </div>
                                            </td>
                                            
                                        </tr>

                                    </tbody>
                                    <tbody>
                                        <tr class="table-row">
                                            <td>2</td>
                                            <td>Bala</td>
                                            <td class="emp-name">PR001</td>
                                            <td class="">Male</td>
                                            <td class="late-emp-time">Production</td>
                                            <td class="late-emp-dept">PR Manager</td>
                                            <td class="d-flex justify-content-center">
                                                <div class="dropdown ms-5">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-gears"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#">Add profile Image</a></li>
                                                        <li><a class="dropdown-item" href="#">Add Data Set</a></li>
                                                        <li><a class="dropdown-item" href="employee-deatils.php">Add/Edit Employee Details</a></li>
                                                    </ul>
                                                    <div class="btn ms-2">View Details</div>
                                                </div>
                                            </td>

                                        </tr>
                                    </tbody>
                                    <tbody>
                                        <tr class="table-row">
                                            <td>3</td>
                                            <td>Surya</td>
                                            <td class="emp-name">QC001</td>
                                            <td class="">Male</td>
                                            <td class="late-emp-time">QC</td>
                                            <td class="late-emp-dept">QC Manager</td>
                                            <td class="d-flex justify-content-center">
                                                <div class="dropdown ms-5">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-gears"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#">Add profile Image</a></li>
                                                        <li><a class="dropdown-item" href="#">Add Data Set</a></li>
                                                        <li><a class="dropdown-item" href="employee-deatils.php">Add/Edit Employee Details</a></li>
                                                    </ul>
                                                    <div class="btn ms-2">View Details</div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody>
                                        <tr class="table-row">
                                            <td>4</td>
                                            <td>Sakthi Nesan</td>
                                            <td class="emp-name">SM001</td>
                                            <td class="">Male</td>
                                            <td class="late-emp-time">SM</td>
                                            <td class="late-emp-dept">SM Manager</td>
                                            <td class="d-flex justify-content-center">
                                                <div class="dropdown ms-5">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-gears"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#">Add profile Image</a></li>
                                                        <li><a class="dropdown-item" href="#">Add Data Set</a></li>
                                                        <li><a class="dropdown-item" href="employee-deatils.php">Add/Edit Employee Details</a></li>
                                                    </ul>
                                                    <div class="btn ms-2">View Details</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Add more rows as needed -->
                                    </tbody>
                                    <tbody>
                                        <tr class="table-row">
                                            <td>5</td>
                                            <td>Prakash</td>
                                            <td class="emp-name">F&A001</td>
                                            <td class="">Male</td>
                                            <td class="late-emp-time">F&A</td>
                                            <td class="late-emp-dept">F&A Manager</td>
                                            <td class="d-flex justify-content-center">
                                                <div class="dropdown ms-5">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-gears"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#">Add profile Image</a></li>
                                                        <li><a class="dropdown-item" href="#">Add Data Set</a></li>
                                                        <li><a class="dropdown-item" href="employee-deatils.php">Add/Edit Employee Details</a></li>
                                                    </ul>
                                                    <div class="btn ms-2">View Details</div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="col-lg-12 d-flex justify-content-center mt-sm-3">
                            <div class="btn"><i class="fa-solid fa-angle-left"></i> Prev</div>
                            <div class="btn ms-3">Next <i class="fa-solid fa-angle-right"></i></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


    <!-- Add profile image  trigger modal -->

    <div class="modal fade" id="Add-Profil-img-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Profile Image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-5  text--sm-center ">
                            <i class="fa-solid fa-user fa-10x p-5 rounded-2 capture"></i><br>
                            <div class="ms-5">
                                <div class="btn  mt-4 ms-1 mb-sm-5 me-sm-4"><i class="fa-solid fa-camera pe-3"></i> Capture</div>
                            </div>
                        </div>

                        <div class="col-lg-6 text-center">
                            <i class="fa-solid fa-folder-open fa-10x p-5 rounded-2  capture "></i><br>
                            <input type="file" class="form-control mt-4 p-3">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add data set Trigger Modal -->
    <!-- <div class="modal fade" id="Add-data-set-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Data Set</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center"><i class="fa-regular fa-folder-open fa-10x p-5 capture rounded-5"></i></div><br>
                            <input type="file" class="form-control p-3">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </div>
    </div> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>

</html>