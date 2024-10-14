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

        .table {
            border: 1px solid var(--my-grey);
        }

        .table-row th {
            text-align: center;
            font-size: var(--th-fonts) !important;
            padding: 20px !important;
            white-space: nowrap;
            text-transform: uppercase;
        }

        .table-row td {
            text-align: center;
            padding: 15px !important;
            font-size: var(--td-fonts);
            padding-top: 20px !important;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: black;
            /* Change this color as needed */
            color: black !important;
            border-radius: 50%;
            padding: 15px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <?php include 'exnavbar.php'; ?>
            <?php include 'exside.php'; ?>
            <div class="col-lg-2"></div>
            <div class="col-lg-10 right-side-section">
                <section class="m-4">
                    <div class="row mb-3">
                        <div class="col-lg-12 fs-3">
                        Unknown Visitor
                        </div>
                    </div>
                    <div class="row mb-5">
                    <div class="col-lg-4 col-6">
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
                        <div class="col-lg-8 text-end col-6">
                            <div class="btn" style="padding: 14px 60px !important;" >Train</div>
                            <div class="btn ms-3" style="padding: 14px 60px !important;">Merge</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <div id="employee_table"></div>


                            </div>
                        </div>
                        <div class="col-lg-12 text-center mt-5">
                            <div class="btn"><i class="fa-solid fa-angle-left pe-1"></i> Prev</div>
                            <div class="btn ms-2">Next <i class="fa-solid fa-angle-right ps-1"></i></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>



    <!--unknown visitor Modal -->
    <div class="modal fade" id="unknown-visitor-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content p-5">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Visitor Entry</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="row mt-1">
                    <div class="col-lg-6">
                        <div id="carouselExampleIndicators" class="carousel slide mb-3">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active " style="margin-left: 35%;">
                                    <img src="..//assets/images/faces/face1.jpg" class="d-block " style="width: 200px;" alt="...">
                                </div>
                                <div class="carousel-item" style="margin-left: 35%;">
                                    <img src="..//assets/images/faces/face1.jpg" class="d-block" style="width: 200px;" alt="...">
                                </div>
                                <div class="carousel-item" style="margin-left: 35%;">
                                    <img src="..//assets/images/faces/face1.jpg" class="d-block " style="width: 200px;" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev text-dark" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon text-dark" aria-hidden="true"></span>
                                <span class="visually-hidden bg-dark text-center">Prev</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" style="color: black !important;" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <form action="">
                            <div class="form-floating mb-4" style="margin-top: 10%;">
                                <select class="form-select" id="categorySelect" aria-label="Floating label select example">
                                    <option selected>Visitor</option>
                                    <option value="vendor">Vendor</option>
                                    <option value="others">Others</option>
                                </select>
                                <label for="categorySelect">Category</label>
                            </div>
                            <div class="form-floating mb-4" id="nameInput">
                                <input type="text" class="form-control" id="floatingInput" placeholder="">
                                <label for="floatingInput">Name</label>
                            </div>
                            <div class="form-floating mb-4" id="organizationInput">
                                <input type="text" class="form-control" id="floatingOrganization" placeholder="">
                                <label for="floatingOrganization">Organization / Company</label>
                            </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-floating mb-4" id="purposeInput">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                            <label for="floatingTextarea">Purpose Of Visit</label>
                        </div>
                        <div class="form-floating mb-4" id="devicesInput">
                            <input type="text" class="form-control" id="floatingDevices" placeholder="">
                            <label for="floatingDevices">Devices if Any</label>
                        </div>
                        <div class="mb-4" id="idProofInput">
                            <input type="file" class="form-control p-3" id="floatingIDProof" placeholder="">
                        </div>
                        <div class="form-floating mb-4" id="toMeetInput">
                            <input type="text" class="form-control" id="floatingToMeet" placeholder="">
                            <label for="floatingToMeet">To Meet</label>
                        </div>
                        <div class="form-floating mb-4" id="departmentInput">
                            <input type="text" class="form-control" id="floatingDepartment" placeholder="">
                            <label for="floatingDepartment">Department</label>
                        </div>
                        <div class=" mb-4 d-none" id="otherInfoInput">
                            <textarea class="form-control" placeholder="Please specify Reasons" rows="5" id="floatingOtherInfo"></textarea>
                        </div>
                        <div class="text-center mt-5">
                            <button type="button" class="btn" style="padding: 10px 40px !important;">Save</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Visitor Entry category option category code -->
    <script>
        $(document).ready(function() {
            $('#categorySelect').change(function() {
                if ($(this).val() === 'others') {
                    $('#nameInput, #organizationInput, #purposeInput, #devicesInput, #idProofInput, #toMeetInput, #departmentInput').hide();
                    $('#otherInfoInput').removeClass('d-none');
                } else {
                    $('#nameInput, #organizationInput, #purposeInput, #devicesInput, #idProofInput, #toMeetInput, #departmentInput').show();
                    $('#otherInfoInput').addClass('d-none');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            function loadTable() {
                $.ajax({
                    url: '../data_get/unknown_fetch_rec.php',
                    type: 'post',
                    success: function(response) {
                        $('#employee_table').html(response);
                    }
                });
            }

            loadTable();

            // Auto refresh every 5 seconds
            setInterval(function() {
                loadTable();
            }, 5000);
        });
    </script>
</body>

</html>