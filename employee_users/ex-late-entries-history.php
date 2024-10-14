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

        #main-panel {
            background-color: #002379;
            height: 100px;
            width: 100%;
            border-radius: 0.5rem;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #fff;
            margin-bottom: 1rem;
        }

        #main-panel h3 {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        .fa-download,
        .fa-share,
        .fa-print {
            color: #fff;
            margin-right: 20px;
            cursor: pointer;
        }

        .date-emp {
            color: grey;
        }

        .emp-container {
            height: 30vh;
            padding: 20px 40px !important;
            padding-top: 30px !important;
        }

        .details-container,
        .emp-container,
        .profile-container,
        .contact-info,
        .activity-log,
        .performance-metrics,
        .leave-summary,
        .skills-qualifications,
        .project-involvement,
        .feedback-reviews {
            background-color: #fff;
            border-radius: 0.5rem;
            padding: 1rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
        }

        .details-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .icon,
        .icon-check {
            height: 50px;
            width: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon {
            color: #002379;
            border: 1px solid #002379;
        }

        .icon-check {
            background-color: #2C7865;
            color: #fff;
        }

        .next {
            color: blue;
            margin: 0 10px;
        }

        .emp-container h3,
        .emp-container h4,
        .emp-container h5,
        .emp-container p,
        .profile-container h5,
        .profile-container p,
        .contact-info h4,
        .activity-log h4,
        .performance-metrics h4,
        .leave-summary h4,
        .skills-qualifications h4,
        .project-involvement h4,
        .feedback-reviews h4 {
            margin-bottom: 1rem;
        }

        .activity-log ul {
            list-style-type: none;
            padding: 0;
        }

        .activity-log ul li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #ddd;
        }

        .activity-log ul li:last-child {
            border-bottom: none;
        }

        .performance-metrics canvas {
            max-width: 100%;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <?php include 'exnavbar.php'; ?>
            <?php include 'exside.php'; ?>
            <div class="col-lg-2"></div>
            <div class="col-lg-10 right-side-section">
                <section class="m-4">
                    <div class="row">
                        <div class="col-lg-12" style="background-color:#063554 ;" id="main-panel">
                            <h3 class="font-weight-bold text-white ">Employee Name: <span style="color:turquoise"> Bala</span></h3>

                            <div>
                                <i class="fa-solid fa-download"></i>
                                <i class="fa-solid fa-share"></i>
                                <i class="fa-solid fa-print"></i>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Profile Section -->
                        <div class="col-md-4">
                            <div class="profile-container ps-5">
                                <img src="./assets/images/faces/face1.jpg" alt="Profile Picture" class="profile-img mb-3" style="border-radius: 50%;">
                                <div class="profile-info">
                                    <!-- <h5>Bala</h5> -->
                                    <p><i class="fas fa-envelope"></i> bala@example.com</p>
                                    <p><i class="fas fa-phone"></i> (123) 456-7890</p>
                                    <!-- <p><i class="fas fa-map-marker-alt"></i> 123 Main St, City, Country</p> -->
                                </div>
                            </div>
                        </div>

                        <!-- Employee Info Section -->
                        <div class="col-md-8">
                            <div class="emp-container">
                                <h3><i class="fas fa-building"></i> Department: Production</h3>
                                <h5 class="date-emp">May 22, 2024</h5>
                                <p class="text-dark"><i class="fas fa-sign-in-alt"></i> Login-Time: 09:00 AM</p>
                                <p class="text-dark"><i class="fas fa-sign-out-alt"></i> Logout-Time: 06:00 PM</p>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-6">
                            <div class="details-container">
                                <div class="d-flex align-items-center p-5">
                                    <div class="icon"><i class="fa-solid fa-camera-retro"></i></div>
                                    <p class="next"><i class="fa-solid fa-angle-right"></i></p>
                                    <div>
                                        <p class="mb-1">Camera-1 <i class="fa-solid fa-arrow-right pe-2"></i>Main Gate IN</p>
                                        <h6>09:00 - AM</h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="details-container">
                                <div class="d-flex align-items-center p-5">
                                    <div class="icon"><i class="fa-solid fa-camera-retro"></i></div>
                                    <p class="next"><i class="fa-solid fa-angle-right"></i></p>
                                    <div>
                                        <p class="mb-1">Camera-2 <i class="fa-solid fa-arrow-right pe-2"></i>Main Gate OUT</p>
                                        <h6>06:05 - PM</h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="details-container">
                                <div class="d-flex align-items-center p-5">
                                    <div class="icon"><i class="fa-solid fa-camera-retro"></i></div>
                                    <p class="next"><i class="fa-solid fa-angle-right"></i></p>
                                    <div>
                                        <p class="mb-1">Camera-3 <i class="fa-solid fa-arrow-right pe-2"></i>Production Dept.. IN</p>
                                        <h6>09:05 - AM</h6>
                                        <h6>10:40 - AM</h6>
                                        <h6>12:40 - PM</h6>
                                        <h6>03:40 - PM</h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="details-container">
                                <div class="d-flex align-items-center p-5">
                                    <div class="icon"><i class="fa-solid fa-camera-retro"></i></div>
                                    <p class="next"><i class="fa-solid fa-angle-right"></i></p>
                                    <div>
                                        <p class="mb-1">Camera-4 <i class="fa-solid fa-arrow-right pe-2"></i>Production Dept.. OUT</p>
                                        <h6>10:30 - AM</h6>
                                        <h6>12:30 - AM</h6>
                                        <h6>03:30 - PM</h6>
                                        <h6>06:00 - PM</h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Contact Info Section -->
                        <div class="col-md-6">
                            <div class="contact-info">
                                <h4>Contact Information</h4>
                                <p> Emergency Contact: Bala - (123) 456-7890</p>
                                <p> Address: <a href="#">123,street</a></p>
                                <p>Email: <a href="#">123@mail.com</a></p>
                            </div>
                        </div>

                        <!-- Leave Summary Section -->
                        <div class="col-md-6">
                            <div class="leave-summary">
                                <h4>Leave Summary</h4>
                                <p>Total Leaves: 12</p>
                                <p>Used Leaves: 5</p>
                                <p>Remaining Leaves: 7</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Activity Log Section -->
                        <div class="col-md-6">
                            <div class="activity-log " style="padding-bottom: 40px;">
                                <h4>Recent Activities</h4>
                                <ul>
                                    <li>Production Dept OUT at 10:30 PM</li>
                                    <li>Production Dept IN at 10:40 PM</li>
                                    <li>Production Dept OUT at 03:30 PM</li>
                                    <li>Production Dept IN at 3:40 PM</li>
                                    <li> Production Dept OUT at 06:00 PM</li>
                                    <li>Main Gate OUT Time 06:05 PM</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Performance Metrics Section -->
                        <div class="col-md-6">
                            <div class="performance-metrics">
                                <h4>Performance Metrics</h4>
                                <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="feedback-reviews">
                            <div class="col-lg-12 p-3">
                                <h4>Feedback reviews</h4>
                                <h5>Nesan - [supervisor] </h5>
                                <p>[23-May-2024]-Excellent Team Player</p>
                            </div>

                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <script>
    var xValues = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
    var yValues = [10.00, 7.55, 8.00, 8.00, 7.49, 8.00, 0];
    var barColors = ["red", "green", "blue", "orange", "red", "black", "grey"];

    var myChart = new Chart("myChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: "Effective Working Hours"
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    document.getElementById("myChart").addEventListener("wheel", function(event) {
        event.preventDefault();
        var increment = event.deltaY < 0 ? 0.1 : -0.1;

        yValues = yValues.map(function(value) {
            return Math.max(0, value + increment); // Ensure value doesn't go below 0
        });

        myChart.data.datasets[0].data = yValues;
        myChart.update();
    });
</script>
</body>

</html>