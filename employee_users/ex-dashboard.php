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
    <?php include '../links/ex.links.php'; ?>
    <link rel="stylesheet" href="../assets/css/ex.css">
</head>

<body>
    <style>
        /* @import url(https://unpkg.com/@webpixels/css@1.1.5/dist/index.css); */


        .card {
            border: 1px solid #dee2e6;
            border-radius: 1rem;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-top: 7%;
            background-color: rgb(255, 255, 255);
        }

        .card-body {
            padding: 20px;
        }



        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 20px;
            color: #333;
        }

        .progress-bar {
            height: 15px;
        }



        .face-img img {
            /* background-color: aqua; */
            border-radius: 50%;
            width: 20%;
        }




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

        .view-head,
        .view-head-2 {
            transition: all 0.2s ease-in-out;
        }

        .view-head:hover {
            transform: scale(1.1);
        }

        .dash-out-icon {
            background-color: #063554;
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
            white-space: nowrap;
            color: var(--my-black);

        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <?php include 'exnavbar.php'; ?>
            <?php include 'exside.php'; ?>
            <div class="col-lg-2"></div>
            <div class="col-lg-10 right-side-section">
                <section class="p-3 m-2 " style="background-color: var(--my-grey);">

                    <div class="row ">
                        <div class="col-xl-4 col-sm-6 col-12 mb-4">
                            <div class="card shadow border-0 view-head">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mb-5">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Departments</span>
                                            <span class="h3 font-bold mb-0">7</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape  text-white text-lg rounded-circle dash-out-icon">
                                                <i class="fa-solid fa-house-chimney-user p-2"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12 mb-4">
                            <div class="card shadow border-0 view-head">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mb-5">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Employees</span>
                                            <span class="h3 font-bold mb-0">1,400</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape  text-white text-lg rounded-circle dash-out-icon">
                                                <i class="fa-solid fa-user p-2"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-12 mb-sm-5">
                            <div class="card shadow border-0 view-head">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mb-5">
                                            <span class=" font-semibold text-muted text-sm d-block mb-2">Shifts</span>
                                            <span class="h3 font-bold mb-0">4</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape  text-white text-lg rounded-circle dash-out-icon">
                                                <i class="fa-solid fa-clipboard-list p-2"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12 mb-4" style="margin-top: -6%;">
                            <div class="card shadow border-0 ">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-8 mb-5 col-sm-12 ">
                                            <h4 class="mb-4 fs-5">Shifts</h4>
                                            <span class="fs-5 font-bold mt-5">A - Shift <span class="ms-2">
                                                    <div class="btn aloca-btn">Allocated - 400</div>
                                                </span><span>
                                                    <div class="btn present-btn ms-lg-2 text-white ms-1 ">Present - 350</div>
                                                </span><span>
                                                    <div class="btn present-btn ms-2 mt-lg-0  text-white mt-4">Absent - 50</div>
                                                </span></span><br><br>
                                            <span class="fs-5 font-bold mt-5 ">GL-Shift <span class="ms-2">
                                                    <div class="btn aloca-btn">Allocated - 200</div>
                                                </span><span>
                                                    <div class="btn present-btn ms-2 text-white">Present - 190</div>
                                                </span><span>
                                                    <div class="btn present-btn ms-2 text-white ">Absent - 10</div>
                                                </span></span><br><br>
                                            <span class="fs-5 font-bold mb-0">B - Shift <span class="ms-2">
                                                    <div class="btn aloca-btn">Allocated - 400</div>
                                                </span><span>
                                                    <div class="btn present-btn ms-2 text-white">Yet To Start</div>
                                                </span><span>
                                                    <div class="btn present-btn ms-2 text-white d-none"></div>
                                                </span></span><br><br>
                                            <span class="fs-5 font-bold mb-0">C - Shift <span class="ms-2">
                                                    <div class="btn aloca-btn">Allocated - 400</div>
                                                </span><span>
                                                    <div class="btn present-btn ms-2 text-white">Yet To Start</div>
                                                </span><span>
                                                    <div class="btn present-btn ms-2 text-white d-none"></div>
                                                </span></span><br><br>
                                        </div>
                                        <div class="col-lg-3 ms-3">
                                            <h4 class="text-center mb-3 fs-5">Shift Allocation</h4>
                                            <canvas id="ShiftDonut" class="mt-5" style="width:100%;max-width:600px"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- </main> -->
                        <div class="col-md-12 grid-margin stretch-card " style="margin-top: -6%;">
                            <div class="card position-relative">
                                <div class="card-body">
                                    <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div class="row bg-white">
                                                    <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                                        <div class="ml-xl-4 mt-3">
                                                            <p class="card-title">Total Employees</p>
                                                            <h1 class="text-primary">1400</h1>
                                                            <h3 class="font-weight-500 mb-xl-4 text-primary">Chennai Branch</h3>
                                                            <!-- <p class="mb-2 mb-xl-0">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p> -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-xl-9">
                                                        <div class="row">
                                                            <div class="col-md-6 border-right">
                                                                <div class="table-responsive mt-3" style="overflow:hidden;">
                                                                    <table class="table table-borderless p-2">
                                                                        <tr>
                                                                            <td class="">Human Resources</td>
                                                                            <td class="w-100 px-0">
                                                                                <div class="progress progress-md mx-4">
                                                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <h5 class="font-weight-bold mb-0">10</h5>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="">Finance and <br> Accounting</td>
                                                                            <td class="w-100 px-0">
                                                                                <div class="progress progress-md mx-4">
                                                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <h5 class="font-weight-bold mb-0">20</h5>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="">Sales and <br>Marketing</td>
                                                                            <td class="w-100 px-0">
                                                                                <div class="progress progress-md mx-4">
                                                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <h5 class="font-weight-bold mb-0">65</h5>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class=" ">Production</td>
                                                                            <td class="w-100 px-0">
                                                                                <div class="progress progress-md mx-4">
                                                                                    <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <h5 class="font-weight-bold mb-0">1039</h5>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class=" ">Quality Control</td>
                                                                            <td class="w-100 px-0">
                                                                                <div class="progress progress-md mx-4">
                                                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <h5 class="font-weight-bold mb-0">250</h5>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="">Security</td>
                                                                            <td class="w-100 px-0">
                                                                                <div class="progress progress-md mx-4">
                                                                                    <div class="progress-bar bg-dark" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <h5 class="font-weight-bold mb-0">16</h5>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mt-3">
                                                                <div class="row justify-content-center">
                                                                    <div class="col-md-8">
                                                                        <canvas class="" style="margin-top: 10%;" id="myChart"></canvas>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="carousel-item">
                                            <div class="row">
                                                <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                                    <div class="ml-xl-4 mt-3">
                                                        <p class="card-title">Detailed Reports</p>
                                                        <h1 class="text-primary">$34040</h1>
                                                        <h3 class="font-weight-500 mb-xl-4 text-primary">North America</h3>
                                                        <p class="mb-2 mb-xl-0">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-xl-9">
                                                    <div class="row">
                                                        <div class="col-md-6 border-right">
                                                            <div class="table-responsive mb-3 mb-md-0 mt-3">
                                                                <table class="table table-borderless report-table">
                                                                    <tr>
                                                                        <td class="">Illinois</td>
                                                                        <td class="w-100 px-0">
                                                                            <div class="progress progress-md mx-4">
                                                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-weight-bold mb-0">713</h5>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="">Washington</td>
                                                                        <td class="w-100 px-0">
                                                                            <div class="progress progress-md mx-4">
                                                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-weight-bold mb-0">583</h5>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="">Mississippi</td>
                                                                        <td class="w-100 px-0">
                                                                            <div class="progress progress-md mx-4">
                                                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-weight-bold mb-0">924</h5>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="">California</td>
                                                                        <td class="w-100 px-0">
                                                                            <div class="progress progress-md mx-4">
                                                                                <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-weight-bold mb-0">664</h5>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="">Maryland</td>
                                                                        <td class="w-100 px-0">
                                                                            <div class="progress progress-md mx-4">
                                                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-weight-bold mb-0">560</h5>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="">Alaska</td>
                                                                        <td class="w-100 px-0">
                                                                            <div class="progress progress-md mx-4">
                                                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-weight-bold mb-0">793</h5>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mt-3">
                                                            <canvas id="south-america-chart"></canvas>
                                                            <div id="south-america-legend"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 stretch-card grid-margin">
                                <div class="card" style="overflow-x: hidden !important;">
                                    <div class="card-body overflow-auto">
                                        <p class="card-title  text-center pt-3">Attendance</p>
                                        <div class="table-responsive ">
                                            <table class="table table-borderless ">
                                                <thead>
                                                    <tr>
                                                        <th class="pl-0  pb-2 border-bottom">Department</th>
                                                        <th class="border-bottom pb-2">Present</th>
                                                        <th class="border-bottom pb-2">Absent</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="pl-0 ">Human Resources</td>
                                                        <td>
                                                            <p class="mb-0"><span class="font-weight-bold mr-2">65</span></p>
                                                        </td>
                                                        <td class="">6</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0">Finance and
                                                            Accounting</td>
                                                        <td>
                                                            <p class="mb-0"><span class="font-weight-bold mr-2">54</span></p>
                                                        </td>
                                                        <td class="">5</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0">Sales and
                                                            Marketing</td>
                                                        <td>
                                                            <p class="mb-0"><span class="font-weight-bold mr-2">22</span></p>
                                                        </td>
                                                        <td class="">2</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0">Production</td>
                                                        <td>
                                                            <p class="mb-0"><span class="font-weight-bold mr-2">46</span></p>
                                                        </td>
                                                        <td class="">5</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0">Quality Control
                                                        </td>
                                                        <td>
                                                            <p class="mb-0"><span class="font-weight-bold mr-2">17</span></p>
                                                        </td>
                                                        <td class="">2</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0">Security</td>
                                                        <td>
                                                            <p class="mb-0"><span class="font-weight-bold mr-2">52</span></p>
                                                        </td>
                                                        <td class="">7</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="d-flex justify-content-center mt-5">
                                                <div class="btn " style="padding: 6px 50px !important;">view</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 stretch-card grid-margin">
                                <div class="card">
                                    <div class="card-body mb-2" style="height: 25vh !important;">
                                        <p class="card-title text-center">Visitor Schedule</p>
                                        <div class="charts-data">
                                            <div class="mt-3">
                                                <p class="mb-0 text-center p-3" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">Today - <span>5</span></p>
                                            </div>
                                            <div class="mt-3">
                                                <p class="mb-0 text-center p-3" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">Upcoming .....</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 stretch-card grid-margin grid-margin-md-0 ">
                                        <div class="card data-icon-card-primary rounded-5" style=" background-color: #063554;">
                                            <div class="card-body">
                                                <p class="card-title text-white text-center">Upcoming Meetings</p>
                                                <div class="row mb-5">
                                                    <div class="col-12 text-white">
                                                        <p class="text-white  mb-0 text-center">Meeting Date <br> Meeting Title</p>
                                                    </div>
                                                    <div class="col-4 background-icon">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 stretch-card grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-title text-center">Late Attendees</p>
                                        <ul class="icon-data-list">
                                            <li>
                                                <div class="d-flex mb-4">
                                                    <div class="face-img">
                                                        <img src="./assets/images/faces/face10.jpg" alt="user">
                                                        <div>
                                                            <p class="text-primary  mb-1">Bala</p>
                                                            <p class="mb-0">Login Time - <span>09:30 Am</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex mb-4">
                                                    <div class="face-img">
                                                        <img src="./assets/images/faces/face2.jpg" alt="user">
                                                        <div>
                                                            <p class="text-primary mb-1 ">Adam Warren</p>
                                                            <p class="mb-0">Login Time - <span>09:30 Am</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex mb-2">
                                                    <div class="face-img">
                                                        <img src="./assets/images/faces/face12.jpg" alt="user">
                                                        <div>
                                                            <p class="text-primary  mb-1">Leonard Thornton</p>
                                                            <p class="mb-0">Login Time - <span>09:30 Am</span></p>
                                                        </div>

                                                    </div>
                                                </div>
                                                <a href="ex-late-attendees.php">
                                                    <div class="btn">View</div>
                                                </a>
                                            </li>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- To Emplyoee Tabile -->
                    <div class="card shadow border-0 mt-5">
                        <div class="card-header">
                            <h5 class="fs-4">Latest Entries</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="">
                                    <tr class="table-row">
                                        <th scope="col">NAME</th>
                                        <th scope="col">DEPARTMENT</th>
                                        <th scope="col">DATE</th>
                                        <th scope="col">SHIFT</th>
                                        <th scope="col">LOGIN TIME</th>
                                        <th scope="col">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <tr class="table-row">
                                        <td class="text-start">
                                            <img alt="..." src="https://images.unsplash.com/photo-1502823403499-6ccfcf4fb453?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" style="width: 50px" class="avatar avatar-sm rounded-circle me-2">
                                            <a class=" text-dark" href="#">
                                                Robert Fox
                                            </a>
                                        </td>
                                        <td>Human Resourses</td>
                                        <td>
                                            Feb 15, 2021
                                        </td>
                                        <td>
                                            General Shift
                                        </td>
                                        <td>
                                            09:00AM
                                        </td>

                                        <td class="">
                                            <a href="ex-late-entries-history.php" class="btn btn-sm btn-neutral text-white">View History</a>

                                        </td>
                                    </tr>
                                    <tr class="table-row">
                                        <td class="text-start">
                                            <img alt="..." src="https://images.unsplash.com/photo-1610271340738-726e199f0258?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" style="width: 50px" class="avatar avatar-sm rounded-circle me-2">
                                            <a class="text-dark" href="#">
                                                Darlene Robertson
                                            </a>
                                        </td>
                                        <td class="">Production</td>
                                        <td>
                                            Apr 15, 2021
                                        </td>
                                        <td>
                                            General Shift
                                            </a>
                                        </td>
                                        <td>
                                            09:00AM
                                        </td>

                                        <td class="">
                                            <a href="#" class="btn btn-sm btn-neutral text-white">View History</a>

                                        </td>
                                    </tr>
                                    <tr class="table-row">
                                        <td class="text-start">
                                            <img alt="..." src="https://images.unsplash.com/photo-1610878722345-79c5eaf6a48c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" style="width: 50px" class="avatar avatar-sm rounded-circle me-2">
                                            <a class="text-dark" href="#">
                                                Theresa Webb
                                            </a>
                                        </td>
                                        <td>
                                            Quality Control
                                        </td>
                                        <td>
                                            Mar 20, 2021
                                        </td>
                                        <td>
                                            General Shift
                                        </td>
                                        <td>
                                            09:00AM
                                        </td>

                                        <td class="">
                                            <a href="#" class="btn btn-sm btn-neutral text-white">View History</a>

                                        </td>
                                    </tr>
                                    <tr class="table-row">
                                        <td class="text-start">
                                            <img alt="..." src="https://images.unsplash.com/photo-1612422656768-d5e4ec31fac0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" style="width: 50px" class="avatar avatar-sm rounded-circle me-2">
                                            <a class="text-dark" href="#">
                                                Kristin Watson
                                            </a>
                                        </td>
                                        <td>
                                            Sales And Marketing
                                        </td>
                                        <td>
                                            Feb 15, 2021
                                        </td>
                                        <td>
                                            General Shift
                                        </td>
                                        <td>
                                            09:00AM
                                        </td>

                                        <td class="">
                                            <a href="#" class="btn btn-sm btn-neutral text-white"> view History</a>

                                        </td>
                                    </tr>
                                    <tr class="table-row">
                                        <td class="text-start">
                                            <img alt="..." src="https://images.unsplash.com/photo-1608976328267-e673d3ec06ce?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" style="width: 50px" class="avatar avatar-sm rounded-circle me-2">
                                            <a class="text-dark" href="#">
                                                Cody Fisher
                                            </a>
                                        </td>
                                        <td>
                                            Security
                                        </td>
                                        <td>
                                            Apr 10, 2021
                                        </td>
                                        <td>
                                            General Shift
                                        </td>
                                        <td>
                                            09:0AM
                                        </td>

                                        <td class="">
                                            <a href="#" class="btn btn-sm btn-neutral text-white">View History</a>

                                        </td>
                                    </tr>



                                </tbody>
                            </table>
                        </div>
                        <div class=" bg-white mb-4 mt-sm-3">
                            <!-- <span class=" text-sm">Showing 10 items out of 250 results found</span> -->
                            <div class="text-center">
                                <div class="btn  rounded-3 paginationg-btn me-2"><i class="fa-solid fa-angle-left"></i> Prev</div>
                                <div class="btn  rounded-3 paginationg-btn">Next <i class="fa-solid fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>



    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>





    <script>
        var xValues = ["HR", "F&A", "S&M", "PR", "QC", "SEC"];
        var yValues = [10, 20, 65, 1039, 250, 16];
        var barColors = [
            "blue",
            "orange",
            "red",
            "skyblue",
            "green",
            "black"
        ];

        new Chart("myChart", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "World Wide Wine Production 2018"
                }
            }
        });
    </script>


    <script>
        var xValues = ["Shift-A", "Shift-G", "Shift-B", "Shift-C"];
        var yValues = [400, 200, 400, 400];
        var barColors = [
            "#b91d47",
            "#00aba9",
            "#2b5797",
            "#e8c3b9",
            "#1e7145"
        ];

        new Chart("ShiftDonut", {
            type: "doughnut",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true,

                }
            }
        });
    </script>
</body>

</html>