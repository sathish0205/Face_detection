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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* *::-webkit-scrollbar {
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
        } */

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
            padding: 15px;
            font-size: var(--th-fonts);
            border: 1px solid var(--my-grey);
            /* Add border to cells */
        }

        .table-row td {
            text-align: center;
            padding: 15px;
            font-size: var(--td-fonts);
            white-space: nowrap;
            border: 1px solid var(--my-grey);
            background-color: var(--my-grey) !important;
            /* Add border to cells */
        }

        .table-row td:hover {
            background-color: var(--my-white) !important;
        }


        .table-row th:first-child {
            padding: 15px;
            /* Adjust padding for S.No column */
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include 'exnavbar.php'; ?>
            <?php include 'exside.php'; ?>
            <div class="col-lg-2"></div>
            <div class="col-lg-10 right-side-section">
                <div id="toast-container" class="toast-container p-1"></div>
                <section class="m-4">
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            <h2 class="fs-3">Department</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="border p-lg-5 text-center rounded-4" style="border: 2px solid #ccc;">
                                <i class="bi bi-plus-lg fs-5" style="color: #ccc;"></i>
                            </div>
                        </div>
                        <div class="col-lg-3">
                        <div class="border p-lg-5 text-center rounded-4 text-white" style="background-color: var(--my-blue);">
                                <h5>HR</h5>
                            </div>
                        </div>
                        <div class="col-lg-3">
                        <div class="border p-lg-5 text-center rounded-4 text-white" style="background-color: var(--my-blue);">
                        <h5 style="letter-spacing: 2px;">CANTEEN</h5>
                        </div>
                        </div>
                        <div class="col-lg-3">
                        <div class="border p-lg-5 text-center rounded-4 text-white" style="background-color: var(--my-blue);">
                                <h5>SECURITY</h5>
                            </div>
                        </div>
                        
                    </div>

                </section>
            </div>
        </div>
    </div>


    <!--add admin  Modal -->

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</html>