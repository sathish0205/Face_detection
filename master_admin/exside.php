
<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../links/ex.links.php'; ?>
    <link rel="stylesheet" href="ex.css">
    <style>
        .side-nav ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        .side-nav::-webkit-scrollbar-track {
            background-color: var(--my-blue);
            -webkit-border-radius: 10px;
            border-radius: 10px;
        }

        .side-nav::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: var(--my-grey);
        }

        .side-nav {
            background-color: var(--my-blue);
        }

        .side-head {
            padding: 15px 20px;
            transition: all 0.2s ease-in-out;
            border-radius: 5px;
            cursor: pointer; /* Indicate that the div is clickable */
        }

        .side-head:hover {
            background-color: var(--my-grey);
        }

        .side-head:hover a {
            color: var(--my-black);
        }

        .active {
            background-color: var(--my-grey);
        }

        a {
            text-decoration: none;
            color: var(--my-white);
        }

        .active a {
            color: var(--my-black);
        }

        @media (max-width: 1218px) {
            .side-nav {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 side-nav position-fixed  overflow-auto m-1 rounded-3" style="margin-top: 6% !important;height: 100vh;">
                <div class="row p-3 summa mb-1">
                    <div class="col-lg-12 mb-3  text-white side-head <?php echo ($current_page == 'ex-dashboard.php') ? 'active' : ''; ?>" onclick="window.location.href='ex-dashboard.php'">
                        <a href="ex-dashboard.php"><i class="fa-solid fa-chart-line pe-1"></i>Dashboard</a>
                    </div>
                    <div class="col-lg-12 mb-3   text-white side-head <?php echo ($current_page == 'ex-add-admin.php') ? 'active' : ''; ?>" onclick="window.location.href='ex-add-admin.php'">
                        <a href="ex-add-admin.php"><i class="fa-solid fa-user-plus pe-2"></i>Add Admin</a>
                    </div>
                    <div class="col-lg-12 mb-3  text-white side-head <?php echo ($current_page == 'ex-department-creation.php') ? 'active' : ''; ?>" onclick="window.location.href='ex-department-creation.php'">
                        <a href="ex-department-creation.php"><i class="fa-solid fa-layer-group pe-2"></i>Create Department</a>
                    </div>
                    <div class="col-lg-12 mb-3  text-white side-head <?php echo ($current_page == 'ex-designation.php') ? 'active' : ''; ?>" onclick="window.location.href='ex-designation.php'">
                        <a href="ex-designation.php"><i class="fa-solid fa-layer-group pe-2"></i>Create Designation</a>
                    </div>
                    <div class="col-lg-12 mb-3  text-white side-head <?php echo ($current_page == 'ex-page-access.php') ? 'active' : ''; ?>" onclick="window.location.href='ex-page-access.php'">
                        <a href="ex-page-access.php"><i class="fa-solid fa-lock-open pe-2"></i>Page Access</a>
                    </div>
                    <div class="col-lg-12 mb-3  text-white side-head <?php echo ($current_page == 'ex-shift-creation.php') ? 'active' : ''; ?>" onclick="window.location.href='ex-shift-creation.php'">
                        <a href="ex-shift-creation.php"><i class="fa-solid fa-clipboard-user pe-2"></i>Shift Creation</a>
                    </div>
                    <div class="col-lg-12 mb-3  text-white side-head <?php echo ($current_page == 'ex.holiday.php') ? 'active' : ''; ?>" onclick="window.location.href='ex.holiday.php'">
                        <a href="ex.holiday.php"><i class="fa-solid fa-clipboard-user pe-2"></i>Holiday Configuration</a>
                    </div>                 
                    <div class="col-lg-12 mb-3  text-white side-head <?php echo ($current_page == 'ex-setting.php') ? 'active' : ''; ?>" onclick="window.location.href='ex-setting.php'">
                        <a href="ex-setting.php"><i class="fa-solid fa-gear pe-2"></i>Settings</a>
                    </div>

                    <div class="col-lg-12 mb-3  text-white side-head <?php echo ($current_page == 'add_camera.php') ? 'active' : ''; ?>" onclick="window.location.href='add_camera.php'">
                        <a href="ex-setting.php"><i class="fa-solid fa-camera pe-2"></i>Settings</a>
                    </div>

                    <!-- <div class="col-lg-12 mb-3  text-white side-head <?php echo ($current_page == 'three.php') ? 'active' : ''; ?>" onclick="window.location.href='three.php'">
                        <a href="three.php"><i class="fa-solid fa-gear pe-2"></i>Three pages</a>
                    </div> -->
                  
                </div>
            </div>
        </div>
    </div>
</body>
</html>